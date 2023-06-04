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
        $timestamp = strtotime($hoadon->HOADON_NGAYTAO); 
        $hoadon->HOADON_NGAYTAO = date('d-m-Y', $timestamp);
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

    public function create(Request $request){
        $urlfull = $request->fullUrl();
        $url  = url()->current();
        $hds = ltrim($urlfull,$url);
        $hds = ltrim($hds,'?hopdong=');
        $error = "";
        $hopdong = HopDong::where('HOPDONG_SO', '=', $hds)->first();
        if($hopdong == null) {
            return redirect()->back();
        }
        
        return view('hoadon.create',[
            'hopdongso' => $hds,
            'error' => $error,
        ]);
        //dd($hopdong);
    }
/*
    protected function validator(array $data)
    {
    return Validator::make($data, [
        
        'filehoadon' => ['required']
    ]);
    }*/
    protected function storeImage(Request $request) {
        $fileName = $request->get('sohoadon') . '.' . $request->file('filehoadon')->extension();        
        $path = $request->file('filehoadon')->storeAs('public/HoaDon', $fileName);
        return substr($path, strlen('public/'));
      }

    public function store(Request $request)
    {
        //
        $today = Carbon::today();
        $hoadon = new HoaDon;
        $chitiethoadon = new ChiTietHoaDon;
        

        $idhopdong = HopDong::where('HOPDONG_SO', '=', $request->sohopdong)->first();
        $tthoadontontai = HoaDon::where('HOADON_SO','=',$request->sohoadon)->first();
        if($tthoadontontai == null) {
            //$this->validator($request->all())->validate();
            $imageUrl = $this->storeImage($request);
            $fileUrl = $imageUrl;
            DB::insert("insert into hoadon(HOPDONG_ID,hoadon_so,HOADON_TRANGTHAI,HOADON_TONGTIEN,HOADON_THUESUAT,HOADON_TIENTHUE,HOADON_TONGTIEN_COTHUE,HOADON_SOTIENBANGCHU,HOADON_NGUOITAO,HOADON_NGAYTAO,HOADON_NGUOIMUAHANG,HOADON_FILE)
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
                $fileUrl,
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
            return redirect('/hopdong/'.$request->sohopdong);
        } else {
            $error = "Lỗi: Số hóa đơn đã tồn tại, vui lòng nhập số hóa đơn khác!";
            /*return view('/hoadon/create',[
                'hopdongso' => $request->sohopdong,
                'error' => $error,
            ]);*/
            return redirect()->back()->withInput()->with('error', 'Lỗi: Số hóa đơn đã tồn tại, vui lòng nhập số hóa đơn khác!');

        }
        
        
        
        //return dd($newid->maxid);
        //$hoadon->save();
        
        //return dd($idhopdong->HOPDONG_ID);
    }

    public function index() {
        //$hoadons = DB::select("select * from HOADON join HOPDONG on HOADON.HOPDONG_ID=HOPDONG.HOPDONG_ID order by HOADON_ID desc");
        $hoadons = DB::table('HOADON')->join('HOPDONG','HOADON.HOPDONG_ID','=','HOPDONG.HOPDONG_ID')->orderBy('HOADON_ID','desc')->paginate(10);
        if($key = request()->find){
            $hoadons = DB::table('HOADON')->join('HOPDONG','HOADON.HOPDONG_ID','=','HOPDONG.HOPDONG_ID')->where('HOPDONG_SO', 'like','%'.$key.'%')->orderBy('HOADON_ID','desc')->paginate(10);
        }
        //return dd($hoadons);
        $hopdongs = DB::select("select * from HOPDONG");
        return view('hoadon.index', [
            'hoadons' => $hoadons,
            'hopdongs' => $hopdongs,
        ]);
        
    }

    public function edit($id)
    {
        
        $hoadon = DB::select("select * from hoadon join HOPDONG on HOADON.HOPDONG_ID=HOPDONG.HOPDONG_ID where HOADON_SO=:id;",
        [
            'id' => $id,
        ])[0];
        
        $chitiethoadon = DB::select("select * from CHITIET_HOADON where HOADON_ID=:id;",
        [
            'id' => $hoadon->HOADON_ID,

        ]);
        
        //return dd($hoadon);
        return view('hoadon.edit', [
            'hoadon' => $hoadon,
            'chitiethoadon' => $chitiethoadon,
            'error' => '',
            'cnt' => count($chitiethoadon),
        ]);
    }

    public function update(Request $request, $id)
    {
        //$request->validated();
        if($request->filehoadon == null){
            $hoadon = HoaDon::where('HOADON_ID', $id)  
            ->update([
                'HOADON_THUESUAT' => $request->input('thuesuat'),
                'HOADON_TONGTIEN' => $request->input('tongtien'),
                'HOADON_TIENTHUE' => $request->input('tienthue'),
                'HOADON_TONGTIEN_COTHUE' => $request->input('tongtiencothue'),
                'HOADON_SOTIENBANGCHU' => $request->input('sotienbangchu'),
                'HOADON_NGUOITAO' => $request->input('nguoitao'),
                'HOADON_NGUOIMUAHANG' => $request->input('nguoimuahang'),
                'HOADON_TRANGTHAI' => $request->input('trangthaihoadon'),
            ]);
        }else{
            $imageUrl = $this->storeImage($request);
            $fileUrl = $imageUrl;

            $hoadon = HoaDon::where('HOADON_ID', $id)  
            ->update([
                'HOADON_THUESUAT' => $request->input('thuesuat'),
                'HOADON_TONGTIEN' => $request->input('tongtien'),
                'HOADON_TIENTHUE' => $request->input('tienthue'),
                'HOADON_TONGTIEN_COTHUE' => $request->input('tongtiencothue'),
                'HOADON_SOTIENBANGCHU' => $request->input('sotienbangchu'),
                'HOADON_NGUOITAO' => $request->input('nguoitao'),
                'HOADON_NGUOIMUAHANG' => $request->input('nguoimuahang'),
                'HOADON_TRANGTHAI' => $request->input('trangthaihoadon'),
                'HOADON_FILE' => $fileUrl = $imageUrl,
            ]);
        }
        
        
        ChiTietHoaDon::where('HOADON_ID', $id)->delete();
        
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
                $id,
                $i,
                $request->$nd,
                $request->$sl,
                $request->$dvt,
                $request->$dg,
                $request->$tt,
            ]);
        }
        return redirect('/hoadon/'.$request->sohoadon);
    }

    public function destroy($id)
    {
        ChiTietHoaDon::where('HOADON_ID', $id)->delete();
        $hoadon = HoaDon::find($id);
        $hoadon->delete();
        //dd($id);
        return redirect('/hoadon');
    }
}
