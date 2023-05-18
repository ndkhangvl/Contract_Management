<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|d
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function () {
//     $users = \DB::table('LOAI_KHACHHANG')->get();
//     //return view('login');
//     return dd($users);
// });
Route::get('/dashboard', function(){
    return view('dashboard');
});
Route::get('/dashboard', [UserAuthController::class, 'dashboard']);
Route::get('/login', [UserAuthController::class,'login']);
Route::post('/user-login', [UserAuthController::class, 'userLogin']) -> name('user-login');