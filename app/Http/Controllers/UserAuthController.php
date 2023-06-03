<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\TaiKhoan;
use App\Mail\ForgotPasswordMail;
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
        $locale = $request->input('locale');
        if (in_array($locale, ['en', 'vi'])) {
            App::setlocale($locale);
            return response()->json(['success' => true, 'test' => $locale]);
        }
        return response()->json(['success' => false]);
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
            'matkhau' => 'required|min:5|max:12',
            'captcha' => 'required'
        ]);

        $captchaData = $request->input('captcha');
        $isCaptchaValid = Captcha::check($captchaData);

        //$taikhoan = $request->only('ma_nd','matkhau');
        if (!$isCaptchaValid) {
            return back()->with('fail', 'Mã xác nhận sai');
            return false;
        }

        $user = TaiKhoan::where('ma_nd','=', $request-> ma_nd)->first();
        $puser = TaiKhoan::where('matkhau', '=', $request->matkhau)->first();
        if($user && !$puser) {
            return back()->with('fail', 'Mật khẩu không đúng.');
        }
        if($user && $puser) {
            $request->session()->put('loginId', $user->nguoidung_id);
            return redirect('dashboard');
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
            return redirect('login');
        }
    }

}
