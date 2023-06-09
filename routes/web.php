<?php

use App\Http\Controllers\HistoryController;
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
use App\Http\Controllers\ReportController;

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
})->middleware('switchLanguage');

Route::get('/test', function () {
    //$value = Session::get('loginId');
    return view('hoadon.pdf');
});

Route::get('/test2', [KhachHangController::class, 'create'])->middleware('isLogin');
Route::delete('/idkhachhang/{id}', [KhachHangController::class, 'destroy'])->name('idkhachhang.destroy');
// Route::get('test2/{lang}', function($lang) {
//     App::setlocale($lang);
//     return view('auth.login');
// });
Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->middleware('isLogin');
Route::get('/login', [UserAuthController::class,'login'])->middleware('alreadyLoggedIn', 'switchLanguage');
Route::post('/updatelocale', [UserAuthController::class, 'updateLocale'])->name('updateLocale');
Route::post('/user-login', [UserAuthController::class, 'userLogin'])-> name('user-login');
Route::post('/forgot-pass', [UserAuthController::class, 'forgotPass'])->middleware('switchLanguage')-> name('forgot-pass');
Route::post('/updatePassWd', [UserAuthController::class, 'updatePass'])->middleware('isLogin');
Route::get('/logout', [UserAuthController::class, 'logout']);
Route::get('/user/{id}', [UserAuthController::class, 'getUser'])->middleware('switchLanguage');

Route::middleware(['isLogin', 'switchLanguage'])->group(function () {
    Route::resource('/loaikhachhangs', LoaiKhachHangController::class);
});

Route::middleware(['isLogin', 'switchLanguage'])->group(function () {
    Route::resource('/khachhang', KhachHangController::class);
});

// Route::middleware(['isLogin', 'switchLanguage'])->group(function () {
//     Route::resource('/hopdong', HopDongController::class);
// });
Route::get('/hopdong', [HopDongController::class, 'index'])->middleware('isLogin', 'switchLanguage');
Route::get('/hopdong/{id}', [HopDongController::class, 'show'])->middleware('isLogin', 'switchLanguage');
Route::put('/updateHopDong/{id}', [HopDongController::class, 'update'])->middleware('isLogin', 'switchLanguage');
Route::post('/hopdong', [HopDongController::class, 'store'])->middleware('isLogin', 'switchLanguage');
Route::get('/searchHopDong', [HopDongController::class, 'search'])->middleware('isLogin','switchLanguage');
Route::get('/gethopdong/{id}', [HopDongController::class, 'getHopDong'])->middleware('isLogin', 'switchLanguage');
Route::delete('/hopdong/delete/{id}', [HopDongController::class, 'delete'])->middleware('isLogin', 'switchLanguage');

Route::middleware(['isLogin', 'switchLanguage'])->group(function () {
    Route::resource('/hoadon', HoaDonController::class);
    Route::post('/createHoaDonModal', [HoaDonController::class, 'storeModal']);
    Route::put('/updateHoaDonModal/{id}', [HoaDonController::class, 'updateModal']);
    Route::get('/gethoadon/{id}',[HoaDonController::class,'getHoaDon']);
});


// Route::resource('/hopdong', HopDongController::class)->middleware('isLogin', 'switchLanguage');
// Route::resource('/hoadon', HoaDonController::class)->middleware('isLogin', 'switchLanguage');
Route::get('/ExportHoaDon', [HoaDonController::class, 'exportInvoices']);

// Danh cho loai khach hang
Route::get('/', [ReportController::class, 'index'])->name('database')->middleware('isLogin', 'switchLanguage');
Route::post('/', [LoaiKhachHangController::class, 'insert'])->name('loaikhachhang.insert')->middleware('isLogin', 'switchLanguage');
Route::post('/update', [LoaiKhachHangController::class, 'update'])->name('loaikhachhang.update')->middleware('isLogin', 'switchLanguage');
Route::delete('/delete/{id}', [LoaiKhachHangController::class, 'delete'])->name('id.delete');




// Route::get('/forgotpasswd', function () {
//     Mail::to('khangb1910654@student.ctu.edu.vn')
//         ->send(new ForgotPasswordMail());
// });

Route::get('/baocao', [ReportController::class, 'index'])->middleware('isLogin','switchLanguage')->name('reports.index');

Route::get('/history', [HistoryController::class, 'index'])->middleware('switchLanguage');
Route::get('/history/searchHistory', [HistoryController::class, 'search'])->middleware('isLogin','switchLanguage');

Route::get('/hoadon/{hoadon}/pdf', [HoaDonController::class, 'pdf']);

