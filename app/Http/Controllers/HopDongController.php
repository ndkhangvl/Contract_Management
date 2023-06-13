<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\LoaiHopDong;
use App\Models\TaiKhoan;
use App\Models\KhachHang;
use App\Models\HopDong;
use App\Models\TrangThaiHD;
use Illuminate\Support\Facades\Session;

class HopDongController extends Controller
{
    //
    public function index()
    {
        $trangthaihopdongs = DB::select('select * from TRANGTHAI_HOPDONG');
        $khachhangs = DB::select('select * from KHACHHANG');
        $hopdongs = DB::table('HOPDONG')->join('LOAI_HOPDONG', 'HOPDONG.LOAIHOPDONG_ID', '=', 'LOAI_HOPDONG.LOAIHOPDONG_ID')
            ->join('TAIKHOAN', 'HOPDONG.HOPDONG_NGUOILAP', '=', 'TAIKHOAN.nguoidung_id')
            ->join('KHACHHANG', 'HOPDONG.KHACHHANG_ID', '=', 'KHACHHANG.KHACHHANG_ID')
            ->join('TRANGTHAI_HOPDONG', 'HOPDONG.HOPDONG_TRANGTHAI', '=', 'TRANGTHAI_HOPDONG.TRANGTHAI_ID')
            ->orderBy('HOPDONG_ID', 'asc')->get();;
        return view('hopdong.index', [
            'hopdongs' => $hopdongs,
            'trangthaihopdongs' => $trangthaihopdongs,
            'khachhangs' => $khachhangs,
        ]);
    }

    public function show($id)
    {
        $hopdong = DB::select("select HOPDONG_ID,LOAIHOPDONG_TEN,KHACHHANG_TEN,HOPDONG_SO,HOPDONG_NGAYKY,HOPDONG_NGAYHIEULUC,HOPDONG_NGAYKETTHUC,HOPDONG_TENGOITHAU,HOPDONG_TENDUAN,HOPDONG_NOIDUNG,HOPDONG_DAIDIENBEN_A,HOPDONG_DAIDIENBEN_B,ten_nd,HOPDONG_THOIGIANTHUCHIEN,HOPDONG_TONGGIATRI,HOPDONG_HINHTHUCTHANHTOAN,HOPDONG_GHICHU,TRANGTHAI_TEN,HOPDONG_FILE
        from hopdong join LOAI_HOPDONG on hopdong.LOAIHOPDONG_ID=LOAI_HOPDONG.LOAIHOPDONG_ID
        join KHACHHANG on HOPDONG.KHACHHANG_ID=KHACHHANG.KHACHHANG_ID
        join TAIKHOAN on HOPDONG.HOPDONG_NGUOILAP=TAIKHOAN.nguoidung_id
        join TRANGTHAI_HOPDONG on HOPDONG.HOPDONG_TRANGTHAI=TRANGTHAI_HOPDONG.TRANGTHAI_ID
        where HOPDONG_SO=:id;",
            [
                'id' => $id,
            ]
        )[0];

        $hoadons = DB::select(
            "select * from hoadon where HOPDONG_ID=:id order by HOADON_ID desc;",
            [
                'id' => $hopdong->HOPDONG_ID,
            ]
        );
        return view('hopdong.show', [
            'hopdong' => $hopdong,
            'hoadons' => $hoadons,
        ]);

    }

    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'loaikhachhang_id' => 'required',
        //     'khachhang_ten' => 'required|min:5',
        //     'khachhang_diachi' => 'required',
        //     'khachhang_sdt' => 'required',
        //     'khachhang_email' => 'required',
        //     'khachhang_chusohuu' => 'required',
        //     'khachhang_nguoidaidien' => 'required',
        //     'khachhang_cmnd' => 'required',
        //     'khachhang_ngaycapcmnd' => 'required',
        //     'khachhang_ngaysinhndd' => 'required',
        //     'khachhang_ngayhoatdong' => 'required',
        //     'khachhang_masothue' => 'required',
        // ], [
        //     'loaikhachhang_id.required' => 'Trường loại khách hàng là bắt buộc.',
        //     'khachhang_ten.required' => 'Trường tên khách hàng là bắt buộc.',
        //     'khachhang_ten.min' => 'Trường tên khách hàng phải có ít nhất :min ký tự.',
        //     'khachhang_diachi.required' => 'Trường địa chỉ khách hàng là bắt buộc.',
        //     'khachhang_sdt.required' => 'Trường số điện thoại là bắt buộc.',
        //     'khachhang_email.required' => 'Trường email là bắt buộc.',
        //     'khachhang_chusohuu.required' => 'Trường chủ sở hữu là bắt buộc.',
        //     'khachhang_nguoidaidien.required' => 'Trường người đại diện là bắt buộc.',
        //     'khachhang_cmnd.required' => 'Trường CCCD là bắt buộc.',
        //     'khachhang_ngaycapcmnd.required' => 'Chọn ngày cấp CCCD là bắt buộc.',
        //     'khachhang_ngaysinhndd.required' => 'Chọn ngày sinh là bắt buộc.',
        //     'khachhang_ngayhoatdong.required' => 'Chọn ngày hoạt động là bắt buộc.',
        //     'khachhang_masothue.required' => 'Trường mã số thuế là bắt buộc.',
        // ]);
        
        // $today = Carbon::today();

        $hdong = new HopDong;
        $hdong->LOAIHOPDONG_ID = $request->loaihopdong_id; 
        $hdong->KHACHHANG_ID = $request->khachhang_id;
        $hdong->HOPDONG_SO = $request->hopdong_so; 
        $hdong->HOPDONG_NGAYKY = $request->hopdong_ngayky; 
        $hdong->HOPDONG_NGAYHIEULUC = $request->hopdong_ngayhieuluc; 
        $hdong->HOPDONG_NGAYKETTHUC = $request->hopdong_ngayketthuc; 
        $hdong->HOPDONG_TENGOITHAU = $request->hopdong_tengoithau; 
        $hdong->HOPDONG_TENDUAN = $request->hopdong_tenduan; 
        $hdong->HOPDONG_NOIDUNG = $request->hopdong_noidung; 
        $hdong->HOPDONG_DAIDIENBEN_A = $request->hopdong_daidienben_a; 
        $hdong->HOPDONG_DAIDIENBEN_B = $request->hopdong_daidienben_b; 
        $hdong->HOPDONG_NGUOILAP = Session::get('infoUser.nguoidung_id'); 
        $hdong->HOPDONG_THOIGIANTHUCHIEN = $request->hopdong_thoigianthuchien; 
        $hdong->HOPDONG_TONGGIATRI = $request->hopdong_tonggiatri; 
        $hdong->HOPDONG_HINHTHUCTHANHTOAN = $request->hopdong_hinhthucthanhtoan;
        $hdong->HOPDONG_TRANGTHAI = $request->hopdong_trangthai;
        $hdong->HOPDONG_GHICHU = $request->hopdong_ghichu;
        $hdong->save();
        return response()->json([
            'success' => true,
            // 'errors' => $validator->errors(),
            'input' => $request->all()
        ]);
        // return redirect('/khachhang');
    }
}