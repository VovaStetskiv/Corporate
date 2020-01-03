<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::auth();
//
//Route::get('/home', 'HomeController@index');


Route::resource('/', 'IndexController', [
    'only' => ['index'],
    'names' => [
        'index' => 'home'
    ]
]); /*, ['only']*/

Route::resource('portfolio', 'PortfolioController', [
    'parameters' => [
        'portfolio' => 'alias'
    ]
]);

Route::resource('articles', 'ArticleController', [
    'parameters' => [
        'articles' => 'alias'
    ]
]);

Route::get('articles/cat/{alias}', ['uses' => 'ArticleController@index', 'as' => 'articlesCategory']);