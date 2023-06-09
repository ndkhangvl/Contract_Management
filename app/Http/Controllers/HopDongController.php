<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\LoaiHopDong;
use App\Models\TaiKhoan;
use App\Models\KhachHang;
use App\Models\HopDong;
use App\Models\TrangThaiHD;
use App\Models\History;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class HopDongController extends Controller
{
    //
    public function index()
    {
        $trangthaihopdongs = DB::select('select * from TRANGTHAI_HOPDONG');
        $khachhangs = DB::select('select * from KHACHHANG where KHACHHANG_TRANGTHAI != 4');
        $hopdongs = DB::table('HOPDONG')
            ->join('LOAI_HOPDONG', 'HOPDONG.LOAIHOPDONG_ID', '=', 'LOAI_HOPDONG.LOAIHOPDONG_ID')
            ->join('TAIKHOAN', 'HOPDONG.HOPDONG_NGUOILAP', '=', 'TAIKHOAN.nguoidung_id')
            ->join('KHACHHANG', 'HOPDONG.KHACHHANG_ID', '=', 'KHACHHANG.KHACHHANG_ID')
            ->join('TRANGTHAI_HOPDONG', 'HOPDONG.HOPDONG_TRANGTHAI', '=', 'TRANGTHAI_HOPDONG.TRANGTHAI_ID')
            ->orderBy('HOPDONG_ID', 'asc')
            ->select('HOPDONG.*', 'TAIKHOAN.ten_nd')
            ->distinct()
            ->paginate(5);
        for ($i = 0; $i < count($hopdongs); $i++) {
            $hopdongs[$i]->HOPDONG_TONGGIATRI = number_format(round($hopdongs[$i]->HOPDONG_TONGGIATRI), 0, '.', '.');
        }
        // $hopdongs = DB::select('select HOPDONG.* from HOPDONG join LOAI_HOPDONG on hopdong.LOAIHOPDONG_ID = LOAI_HOPDONG.LOAIHOPDONG_ID join taikhoan on hopdong.HOPDONG_NGUOILAP = TAIKHOAN.nguoidung_id
        // join KHACHHANG on HOPDONG.KHACHHANG_ID = KHACHHANG.KHACHHANG_ID join TRANGTHAI_HOPDONG on HOPDONG.HOPDONG_TRANGTHAI = TRANGTHAI_HOPDONG.TRANGTHAI_ID
        // order by HOPDONG_ID asc;')->paginate(5);
        // dd($hopdongs);
        return view('hopdong.index', [
            'hopdongs' => $hopdongs,
            'trangthaihopdongs' => $trangthaihopdongs,
            'khachhangs' => $khachhangs,
        ]);
    }

    public function show($id)
    {
        $trangthaihopdongs = DB::select('select * from TRANGTHAI_HOPDONG');
        $hopdong = DB::select("select hopdong.KHACHHANG_ID, HOPDONG_ID,LOAIHOPDONG_TEN,KHACHHANG_TEN,HOPDONG_SO,HOPDONG_NGAYKY,HOPDONG_NGAYHIEULUC,HOPDONG_NGAYKETTHUC,HOPDONG_TENGOITHAU,HOPDONG_TENDUAN,HOPDONG_NOIDUNG,HOPDONG_DAIDIENBEN_A,HOPDONG_DAIDIENBEN_B,ten_nd,HOPDONG_THOIGIANTHUCHIEN,HOPDONG_TONGGIATRI,HOPDONG_HINHTHUCTHANHTOAN,HOPDONG_GHICHU,TRANGTHAI_TEN,HOPDONG_FILE
        from hopdong join LOAI_HOPDONG on hopdong.LOAIHOPDONG_ID=LOAI_HOPDONG.LOAIHOPDONG_ID
        join KHACHHANG on HOPDONG.KHACHHANG_ID=KHACHHANG.KHACHHANG_ID
        join TAIKHOAN on HOPDONG.HOPDONG_NGUOILAP=TAIKHOAN.nguoidung_id
        join TRANGTHAI_HOPDONG on HOPDONG.HOPDONG_TRANGTHAI=TRANGTHAI_HOPDONG.TRANGTHAI_ID
        where HOPDONG_SO=:id;",
            [
                'id' => $id,
            ]
        )[0];

        $hoadons = DB::select(
            "select * from hoadon where HOPDONG_ID=:id order by HOADON_ID desc;",
            [
                'id' => $hopdong->HOPDONG_ID,
            ]
        );
        $hopdong->HOPDONG_TONGGIATRI = number_format(round($hopdong->HOPDONG_TONGGIATRI), 0, '.', '.');
        return view('hopdong.show', [
            'hopdong' => $hopdong,
            'hoadons' => $hoadons,
            'trangthaihopdongs' => $trangthaihopdongs,
        ]);

    }

    public function getHopDong($id)
    {
        $trangthaihopdongs = DB::select('select * from TRANGTHAI_HOPDONG');
        $hopdong = DB::select("select hopdong.LOAIHOPDONG_ID, hopdong.HOPDONG_TRANGTHAI, hopdong.KHACHHANG_ID, HOPDONG_ID,LOAIHOPDONG_TEN,KHACHHANG_TEN,HOPDONG_SO,HOPDONG_NGAYKY,HOPDONG_NGAYHIEULUC,HOPDONG_NGAYKETTHUC,HOPDONG_TENGOITHAU,HOPDONG_TENDUAN,HOPDONG_NOIDUNG,HOPDONG_DAIDIENBEN_A,HOPDONG_DAIDIENBEN_B,ten_nd,HOPDONG_THOIGIANTHUCHIEN,HOPDONG_TONGGIATRI,HOPDONG_HINHTHUCTHANHTOAN,HOPDONG_GHICHU,TRANGTHAI_TEN,HOPDONG_FILE
        from hopdong join LOAI_HOPDONG on hopdong.LOAIHOPDONG_ID=LOAI_HOPDONG.LOAIHOPDONG_ID
        join KHACHHANG on HOPDONG.KHACHHANG_ID=KHACHHANG.KHACHHANG_ID
        join TAIKHOAN on HOPDONG.HOPDONG_NGUOILAP=TAIKHOAN.nguoidung_id
        join TRANGTHAI_HOPDONG on HOPDONG.HOPDONG_TRANGTHAI=TRANGTHAI_HOPDONG.TRANGTHAI_ID
        where HOPDONG_SO=:id;",
            [
                'id' => $id,
            ]
        )[0];
        $hopdong->HOPDONG_TONGGIATRI = number_format(round($hopdong->HOPDONG_TONGGIATRI), 0, '.', '.');
        $hoadons = DB::select(
            "select * from hoadon where HOPDONG_ID=:id order by HOADON_ID desc;",
            [
                'id' => $hopdong->HOPDONG_ID,
            ]
        );
        $data = [
            'hopdong' => $hopdong,
            'hoadons' => $hoadons,
            'trangthaihopdongs' => $trangthaihopdongs,
        ];

        return response()->json($data);

    }

    protected function storeImage(Request $request)
    {
        $fileName = $request->get('hopdong_so') . '.' . $request->file('filehopdong')->extension();
        $path = $request->file('filehopdong')->storeAs('public/HopDong', $fileName);
        return substr($path, strlen('public/'));
    }
    protected function deleteImage(Request $request)
    {
        $sohoadon = $request->get('hopdong_so');
        $files = Storage::files('public/HopDong');

        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if ($filename == $sohoadon) {
                Storage::delete($file);
            }
        }
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $trangthaihopdongs = DB::select('select * from TRANGTHAI_HOPDONG');
            $khachhangs = DB::select('select * from KHACHHANG where KHACHHANG_TRANGTHAI != 4');
            $hopdongs = DB::table('hopdong')->join('LOAI_HOPDONG', 'HOPDONG.LOAIHOPDONG_ID', '=', 'LOAI_HOPDONG.LOAIHOPDONG_ID')
                ->join('TAIKHOAN', 'HOPDONG.HOPDONG_NGUOILAP', '=', 'TAIKHOAN.nguoidung_id')
                ->join('KHACHHANG', 'HOPDONG.KHACHHANG_ID', '=', 'KHACHHANG.KHACHHANG_ID')
                ->join('TRANGTHAI_HOPDONG', 'HOPDONG.HOPDONG_TRANGTHAI', '=', 'TRANGTHAI_HOPDONG.TRANGTHAI_ID')
                ->where('hopdong_so', 'LIKE', '%' . $request->search . '%')
                ->orderBy('HOPDONG_ID', 'asc')
                ->select('HOPDONG.*', 'TAIKHOAN.ten_nd')
                ->distinct()
                ->paginate(5);
            for ($i = 0; $i < count($hopdongs); $i++) {
                $hopdongs[$i]->HOPDONG_TONGGIATRI = number_format(round($hopdongs[$i]->HOPDONG_TONGGIATRI), 0, '.', '.');
            }
            //$histories->appends($request->all());
            // return response()->json([
            //     'histories' => $histories,
            // ]); 
            return view('hopdong.hopdong_data', compact('trangthaihopdongs', 'khachhangs', 'hopdongs'))->render();
        }
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'hopdong_so' => 'required|unique:hopdong',
            'loaihopdong_id' => 'required',
            'khachhang_id' => 'required',
            'hopdong_ngayky' => 'required|before_or_equal:' . Carbon::now()->format('Y-m-d H:i:s'),
            'hopdong_ngayhieuluc' => 'required|after_or_equal:hopdong_ngayky',
            'hopdong_ngayketthuc' => 'required|after:hopdong_ngayhieuluc',
            'hopdong_tengoithau' => 'required',
            'hopdong_tenduan' => 'required',
            'hopdong_noidung' => 'required',
            'hopdong_thoigianthuchien' => 'required',
            'hopdong_daidienben_a' => 'required',
            'hopdong_daidienben_b' => 'required',
            'hopdong_tonggiatri' => 'required',
            'hopdong_hinhthucthanhtoan' => 'required',
            'hopdong_trangthai' => 'required',
            'hopdong_ghichu' => 'required',
        ], [
            'hopdong_so.required' => 'Trường số hợp đồng là bắt buộc.',
            'hopdong_so.unique' => 'Số hợp đồng đã tồn tại.',
            'loaihopdong_id.required' => 'Trường loại hợp đồng là bắt buộc.',
            // 'khachhang_ten.min' => 'Trường tên khách hàng phải có ít nhất :min ký tự.',
            'khachhang_id.required' => 'Trường khách hàng là bắt buộc.',
            'hopdong_ngayky.required' => 'Chọn ngày ký là bắt buộc.',
            'hopdong_ngayky.before_or_equal' => 'Ngày ký không được lớn hơn ngày và giờ hiện tại.',
            'hopdong_ngayhieuluc.required' => 'Chọn ngày hiệu lực là bắt buộc.',
            'hopdong_ngayhieuluc.after_or_equal' => 'Ngày hiệu lực phải bằng hoặc sau ngày ký.',
            'hopdong_ngayketthuc.required' => 'Chọn ngày kết thúc là bắt buộc.',
            'hopdong_ngayketthuc.after' => 'Ngày kết thúc phải sau ngày hiệu lực.',
            'hopdong_tengoithau.required' => 'Trường tên gói thầu là bắt buộc.',
            'hopdong_tenduan.required' => 'Trường tên dự án là bắt buộc.',
            'hopdong_noidung.required' => 'Trường nội dung là bắt buộc.',
            'hopdong_thoigianthuchien.required' => 'Chọn thời gian thực hiện là bắt buộc.',
            'hopdong_daidienben_a.required' => 'Trường đại diện bên A là bắt buộc.',
            'hopdong_daidienben_b.required' => 'Trường đại diện bên B là bắt buộc.',
            'hopdong_tonggiatri.required' => 'Trường tổng giá trị là bắt buộc.',
            'hopdong_hinhthucthanhtoan.required' => 'Trường hình thức thanh toán là bắt buộc.',
            'hopdong_trangthai.required' => 'Trường trạng thái là bắt buộc.',
            'hopdong_ghichu.required' => 'Trường ghi chú là bắt buộc nếu không có ghi "Không"',
        ]);

        // $today = Carbon::today();
        $fileUrl = "";
        if ($request->file('filehopdong')) {
            $imageUrl = $this->storeImage($request);
            $fileUrl = $imageUrl;
        }

        $hdong = new HopDong;
        $hdong->LOAIHOPDONG_ID = $request->loaihopdong_id;
        $hdong->KHACHHANG_ID = $request->khachhang_id;
        $hdong->HOPDONG_SO = $request->hopdong_so;
        $hdong->HOPDONG_NGAYKY = $request->hopdong_ngayky;
        $hdong->HOPDONG_NGAYHIEULUC = $request->hopdong_ngayhieuluc;
        $hdong->HOPDONG_NGAYKETTHUC = $request->hopdong_ngayketthuc;
        $hdong->HOPDONG_TENGOITHAU = $request->hopdong_tengoithau;
        $hdong->HOPDONG_TENDUAN = $request->hopdong_tenduan;
        $hdong->HOPDONG_NOIDUNG = $request->hopdong_noidung;
        $hdong->HOPDONG_DAIDIENBEN_A = $request->hopdong_daidienben_a;
        $hdong->HOPDONG_DAIDIENBEN_B = $request->hopdong_daidienben_b;
        $hdong->HOPDONG_NGUOILAP = Session::get('infoUser.nguoidung_id');
        $hdong->HOPDONG_THOIGIANTHUCHIEN = $request->hopdong_thoigianthuchien;
        $hdong->HOPDONG_TONGGIATRI = $request->hopdong_tonggiatri;
        $hdong->HOPDONG_HINHTHUCTHANHTOAN = $request->hopdong_hinhthucthanhtoan;
        $hdong->HOPDONG_TRANGTHAI = $request->hopdong_trangthai;
        $hdong->HOPDONG_GHICHU = $request->hopdong_ghichu;
        $hdong->HOPDONG_FILE = $fileUrl;
        $hdong->save();

        $history = new History;
        $history->ten_nd = Session::get('infoUser.ten_nd');
        $history->action = 'Thêm';
        $history->model_type = 'Hợp đồng';
        $history->model_id = $hdong->HOPDONG_ID;
        $history->description = 'Thêm mới hợp đồng số: ' . $hdong->HOPDONG_SO;
        $history->Time = Carbon::now();
        $history->save();

        return response()->json([
            'success' => true,
            // 'errors' => $validator->errors(),
            'input' => $request->all()
        ]);
        // return redirect('/khachhang');
    }

    public function delete($id)
    {
        $hopdong = HopDong::find($id);
        $results = DB::select('SET NOCOUNT ON; EXEC CheckDeleteHopDong ?', [$id]);
        $message = $results[0]->message;

        if ($message === 'Deleted') {
            $request2 = new Request(['hopdong_so' => $hopdong->HOPDONG_SO]);
            if ($request2) {
                $this->deleteImage($request2);
            }
            $history = new History;
            $history->ten_nd = Session::get('infoUser.ten_nd');
            $history->action = 'Xóa';
            $history->model_type = 'Hợp đồng';
            $history->model_id = $hopdong->HOPDONG_ID;
            $history->description = "Xóa hợp đồng số: $hopdong->HOPDONG_SO";
            $history->Time = Carbon::now();
            $history->save();
            return response()->json([
                'success' => true,
                'data' => $results,
                'data1' => $hopdong,
            ]);
        } elseif ($message === 'CannotDelete') {
            return response()->json([
                'success' => false,
                'data' => $results,
            ]);
        } else {
            return response()->json([
                'error' => 'Có lỗi xảy ra.',
                'data' => $hopdong,
            ], 500);
        }
    }

    //Con` cai file cuu cuu 
    public function update(Request $request, $id)
    {
        $request->validate([
            'hopdong_so' => 'required',
            'loaihopdong_id' => 'required',
            'khachhang_id' => 'required',
            'hopdong_ngayky' => 'required',
            'hopdong_ngayhieuluc' => 'required',
            'hopdong_ngayketthuc' => 'required',
            'hopdong_tengoithau' => 'required',
            'hopdong_tenduan' => 'required',
            'hopdong_noidung' => 'required',
            'hopdong_thoigianthuchien' => 'required',
            'hopdong_daidienben_a' => 'required',
            'hopdong_daidienben_b' => 'required',
            'hopdong_tonggiatri' => 'required',
            'hopdong_hinhthucthanhtoan' => 'required',
            'hopdong_trangthai' => 'required',
            'hopdong_ghichu' => 'required',
        ], [
            'hopdong_so.required' => 'Trường số hợp đồng là bắt buộc.',
            'loaihopdong_id.required' => 'Trường loại hợp đồng là bắt buộc.',
            // 'khachhang_ten.min' => 'Trường tên khách hàng phải có ít nhất :min ký tự.',
            'khachhang_id.required' => 'Trường khách hàng là bắt buộc.',
            'hopdong_ngayky.required' => 'Chọn ngày ký là bắt buộc.',
            'hopdong_ngayhieuluc.required' => 'Chọn ngày hiệu lực là bắt buộc.',
            'hopdong_ngayketthuc.required' => 'Chọn ngày kết thúc là bắt buộc.',
            'hopdong_tengoithau.required' => 'Trường tên gói thầu là bắt buộc.',
            'hopdong_tenduan.required' => 'Trường tên dự án là bắt buộc.',
            'hopdong_noidung.required' => 'Trường nội dung là bắt buộc.',
            'hopdong_thoigianthuchien.required' => 'Chọn thời gian thực hiện là bắt buộc.',
            'hopdong_daidienben_a.required' => 'Trường đại diện bên A là bắt buộc.',
            'hopdong_daidienben_b.required' => 'Trường đại diện bên B là bắt buộc.',
            'hopdong_tonggiatri.required' => 'Trường tổng giá trị là bắt buộc.',
            'hopdong_hinhthucthanhtoan.required' => 'Trường hình thức thanh toán là bắt buộc.',
            'hopdong_trangthai.required' => 'Trường trạng thái là bắt buộc.',
            'hopdong_ghichu.required' => 'Trường ghi chú là bắt buộc nếu không có ghi "Không"',
        ]);

        $LOAIHOPDONG_ID = $request->loaihopdong_id;
        $KHACHHANG_ID = $request->khachhang_id;
        $HOPDONG_SO = $request->hopdong_so;
        $HOPDONG_NGAYKY = $request->hopdong_ngayky;
        $HOPDONG_NGAYHIEULUC = $request->hopdong_ngayhieuluc;
        $HOPDONG_NGAYKETTHUC = $request->hopdong_ngayketthuc;
        $HOPDONG_TENGOITHAU = $request->hopdong_tengoithau;
        $HOPDONG_TENDUAN = $request->hopdong_tenduan;
        $HOPDONG_NOIDUNG = $request->hopdong_noidung;
        $HOPDONG_DAIDIENBEN_A = $request->hopdong_daidienben_a;
        $HOPDONG_DAIDIENBEN_B = $request->hopdong_daidienben_b;
        $HOPDONG_NGUOILAP = Session::get('infoUser.nguoidung_id');
        $HOPDONG_THOIGIANTHUCHIEN = $request->hopdong_thoigianthuchien;
        $HOPDONG_TONGGIATRI = $request->hopdong_tonggiatri;
        $HOPDONG_HINHTHUCTHANHTOAN = $request->hopdong_hinhthucthanhtoan;
        $HOPDONG_TRANGTHAI = $request->hopdong_trangthai;
        $HOPDONG_GHICHU = $request->hopdong_ghichu;
        if ($request->fileadd_yes_no == "0") {
            DB::update('UPDATE HOPDONG SET
                LOAIHOPDONG_ID = ?,
                KHACHHANG_ID = ?,
                HOPDONG_SO = ?,
                HOPDONG_NGAYKY = ?,
                HOPDONG_NGAYHIEULUC = ?,
                HOPDONG_NGAYKETTHUC = ?,
                HOPDONG_TENGOITHAU = ?,
                HOPDONG_TENDUAN = ?,
                HOPDONG_NOIDUNG = ?,
                HOPDONG_DAIDIENBEN_A = ?,
                HOPDONG_DAIDIENBEN_B = ?,
                HOPDONG_NGUOILAP = ?,
                HOPDONG_THOIGIANTHUCHIEN = ?,
                HOPDONG_TONGGIATRI = ?,
                HOPDONG_HINHTHUCTHANHTOAN = ?,
                HOPDONG_TRANGTHAI = ?,
                HOPDONG_GHICHU = ?
            WHERE HOPDONG_ID = ?;',
                [$LOAIHOPDONG_ID, $KHACHHANG_ID, $HOPDONG_SO, $HOPDONG_NGAYKY, $HOPDONG_NGAYHIEULUC, $HOPDONG_NGAYKETTHUC, $HOPDONG_TENGOITHAU, $HOPDONG_TENDUAN, $HOPDONG_NOIDUNG, $HOPDONG_DAIDIENBEN_A, $HOPDONG_DAIDIENBEN_B, $HOPDONG_NGUOILAP, $HOPDONG_THOIGIANTHUCHIEN, $HOPDONG_TONGGIATRI, $HOPDONG_HINHTHUCTHANHTOAN, $HOPDONG_TRANGTHAI, $HOPDONG_GHICHU, $id]
            );
        } else if ($request->fileadd_yes_no == "1") {
            $fileUrl = "";
            $request2 = new Request(['hopdong_so' => $request->hopdong_so]);
            if ($request2) {
                $this->deleteImage($request2);
            }
            if ($request->file('filehopdong')) {
                $imageUrl = $this->storeImage($request);
                $fileUrl = $imageUrl;
            }
            DB::update('UPDATE HOPDONG SET
            LOAIHOPDONG_ID = ?,
            KHACHHANG_ID = ?,
            HOPDONG_SO = ?,
            HOPDONG_NGAYKY = ?,
            HOPDONG_NGAYHIEULUC = ?,
            HOPDONG_NGAYKETTHUC = ?,
            HOPDONG_TENGOITHAU = ?,
            HOPDONG_TENDUAN = ?,
            HOPDONG_NOIDUNG = ?,
            HOPDONG_DAIDIENBEN_A = ?,
            HOPDONG_DAIDIENBEN_B = ?,
            HOPDONG_NGUOILAP = ?,
            HOPDONG_THOIGIANTHUCHIEN = ?,
            HOPDONG_TONGGIATRI = ?,
            HOPDONG_HINHTHUCTHANHTOAN = ?,
            HOPDONG_TRANGTHAI = ?,
            HOPDONG_GHICHU = ?,
            HOPDONG_FILE = ?
        WHERE HOPDONG_ID = ?;',
                [$LOAIHOPDONG_ID, $KHACHHANG_ID, $HOPDONG_SO, $HOPDONG_NGAYKY, $HOPDONG_NGAYHIEULUC, $HOPDONG_NGAYKETTHUC, $HOPDONG_TENGOITHAU, $HOPDONG_TENDUAN, $HOPDONG_NOIDUNG, $HOPDONG_DAIDIENBEN_A, $HOPDONG_DAIDIENBEN_B, $HOPDONG_NGUOILAP, $HOPDONG_THOIGIANTHUCHIEN, $HOPDONG_TONGGIATRI, $HOPDONG_HINHTHUCTHANHTOAN, $HOPDONG_TRANGTHAI, $HOPDONG_GHICHU, $fileUrl, $id]
            );

        }

        $hopdong = HopDong::find($id);
        if ($hopdong) {
            $history = new History;
            $history->ten_nd = Session::get('infoUser.ten_nd');
            $history->action = 'Sửa';
            $history->model_type = 'Hợp Đồng';
            $history->model_id = $id;
            $history->description = "Sửa thông tin hợp đồng số: $hopdong->HOPDONG_SO";
            $history->Time = Carbon::now();
            $history->save();
        }

        // return redirect('/hopdong');
        return response()->json([
            'success' => true,
            // 'errors' => $validator->errors(),
            'input' => $request->all()
        ]);
    }

}