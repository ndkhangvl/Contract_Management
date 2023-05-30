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
        //$loaikhachhangs = DB::select("SELECT * FROM LOAI_KHACHHANG ORDER BY LOAIKHACHHANG_ID ASC;")->paginate(5);
        // $loaikhachhangs = collect($loaikhachhangs)->paginate(5);

        return view('loaikhachhang/index', [
            'loaikhachhangs' => $loaikhachhangs,
        ]);
        // return view('loaikhachhang/index', compact('loaikhachhangs'))->with('i', (request()->input('page', 1) -1) *5);
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
