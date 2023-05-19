<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoaiKhachHangController;
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
    return view('auth.login');
})->name('routeName');;

//Route::get('/login', function () {
//    return view('login');
//});

//Route::resource('/loaikhachhang', LoaiKhachHangController::class);
// Route::get('/login', function () {
//     $users = \DB::table('LOAI_KHACHHANG')->get();
//     //return view('login');
//     return dd($users);
// });

// Route::get('/dashboard', function(){
//     return view('dashboard');
// });
Route::get('/header', function () {
    //$value = Session::get('loginId');
    return view('header');
});

Route::get('/test', function () {
    //$value = Session::get('loginId');
    return view('khachhang.createCustomer');
});

Route::get('login/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'vi'])) {
        App::setLocale($locale);
    }
    return Redirect::back();
})->name('setlocale');

Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->middleware('isLogin');
Route::get('/login', [UserAuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::post('/user-login', [UserAuthController::class, 'userLogin']) -> name('user-login');
Route::get('/logout', [UserAuthController::class, 'logout']);
