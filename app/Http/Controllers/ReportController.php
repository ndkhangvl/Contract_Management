<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HopDong;
use App\Models\HoaDon;
use Illuminate\Support\Facades\DB;
use App\Models\TrangThaiHD;

class ReportController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $startDate = null;
        $endDate = null;
        if ($startDate = request()->start_date) {
            if($endDate = request()->end_date){
                $HoaDonTheoThang = DB::table('hoadon')
                ->selectRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)) AS Thang, YEAR(CONVERT(date, HOADON_NGAYTAO)) AS Nam, COUNT(*) AS SoLuongHoaDon')
                ->whereBetween('HOADON_NGAYTAO', [$startDate, $endDate])
                ->groupByRaw('MONTH(CONVERT(date, HOADON_NGAYTAO)), YEAR(CONVERT(date, HOADON_NGAYTAO))')
                ->get();

                $ThongtinHD = DB::table('HOPDONG')
                    ->join('TRANGTHAI_HOPDONG', 'HOPDONG.HOPDONG_TRANGTHAI', '=', 'TRANGTHAI_HOPDONG.TRANGTHAI_ID')
                    ->select('HOPDONG.HOPDONG_SO', 'HOPDONG.HOPDONG_TRANGTHAI', 'TRANGTHAI_HOPDONG.TRANGTHAI_TEN',
                        'HOPDONG_TENGOITHAU', 'HOPDONG_TENDUAN', 'HOPDONG_DAIDIENBEN_A', 'HOPDONG_DAIDIENBEN_B',
                        'HOPDONG_THOIGIANTHUCHIEN', DB::raw("FORMAT(HOPDONG_TONGGIATRI, 'N0') AS HOPDONG_TONGGIATRI"),
                        'HOPDONG_NGAYKY')
                    ->whereBetween('HOPDONG.HOPDONG_NGAYKY', [$startDate, $endDate])
                    ->get();


                $ThongtinHoaDon = DB::table('HOADON')
                    ->join('HOPDONG', 'HOPDONG.HOPDONG_ID', '=', 'HOADON.HOPDONG_ID')
                    ->select('HOADON.HOADON_SO', 'HOADON.HOADON_TRANGTHAI', 'HOADON.HOADON_TONGTIEN', 'HOADON.HOADON_TIENTHUE', 'HOADON.HOADON_THUESUAT', 'HOADON.HOADON_TONGTIEN_COTHUE', 'HOADON.HOADON_NGAYTAO', 'HOPDONG.HOPDONG_SO','HOADON_NGUOITAO','HOADON_NGUOIMUAHANG')
                    ->whereBetween('HOADON.HOADON_NGAYTAO', [$startDate, $endDate])
                    ->get();

                $TongHopDong = DB::table('hopdong')->whereBetween('HOPDONG_NGAYKY', [$startDate, $endDate])->count();
                $TongThuHoaDon = DB::table('hoadon')->whereBetween('HOADON_NGAYTAO', [$startDate, $endDate])->sum('HOADON_TONGTIEN_COTHUE');
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

            $ThongtinHD = DB::table('HOPDONG')
                ->join('TRANGTHAI_HOPDONG', 'HOPDONG.HOPDONG_TRANGTHAI', '=', 'TRANGTHAI_HOPDONG.TRANGTHAI_ID')
                ->select('HOPDONG.HOPDONG_SO', 'HOPDONG.HOPDONG_TRANGTHAI', 'TRANGTHAI_HOPDONG.TRANGTHAI_TEN',
                    'HOPDONG_TENGOITHAU', 'HOPDONG_TENDUAN', 'HOPDONG_DAIDIENBEN_A', 'HOPDONG_DAIDIENBEN_B',
                    'HOPDONG_THOIGIANTHUCHIEN', DB::raw("FORMAT(HOPDONG_TONGGIATRI, 'N0') AS HOPDONG_TONGGIATRI"),
                    'HOPDONG_NGAYKY')
                ->get();

            
            $ThongtinHoaDon = DB::table('HOADON')
                ->join('HOPDONG', 'HOPDONG.HOPDONG_ID', '=', 'HOADON.HOPDONG_ID')
                ->select('HOADON.HOADON_SO', 'HOADON.HOADON_TRANGTHAI', 'HOADON.HOADON_TONGTIEN', 'HOADON.HOADON_TIENTHUE', 'HOADON.HOADON_THUESUAT', 'HOADON.HOADON_TONGTIEN_COTHUE', 'HOADON.HOADON_NGAYTAO', 'HOPDONG.HOPDONG_SO','HOADON_NGUOITAO','HOADON_NGUOIMUAHANG')
                ->get();
            

            $TongHopDong = DB::table('hopdong')->count();
            $TongThuHoaDon = DB::table('hoadon')->sum('HOADON_TONGTIEN_COTHUE');
            $HopDongMoiTao = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '1')->count();
            $HopDongNghiemThu = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '2')->count();
            $HopDongXuatHoaDon = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '3')->count();
            $HopDongThanhLy = DB::table('hopdong')->where('HOPDONG_TRANGTHAI', '4')->count();

            $TongHoaDon = DB::table('hoadon')->count('HOADON_ID');
            $TongChuaThanhToan = DB::table('hoadon')->where('HOADON_TRANGTHAI','=','0')->count();
        }
        

        // Định dạng số tiền
        $TongThuHoaDonFormatted = number_format($TongThuHoaDon, 0, ',', '.');

        return view('reports.index', compact('ThongtinHoaDon', 'TongHopDong', 'TongThuHoaDonFormatted', 'HopDongMoiTao', 'HopDongNghiemThu', 'HopDongXuatHoaDon', 'HopDongThanhLy', 'HoaDonTheoThang','ThongtinHD', 'startDate','endDate','TongHoaDon','TongChuaThanhToan'));
    }


}