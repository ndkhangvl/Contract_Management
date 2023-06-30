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
        // $loaikhachhangss = DB::table('LOAI_KHACHHANG')->orderBy('LOAIKHACHHANG_ID','asc');
        $loaikhachhangs = DB::table('LOAI_KHACHHANG')->orderBy('LOAIKHACHHANG_ID','asc')->paginate(10);
        // $loaikhachhangss = DB::select("SELECT * FROM LOAI_KHACHHANG ORDER BY LOAIKHACHHANG_ID ASC;");
        // $loaikhachhangs = collect($loaikhachhangs)->paginate(5);

        return view('loaikhachhang/index', [
            'loaikhachhangs' => $loaikhachhangs,
            // 'loaikhachhangss' => $loaikhachhangss,
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

        return redirect('/')->with('success', 'Thêm loại khách hàng thành công');
    }
    /*public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'loaikhachhangid' => 'required'
        ]);

        DB::table('LOAI_KHACHHANG')->where('LOAIKHACHHANG_ID', $validatedData['loaikhachhangid'])->delete();

        return redirect('/')->with('success', 'Data deleted successfully!');
    }*/
    public function delete($loaikhachhangid)
    {
        $khachHangCount = DB::table('KHACHHANG')->where('LOAIKHACHHANG_ID', $loaikhachhangid)->count();

        if ($khachHangCount > 0) {
            session()->flash('error', 'Không thể xóa Loại Khách Hàng vì có Khách Hàng mang loại này.');
            return redirect()->back()->withErrors('Không thể xóa Loại Khách Hàng vì có Khách Hàng mang loại này.');
        }

        DB::table('LOAI_KHACHHANG')->where('LOAIKHACHHANG_ID', $loaikhachhangid)->delete();
        session()->flash('success', 'Xóa loại khách hàng thành công.');
        return redirect()->back()->with('success', 'Xóa loại khách hàng thành công');
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
    
        return redirect('/')->with('success', 'Cập nhật loại khách hàng thành công');
    }
    

}
