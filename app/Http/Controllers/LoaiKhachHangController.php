<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiKhachHang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class LoaiKhachHangController extends Controller
{
    public function index()
    {
        $loaikhachhangs = DB::table('LOAI_KHACHHANG')->orderBy('LOAIKHACHHANG_ID','asc')->paginate(10);
        return view('loaikhachhang/index', [
            'loaikhachhangs' => $loaikhachhangs,
        ]);
    }

    public function insert(Request $request){
    $validatedData = $request->validate([
        'loaikhachhangid' => 'required',
        'loaikhachhangma' => 'required',
        'loaikhachhangten' => 'required',
        'loaikhachhangidcss' => 'required',
    ]);
    $existingLoaiKhachHang = DB::table('LOAI_KHACHHANG')->where('LOAIKHACHHANG_ID', $validatedData['loaikhachhangid'])->count();

    if ($existingLoaiKhachHang > 0) {
        return response()->json([
            'error' => $validator->errors()
        ]);
    } else {
        DB::table('LOAI_KHACHHANG')->insert([
            'LOAIKHACHHANG_ID' => $validatedData['loaikhachhangid'],
            'LOAIKHACHHANG_MA' => $validatedData['loaikhachhangma'],
            'LOAIKHACHHANG_TEN' => $validatedData['loaikhachhangten'],
            'LOAIKHACHHANG_ID_CSS' => $validatedData['loaikhachhangidcss'],
        ]);
        return response()->json([
            'success' => true
        ]);
    }}
    public function delete($loaikhachhangid)
    {
        $khachHangCount = DB::table('KHACHHANG')->where('LOAIKHACHHANG_ID', $loaikhachhangid)->count();

        if ($khachHangCount > 0) {
            return;
        } else {
            DB::table('LOAI_KHACHHANG')->where('LOAIKHACHHANG_ID', $loaikhachhangid)->delete();
            return response()->json([
                'success' => true
            ]);
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'loaikhachhangid' => 'required',
            'loaikhachhangma' => 'required',
            'loaikhachhangten' => 'required',
            'loaikhachhangidcss' => 'required',
        ]);
    
        $loaikhachhangid = $request->input('loaikhachhangid');
        $loaikhachhangma = $request->input('loaikhachhangma');
        $loaikhachhangten = $request->input('loaikhachhangten');
        $loaikhachhangidcss = $request->input('loaikhachhangidcss');
    
        DB::table('LOAI_KHACHHANG')
            ->where('LOAIKHACHHANG_ID', $loaikhachhangid)
            ->update([
                'LOAIKHACHHANG_MA' => $loaikhachhangma,
                'LOAIKHACHHANG_TEN' => $loaikhachhangten,
                'LOAIKHACHHANG_ID_CSS' => $loaikhachhangidcss,
            ]);
    
            return response()->json([
                'success' => true
            ]);
    }
    

}
