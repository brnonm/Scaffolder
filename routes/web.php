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
Route::post("/configure/func", "Scaffolder\ScaffolderController@tablesConfigureFuncPost")->name("scaffolder.tablesConfigureFunction");

Route::post("/configure/", "Scaffolder\ScaffolderController@tablesConfigureP1Post")->name("scaffolder.tablesConfigureP1");
Route::get("/backoffice/", "Scaffolder\ScaffolderController@backofficeIndex")->name("scaffolder.backofficeIndex");




Route::resource("/Categorie/", "CategorieController");
Route::resource("/Appointment/", "AppointmentController");

Route::resource("/Appointment/", "AppointmentController");
Route::resource("/Employee/", "EmployeeController");
