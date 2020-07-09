<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//rotas de administração

Route::get('/', "Scaffolder\ScaffolderController@selectView")->name("selectView");

Route::group([ 'prefix' => 'install', 'as' => 'install.'], function () {
    Route::get('/login', "Scaffolder\ScaffolderController@login")->name("login");
    Route::get('/register', "Scaffolder\ScaffolderController@register")->name("register");
    Route::post('/login', "Scaffolder\ScaffolderController@loginPost")->name("loginPost");
    Route::post('/register', "Scaffolder\ScaffolderController@registerPost")->name("registerPost");

    Route::get('/', "Scaffolder\ScaffolderController@indexChooseDB")->name("indexChooseDB");
    Route::get('/getSchemaDB', "Scaffolder\ScaffolderController@getSchemaDB")->name("getSchemaDB");
    Route::post("/error", "Scaffolder\ScaffolderController@errorPage")->name("error");
    Route::post("/configure", "Scaffolder\ScaffolderController@tablesConfigureP1Post")->name("tablesConfigureP1");
    Route::post("/configure/func", "Scaffolder\ScaffolderController@tablesConfigureFuncPost")->name("tablesConfigureFunction");

});
Route::group([ 'prefix' => 'scaffolder', 'as' => 'scaffolder.'], function () {
    Route::get("/controller", "Scaffolder\ScaffolderController@backofficeController")->name("controller");


});



Route::resource("clientes", "ClienteController");

Route::resource("alunos", "AlunoController");
Route::resource("users", "UserController");
Route::resource("autorizacoes_contas", "AutorizacoesContaController");
Route::resource("contas", "ContaController");
Route::resource("migrations", "MigrationController");
Route::resource("movimentos", "MovimentoController");