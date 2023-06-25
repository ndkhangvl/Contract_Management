<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\HopDong;
use Carbon\Carbon;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
class HoaDonController extends Controller
{
    //
    public function show($id) {
        
        $hoadon = DB::select("select * from hoadon join HOPDONG on HOADON.HOPDONG_ID=HOPDONG.HOPDONG_ID join KHACHHANG on HOPDONG.KHACHHANG_ID = KHACHHANG.KHACHHANG_ID where HOADON_SO=:id;",
        [
            'id' => $id,
        ])[0];
        $timestamp = strtotime($hoadon->HOADON_NGAYTAO); 
        $hoadon->HOADON_NGAYTAO = date('d-m-Y', $timestamp);
        $hoadon->HOADON_TONGTIEN = number_format(round($hoadon->HOADON_TONGTIEN),0,'.','.');
        $hoadon->HOADON_TIENTHUE = number_format(round($hoadon->HOADON_TIENTHUE),0,'.','.');
        $hoadon->HOADON_TONGTIEN_COTHUE = number_format(round($hoadon->HOADON_TONGTIEN_COTHUE),0,'.','.');
        
        $chitiethoadon = DB::select("select * from CHITIET_HOADON where HOADON_ID=:id;",
        [
            'id' => $hoadon->HOADON_ID,

        ]);
        $chitiethoadon2 = DB::select("select * from CHITIET_HOADON where HOADON_ID=:id;",
        [
            'id' => $hoadon->HOADON_ID,

        ]);
        for ($i = 0 ; $i < count($chitiethoadon); $i++){
            $chitiethoadon[$i]->DONGIA = number_format(round($chitiethoadon[$i]->DONGIA),0,'.','.');
            $chitiethoadon[$i]->THANHTIEN = number_format(round($chitiethoadon[$i]->THANHTIEN),0,'.','.');
        }
        
        //return dd($hoadon);
        return view('hoadon.show', [
            'hoadon' => $hoadon,
            'chitiethoadon' => $chitiethoadon,
            'chitiethoadon2' => $chitiethoadon2,
            'cnt' => count($chitiethoadon),
        ]);
    }

    public function create(){
        $urlfull  = url()->full();
        $url  = url()->current();
        $hds = ltrim($urlfull,$url);
        $hds = ltrim($hds,'?hopdong=');
        $error = "";
        $hopdong = HopDong::where('HOPDONG_SO', '=', $hds)->first();
        if($hopdong == null) {
            return redirect()->back();
        }
        $hoadons = DB::select("select HOADON_SO from hoadon;");
        return view('hoadon.create',[
            'hopdongso' => $hds,
            'error' => $error,
            'dssohoadon' => $hoadons,
            'cnt' => count($hoadons)
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
        $validatedData = $request->validate([
            'sohopdong' => 'required',
            'sohoadon' => 'required',
            //'filehoadon' => 'required',
            'thuesuat' => 'required',
            'tongtien' => 'required',
            'tienthue' => 'required',
            'tongtiencothue' => 'required',
            'sotienbangchu' => 'required',
            'nguoitao' => 'required',
            'nguoimuahang' => 'required',
        ], [
            'sohopdong.required' => 'Trường số hợp đồng là bắt buộc.',
            'sohoadon.required' => 'Trường số hóa đơn là bắt buộc.',
            //'filehoadon.required' => 'Trường file hóa đơn là bắt buộc.',
            'thuesuat.required' => 'Trường thuế là bắt buộc.',
            'tongtien.required' => 'Trường tổng tiền là bắt buộc.',
            'tienthue.required' => 'Trường tiền thuế là bắt buộc.',
            'tongtiencothue.required' => 'Trường tổng tiền (có thuế) là bắt buộc.',
            'sotienbangchu.required' => 'Trường số tiền bằng chữ là bắt buộc.',
            'nguoitao.required' => 'Trường người tạo là bắt buộc.',
            'nguoimuahang.required' => 'Trường người mua hàng là bắt buộc.',
        ]);

        
        $today = Carbon::today();
        $hoadon = new HoaDon;
        $chitiethoadon = new ChiTietHoaDon;
        

        $idhopdong = HopDong::where('HOPDONG_SO', '=', $request->sohopdong)->first();
        $tthoadontontai = HoaDon::where('HOADON_SO','=',$request->sohoadon)->first();
        if($tthoadontontai == null) {
            
            $fileUrl = "";
            if ($request->file('filehoadon')){
                $imageUrl = $this->storeImage($request);
                $fileUrl = $imageUrl;
            }
            
            $newid = DB::select('SET NOCOUNT ON; exec insertHoaDon ?,?,?,?,?,?,?,?,?,?,?,?',
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
                $fileUrl
            ]);

            $soluongchitiet = $request->soluongchitiet;
            for ($i = 1; $i <= $soluongchitiet; $i++){
                $nd = "noidung".$i;
                $sl = "soluong".$i;
                $dvt = "donvitinh".$i;
                $dg = "dongia".$i;
                $tt = "thanhtien".$i;
                
                DB::update('SET NOCOUNT ON; exec insertChiTietHoaDon ?,?,?,?,?,?,?',
                [
                    $newid[0]->HOADON_ID,
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
            
            return redirect()->back()->withInput()->with('error', 'Lỗi: Số hóa đơn đã tồn tại, vui lòng nhập số hóa đơn khác!');

        }
    }

    public function index() {
        
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $key = '';
        $state = 2;
        $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',[$key, 2]);
        if ($key = request()->find) {
            switch (request()->state) {
                case '2':
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',[$key,2]);
                    break;
                case '0':
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',[$key,0]);
                    break;
                case '1':
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',[$key,1]);
                    break;
                default:
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',[$key,2]);
                    break;
            }
        } else {
            switch (request()->state) {
                case '2':
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',['',2]);
                    break;
                case '0':
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',['',0]);
                    break;
                case '1':
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',['',1]);
                    break;
                default:
                    $results = DB::select('EXEC GetHoaDonWithHopDong ?, ?',['',2]);
                    break;
            }
        }
        for ($i = 0 ; $i < count($results); $i++){
            $timestamp = strtotime($results[$i]->HOADON_NGAYTAO); 
            $results[$i]->HOADON_NGAYTAO = date('d-m-Y', $timestamp);
            $results[$i]->HOADON_TONGTIEN_COTHUE = number_format(round($results[$i]->HOADON_TONGTIEN_COTHUE),0,'.','.');
        }
        $total = count($results);
        $offset = ($currentPage - 1) * $perPage;
        $results = array_slice($results, $offset, $perPage);
        $hoadons = new LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
        
        $hopdongs = DB::select("select * from HOPDONG");
        $dssohoadon = DB::select("select HOADON_SO from hoadon;");
        return view('hoadon.index', [
            'hoadons' => $hoadons,
            'hopdongs' => $hopdongs,
            'dssohoadon' => $dssohoadon,
            'cnt' => count($dssohoadon)
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
        $validatedData = $request->validate([
            'sohopdong' => 'required',
            'sohoadon' => 'required',
            //'filehoadon' => 'required',
            'thuesuat' => 'required',
            'tongtien' => 'required',
            'tienthue' => 'required',
            'tongtiencothue' => 'required',
            'sotienbangchu' => 'required',
            'nguoitao' => 'required',
            'nguoimuahang' => 'required',
        ], [
            'sohopdong.required' => 'Trường số hợp đồng là bắt buộc.',
            'sohoadon.required' => 'Trường số hóa đơn là bắt buộc.',
            //'filehoadon.required' => 'Trường file hóa đơn là bắt buộc.',
            'thuesuat.required' => 'Trường thuế là bắt buộc.',
            'tongtien.required' => 'Trường tổng tiền là bắt buộc.',
            'tienthue.required' => 'Trường tiền thuế là bắt buộc.',
            'tongtiencothue.required' => 'Trường tổng tiền (có thuế) là bắt buộc.',
            'sotienbangchu.required' => 'Trường số tiền bằng chữ là bắt buộc.',
            'nguoitao.required' => 'Trường người tạo là bắt buộc.',
            'nguoimuahang.required' => 'Trường người mua hàng là bắt buộc.',
        ]);

        //$request->validated();
        
        $fileUrl = "";
        if ($request->file('filehoadon')){
            $imageUrl = $this->storeImage($request);
            $fileUrl = $imageUrl;

            DB::update('exec updateHoaDon_WithFile ?,?,?,?,?,?,?,?,?,?',
            [
                $id,
                $request->tongtien,
                $request->thuesuat,
                $request->tienthue,
                $request->tongtiencothue,
                $request->sotienbangchu,
                $request->nguoitao,
                $request->nguoimuahang,
                $request->trangthaihoadon,
                $fileUrl = $imageUrl
            ]);
        } else {
            DB::update('exec updateHoaDon_NoFile ?,?,?,?,?,?,?,?,?',
            [
                $id,
                $request->tongtien,
                $request->thuesuat,
                $request->tienthue,
                $request->tongtiencothue,
                $request->sotienbangchu,
                $request->nguoitao,
                $request->nguoimuahang,
                $request->trangthaihoadon
            ]);
        }

        $soluongchitiet = $request->soluongchitiet;
        for ($i = 1; $i <= $soluongchitiet; $i++){
            $nd = "noidung".$i;
            $sl = "soluong".$i;
            $dvt = "donvitinh".$i;
            $dg = "dongia".$i;
            $tt = "thanhtien".$i;
                
            DB::update('SET NOCOUNT ON; exec insertChiTietHoaDon ?,?,?,?,?,?,?',
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
        DB::update('exec deleteHoaDon ?', [$id]);
        return redirect('/hoadon');
    }
        

    public function exportInvoices()
    {
        $ngayxuat = Carbon::now('Asia/Ho_Chi_Minh')->year."-".Carbon::now('Asia/Ho_Chi_Minh')->month."-".Carbon::now('Asia/Ho_Chi_Minh')->day."_".Carbon::now('Asia/Ho_Chi_Minh')->hour."-".Carbon::now('Asia/Ho_Chi_Minh')->minute."-".Carbon::now('Asia/Ho_Chi_Minh')->second;
        return Excel::download(new InvoiceExport, 'TK_HOADON_'.$ngayxuat.'.xlsx');
    }

    public function storeModal(Request $request)
    {
        $request->validate([
            'sohopdong' => 'required',
            'sohoadon' => 'required',
            //'filehoadon' => 'required',
            'thuesuat' => 'required',
            'tongtien' => 'required',
            'tienthue' => 'required',
            'tongtiencothue' => 'required',
            'sotienbangchu' => 'required',
            'nguoitao' => 'required',
            'nguoimuahang' => 'required',
        ], [
            'sohopdong.required' => 'Trường số hợp đồng là bắt buộc.',
            'sohoadon.required' => 'Trường số hóa đơn là bắt buộc.',
            //'filehoadon.required' => 'Trường file (Modal) hóa đơn là bắt buộc.',
            'thuesuat.required' => 'Trường thuế là bắt buộc.',
            'tongtien.required' => 'Trường tổng tiền là bắt buộc.',
            'tienthue.required' => 'Trường tiền thuế là bắt buộc.',
            'tongtiencothue.required' => 'Trường tổng tiền (có thuế) là bắt buộc.',
            'sotienbangchu.required' => 'Trường số tiền bằng chữ là bắt buộc.',
            'nguoitao.required' => 'Trường người tạo là bắt buộc.',
            'nguoimuahang.required' => 'Trường người mua hàng là bắt buộc.',
        ]);

        //
        $today = Carbon::today();
        $hoadon = new HoaDon;
        $chitiethoadon = new ChiTietHoaDon;
        

        $idhopdong = HopDong::where('HOPDONG_SO', '=', $request->sohopdong)->first();
        $tthoadontontai = HoaDon::where('HOADON_SO','=',$request->sohoadon)->first();
        if($tthoadontontai == null) {
            
            $fileUrl = "";
            if ($request->file('filehoadon')){
                $imageUrl = $this->storeImage($request);
                $fileUrl = $imageUrl;
            }
                
            $newid = DB::select('SET NOCOUNT ON; exec insertHoaDon ?,?,?,?,?,?,?,?,?,?,?,?',
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
                $fileUrl
            ]);

            $soluongchitiet = $request->soluongchitiet;
            for ($i = 1; $i <= $soluongchitiet; $i++){
                $nd = "noidung".$i;
                $sl = "soluong".$i;
                $dvt = "donvitinh".$i;
                $dg = "dongia".$i;
                $tt = "thanhtien".$i;
                
                DB::update('SET NOCOUNT ON; exec insertChiTietHoaDon ?,?,?,?,?,?,?',
                [
                    $newid[0]->HOADON_ID,
                    $i,
                    $request->$nd,
                    $request->$sl,
                    $request->$dvt,
                    $request->$dg,
                    $request->$tt,
                ]);
            }

            return response()->json([
                'success' => true,
                // 'errors' => $validator->errors(),
                'input' => $request->all()
            ]);
        }
    }

    public function pdf($id) 
    {
        
        $hoadon = DB::select("select * from hoadon join HOPDONG on HOADON.HOPDONG_ID=HOPDONG.HOPDONG_ID join KHACHHANG on HOPDONG.KHACHHANG_ID = KHACHHANG.KHACHHANG_ID where HOADON_ID=:id;",
        [
            'id' => $id,
        ])[0];
        $timestamp = strtotime($hoadon->HOADON_NGAYTAO); 
        $hoadon->HOADON_NGAYTAO = date('d-m-Y', $timestamp);
        $hoadon->HOADON_TONGTIEN = number_format(round($hoadon->HOADON_TONGTIEN),0,'.','.');
        $hoadon->HOADON_TIENTHUE = number_format(round($hoadon->HOADON_TIENTHUE),0,'.','.');
        $hoadon->HOADON_TONGTIEN_COTHUE = number_format(round($hoadon->HOADON_TONGTIEN_COTHUE),0,'.','.');
        
        $chitiethoadon = DB::select("select * from CHITIET_HOADON where HOADON_ID=:id;",
        [
            'id' => $hoadon->HOADON_ID,

        ]);
        for ($i = 0 ; $i < count($chitiethoadon); $i++){
            $chitiethoadon[$i]->DONGIA = number_format(round($chitiethoadon[$i]->DONGIA),0,'.','.');
            $chitiethoadon[$i]->THANHTIEN = number_format(round($chitiethoadon[$i]->THANHTIEN),0,'.','.');
        }
        
        $ngayxuat = Carbon::now('Asia/Ho_Chi_Minh')->year."-".Carbon::now('Asia/Ho_Chi_Minh')->month."-".Carbon::now('Asia/Ho_Chi_Minh')->day."_".Carbon::now('Asia/Ho_Chi_Minh')->hour."-".Carbon::now('Asia/Ho_Chi_Minh')->minute."-".Carbon::now('Asia/Ho_Chi_Minh')->second;
       
        $data = [
            'hoadon' => $hoadon,
            'chitiethoadon'    => $chitiethoadon,
            'ngayin' => Carbon::now('Asia/Ho_Chi_Minh')->day."-".Carbon::now('Asia/Ho_Chi_Minh')->month."-".Carbon::now('Asia/Ho_Chi_Minh')->year." ".Carbon::now('Asia/Ho_Chi_Minh')->hour.":".Carbon::now('Asia/Ho_Chi_Minh')->minute.":".Carbon::now('Asia/Ho_Chi_Minh')->second,
        ];
        $pdf = LaravelMpdf::loadView('hoadon.pdf', $data);
        $sohoadon = $hoadon->HOADON_SO;
        return $pdf->download($sohoadon."_".$ngayxuat.'.pdf');
    }

    public function updateModal(Request $request, $id)
    {
        $validatedData = $request->validate([
            'sohopdong' => 'required',
            'sohoadon' => 'required',
            //'filehoadon' => 'required',
            'thuesuat' => 'required',
            'tongtien' => 'required',
            'tienthue' => 'required',
            'tongtiencothue' => 'required',
            'sotienbangchu' => 'required',
            'nguoitao' => 'required',
            'nguoimuahang' => 'required',
        ], [
            'sohopdong.required' => 'Trường số hợp đồng là bắt buộc.',
            'sohoadon.required' => 'Trường số hóa đơn là bắt buộc.',
            //'filehoadon.required' => 'Trường file hóa đơn là bắt buộc.',
            'thuesuat.required' => 'Trường thuế là bắt buộc.',
            'tongtien.required' => 'Trường tổng tiền là bắt buộc.',
            'tienthue.required' => 'Trường tiền thuế là bắt buộc.',
            'tongtiencothue.required' => 'Trường tổng tiền (có thuế) là bắt buộc.',
            'sotienbangchu.required' => 'Trường số tiền bằng chữ là bắt buộc.',
            'nguoitao.required' => 'Trường người tạo là bắt buộc.',
            'nguoimuahang.required' => 'Trường người mua hàng là bắt buộc.',
        ]);

        //$request->validated();

        if ($request->fileadd_yes_no == "0") {
            DB::update('exec updateHoaDon_NoFile ?,?,?,?,?,?,?,?,?',
            [
                $id,
                $request->tongtien,
                $request->thuesuat,
                $request->tienthue,
                $request->tongtiencothue,
                $request->sotienbangchu,
                $request->nguoitao,
                $request->nguoimuahang,
                $request->trangthaihoadon
            ]);
        }
        else if ($request->fileadd_yes_no == "1") {
            $fileUrl = "";
            if ($request->file('filehoadon')) {
                $imageUrl = $this->storeImage($request);
                $fileUrl = $imageUrl;
            }
            DB::update('exec updateHoaDon_WithFile ?,?,?,?,?,?,?,?,?,?',
            [
                $id,
                $request->tongtien,
                $request->thuesuat,
                $request->tienthue,
                $request->tongtiencothue,
                $request->sotienbangchu,
                $request->nguoitao,
                $request->nguoimuahang,
                $request->trangthaihoadon,
                $fileUrl
            ]);
        }

        $soluongchitiet = $request->soluongchitiet;
        for ($i = 1; $i <= $soluongchitiet; $i++){
            $nd = "noidung".$i;
            $sl = "soluong".$i;
            $dvt = "donvitinh".$i;
            $dg = "dongia".$i;
            $tt = "thanhtien".$i;
                
            DB::update('SET NOCOUNT ON; exec insertChiTietHoaDon ?,?,?,?,?,?,?',
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

        return response()->json([
            'success' => true,
            // 'errors' => $validator->errors(),
            'input' => $request->all()
        ]);
    }
    public function getHoaDon($id)
    {
        $hoadon = DB::select("select * from HOADON join HOPDONG on HOADON.HOPDONG_ID = HOPDONG.HOPDONG_ID where HOADON_ID = ?", [$id])[0];
        $chitiethoadon = DB::select("select * from CHITIET_HOADON where HOADON_ID= ?", [$id]);
        /////
        $hoadon2 = DB::select("select * from hoadon join HOPDONG on HOADON.HOPDONG_ID=HOPDONG.HOPDONG_ID join KHACHHANG on HOPDONG.KHACHHANG_ID = KHACHHANG.KHACHHANG_ID where HOADON_ID= ?", [$id])[0];
        $chitiethoadon2 = DB::select("select * from CHITIET_HOADON where HOADON_ID= ?", [$id]);

        $timestamp = strtotime($hoadon2->HOADON_NGAYTAO); 
        $hoadon2->HOADON_NGAYTAO = date('d-m-Y', $timestamp);
        $hoadon2->HOADON_TONGTIEN = number_format(round($hoadon2->HOADON_TONGTIEN),0,'.','.');
        $hoadon2->HOADON_TIENTHUE = number_format(round($hoadon2->HOADON_TIENTHUE),0,'.','.');
        $hoadon2->HOADON_TONGTIEN_COTHUE = number_format(round($hoadon2->HOADON_TONGTIEN_COTHUE),0,'.','.');
        for ($i = 0 ; $i < count($chitiethoadon2); $i++){
            $chitiethoadon2[$i]->DONGIA = number_format(round($chitiethoadon2[$i]->DONGIA),0,'.','.');
            $chitiethoadon2[$i]->THANHTIEN = number_format(round($chitiethoadon2[$i]->THANHTIEN),0,'.','.');
        }
        $data = [
            'hoadon' => $hoadon,
            'chitiethoadon' => $chitiethoadon,
            'cntcthd' => count($chitiethoadon),
            'hoadon2' => $hoadon2,
            'chitiethoadon2' => $chitiethoadon2,
        ];

        return response()->json($data);
    }
}