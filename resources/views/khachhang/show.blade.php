{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
@include('header2')
@include('sidebar')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    td {
        border-bottom: 1px solid #ddd;
    }
    .subheading {
        font-size: 18px;
        margin-bottom: 5px;
    }
    .btn-danger {
        margin-right: 10px;
    }
    .btn-primary {
        margin-bottom: 20px;
    }
    .btn-info {
        margin: 0 auto;
    }
    .alert-danger {
        width: 375px;
        border-radius: 50%;
        padding: 10px;
        margin-bottom: 20px;
        position: relative;
    }
    .close {
        position: absolute;
        top: 5px;
        right: 5px;
        color: red;
        cursor: pointer;
    }
    .trangthai-danghoatdong {
        color: green;
    }

    .trangthai-bikhoa {
        color: red;
    }

    .trangthai-tamngunghoatdong {
        color: yellow;
    }

    .trangthai-dagiaithe {
        color: gray;
    }
</style>
<div id="main">
    <div class="container bg-white shadow">
        <h1>Chi tiết Khách Hàng</h1>
        <hr>
        @if (session('error'))
            <div id="alert-danger" class="alert alert-danger" style="width: 375px">
                {{ session('error') }}
                <button type="button" class="close" style="border-radius: 50% red" onclick="closeAlert()">&times;</button>
            </div>
        @endif

        <script>
            function closeAlert() {
                document.getElementById('alert-danger').style.display = 'none';
            }
        </script>

        @foreach ($khachhang as $khachhang)
            <form action="{{ route('idkhachhang.destroy', ['id' => $khachhang->KHACHHANG_ID]) }}" method="POST" onsubmit="return confirmDelete()" id="xoaKH">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Xóa!
                </button>
            </form>
            <script>
                function confirmDelete() {
                    return confirm('Bạn có chắc chắn muốn xóa khách hàng?');
                }
            </script>

            <a href="/khachhang/{{$khachhang->KHACHHANG_ID}}/edit">
                <button type="button" class="btn btn-primary">
                    Cập nhật Thông tin
                </button>
            </a>
            <div class="row">
                <div class="col-md-6">
                    <div class="@if ($khachhang->TRANGTHAI_TEN === 'Đang hoạt động') trangthai-danghoatdong @elseif ($khachhang->TRANGTHAI_TEN === 'Bị khóa') trangthai-bikhoa @elseif ($khachhang->TRANGTHAI_TEN === 'Tạm ngưng hoạt động') trangthai-tamngunghoatdong @else trangthai-dagiaithe @endif"><b style="color: black">Trạng thái: </b><b>{{ $khachhang->TRANGTHAI_TEN }}</b></div>
                    <div class="subheading"><b>Mã KH:</b> {{ $khachhang->KHACHHANG_ID }}</div>
                    <div class="subheading"><b>Loại:</b> {{ $khachhang->LOAIKHACHHANG_TEN }}</div>
                    <div class="subheading"><b>Tên KH:</b> {{ $khachhang->KHACHHANG_TEN }}</div>
                    <div class="subheading"><b>SĐT:</b> {{ $khachhang->KHACHHANG_SDT }}</div>
                    <div class="subheading"><b>Email:</b> {{ $khachhang->KHACHHANG_EMAIL }}</div>
                    <div class="subheading"><b>Địa chỉ:</b> {{ $khachhang->KHACHHANG_DIACHI }}</div>
                </div>
                <div class="col-md-6">
                    <div class="subheading"><b>Mã số thuế:</b> <b style="color: red">{{ $khachhang->KHACHHANG_MASOTHUE }}</b></div>
                    <div class="subheading"><b>Chủ sỡ hữu:</b> {{ $khachhang->KHACHHANG_CHUSOHUU }}</div>
                    <div class="subheading"><b>Người đại diện:</b> {{ $khachhang->KHACHHANG_NGUOIDAIDIEN }}</div>
                    <div class="subheading"><b>CMND:</b> {{ $khachhang->KHACHHANG_CMND }}</div>
                    <div class="subheading"><b>Ngày cấp CMND:</b> {{ $khachhang->KHACHHANG_NGAYCAPCMND }}</div>
                    <div class="subheading"><b>Ngày sinh:</b> {{ $khachhang->KHACHHANG_NGAYSINHNDD }}</div>
                    <div class="subheading"><b>Ngày hoạt động:</b> {{ $khachhang->KHACHHANG_NGAYHOATDONG }}</div>
                    <div class="subheading"><b>Ngày tạo lập:</b> {{ $khachhang->NGAYTAOLAP }}</div>
                </div>
            </div>
        @endforeach
        <hr>
        <h1>Danh sách Hợp đồng</h1>
        <a href="">
            <button type="button" class="btn btn-primary">
                Thêm mới hợp đồng
            </button>
        </a>
        <hr>
        <table>
            <tr>
                <th class="text-center text-nowrap">Số Hợp đồng</th>
                <th class="text-center text-nowrap">Tên gói thầu</th>
                <th class="text-center text-nowrap">Tên dự án</th>
                <th class="text-center text-nowrap">Chi tiết hợp đồng</th>
            </tr>
            @foreach ($hopdongs as $hopdong)
                <tr>
                    <td>{{$hopdong->HOPDONG_SO}}</td>
                    <td>{{$hopdong->HOPDONG_TENGOITHAU}}</td>
                    <td>{{$hopdong->HOPDONG_TENDUAN}}</td>
                    <td class="text-center text-nowrap">
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


