<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HopDong;
use App\Models\HoaDon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $TongHopDong = DB::table('hopdong')->count();
        $TongHoaDon = DB::table('hoadon')->sum('HOADON_TONGTIEN');
        $HopDongHoatDong = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '1')->count();
        $HopDongNgungHoatDong = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '0')->count();

        $HoaDonTheoThang = DB::table('hoadon')
            ->selectRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)) AS Thang, YEAR(CONVERT(date, HOADON_NGAYTAO)) AS Nam, COUNT(*) AS SoLuongHoaDon')
            ->groupByRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)), YEAR(CONVERT(date, HOADON_NGAYTAO))')
            ->get();

            
        return view('reports.index', compact('TongHopDong', 'TongHoaDon', 'HopDongHoatDong', 'HopDongNgungHoatDong', 'HoaDonTheoThang'));
    }
}