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
        $startDate = null;
        $endDate = null;
        if ($startDate = request()->start_date) {
            if($endDate = request()->end_date){
                $HoaDonTheoThang = DB::table('hoadon')
                ->selectRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)) AS Thang, YEAR(CONVERT(date, HOADON_NGAYTAO)) AS Nam, COUNT(*) AS SoLuongHoaDon')
                ->whereBetween('HOADON_NGAYTAO', [$startDate, $endDate])
                ->groupByRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)), YEAR(CONVERT(date, HOADON_NGAYTAO))')
                ->get();

                $TongHopDong = DB::table('hopdong')->whereBetween('HOPDONG_NGAYKY', [$startDate, $endDate])->count();
                $TongThuHoaDon = DB::table('hoadon')->whereBetween('HOADON_NGAYTAO', [$startDate, $endDate])->sum('HOADON_TONGTIEN');
                $HopDongMoiTao = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '1')->whereBetween('HOPDONG_NGAYKY', [$startDate, $endDate])->count();
                $HopDongNghiemThu = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '2')->whereBetween('HOPDONG_NGAYKY', [$startDate, $endDate])->count();
                $HopDongXuatHoaDon = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '3')->whereBetween('HOPDONG_NGAYKY', [$startDate, $endDate])->count();
                $HopDongThanhLy = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '4')->whereBetween('HOPDONG_NGAYKY', [$startDate, $endDate])->count();
                
                $TongHoaDon = DB::table('hoadon')->whereBetween('HOADON_NGAYTAO', [$startDate, $endDate])->count('HOADON_ID');
                $TongChuaThanhToan = DB::table('hoadon')->where('HOADON_TRANGTHAI','=','0')->whereBetween('HOADON_NGAYTAO', [$startDate, $endDate])->count();
            }
        }
        else {
            $HoaDonTheoThang = DB::table('hoadon')
            ->selectRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)) AS Thang, YEAR(CONVERT(date, HOADON_NGAYTAO)) AS Nam, COUNT(*) AS SoLuongHoaDon')
            ->groupByRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)), YEAR(CONVERT(date, HOADON_NGAYTAO))')
            ->get();

            $TongHopDong = DB::table('hopdong')->count();
            $TongThuHoaDon = DB::table('hoadon')->sum('HOADON_TONGTIEN');
            $HopDongMoiTao = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '1')->count();
            $HopDongNghiemThu = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '2')->count();
            $HopDongXuatHoaDon = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '3')->count();
            $HopDongThanhLy = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '4')->count();

            $TongHoaDon = DB::table('hoadon')->count('HOADON_ID');
            $TongChuaThanhToan = DB::table('hoadon')->where('HOADON_TRANGTHAI','=','0')->count();
        }
        

        // Định dạng số tiền
        $TongThuHoaDonFormatted = number_format($TongThuHoaDon, 0, ',', '.');

        return view('reports.index', compact('TongHopDong', 'TongThuHoaDonFormatted', 'HopDongMoiTao', 'HopDongNghiemThu', 'HopDongXuatHoaDon', 'HopDongThanhLy', 'HoaDonTheoThang','startDate','endDate','TongHoaDon','TongChuaThanhToan'));
    }

}