<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiKhachHang;
use Illuminate\Support\Facades\DB;

class LoaiKhachHangController extends Controller
{
    public function index()
    {
        $loaikhachhangs = DB::select("SELECT * FROM LOAI_KHACHHANG ORDER BY LOAIKHACHHANG_ID ASC;");

        return view('database', [
            'loaikhachhangs' => $loaikhachhangs,
        ]);
    }

    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'loaikhachhangid' => 'required',
            'loaikhachhangma' => 'required',
            'loaikhachhangten' => 'required',
            'loaikhachhangidcss' => 'required',
        ]);

        DB::table('LOAI_KHACHHANG')->insert([
            'LOAIKHACHHANG_ID' => $validatedData['loaikhachhangid'],
            'LOAIKHACHHANG_MA' => $validatedData['loaikhachhangma'],
            'LOAIKHACHHANG_TEN' => $validatedData['loaikhachhangten'],
            'LOAIKHACHHANG_ID_CSS' => $validatedData['loaikhachhangidcss'],
        ]);

        return redirect('/')->with('success', 'Data inserted successfully!');
    }
    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'loaikhachhangid' => 'required'
        ]);

        DB::table('LOAI_KHACHHANG')->where('LOAIKHACHHANG_ID', $validatedData['loaikhachhangid'])->delete();

        return redirect('/')->with('success', 'Data deleted successfully!');
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

        DB::update('UPDATE [LOAI_KHACHHANG] SET [LOAIKHACHHANG_MA] = ?,
            [LOAIKHACHHANG_TEN] = ?,
            [LOAIKHACHHANG_ID_CSS] = ?
            WHERE [LOAIKHACHHANG_ID] = ?;', [$loaikhachhangma, $loaikhachhangten, $loaikhachhangidcss, $loaikhachhangid]);
    }

}
