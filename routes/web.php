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

//General routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mystacks', 'StackController@getUserStacks')->name('my-stacks');

//Creating/updating stacks routes
Route::get('/stack-create', 'StackController@create')->name('stack-create');
Route::post('/stack-create', 'StackController@store')->name('stack-store');
Route::get('/stack-edit/{stack}', 'StackController@edit')->name('stack-edit')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/stack-edit/{stack}', 'StackController@publish')->name('stack-publish')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::get('/sheet-create/{stack}', 'SheetController@create')->name('sheet-create')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/sheet-create/{stack}', 'SheetController@store')->name('sheet-store')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/stack-clear/{stack}', 'StackController@clear')->name('stack-clear');
//Sharing & searching stacks
Route::post('/stack-makepublic/{stack}', 'StackController@makepublic')->name('stack-makepublic')->middleware('can:update-stack,stack')->middleware('can:stack-be-public,stack');
Route::post('/stack-subscribe/{stack}', 'StackController@subscribe')->name('stack-subscribe');
Route::get('/marketplace', 'StackController@marketplace')->name('marketplace');

//Using stacks routes
Route::get('/stackstatus/{stack}', 'StackController@getUserStackStatus')->name('stack-status')->middleware('can:use-stack,stack');
Route::get('/practice/{stack}', 'PracticeController@index')->name('practice')->middleware('can:use-stack,stack');
Route::post('/practice/{stack}', 'PracticeController@postAnswer')->name('practice_postanswer');

Route::get('/test', function(){
    $user = App\User::find(1);
    $stack = App\Stack::find(1);
    event(new UsersubscripedToStack($user, $stack));
    return 'done';
});