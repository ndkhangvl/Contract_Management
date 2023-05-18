<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiKhachHang;
use Illuminate\Support\Facades\DB;

class LoaiKhachHangController extends Controller
{
    //
    public function index() {
        $loaikhachhang = DB::select("select * from LOAI_KHACHHANG order by LOAIKHACHHANG_ID asc;");
       /* return view('loaikhachhang.index', [
            'loaikhachhang' => $loaikhachhang,
        ]);*/
        dd($loaikhachhang);
    }
}
