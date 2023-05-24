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
<div class="container">
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
<div class="table-responsive">
    <table class="table table-auto">
        <tr>
            <th class="text-center text-nowrap">Mã KH</th>
            <th class="text-center text-nowrap">Loại KH</th>
            <th class="text-center text-nowrap">Tên</th>
            <th class="text-center text-nowrap">Địa chỉ</th>
            <th class="text-center text-nowrap">Số Điện thoại</th>
            <th class="text-center text-nowrap">Email</th>
            <th class="text-center text-nowrap">Xem chi tiết</th>
            <th class="text-center text-nowrap">Trạng thái</th>
        </tr>
        @foreach ($khachhangs as $khachhang)
        
            <tr>
                <td class="text-center align-middle">{{ $khachhang->KHACHHANG_ID }}</td>
                <td>{{ $khachhang->LOAIKHACHHANG_TEN }}</td>
                <td>{{ $khachhang->KHACHHANG_TEN }}</td>
                <td>{{ $khachhang->KHACHHANG_DIACHI }}</td>
                <td>{{ $khachhang->KHACHHANG_SDT }}</td>
                <td>{{ $khachhang->KHACHHANG_EMAIL }}</td>
                <td class="text-center">
                    <a href="/khachhang/{{$khachhang->KHACHHANG_ID}}">
                        <button type="button" class="btn btn-info">
                            Chi tiết
                        </button>
                    </a>
                </td>
                <td class="text-success text-nowrap">{{ $khachhang->TRANGTHAI_TEN }}</td>
            </tr>
        
        @endforeach
    </table>
</div>
</div>
</body>