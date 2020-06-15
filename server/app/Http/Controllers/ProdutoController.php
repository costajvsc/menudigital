<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;    

class ProdutoController 
{
    public function index(Request $request)
    {
        return Produto::all();
    }

    public function show(int $id_produto)
    {
        $produto = Produto::find($id_produto);

        if (is_null($produto))
            return response()->json('', 204);

        return response()->json($produto);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
            $produto = Produto::create([
                'nome_produto' => $request->nome_produto,
                'descricao' => $request->descricao,
                'preco' => $request->preco,
                'categoria' => $request->categoria,
                'status' => ($request->status == 'ativo') ? 1 : 0,
                'ext' => $request->file('img_produto')->extension()
            ]);
            $request->file('img_produto')->move('img/produtos', $produto->id_produto.'.'.$produto->ext);
        DB::commit();

        if(empty($produto))
            return response()->json(['erro' => 'Erro ao inserir produto'], 404);

        return response()->json(['message' => 'Produto inserido com sucesso!'], 201);
    }

    public function destroy(int $id_produto)
    {
        $itens = DB::table('itens_pedido')->select('id_produto')->where('id_produto', '=', "{$id_produto}")->first();

        if(is_null($itens))
        {
            $produto = Produto::find($id_produto);

            if (is_null($produto))
                return response()->json('', 204);

            $image_path = "img/produtos/".$id_produto.".".$produto->ext;
            if (File::exists($image_path))
                File::delete($image_path);
            
            $qnt = Produto::destroy($id_produto);
            if($qnt === 0)
                return response()->json(['erro' => 'Erro ao excluir o produto, contate o administrador do sistema'], 404);
                
            return response()->json('', 204);

        }
        return response()->json(['erro' => 'Não é possível excluir o produto em questão!'], 404);
    }

    public function update(int $id_produto, Request $request)
    {
        $produto = Produto::find($id_produto);
        if(empty($produto))
            return response()->json(['erro' => 'Produto não encontrado'], 404);

        DB::beginTransaction();
        if(isset($request->img_produto))
        {
            $produto->nome_produto = $request->nome_produto;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->categoria = $request->categoria;
            $produto->ext = $request->file('img_produto')->extension();
            $produto->status = ($request->status == 'ativo') ? 1 : 0;
            $produto->save();

            if(File::exists("img/produtos/{$produto->id_produto}.{$produto->ext}")){
                File::delete("img/produtos/{$produto->id_produto}.{$produto->ext}");
                $request->file('img_produto')->move('img/produtos', $produto->id_produto.'.'.$produto->ext);
            }
            
            return response()->json(['message' => 'Produto e imagem alterado com sucesso!'], 200);
        }
        else
        {
            $produto->nome_produto = $request->nome_produto;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->categoria = $request->categoria;
            $produto->status = ($request->status == 'ativo') ? 1 : 0;
            $produto->save();

            return response()->json(['message' => 'Produto alterado com sucesso!'], 200);
        }
            

        return response()->json(['erro' => 'Erro ao alterar produto produto'], 404);
    }
}
