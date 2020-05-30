<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        return Produto::all();
    }

    public function show(int $id_produto)
    {
        $produto = Produto::find($id);

        if (is_null($produto))
            return response()->json('', 204);

        return response()->json($produto);
    }

    public function store(Request $request)
    {
        $img = $request->file('img_produto');
        $ext = $img->getClientOriginalExtension();

        DB::beginTransaction();
            $produto = Aluno::create([
                'nome_produto' => $request->nome_produto,
                'descricao' => $request->descricao,
                'preco' => $request->preco,
                'categoria' => $request->categoria,
                'status' => ($request->status == 'ativo') ? 1 : 0,
                'ext' => $request->ext
            ]);

            $input['imgname'] = $produto->id.'.'.$ext;
            $path = public_path('/img/produtos');
            $img->move($path, $input['imgname']);
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
            $image_path = "img/produtos/".$id_produto.".jpg";
            if (File::exists($image_path))
                File::delete($image_path);
            
            $qnt = Produto::destroy($id_produto);
            if($qnt === 0)
                return response()->json('', 204);
                
            return response()->json(['erro' => 'Erro ao excluir o produto, contate o administrador do sistema'], 404);
        }
        return response()->json(['erro' => 'Não é possível excluir o produto em questão!'], 404);
    }

    public function edit(int $id_produto, Request $request)
    {
        $produto = Produto::find($id_produto);

        if(empty($produto))
            return response()->json(['erro' => 'Produto não encontrado'], 404);

        DB::beginTransaction();
        if(isset($request->img_produto))
        {
            $img = $request->file('img_produto');
            $ext = $img->getClientOriginalExtension();

            $produto->nome_produto = $request->nome_produto;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->categoria = $request->categoria;
            $produto->ext = $ext;
            $produto->status = ($request->status == 'ativo') ? 1 : 0;
            $produto->save();

            if(File::exists("img/produtos/{$produto->id_produto}.{$produto->ext}"))
                File::delete("img/produtos/{$produto->id_produto}.{$produto->ext}");

            $input['imgname'] = $request->id_produto.'.'.$ext;
            $path = public_path('/img/produtos/');
            $img->move($path, $input['imgname']);
            
            return response()->json(['message' => 'Produto alterado com sucesso!'], 200);
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
