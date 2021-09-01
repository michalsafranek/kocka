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
    return view('dailyMenu');
});


Route::get('/menu', [\App\Http\Controllers\MenuController::class, 'index'])->middleware('auth');
Route::get('/menu/{id}', [\App\Http\Controllers\MenuController::class, 'manage'])->where('id', 'zamek|kocka')->middleware('auth');
Route::get('/menu/mealHistory/{id}', [\App\Http\Controllers\MenuController::class, 'getMealHistory'])->middleware('auth');
Route::get('/menu/getMenus/{id}' ,[\App\Http\Controllers\MenuController::class, 'getMenus'])->middleware('auth');
Route::get('/menu/print/{restaurant}/{year}/{week}', [\App\Http\Controllers\MenuController::class, 'printPdf'])->middleware('auth');
Route::get('/menu/email/{restaurant}/{year}/{week}', [\App\Http\Controllers\MenuController::class, 'emailPdf'])->middleware('auth');
Route::post('/menu/send', [\App\Http\Controllers\MenuController::class, 'sendEmail'])->middleware('auth');
Route::post('/menu/{restaurant}', [\App\Http\Controllers\MenuController::class, 'saveMenu'])->middleware('auth');
Route::get('/todayMenu', [\App\Http\Controllers\MenuController::class, 'todayMenu']);





Route::get('/menu/emails/{id}', [\App\Http\Controllers\MenuController::class, 'emails'])->where('id', 'zamek|kocka')->middleware('auth');
Route::get('/menu/getEmails/{id}', [\App\Http\Controllers\MenuController::class, 'getEmails'])->middleware('auth');
Route::post('/menu/emails/{id}/add', [\App\Http\Controllers\MenuController::class, 'addEmail'])->middleware('auth');
Route::delete('/menu/emails/{restaurant}/{id}', [\App\Http\Controllers\MenuController::class, 'deleteEmail'])->middleware('auth');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
