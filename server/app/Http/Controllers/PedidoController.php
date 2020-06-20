<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Pedido;
use App\ItensPedido;
use App\Mail\CreatePedido;
use App\Mail\FinishPedido;
use App\Mail\CancelPedido;

    
class PedidoController
{
    public function index(Request $request)
    {
        return Pedido::all()->where('status', '=', "Em produção");
    }

    public function show(int $id_pedido)
    {
        $pedido = Pedido::find($id_pedido);
        
        if (is_null($pedido))
            return response()->json('', 204);

        return response()->json($pedido);
    }

    public function store(Request $request)
    {
        $itens = json_decode($request->itens);
        DB::beginTransaction();
        $pedido = Pedido::create([
            "nome_cliente" => $request->nome_cliente,
            "cpf_cliente" => $request->cpf_cliente,
            "email_cliente" => $request->email_cliente,
            "telefone" => $request->telefone,
            "id_funcionario" => $request->id_funcionario,
            "status" => 'Em produção'
        ]);
        foreach ($itens as $i) 
        {
            ItensPedido::create([
                "id_pedido" => $pedido->id_pedido,
                "id_produto" => $i
            ]);
        }  
        DB::commit();

        $itens = $this->itens_pedido($pedido->id_pedido);
        $itens = json_decode($itens);
        Mail::to($pedido->email_cliente)->send(new CreatePedido($pedido, $itens));
        
        if(empty($pedido))
            return response()->json(['erro' => 'Erro ao realizar pedido'], 404);

        return response()->json(['message' => 'Pedido realizado com sucesso!'], 201);
    }

    public function update(int $id_pedido, Request $request)
    {
        $pedido = Pedido::find($id_pedido);

        if(is_null($pedido))
            return response()->json('',204);

        $pedido->fill($request->all());
        $pedido->save();

        return response()->json($pedido, 200);
    }

    public function itens_pedido(int $id_pedido)
    {
        $itens_pedido = DB::table('itens_pedido')
                    ->join('produtos', 'produtos.id_produto', '=', 'itens_pedido.id_produto')
                    ->join('pedidos', 'pedidos.id_pedido', '=', 'itens_pedido.id_pedido')
                    ->select('itens_pedido.id_item_produto', 'itens_pedido.avaliacao_produto', 'produtos.id_produto', 'produtos.nome_produto', 'pedidos.nome_cliente', 'pedidos.id_pedido')
                    ->where('itens_pedido.id_pedido', '=', "{$id_pedido}")->get();

        if(is_null($itens_pedido) || empty($itens_pedido))
            return response()->json('', 204);

        return json_encode($itens_pedido);
    }

    public function finish(int $id_pedido)
    {
        $pedido = Pedido::find($id_pedido);

        if(is_null($pedido))
            return response()->json('',204);
        
        $pedido->status = 'Finalizado';
        $pedido->save();

        Mail::to($pedido->email_cliente)->send(new FinishPedido($pedido));

        return response()->json($pedido, 200);
    }

    public function cancel(int $id_pedido)
    {
        $pedido = Pedido::find($id_pedido);

        if(is_null($pedido))
            return response()->json('',204);
        
        $pedido->status = 'Cancelado';
        $pedido->save();

        Mail::to($pedido->email_cliente)->send(new CancelPedido($pedido));

        return response()->json($pedido, 200);
    }

    public function reting(int $id_pedido, Request $request)
    {
        $pedido = Pedido::find($id_pedido);
        $avaliacoes = $request->avaliacoes;

        if(is_null($pedido))
            return response()->json('',204);
        
        $pedido->avaliacao_funcionario = $request->avaliacao_funcionario;
        $pedido->save();
        foreach ($avaliacoes as $a) 
        {
            $item = ItensPedido::find($a['id_item_produto']);
            $item->avaliacao_produto = $a['avaliacao_produto'];
            $item->save();
        }  

        return response()->json($pedido, 200);
    }
}
