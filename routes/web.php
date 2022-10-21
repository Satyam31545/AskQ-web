<?php
use App\Http\Controllers;

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

 
Route::get('/', 'askcon@login');
Route::post('/login', 'askcon@loginpost');
Route::get('/home', 'askcon@home')->middleware('login');
Route::get('/create', 'askcon@create');
Route::post('/create', 'askcon@create_post');
Route::get('/create_contest', 'askcon@create_contest')->middleware('login');
Route::post('/create_contest', 'askcon@create_contest_post')->middleware('login');
Route::post('/create_contest_q', 'askcon@create_contest_q_post')->middleware('login');
Route::get('/start_con', 'askcon@start_con')->middleware('login','time');
Route::post('/start_con', 'askcon@start_con_post')->middleware('login');
Route::get('/enter_contest', 'askcon@enter_contest')->middleware('login');
Route::post('/enter_contest', 'askcon@enter_contest_post')->middleware('login');
Route::get('/contest_result/{id}', 'askcon@contest_results')->middleware('login','result');
Route::get('/my_result', 'askcon@my_result')->middleware('login');
Route::get('/logout', 'askcon@logout')->middleware('login');
Route::get('/error/{id}', 'askcon@error');


 

