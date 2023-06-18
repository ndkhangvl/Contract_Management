<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\TaiKhoan;
use App\Mail\ForgotPasswordMail;
use App\Models\LoaiKhachHang;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\DB;


class UserAuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }
    public function getUser($ma_nd)
    {
        $user = TaiKhoan::where('ma_nd', $ma_nd)->first();
        return response()->json($user);
    }


    public function updateLocale(Request $request)
    {
        $locale = $request->input('culture');
        if (in_array($locale, ['en', 'vi'])) {
            Session::put('locale', $locale); // Store the locale in the session
            return response()->json(['success' => true, 'test' => $locale]);
        }
        // // return response()->json(['success' => false]);
        // app()->setLocale($locale);
        // app::setlocale($locale);
        return response()->json(['success' => true, 'test' => $locale]);
    }

    // public function updateLocale()
    // {
    //     App::setlocale('en');
    //     return view('auth.login');
    // }

    public function forgotPass(Request $request) {
        $user = TaiKhoan::where('nguoidung_email','=', $request->nd_email)->first();
        if(!$user) {
            return back()->with('fail', 'Tài khoản không tồn tại với thông tin email.');
        } else {
            $newpass = Str::random(8);
            TaiKhoan::where('nguoidung_email', $request->nd_email)  
                ->update([
                    'MATKHAU' => $newpass,
                ]);
            $user_after = TaiKhoan::where('nguoidung_email','=', $request->nd_email)->first();
            Mail::to($request->nd_email)->send(new ForgotPasswordMail($user_after));
        }
        return redirect('/login');
    }
    //public function getLogin()
    //{
    //    $captcha = Captcha::create('default');
    //    return view('auth.login', compact('captcha'));s
    //}

    public function userLogin(Request $request) {
        
        $request->validate([
            'ma_nd' => 'required',
            'matkhau' => 'required|min:5|max:30',
            'captcha' => 'required'
        ], [
            'ma_nd.required' => 'Vui lòng nhập tên đăng nhập.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
            'matkhau.min' => 'Mật khẩu phải ít nhất :min ký tự.',
            'matkhau.max' => 'Mật khẩu tối đa :max ký tự.',
            'captcha.required' => 'Vui lòng nhập mã captcha.',
        ]);

        $captchaData = $request->input('captcha');
        $isCaptchaValid = Captcha::check($captchaData);

        //$taikhoan = $request->only('ma_nd','matkhau');
        if (!$isCaptchaValid) {
            return response()->json(['success' => false, 'captcha' => false, 'message' => 'Mã captcha không đúng']);
            // return false;
        }

        $user = TaiKhoan::where('ma_nd','=', $request-> ma_nd)->first();
        $puser = TaiKhoan::where('matkhau', '=', $request->matkhau)->first();
        if($user && !$puser) {
            // return back()->with('fail', 'Mật khẩu không đúng.');
            return response()->json(['success' => false, 'message' => 'Mật khẩu không đúng']);
        }
        if($user && $puser) {
            $request->session()->put('loginId', $user->nguoidung_id);
            $data = array();
            if(Session::has('loginId')) {
                $data = TaiKhoan::where('nguoidung_id','=', Session::get('loginId'))->first();
                $information = Session::put('infoUser', $data);
            }
            $loaikhachhang = LoaiKhachHang::orderBy('LOAIKHACHHANG_TEN', 'asc')->get();
            $khachhangs = DB::select("select * from KHACHHANG join LOAI_KHACHHANG on KHACHHANG.LOAIKHACHHANG_ID=LOAI_KHACHHANG.LOAIKHACHHANG_ID
            join TRANGTHAI_KHACHHANG on KHACHHANG.KHACHHANG_TRANGTHAI=TRANGTHAI_KHACHHANG.TRANGTHAI_ID;");
            // return view('khachhang.index', compact('data'));
            // return redirect('/khachhang');
            return response()->json(['success' => true, 'redirect' => '/khachhang']);
        } else {
            return back()->with('fail', 'Tên đăng nhập không tồn tại.');
        }
    }
    

    public function dashboard() {
        $data = array();
        if(Session::has('loginId')) {
            $data = TaiKhoan::where('nguoidung_id','=', Session::get('loginId'))->first();
            $information = Session::put('infoUser', $data);
        }
        //return view('dashboard', compact('data'));
        return view('dashboard', compact('data'));
    }

    public function logout(){
        //Auth::logout();
        if(Session::has('loginId')) {
            Session::pull('loginId');
            Session::pull('infoUser');
            Session::pull('locale');
            return redirect('login');
        }
    }

}
