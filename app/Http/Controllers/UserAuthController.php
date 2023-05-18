<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function login() {
        return view("auth.login");
    }

    public function userLogin(Request $request) {
        $request->validate([
            'ma_nd' => 'required',
            'matkhau' => 'required|min:5|max:12'
        ]);

        //$taikhoan = $request->only('ma_nd','matkhau');
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
}
