<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiKhachHang;
use App\Models\KhachHang;
use App\Models\TrangThaiKH;
use App\Models\HopDong;
use Carbon\Carbon;
use App\Models\History;
use Illuminate\Support\Facades\Session;

//use App\Http\Requests\CreateValidationRequest;

class KhachHangController extends Controller
{
    
    public function index() {
        $loaikhachhang = LoaiKhachHang::orderBy('LOAIKHACHHANG_TEN', 'asc')->get();
        $khachhangs = DB::select("select * from KHACHHANG join LOAI_KHACHHANG on KHACHHANG.LOAIKHACHHANG_ID=LOAI_KHACHHANG.LOAIKHACHHANG_ID
        join TRANGTHAI_KHACHHANG on KHACHHANG.KHACHHANG_TRANGTHAI=TRANGTHAI_KHACHHANG.TRANGTHAI_ID;");
        return view('khachhang.index', [
            'khachhangs' => $khachhangs,
            'loaikhachhang' => $loaikhachhang,
        ]); 
    }

    public function show($id) {
        /*$khachhang = DB::select("EXEC GetKhachHangByID @KhachHangID = :id", [
            'id' => $id
        ]);*/
        $khachhangs = DB::select('select * from KHACHHANG');
        $trangthaihopdongs = DB::select('select * from TRANGTHAI_HOPDONG');
        $khachhang = DB::select("select * from KHACHHANG join LOAI_KHACHHANG on KHACHHANG.LOAIKHACHHANG_ID=LOAI_KHACHHANG.LOAIKHACHHANG_ID
        join TRANGTHAI_KHACHHANG on KHACHHANG.KHACHHANG_TRANGTHAI=TRANGTHAI_KHACHHANG.TRANGTHAI_ID where KHACHHANG_ID=:id;",
        [
            'id' => $id
        ]);
        $hopdongs = DB::select("select * from HOPDONG where KHACHHANG_ID=:id;",
        [
            'id' => $id
        ]);
        //return view('khachhang.show')->with('khachhang', $khachhang);
        return view('khachhang.show', [
            'khachhang' => $khachhang,
            'hopdongs' => $hopdongs,
            'khachhangs' => $khachhangs,
            'trangthaihopdongs' => $trangthaihopdongs,
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
        $request->validate([
            'loaikhachhang_id' => 'required',
            'khachhang_ten' => 'required|min:5',
            'khachhang_diachi' => 'required',
            'khachhang_sdt' => 'required',
            'khachhang_email' => 'required',
            'khachhang_chusohuu' => 'required',
            'khachhang_nguoidaidien' => 'required',
            'khachhang_cmnd' => 'required',
            'khachhang_ngaycapcmnd' => 'required',
            'khachhang_ngaysinhndd' => 'required',
            'khachhang_ngayhoatdong' => 'required',
            'khachhang_masothue' => 'required',
        ], [
            'loaikhachhang_id.required' => 'Trường loại khách hàng là bắt buộc.',
            'khachhang_ten.required' => 'Trường tên khách hàng là bắt buộc.',
            'khachhang_ten.min' => 'Trường tên khách hàng phải có ít nhất :min ký tự.',
            'khachhang_diachi.required' => 'Trường địa chỉ khách hàng là bắt buộc.',
            'khachhang_sdt.required' => 'Trường số điện thoại là bắt buộc.',
            'khachhang_email.required' => 'Trường email là bắt buộc.',
            'khachhang_chusohuu.required' => 'Trường chủ sở hữu là bắt buộc.',
            'khachhang_nguoidaidien.required' => 'Trường người đại diện là bắt buộc.',
            'khachhang_cmnd.required' => 'Trường CCCD là bắt buộc.',
            'khachhang_ngaycapcmnd.required' => 'Chọn ngày cấp CCCD là bắt buộc.',
            'khachhang_ngaysinhndd.required' => 'Chọn ngày sinh là bắt buộc.',
            'khachhang_ngayhoatdong.required' => 'Chọn ngày hoạt động là bắt buộc.',
            'khachhang_masothue.required' => 'Trường mã số thuế là bắt buộc.',
        ]);

        $today = Carbon::today();

        $khachhang = new KhachHang;
        $khachhang->LOAIKHACHHANG_ID = $request->loaikhachhang_id;
        $khachhang->KHACHHANG_TEN = $request->khachhang_ten;
        $khachhang->KHACHHANG_DIACHI = $request->khachhang_diachi;
        $khachhang->KHACHHANG_SDT = $request->khachhang_sdt;
        $khachhang->KHACHHANG_EMAIL = $request->khachhang_email;
        $khachhang->KHACHHANG_CHUSOHUU = $request->khachhang_chusohuu;
        $khachhang->KHACHHANG_NGUOIDAIDIEN = $request->khachhang_nguoidaidien;
        $khachhang->KHACHHANG_CMND = $request->khachhang_cmnd;
        $khachhang->KHACHHANG_NGAYCAPCMND = $request->khachhang_ngaycapcmnd;
        $khachhang->KHACHHANG_NGAYSINHNDD = $request->khachhang_ngaysinhndd;
        $khachhang->KHACHHANG_NGAYHOATDONG = $request->khachhang_ngayhoatdong;
        $khachhang->KHACHHANG_TRANGTHAI = 2;
        $khachhang->KHACHHANG_MASOTHUE = $request->khachhang_masothue;
        $khachhang->NGAYTAOLAP = $today;
        $khachhang->save();

        
        $history = new History;
        $history->ten_nd = Session::get('infoUser.ten_nd');
        $history->action = 'Thêm';
        $history->model_type = 'Khách Hàng';
        $history->model_id = $khachhang->KHACHHANG_ID;
        $history->description = 'Thêm mới khách hàng: ' . mb_convert_encoding($khachhang->KHACHHANG_ID, 'UTF-8');
        $history->Time = Carbon::now();
        $history->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
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

                $history = new History;
                $history->ten_nd = Session::get('infoUser.ten_nd');
                $history->action = 'Sửa';
                $history->model_type = 'Khách Hàng';
                $history->model_id = $id;
                $history->description = 'Sửa thông tin khách hàng: ' . mb_convert_encoding($id, 'UTF-8');
                $history->Time = Carbon::now();
                $history->save();

        return redirect('/khachhang');
    }

    public function destroy($id)
    {
        $khachhang = KhachHang::find($id);
        $hopdong = HopDong::where('KHACHHANG_ID', $khachhang->KHACHHANG_ID)->first();

        if ($hopdong) {
            session()->flash('error', 'Không thể xóa khách hàng vì có hợp đồng.');
            return back();
        }

        $khachhang->delete();

        $history = new History;
        $history->ten_nd = Session::get('infoUser.ten_nd');
        $history->action = 'Xóa';
        $history->model_type = 'Khách Hàng';
        $history->model_id = $khachhang->KHACHHANG_ID;
        $history->description = "Xóa thông tin khách hàng: " . $id . "";
        $history->Time = Carbon::now();
        $history->save();

        session()->flash('success', 'Xóa khách hàng thành công.');
        return redirect()->route('khachhang.index');
    }


}
