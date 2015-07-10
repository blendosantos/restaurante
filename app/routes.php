<?php

/*
|--------------------------------------------------------------------------
| Configurações de Rotas
|--------------------------------------------------------------------------
|
| Aqui é onde é registrada todas as rotas para o sistema.
|
*/
            /** Rota Principal **/
Route::get('/', 'HomeController@getIndex');

            /** Rotas Login - Autenticação de Usuário **/
Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');

            /** Rotas Resert de Senhas **/
Route::get('resertPassword', 'AuthController@getResertPassword');
Route::post('resertPassword', 'AuthController@postResertPassword');

            /** Rotas Cadastro de Usuário **/
Route::get('create-login', 'AuthController@getCadastro');
Route::post('create-login', 'AuthController@postCadastro');

Route::controller('produto', 'ProdutoController');

Route::controller('servico', 'ServicoController');

Route::controller('mesa', 'MesaController');

Route::controller('usuario', 'AuthController');