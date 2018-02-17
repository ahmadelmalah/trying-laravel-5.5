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

Route::get('/mystacks', 'StackController@getUserStacks')->name('my-stacks');
Route::get('/stackstatus/{stack}', 'StackController@getUserStackStatus')->name('stack-status');
Route::get('/stack-create', 'StackController@create')->name('stack-create');
Route::post('/stack-create', 'StackController@store')->name('stack-store');
Route::get('/stack-edit/{stack}', 'StackController@edit')->name('stack-edit');
Route::get('/sheet-create/{stack}', 'SheetController@create')->name('sheet-create');
Route::post('/sheet-create/{stack}', 'SheetController@store')->name('sheet-store');

Route::get('/practice/{stack}', 'PracticeController@index')->name('practice');
Route::post('/practice/{stack}', 'PracticeController@postAnswer')->name('practice_postanswer');

Route::get('/test', function(){
    $user = App\User::find(1);
    $stack = App\Stack::find(1);
    event(new UsersubscripedToStack($user, $stack));
    return 'done';
});