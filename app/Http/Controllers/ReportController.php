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
        $TongThuHoaDon = DB::table('hoadon')->sum('HOADON_TONGTIEN');
        $HopDongMoiTao = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '1')->count();
        $HopDongNghiemThu = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '2')->count();
        $HopDongXuatHoaDon = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '3')->count();
        $HopDongThanhLy = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '4')->count();

        $HoaDonTheoThang = DB::table('hoadon')
            ->selectRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)) AS Thang, YEAR(CONVERT(date, HOADON_NGAYTAO)) AS Nam, COUNT(*) AS SoLuongHoaDon')
            ->groupByRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)), YEAR(CONVERT(date, HOADON_NGAYTAO))')
            ->get();

        // Định dạng số tiền
        $TongThuHoaDonFormatted = number_format($TongThuHoaDon, 0, ',', '.');

        return view('reports.index', compact('TongHopDong', 'TongThuHoaDonFormatted', 'HopDongMoiTao', 'HopDongNghiemThu', 'HopDongXuatHoaDon', 'HopDongThanhLy', 'HoaDonTheoThang'));
    }

}