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

Route::get('/', "Scaffolder\ScaffolderController@indexChooseDB")->name("scaffolder.indexChooseDB");
Route::get('/getSchemaDB', "Scaffolder\ScaffolderController@getSchemaDB")->name("scaffolder.getSchemaDB");


//rotas de administração
Route::post("/configure", "Scaffolder\ScaffolderController@tablesConfigureP1Post")->name("scaffolder.tablesConfigureP1");
Route::post("/configure/function", "Scaffolder\ScaffolderController@tablesConfigureFunctionPost")->name("scaffolder.tablesConfigureFunction");



Route::resource("/Categorie/", "CategorieController");
Route::resource("/Failed_job/", "Failed_jobController");