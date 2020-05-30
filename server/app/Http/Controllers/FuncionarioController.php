<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    public function index(Request $request)
    {
        return Funcionario::all();
    }

    public function show(int $id_funcionario)
    {
        $funcionario = Funcionario::find($id_funcionario);
        
        if (is_null($funcionario))
            return response()->json('', 204);

        return response()->json($funcionario);
    }

    public function store(Request $request)
    {
        $funcionario = Funcionario::create($request->all());
        
        if(empty($produto))
            return response()->json(['erro' => 'Erro ao inserir funcionairo.'], 404);

        return response()->json(['message' => 'Funcionario inserido com sucesso!'], 201);
    }

    public function update(int $id_funcionario, Request $request)
    {
        $funcionario = Funcionario::find($id_funcionario);

        if(is_null($funcionario))
            return response()->json('',204);

        $funcionario->fill($request->all());
        $funcionario->savef();

        return response()->json($funcionario, 200);
    }

    public function destroy(int $id_pedido)
    {
        $qnt = Funcionario::destroy($id_aluno);

        if($qnt === 0)
            return response()->json(['error' => 'Erro ao remover funcionario'], 404);

        return response()->json('Funcionario removido com sucesso', 204);
    }
}
