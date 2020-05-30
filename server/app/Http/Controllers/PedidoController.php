<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;
use App\Produto;
use App\Pedido;
use App\ItensPedido;


class PedidoController extends Controller
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
            "status" => 'Em produção',
            "id_funcionario" => 1
        ]);
        foreach ($itens as $i) 
        {
            ItensPedido::create([
                "id_pedido" => $i->id_pedido,
                "id_produto" => $i->id_produto
            ]);
        }  
        DB::commit();
        
        if(empty($produto))
            return response()->json(['erro' => 'Erro ao realizar pedido'], 404);

        return response()->json(['message' => 'Pedido realizado com sucesso!'], 201);
    }

    public function update(int $id_pedido, Request $request)
    {
        $pedido = Pedido::find($request->id_pedido);

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
                    ->select('itens_pedido.id_item','produtos.nome_produto','pedidos.nome_cliente', 'pedidos.id_pedido')
                    ->where('itens_pedido.id_pedido', '=', "{$request->id_pedido}")->get();

        if(is_null($itens_pedido))
            return response()->json('', 204);
            
        return json_encode($itens_pedido);
    }

    
}
