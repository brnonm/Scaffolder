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
Route::get('/', "Scaffolder\ScaffolderController@indexChooseDB")->name("scaffolder.indexChooseDB");
Route::get('/getSchemaDB', "Scaffolder\ScaffolderController@getSchemaDB")->name("scaffolder.getSchemaDB");
Route::post("/error", "Scaffolder\ScaffolderController@errorPage")->name("scaffolder.error");
Route::post("/configure", "Scaffolder\ScaffolderController@tablesConfigureP1Post")->name("scaffolder.tablesConfigureP1");
Route::post("/configure/func", "Scaffolder\ScaffolderController@tablesConfigureFuncPost")->name("scaffolder.tablesConfigureFunction");
//backOffice
<<<<<<< HEAD
Route::get(" ", "Scaffolder\ScaffolderController@backofficeController")->name("scaffolder.backofficeController");



Route::resource("Categorie", "CategorieController");
Route::resource("Failed_job", "Failed_jobController");

Route::resource("Cliente", "ClienteController");
Route::resource("Contact", "ContactController");
Route::resource("Migration", "MigrationController");
Route::resource("Movement", "MovementController");
Route::resource("Password_reset", "Password_resetController");
=======
Route::get("/backoffice/controller", "Scaffolder\ScaffolderController@backofficeController")->name("scaffolder.backoffice.controller");


Route::resource("clientes", "ClienteController");
Route::resource("contacts", "ContactController");
>>>>>>> master
