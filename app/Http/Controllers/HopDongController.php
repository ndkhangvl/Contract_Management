<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HoaDon;

class HopDongController extends Controller
{
    //
    public function show($id) {
        $hopdong = DB::select("select HOPDONG_ID,LOAIHOPDONG_TEN,KHACHHANG_TEN,HOPDONG_SO,HOPDONG_NGAYKY,HOPDONG_NGAYHIEULUC,HOPDONG_NGAYKETTHUC,HOPDONG_TENGOITHAU,HOPDONG_TENDUAN,HOPDONG_NOIDUNG,HOPDONG_DAIDIENBEN_A,HOPDONG_DAIDIENBEN_B,ten_nd,HOPDONG_THOIGIANTHUCHIEN,HOPDONG_TONGGIATRI,HOPDONG_HINHTHUCTHANHTOAN,HOPDONG_GHICHU,TRANGTHAI_TEN,HOPDONG_FILE
        from hopdong join LOAI_HOPDONG on hopdong.LOAIHOPDONG_ID=LOAI_HOPDONG.LOAIHOPDONG_ID
        join KHACHHANG on HOPDONG.KHACHHANG_ID=KHACHHANG.KHACHHANG_ID
        join TAIKHOAN on HOPDONG.HOPDONG_NGUOILAP=TAIKHOAN.nguoidung_id
        join TRANGTHAI_HOPDONG on HOPDONG.HOPDONG_TRANGTHAI=TRANGTHAI_HOPDONG.TRANGTHAI_ID
        where HOPDONG_SO=:id;",
        [
            'id' => $id,
        ])[0];

        $hoadons = DB::select("select * from hoadon where HOPDONG_ID=:id order by HOADON_ID desc;",
        [
            'id' => $hopdong->HOPDONG_ID,
        ]);
        return view('hopdong.show', [
            'hopdong' => $hopdong,
            'hoadons' => $hoadons,
        ]);
        
    }
}
