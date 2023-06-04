<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\LoaiKhachHangController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\HopDongController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\UserAuthController;
use App\Mail\ForgotPasswordMail;

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
});

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

Route::get('/forgotpass', function () {
    //$value = Session::get('loginId');
    return view('mail.indexforgotpass');
});

Route::get('/test', function () {
    //$value = Session::get('loginId');
    return view('khachhang.createCustomer');
})->middleware('isLogin');

// Route::get('test2/{lang}', function($lang) {
//     App::setlocale($lang);
//     return view('auth.login');
// });
Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->middleware('isLogin');
Route::get('/login', [UserAuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::post('/user-login', [UserAuthController::class, 'userLogin']) -> name('user-login');
Route::post('/forgot-pass', [UserAuthController::class, 'forgotPass']) -> name('forgot-pass');
Route::get('/logout', [UserAuthController::class, 'logout']);
Route::get('/user/{id}', [UserAuthController::class, 'getUser']);
Route::post('/updatelocale', [UserAuthController::class, 'updateLocale'])->name('updateLocale');

Route::resource('/loaikhachhangs', LoaiKhachHangController::class)->middleware('isLogin');
Route::resource('/khachhang', KhachHangController::class)->middleware('isLogin');
Route::resource('/hopdong', HopDongController::class)->middleware('isLogin');
Route::resource('/hoadon', HoaDonController::class)->middleware('isLogin');
Route::get('/ExportHoaDon', [HoaDonController::class, 'exportInvoices']);

/* Danh cho loai khach hang
Route::get('/', [LoaiKhachHangController::class, 'index'])->name('database');
Route::post('/', [LoaiKhachHangController::class, 'insert'])->name('testconnect.insert');
Route::post('/delete', [LoaiKhachHangController::class, 'delete'])->name('testconnect.delete');
Route::post('/update', [LoaiKhachHangController::class, 'update'])->name('testconnect.update');
*/
Route::get('/', [LoaiKhachHangController::class, 'index'])->name('database')->middleware('isLogin');
Route::post('/', [LoaiKhachHangController::class, 'insert'])->name('testconnect.insert')->middleware('isLogin');
Route::post('/delete', [LoaiKhachHangController::class, 'delete'])->name('testconnect.delete')->middleware('isLogin');
Route::post('/update', [LoaiKhachHangController::class, 'update'])->name('testconnect.update')->middleware('isLogin');

// Route::get('/forgotpasswd', function () {
//     Mail::to('khangb1910654@student.ctu.edu.vn')
//         ->send(new ForgotPasswordMail());
// });


