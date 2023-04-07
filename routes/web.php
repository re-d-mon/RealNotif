<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/to_do', [App\Http\Controllers\HomeController::class, 'To_Do_List']);
/*Прием уведомлений*/
Route::post('/post-like',[App\Http\Controllers\HomeController::class, 'postLike']);
//Добавление задачи пользователю
Route::post('/add_to_do',[App\Http\Controllers\HomeController::class, 'add_to_do']);

Route::post('/add_to_do_group',[App\Http\Controllers\HomeController::class, 'add_to_do_group']);