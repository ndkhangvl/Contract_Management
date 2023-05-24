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
</style>
<body>
@include('header2')
@include('header')
<h1>Danh sách Khách Hàng</h1>
<a href="/loaikhachhangs">
    <button type="button" class="btn btn-info">
        Loại khách hàng
    </button>
</a>
<a href="/khachhang/create">
    <button  type="button" class="btn btn-primary">
        Thêm mới
    </button>
</a>
<hr/>
<table>
    <tr>
        <th>Mã KH</th>
        <th>Loại KH</th>
        <th>Tên</th>
        <th>Địa chỉ</th>
        <th>Số Điện thoại</th>
        <th>Email</th>
        <th>Xem chi tiết</th>
        <th>Trạng thái</th>
    </tr>
    @foreach ($khachhangs as $khachhang)
    
        <tr>
            <td>{{ $khachhang->KHACHHANG_ID }}</td>
            <td>{{ $khachhang->LOAIKHACHHANG_TEN }}</td>
            <td>{{ $khachhang->KHACHHANG_TEN }}</td>
            <td>{{ $khachhang->KHACHHANG_DIACHI }}</td>
            <td>{{ $khachhang->KHACHHANG_SDT }}</td>
            <td>{{ $khachhang->KHACHHANG_EMAIL }}</td>
            <td>
                <a href="/khachhang/{{$khachhang->KHACHHANG_ID}}">
                    <button type="button" class="btn btn-info">
                        Chi tiết
                    </button>
                </a>
            </td>
            <td>{{ $khachhang->TRANGTHAI_TEN }}</td>
        </tr>
    
    @endforeach
</table>
</body>