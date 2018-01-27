<?php

use App\Events\UsersubscripedToStack;

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

Route::get('/', function(){
    return view('landing-page');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/stacks', function () {
    $users = DB::select('select * from stacks');

    event(new UsersubscripedToStack());

    return $users;
});
