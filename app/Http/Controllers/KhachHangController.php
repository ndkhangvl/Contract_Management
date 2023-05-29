<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiKhachHang;
use App\Models\KhachHang;
use App\Models\TrangThaiKH;
use App\Models\HopDong;
use Carbon\Carbon;
//use App\Http\Requests\CreateValidationRequest;

class KhachHangController extends Controller
{
    //
    public function index() {
        $khachhangs = DB::select("select * from KHACHHANG join LOAI_KHACHHANG on KHACHHANG.LOAIKHACHHANG_ID=LOAI_KHACHHANG.LOAIKHACHHANG_ID
        join TRANGTHAI_KHACHHANG on KHACHHANG.KHACHHANG_TRANGTHAI=TRANGTHAI_KHACHHANG.TRANGTHAI_ID;");
        return view('khachhang.index', [
            'khachhangs' => $khachhangs,
        ]);
        
    }

    public function show($id) {
        $khachhang = DB::select("select * from KHACHHANG join LOAI_KHACHHANG on KHACHHANG.LOAIKHACHHANG_ID=LOAI_KHACHHANG.LOAIKHACHHANG_ID
        join TRANGTHAI_KHACHHANG on KHACHHANG.KHACHHANG_TRANGTHAI=TRANGTHAI_KHACHHANG.TRANGTHAI_ID where KHACHHANG_ID=:id;",
        [
            'id' => $id
        ]
        );
        $hopdongs = DB::select("select * from HOPDONG where KHACHHANG_ID=:id;",
        [
            'id' => $id
        ]);
        //return view('khachhang.show')->with('khachhang', $khachhang);
        return view('khachhang.show', [
            'khachhang' => $khachhang,
            'hopdongs' => $hopdongs,
        ]);
    }

    public function create() {
        $loaikhachhang = LoaiKhachHang::all();
        return view('khachhang.createCustomer',[
            'loaikhachhang' => $loaikhachhang,
        ]);
    }

    public function edit($id)
    {
        //dd($id);
        $khhang = KhachHang::find($id);
        $loaikhachhang = LoaiKhachHang::all();
        $trangthaikh = TrangThaiKH::all();
        //dd($food);
        //return view('khachhang.edit')->with('khhang', $khhang);
        return view('khachhang.editCustomer',[
            'khhang' => $khhang,
            'loaikhachhang' => $loaikhachhang,
            'trangthaikh' => $trangthaikh,

        ]);
    }

    public function store(Request $request)
    {
        //
        $today = Carbon::today();

        $khhang = new KhachHang;
        $khhang->LOAIKHACHHANG_ID = $request->loaikhachhang_id; 
        $khhang->KHACHHANG_TEN = $request->khachhang_ten;
        $khhang->KHACHHANG_DIACHI = $request->khachhang_diachi; 
        $khhang->KHACHHANG_SDT = $request->khachhang_sdt; 
        $khhang->KHACHHANG_EMAIL = $request->khachhang_email; 
        $khhang->KHACHHANG_CHUSOHUU = $request->khachhang_chusohuu; 
        $khhang->KHACHHANG_NGUOIDAIDIEN = $request->khachhang_nguoidaidien; 
        $khhang->KHACHHANG_CMND = $request->khachhang_cmnd; 
        $khhang->KHACHHANG_NGAYCAPCMND = $request->khachhang_ngaycapcmnd; 
        $khhang->KHACHHANG_NGAYSINHNDD = $request->khachhang_ngaysinhndd; 
        $khhang->KHACHHANG_NGAYHOATDONG = $request->khachhang_ngayhoatdong; 
        $khhang->KHACHHANG_TRANGTHAI = 2; 
        $khhang->KHACHHANG_MASOTHUE = $request->khachhang_masothue; 
        $khhang->NGAYTAOLAP = $today; 
        

        $khhang->save();
        return redirect('/khachhang');
    }

    public function update(Request $request, $id)
    {
        //$request->validated();
        $khhang = KhachHang::where('KHACHHANG_ID', $id)  
                ->update([
                    'LOAIKHACHHANG_ID' => $request->input('loaikhachhang_id'),
                    'KHACHHANG_TEN' => $request->input('khachhang_ten'),
                    'KHACHHANG_DIACHI' => $request->input('khachhang_diachi'),
                    'KHACHHANG_SDT' => $request->input('khachhang_sdt'),
                    'KHACHHANG_EMAIL' => $request->input('khachhang_email'),
                    'KHACHHANG_CHUSOHUU' => $request->input('khachhang_chusohuu'),
                    'KHACHHANG_NGUOIDAIDIEN' => $request->input('khachhang_nguoidaidien'),
                    'KHACHHANG_CMND' => $request->input('khachhang_cmnd'),
                    'KHACHHANG_NGAYCAPCMND' => $request->input('khachhang_ngaycapcmnd'),
                    'KHACHHANG_NGAYSINHNDD' => $request->input('khachhang_ngaysinhndd'),
                    'KHACHHANG_NGAYHOATDONG' => $request->input('khachhang_ngayhoatdong'),
                    'KHACHHANG_TRANGTHAI' => $request->input('khachhang_trangthai'),
                    'KHACHHANG_MASOTHUE' => $request->input('khachhang_masothue'),
                    
                ]);
        return redirect('/khachhang');
    }

    public function destroy($id)
    {
        $khhang = KhachHang::find($id);
        $khhang->delete();
        //dd($id);
        return redirect('/khachhang');
    }
}
