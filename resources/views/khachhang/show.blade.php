{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding-left: 10px;
        padding-right: 10px;
    }
    table {
        width:90%;
    }
</style>
@include('header2')
@include('sidebar')
<div id="main">
    <div class="container bg-white shadow">
        <h1>Chi tiết Khách Hàng</h1>

@foreach ($khachhang as $khachhang)

<form action="/khachhang/{{$khachhang->KHACHHANG_ID}}" method="post">
      @csrf
      @method('delete')
      <button type="submit" class="btn btn-danger">
        Xóa
      </button>
</form>

<a href="/khachhang/{{$khachhang->KHACHHANG_ID}}/edit">
    <button type="button" class="btn btn-primary">
        Cập nhật Thông tin
    </button>
</a>
    <h3>Trạng thái: {{ $khachhang->TRANGTHAI_TEN }}</h3>
    <h3>Mã KH: {{ $khachhang->KHACHHANG_ID }}</h3>
    <h3>Loại: {{ $khachhang->LOAIKHACHHANG_TEN }}</h3>
    <h3>Tên KH: {{ $khachhang->KHACHHANG_TEN }}</h3>
    <h3>Địa chỉ: {{ $khachhang->KHACHHANG_DIACHI }}</h3>
    <h3>SĐT: {{ $khachhang->KHACHHANG_SDT }}</h3>
    <h3>Email: {{ $khachhang->KHACHHANG_EMAIL }}</h3>
    <h3>Chủ sỡ hữu: {{ $khachhang->KHACHHANG_CHUSOHUU }}</h3>
    <h3>Người đại diện: {{ $khachhang->KHACHHANG_NGUOIDAIDIEN }}</h3>
    <h3>CMND: {{ $khachhang->KHACHHANG_CMND }}</h3>
    <h3>Ngày cấp CMND: {{ $khachhang->KHACHHANG_NGAYCAPCMND }}</h3>
    <h3>Ngày sinh: {{ $khachhang->KHACHHANG_NGAYSINHNDD }}</h3>
    <h3>Ngày hoạt động: {{ $khachhang->KHACHHANG_NGAYHOATDONG }}</h3>
    <h3>Mã số thuế: {{ $khachhang->KHACHHANG_MASOTHUE }}</h3>
    <h3>Ngày tạo lập: {{ $khachhang->NGAYTAOLAP }}</h3>
@endforeach

<h1>Danh sách Hợp đồng</h1>
<a href="">
    <button type="button" class="btn btn-primary">
        Thêm mới hợp đồng
    </button>
</a>
<hr>
<table>
    <tr>
    
    <th>Số Hợp đồng</th>
    <th>Tên gói thầu</th>
    <th>Tên dự án</th>
    <th>Chi tiết hợp đồng</th>
    </tr>
    @foreach ($hopdongs as $hopdong)
    <tr>
        
        <td>{{$hopdong->HOPDONG_SO}}</td>
        <td>{{$hopdong->HOPDONG_TENGOITHAU}}</td>
        <td>{{$hopdong->HOPDONG_TENDUAN}}</td>
        <td>
        <a href="/hopdong/{{$hopdong->HOPDONG_SO}}">
                    <button type="button" class="btn btn-info">
                        Chi tiết
                    </button>
        </a>
        </td>

    </tr>
    @endforeach
</table>

<br><br><br>
    </div>
</div>
