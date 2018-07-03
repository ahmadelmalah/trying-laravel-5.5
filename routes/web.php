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

Route::get('/', function(){
    return view('landing-page');
});

Auth::routes();

//General routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mystacks', 'StackController@getUserStacks')->name('my-stacks');
Route::get('/marketplace', 'StackController@marketplace')->name('marketplace');
Route::get('/subscriptions', 'StackController@subscriptions')->name('subscriptions');

//User management routes
Route::post('/user-deactivate/{user}', 'UserController@destroy')->name('user-destroy')->middleware('can:have-admin-auth');

//Stack management routes
Route::get('/stack-create', 'StackController@create')->name('stack-create');
Route::post('/stack-create', 'StackController@store')->name('stack-store');
Route::get('/stack-edit/{stack}', 'StackController@edit')->name('stack-edit')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/stack-edit/{stack}', 'StackController@publish')->name('stack-publish')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/stack-delete/{stack}', 'StackController@destroy')->name('stack-destroy')->middleware('can:have-admin-auth');
//Sheet management routes
Route::get('/sheet-create/{stack}', 'SheetController@create')->name('sheet-create')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/sheet-create/{stack}', 'SheetController@store')->name('sheet-store')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::get('/sheet-edit/{stack}/{sheet}', 'SheetController@edit')->name('sheet-edit')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::get('/sheet-links/{stack}/{sheet}', 'SheetController@showLinks')->name('sheet-links')->middleware('can:update-stack,stack');
Route::put('/sheet-update/{stack}/{sheet}', 'SheetController@update')->name('sheet-update')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/sheet-delete/{stack}/{sheet}', 'SheetController@destroy')->name('sheet-destroy')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
//the next routes should be in a separete controller that control links
Route::post('/sheet-link-delete/{stack}/{sheet}/{sheetlink}', 'SheetController@destroy_link')->name('sheet-link-destroy')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');
Route::post('/sheet-link-create/{stack}/{sheet}', 'SheetController@store_link')->name('sheet-link-store')->middleware('can:update-stack,stack')->middleware('can:stack-is-updatable,stack');

//Sharing & searching stacks
Route::post('/stack-makepublic/{stack}', 'StackController@makepublic')->name('stack-makepublic')->middleware('can:update-stack,stack')->middleware('can:stack-be-public,stack');
Route::post('/stack-subscribe/{stack}', 'StackController@subscribe')->name('stack-subscribe');
Route::post('/stack-unsubscribe/{stack}', 'StackController@unsubscribe')->name('stack-unsubscribe');

//Using stacks routes
Route::get('/stackstatus/{stack}', 'StackController@getUserStackStatus')->name('stack-status')->middleware('can:use-stack,stack');
Route::get('/practice/{stack}', 'PracticeController@index')->name('practice')->middleware('can:use-stack,stack');
Route::post('/practice/{stack}', 'PracticeController@postAnswer')->name('practice_postanswer')->middleware('can:use-stack,stack');
Route::post('/stack-clear/{stack}', 'StackController@clear')->name('stack-clear')->middleware('can:use-stack,stack');

//Admin Area
Route::prefix('/cp')->middleware(['can:have-admin-auth'])->group(function () {
    Route::get('', 'AdminController@index');
    Route::get('user-management', 'AdminController@indexUserManagement');
    Route::get('stack-management', 'AdminController@indexStackManagement');
});
