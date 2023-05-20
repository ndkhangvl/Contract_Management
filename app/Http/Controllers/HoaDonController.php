<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\HopDong;
use Carbon\Carbon;

use Illuminate\Support\Facades\URL;
class HoaDonController extends Controller
{
    //
    public function show($id) {
        
        $hoadon = DB::select("select * from hoadon join HOPDONG on HOADON.HOPDONG_ID=HOPDONG.HOPDONG_ID where HOADON_SO=:id;",
        [
            'id' => $id,
        ])[0];
        
        $chitiethoadon = DB::select("select * from CHITIET_HOADON where HOADON_ID=:id;",
        [
            'id' => $hoadon->HOADON_ID,

        ]);
        
        //return dd($hoadon);
        return view('hoadon.show', [
            'hoadon' => $hoadon,
            'chitiethoadon' => $chitiethoadon,
        ]);
    }

    public function create(){
        $urlfull  = url()->full();
        $url  = url()->current();
        $hds = ltrim($urlfull,$url);
        $hds = ltrim($hds,'?hopdong=');

        $hopdong = HopDong::where('HOPDONG_SO', '=', $hds)->first();
        if($hopdong == null) {
            return redirect('/');
        }
        
        return view('hoadon.create',[
            'hopdongso' => $hds,
        ]);
        //dd($hopdong);
    }

    public function store(Request $request)
    {
        //
        $today = Carbon::today();
        $hoadon = new HoaDon;
        $chitiethoadon = new ChiTietHoaDon;
        
        $idhopdong = HopDong::where('HOPDONG_SO', '=', $request->sohopdong)->first();
        
        DB::insert("insert into hoadon(HOPDONG_ID,hoadon_so,HOADON_TRANGTHAI,HOADON_TONGTIEN,HOADON_THUESUAT,HOADON_TIENTHUE,HOADON_TONGTIEN_COTHUE,HOADON_SOTIENBANGCHU,HOADON_NGUOITAO,HOADON_NGAYTAO,HOADON_NGUOIMUAHANG)
        values(
           ?,
           ?,
           ?,
           ?,
           ?,
           ?,
           ?,
           ?,
           ?,
           ?,
           ?
        );",
        [
            $idhopdong->HOPDONG_ID,
            $request->sohoadon,
            $request->trangthaihoadon,
            $request->tongtien,
            $request->thuesuat,
            $request->tienthue,
            $request->tongtiencothue,
            $request->sotienbangchu,
            $request->nguoitao,
            $today,
            $request->nguoimuahang,
        ]);
        
        $newid = DB::select(" select max(HOADON_ID) as maxid from HOADON;")[0];

        $soluongchitiet = $request->soluongchitiet;
        for ($i = 1; $i <= $soluongchitiet; $i++){
            $nd = "noidung".$i;
            $sl = "soluong".$i;
            $dvt = "donvitinh".$i;
            $dg = "dongia".$i;
            $tt = "thanhtien".$i;
            
            DB::insert("insert into CHITIET_HOADON(HOADON_ID,STT,NOIDUNG,SOLUONG,DVT,DONGIA,THANHTIEN)
            values(
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?
            );",
            [
                $newid->maxid,
                $i,
                $request->$nd,
                $request->$sl,
                $request->$dvt,
                $request->$dg,
                $request->$tt,
            ]);
        }
        
        //return dd($newid->maxid);
        //$hoadon->save();
        return redirect('/hopdong/'.$request->sohopdong);
        //return dd($idhopdong->HOPDONG_ID);
    }
}
