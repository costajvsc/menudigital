<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => '/api'], function () use ($router) {
    $router->group(['prefix' => 'produtos'], function () use ($router) {    
        $router->get('/', 'ProdutoController@index');
        $router->post('/', 'ProdutoController@store');
        $router->get('/{id_aluno}', 'ProdutoController@show');
        $router->put('/{id_aluno}', 'ProdutoController@update');
        $router->delete('/{id_aluno}', 'ProdutoController@destroy');
    });

    $router->group(['prefix' => 'pedidos'], function () use ($router) {    
        $router->get('/', 'PedidoController@index');
        $router->get('/itens/{id_sala}', 'PedidoController@itens_pedido');
        $router->post('/', 'PedidoController@store');
        $router->get('/{id_sala}', 'PedidoController@show');
        $router->put('/{id_sala}', 'PedidoController@update');
    });

    $router->group(['prefix' => 'funcionarios'], function () use ($router) {    
        $router->get('/', 'FuncionarioController@index');
        $router->post('/', 'FuncionarioController@store');
        $router->get('/{id_funcionario}', 'FuncionarioController@show');
        $router->put('/{id_funcionario}', 'FuncionarioController@update');
        $router->delete('/{id_funcionario}', 'FuncionarioController@destroy');
    });
});