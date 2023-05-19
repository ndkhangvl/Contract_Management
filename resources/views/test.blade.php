<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <h1>{{ Session::get('infoUser') }}</h1>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<h1>Thêm mới Khách hàng</h1>
<form action="/khachhang" method="post">
@csrf
        {{-- <div>
            <label>Loại KH:</label>
            <select name="loaikhachhang_id">
              @foreach ($loaikhachhang as $loai)
                <option value="{{ $loai->LOAIKHACHHANG_ID }}">
                  {{ $loai->LOAIKHACHHANG_TEN }}
                </option>    
              @endforeach                                
            </select>
        </div> --}}

    Tên KH: <input class="form-control" 
            type="text" name="khachhang_ten" 
            placeholder="Tên KH">
    Địa chỉ: <input class="form-control" 
            type="text" name="khachhang_diachi" 
            placeholder="Địa chỉ"><br>
    SĐT: <input class="form-control" 
            type="text" name="khachhang_sdt" 
            placeholder="SĐT">
    Email: <input class="form-control" 
            type="text" name="khachhang_email" 
            placeholder="Email"><br>
    Chủ sỡ hữu: <input class="form-control" 
            type="text" name="khachhang_chusohuu" 
            placeholder="Chủ sỡ hữu"><br>
    Người đại diện: <input class="form-control" 
            type="text" name="khachhang_nguoidaidien" 
            placeholder="Người đại diện"><br>
    CMND: <input class="form-control" 
            type="text" name="khachhang_cmnd" 
            placeholder="CMND">
    Ngày cấp CMND: <input class="form-control" 
            type="date" name="khachhang_ngaycapcmnd" 
            placeholder="Ngày cấp CMND"><br>
    Ngày sinh: <input class="form-control" 
            type="date" name="khachhang_ngaysinhndd" 
            placeholder="Ngày Sinh (YYYY/MM/DD)"><br>
    Ngày hoạt động: <input class="form-control" 
            type="date" name="khachhang_ngayhoatdong" 
            placeholder="Ngày hoạt động (YYYY/MM/DD)"><br>
    Mã số thuế: <input class="form-control" 
            type="text" name="khachhang_masothue" 
            placeholder="Mã số thuế"><br>
        <button class="btn btn-primary" type="submit">
            Thêm mới
        </button>
</form>
@if ($errors->any())
      <div>
        @foreach ($errors->all() as $error)
          <p class="text-danger">
            {{ $error }}
          </p>
        @endforeach
      </div>
    @endif
</body>
</html>