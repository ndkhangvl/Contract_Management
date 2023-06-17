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
        return response()->json([
            'success' => true,
            // 'errors' => $validator->errors(),
            'input' => $request->all()
        ]);
        // return redirect('/khachhang');
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
        $khachhang = KhachHang::find($id);
        $hopdong = HopDong::where('KHACHHANG_ID', $khachhang->KHACHHANG_ID)->first();

        if ($hopdong) {
            session()->flash('error', 'Không thể xóa khách hàng vì có hợp đồng.');
            return back();
        }

        $khachhang->delete();
        session()->flash('success', 'Xóa khách hàng thành công.');
        return redirect()->route('khachhang.index');
    }

}
