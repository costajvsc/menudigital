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
        $router->get('/{id_produto}', 'ProdutoController@show');
        $router->put('/{id_produto}', 'ProdutoController@update');
        $router->delete('/{id_produto}', 'ProdutoController@destroy');
    });

    $router->group(['prefix' => 'pedidos'], function () use ($router) {    
        $router->get('/', 'PedidoController@index');
        $router->get('/{id_pedido}', 'PedidoController@show');
        $router->get('/itens/{id_pedido}', 'PedidoController@itens_pedido');
        $router->post('/', 'PedidoController@store');
        $router->put('/finish/{id_pedido}', 'PedidoController@finish');
        $router->put('/cancel/{id_pedido}', 'PedidoController@cancel');
        $router->put('/reting/{id_pedido}', 'PedidoController@reting');
        
    });

    $router->group(['prefix' => 'funcionarios'], function () use ($router) {    
        $router->get('/', 'FuncionarioController@index');
        $router->post('/', 'FuncionarioController@store');
        $router->get('/{id_funcionario}', 'FuncionarioController@show');
        $router->put('/{id_funcionario}', 'FuncionarioController@update');
        $router->delete('/{id_funcionario}', 'FuncionarioController@destroy');
    });
});
Route::get('/product', function () { return view('meta/produto'); });
Route::get('/dashboard', function () { return view('meta/dashboard'); });
Route::get('/', 'ProdutoController@page');
