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
use Illuminate\Support\Facades\Response;
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
            ->orderBy('HOPDONG_ID', 'asc')->get();
        ;
        return view('hopdong.index', [
            'hopdongs' => $hopdongs,
            'trangthaihopdongs' => $trangthaihopdongs,
            'khachhangs' => $khachhangs,
        ]);
    }

    public function show($id)
    {
        $trangthaihopdongs = DB::select('select * from TRANGTHAI_HOPDONG');
        $hopdong = DB::select("select KHACHHANG_ID, HOPDONG_ID,LOAIHOPDONG_TEN,KHACHHANG_TEN,HOPDONG_SO,HOPDONG_NGAYKY,HOPDONG_NGAYHIEULUC,HOPDONG_NGAYKETTHUC,HOPDONG_TENGOITHAU,HOPDONG_TENDUAN,HOPDONG_NOIDUNG,HOPDONG_DAIDIENBEN_A,HOPDONG_DAIDIENBEN_B,ten_nd,HOPDONG_THOIGIANTHUCHIEN,HOPDONG_TONGGIATRI,HOPDONG_HINHTHUCTHANHTOAN,HOPDONG_GHICHU,TRANGTHAI_TEN,HOPDONG_FILE
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
            'trangthaihopdongs' => $trangthaihopdongs,
        ]);

    }

    protected function storeImage(Request $request)
    {
        $fileName = $request->get('hopdong_so') . '.' . $request->file('filehopdong')->extension();
        $path = $request->file('filehopdong')->storeAs('public/HopDong', $fileName);
        return substr($path, strlen('public/'));
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'hopdong_so' => 'required',
            'loaihopdong_id' => 'required',
            'khachhang_id' => 'required',
            'hopdong_ngayky' => 'required',
            'hopdong_ngayhieuluc' => 'required',
            'hopdong_ngayketthuc' => 'required',
            'hopdong_tengoithau' => 'required',
            'hopdong_tenduan' => 'required',
            'hopdong_noidung' => 'required',
            'hopdong_thoigianthuchien' => 'required',
            'hopdong_daidienben_a' => 'required',
            'hopdong_daidienben_b' => 'required',
            'hopdong_tonggiatri' => 'required',
            'hopdong_hinhthucthanhtoan' => 'required',
            'hopdong_trangthai' => 'required',
            'hopdong_ghichu' => 'required',
        ], [
            'hopdong_so.required' => 'Trường số hợp đồng là bắt buộc.',
            'loaihopdong_id.required' => 'Trường loại hợp đồng là bắt buộc.',
            // 'khachhang_ten.min' => 'Trường tên khách hàng phải có ít nhất :min ký tự.',
            'khachhang_id.required' => 'Trường khách hàng là bắt buộc.',
            'hopdong_ngayky.required' => 'Chọn ngày ký là bắt buộc.',
            'hopdong_ngayhieuluc.required' => 'Chọn ngày hiệu lực là bắt buộc.',
            'hopdong_ngayketthuc.required' => 'Chọn ngày kết thúc là bắt buộc.',
            'hopdong_tengoithau.required' => 'Trường tên gói thầu là bắt buộc.',
            'hopdong_tenduan.required' => 'Trường tên dự án là bắt buộc.',
            'hopdong_noidung.required' => 'Trường nội dung là bắt buộc.',
            'hopdong_thoigianthuchien.required' => 'Chọn thời gian thực hiện là bắt buộc.',
            'hopdong_daidienben_a.required' => 'Trường đại diện bên A là bắt buộc.',
            'hopdong_daidienben_b.required' => 'Trường đại diện bên B là bắt buộc.',
            'hopdong_tonggiatri.required' => 'Trường tổng giá trị là bắt buộc.',
            'hopdong_hinhthucthanhtoan.required' => 'Trường hình thức thanh toán là bắt buộc.',
            'hopdong_trangthai.required' => 'Trường trạng thái là bắt buộc.',
            'hopdong_ghichu.required' => 'Trường ghi chú là bắt buộc nếu không có ghi "Không"',
        ]);

        // $today = Carbon::today();
        $fileUrl = "";
        if ($request->file('filehopdong')) {
            $imageUrl = $this->storeImage($request);
            $fileUrl = $imageUrl;
        }

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
        $hdong->HOPDONG_FILE = $fileUrl;
        $hdong->save();
        return response()->json([
            'success' => true,
            // 'errors' => $validator->errors(),
            'input' => $request->all()
        ]);
        // return redirect('/khachhang');
    }

    public function delete($id)
    {
        $results = DB::select('SET NOCOUNT ON; EXEC CheckDeleteHopDong ?', [$id]);
        //dd($results);
        $message = $results[0]->message;

        if ($message === 'Deleted') {
            return response()->json([
                'success' => true,
            ]);
        } elseif ($message === 'CannotDelete') {
            // return redirect('/khachhang');
            return response()->json([
                'success' => false,
            ]);
        } else {
            return Response::json(['error' => 'Có lỗi xảy ra.'], 500);
        }
    }

    //Con` cai file cuu cuu 
    public function update(Request $request, $id)
    {
        $request->validate([
            'hopdong_so' => 'required',
            'loaihopdong_id' => 'required',
            'khachhang_id' => 'required',
            'hopdong_ngayky' => 'required',
            'hopdong_ngayhieuluc' => 'required',
            'hopdong_ngayketthuc' => 'required',
            'hopdong_tengoithau' => 'required',
            'hopdong_tenduan' => 'required',
            'hopdong_noidung' => 'required',
            'hopdong_thoigianthuchien' => 'required',
            'hopdong_daidienben_a' => 'required',
            'hopdong_daidienben_b' => 'required',
            'hopdong_tonggiatri' => 'required',
            'hopdong_hinhthucthanhtoan' => 'required',
            'hopdong_trangthai' => 'required',
            'hopdong_ghichu' => 'required',
        ], [
            'hopdong_so.required' => 'Trường số hợp đồng là bắt buộc.',
            'loaihopdong_id.required' => 'Trường loại hợp đồng là bắt buộc.',
            // 'khachhang_ten.min' => 'Trường tên khách hàng phải có ít nhất :min ký tự.',
            'khachhang_id.required' => 'Trường khách hàng là bắt buộc.',
            'hopdong_ngayky.required' => 'Chọn ngày ký là bắt buộc.',
            'hopdong_ngayhieuluc.required' => 'Chọn ngày hiệu lực là bắt buộc.',
            'hopdong_ngayketthuc.required' => 'Chọn ngày kết thúc là bắt buộc.',
            'hopdong_tengoithau.required' => 'Trường tên gói thầu là bắt buộc.',
            'hopdong_tenduan.required' => 'Trường tên dự án là bắt buộc.',
            'hopdong_noidung.required' => 'Trường nội dung là bắt buộc.',
            'hopdong_thoigianthuchien.required' => 'Chọn thời gian thực hiện là bắt buộc.',
            'hopdong_daidienben_a.required' => 'Trường đại diện bên A là bắt buộc.',
            'hopdong_daidienben_b.required' => 'Trường đại diện bên B là bắt buộc.',
            'hopdong_tonggiatri.required' => 'Trường tổng giá trị là bắt buộc.',
            'hopdong_hinhthucthanhtoan.required' => 'Trường hình thức thanh toán là bắt buộc.',
            'hopdong_trangthai.required' => 'Trường trạng thái là bắt buộc.',
            'hopdong_ghichu.required' => 'Trường ghi chú là bắt buộc nếu không có ghi "Không"',
        ]);

        $LOAIHOPDONG_ID = $request->loaihopdong_id;
        $KHACHHANG_ID = $request->khachhang_id;
        $HOPDONG_SO = $request->hopdong_so;
        $HOPDONG_NGAYKY = $request->hopdong_ngayky;
        $HOPDONG_NGAYHIEULUC = $request->hopdong_ngayhieuluc;
        $HOPDONG_NGAYKETTHUC = $request->hopdong_ngayketthuc;
        $HOPDONG_TENGOITHAU = $request->hopdong_tengoithau;
        $HOPDONG_TENDUAN = $request->hopdong_tenduan;
        $HOPDONG_NOIDUNG = $request->hopdong_noidung;
        $HOPDONG_DAIDIENBEN_A = $request->hopdong_daidienben_a;
        $HOPDONG_DAIDIENBEN_B = $request->hopdong_daidienben_b;
        $HOPDONG_NGUOILAP = Session::get('infoUser.nguoidung_id');
        $HOPDONG_THOIGIANTHUCHIEN = $request->hopdong_thoigianthuchien;
        $HOPDONG_TONGGIATRI = $request->hopdong_tonggiatri;
        $HOPDONG_HINHTHUCTHANHTOAN = $request->hopdong_hinhthucthanhtoan;
        $HOPDONG_TRANGTHAI = $request->hopdong_trangthai;
        $HOPDONG_GHICHU = $request->hopdong_ghichu;

        DB::update('UPDATE HOPDONG SET
        LOAIHOPDONG_ID = ?,
        KHACHHANG_ID = ?,
        HOPDONG_SO = ?,
        HOPDONG_NGAYKY = ?,
        HOPDONG_NGAYHIEULUC = ?,
        HOPDONG_NGAYKETTHUC = ?,
        HOPDONG_TENGOITHAU = ?,
        HOPDONG_TENDUAN = ?,
        HOPDONG_NOIDUNG = ?,
        HOPDONG_DAIDIENBEN_A = ?,
        HOPDONG_DAIDIENBEN_B = ?,
        HOPDONG_NGUOILAP = ?,
        HOPDONG_THOIGIANTHUCHIEN = ?,
        HOPDONG_TONGGIATRI = ?,
        HOPDONG_HINHTHUCTHANHTOAN = ?,
        HOPDONG_TRANGTHAI = ?,
        HOPDONG_GHICHU = ?
    WHERE HOPDONG_ID = ?;',
            [$LOAIHOPDONG_ID, $KHACHHANG_ID, $HOPDONG_SO, $HOPDONG_NGAYKY, $HOPDONG_NGAYHIEULUC, $HOPDONG_NGAYKETTHUC, $HOPDONG_TENGOITHAU, $HOPDONG_TENDUAN, $HOPDONG_NOIDUNG, $HOPDONG_DAIDIENBEN_A, $HOPDONG_DAIDIENBEN_B, $HOPDONG_NGUOILAP, $HOPDONG_THOIGIANTHUCHIEN, $HOPDONG_TONGGIATRI, $HOPDONG_HINHTHUCTHANHTOAN, $HOPDONG_TRANGTHAI, $HOPDONG_GHICHU, $id]
        );
        return redirect('/hopdong');
    }
}