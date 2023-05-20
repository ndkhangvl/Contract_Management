<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<h1>Cập nhật thông tin Khách hàng</h1>
<style>
        form {
                width: 25%;
        }
</style>
<form action="/khachhang/{{$khhang->KHACHHANG_ID}}" method="post">
@csrf
@method('PUT')
        <div>
            <label>Loại KH:</label>
            <select name="loaikhachhang_id">
              @foreach ($loaikhachhang as $loai)
                @if ($loai->LOAIKHACHHANG_ID == $khhang->LOAIKHACHHANG_ID)
                <option value="{{ $loai->LOAIKHACHHANG_ID }}" selected>
                  {{ $loai->LOAIKHACHHANG_TEN }}
                </option>  
                @else
                <option value="{{ $loai->LOAIKHACHHANG_ID }}" >
                  {{ $loai->LOAIKHACHHANG_TEN }}
                </option>    
                @endif
              @endforeach                                
            </select>
        </div>

        <div>
            <label>Trạng thái:</label>
            <select name="khachhang_trangthai">
              @foreach ($trangthaikh as $trangthai)
                @if ($trangthai->TRANGTHAI_ID == $khhang->KHACHHANG_TRANGTHAI)
                <option value="{{ $trangthai->TRANGTHAI_ID }}" selected>
                  {{ $trangthai->TRANGTHAI_TEN }}
                </option>  
                @else
                <option value="{{ $trangthai->TRANGTHAI_ID }}" >
                {{ $trangthai->TRANGTHAI_TEN }}
                </option>    
                @endif
              @endforeach                                
            </select>
        </div>

    Tên KH: <input class="form-control" 
            type="text" name="khachhang_ten"
            value="{{$khhang->KHACHHANG_TEN}}" 
            placeholder="Tên KH">
    Địa chỉ: <input class="form-control" 
            type="text" name="khachhang_diachi" 
            value="{{$khhang->KHACHHANG_DIACHI}}" 
            placeholder="Địa chỉ"><br>
    SĐT: <input class="form-control" 
            type="text" name="khachhang_sdt"
            value="{{$khhang->KHACHHANG_SDT}}" 
            placeholder="SĐT">
    Email: <input class="form-control" 
            type="text" name="khachhang_email"
            value="{{$khhang->KHACHHANG_EMAIL}}" 
            placeholder="Email"><br>
    Chủ sỡ hữu: <input class="form-control" 
            type="text" name="khachhang_chusohuu" 
            value="{{$khhang->KHACHHANG_CHUSOHUU}}" 
            placeholder="Chủ sỡ hữu"><br>
    Người đại diện: <input class="form-control" 
            type="text" name="khachhang_nguoidaidien" 
            value="{{$khhang->KHACHHANG_NGUOIDAIDIEN}}" 
            placeholder="Người đại diện"><br>
    CMND: <input class="form-control" 
            type="text" name="khachhang_cmnd" 
            value="{{$khhang->KHACHHANG_CMND}}" 
            placeholder="CMND">
    Ngày cấp CMND: <input class="form-control" 
            type="date" name="khachhang_ngaycapcmnd" 
            value="{{$khhang->KHACHHANG_NGAYCAPCMND}}" 
            placeholder="Ngày cấp CMND"><br>
    Ngày sinh: <input class="form-control" 
            type="date" name="khachhang_ngaysinhndd" 
            value="{{$khhang->KHACHHANG_NGAYSINHNDD}}" 
            placeholder="Ngày Sinh (YYYY/MM/DD)"><br>
    Ngày hoạt động: <input class="form-control" 
            type="date" name="khachhang_ngayhoatdong" 
            value="{{$khhang->KHACHHANG_NGAYHOATDONG}}" 
            placeholder="Ngày hoạt động (YYYY/MM/DD)"><br>
    Mã số thuế: <input class="form-control" 
            type="text" name="khachhang_masothue" 
            value="{{$khhang->KHACHHANG_MASOTHUE}}" 
            placeholder="Mã số thuế"><br>
        <button class="btn btn-primary" type="submit">
            Cập nhật
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