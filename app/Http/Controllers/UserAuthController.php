<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth;
use App\Models\TaiKhoan;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mews\Captcha\Facades\Captcha;

class UserAuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }


    //public function getLogin()
    //{
    //    $captcha = Captcha::create('default');
    //    return view('auth.login', compact('captcha'));
    //}

    public function userLogin(Request $request) {
        
        $captchaData = $request->input('captcha');
        $isCaptchaValid = Captcha::check($captchaData);

        $request->validate([
            'ma_nd' => 'required',
            'matkhau' => 'required|min:5|max:12'
        ]);

        //$taikhoan = $request->only('ma_nd','matkhau');
        if (!$isCaptchaValid) {
            return back()->with('fail', 'mã xác nhận sai');
            return false;
        }
        $user = TaiKhoan::where('ma_nd','=', $request-> ma_nd)->first();
        $puser = TaiKhoan::where('matkhau', '=', $request->matkhau)->first();
        if($user && $puser) {
            $request->session()->put('loginId', $user->nguoidung_id);
            return redirect('dashboard');
        } else {
            return back()->with('fail', 'This username is not register');
        }
    }
    

    public function dashboard() {
        $data = array();
        if(Session::has('loginId')) {
            $data = TaiKhoan::where('nguoidung_id','=', Session::get('loginId'))->first();
        }
        //return view('dashboard', compact('data'));
        return view('dashboard', compact('data'));
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
