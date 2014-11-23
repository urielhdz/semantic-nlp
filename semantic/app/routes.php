<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get("/","NERController@nuevo");
Route::get("/display","NERController@show");
Route::get("/look","NERController@search");
Route::get("/sparql_data","NERController@sparql");
Route::get("/query","NERController@query");
Route::get("/crawl","NERController@crawl");
Route::get("/relate","ArchemyController@search");
Route::get("/dbpedia/{id}","DBPediaController@show");