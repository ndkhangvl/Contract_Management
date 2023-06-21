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
            <div class="container-fluid">
                <div class="border" style="padding-left:100px; padding-right:100px">
                    <div class="mt-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="logo" width="100" height="43.25">
                            </div>
                            <div class="col text-center">
                                <h4 class="fs-2">Chi tiết Khách hàng</h4>
                            </div>
                        </div>
                        
                        <hr style="border-top: 2px dashed black;"/>
                        <div class="text-start">
                                    <b>Mã khách hàng: </b><b style="color: red">{{ $khachhang->KHACHHANG_ID }}</b><br>
                                    <div class="@if ($khachhang->TRANGTHAI_TEN === 'Đang hoạt động') trangthai-danghoatdong @elseif ($khachhang->TRANGTHAI_TEN === 'Bị khóa') trangthai-bikhoa @elseif ($khachhang->TRANGTHAI_TEN === 'Tạm ngưng hoạt động') trangthai-tamngunghoatdong @else trangthai-dagiaithe @endif"><b style="color: black">Trạng thái: </b><b>{{ $khachhang->TRANGTHAI_TEN }}</b></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col subheading">
                                <span class="form-label fw-bold">Loại:</span>
                                {{ $khachhang->LOAIKHACHHANG_TEN }}<br>
                                &nbsp;<br>
                                &nbsp;<br>
                                &nbsp;<br>
                                &nbsp;
                                <hr>
                            </div>
                            <div class="col subheading">
                                <span class="form-label fw-bold">Tên khách hàng:</span>
                                {{ $khachhang->KHACHHANG_TEN }}<br>
                                <span class="form-label fw-bold">Điện thoại:</span>
                                {{ $khachhang->KHACHHANG_SDT }}<br>
                                <span class="form-label fw-bold">Email:</span>
                                {{ $khachhang->KHACHHANG_EMAIL }}<br>
                                <span class="form-label fw-bold">Địa chỉ:</span>
                                {{ $khachhang->KHACHHANG_DIACHI }}<br>
                                <span class="form-label fw-bold">Mã số thuế:</span>
                                <b style="color: red">{{ $khachhang->KHACHHANG_MASOTHUE }}</b>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col subheading">
                                <span class="form-label fw-bold">Chủ sỡ hữu:</span>
                                {{ $khachhang->KHACHHANG_CHUSOHUU }}<br>
                                &nbsp;<br>
                                &nbsp;<br>
                                &nbsp;<br>
                                &nbsp;
                                <hr>
                            </div>
                            <div class="col subheading">
                                <span class="form-label fw-bold">Người đại diện:</span>
                                {{ $khachhang->KHACHHANG_NGUOIDAIDIEN }}<br>
                                <span class="form-label fw-bold">CMND/CCCD:</span>
                                {{ $khachhang->KHACHHANG_CMND }}<br>
                                <span class="form-label fw-bold">Ngày cấp CMND:</span>
                                {{ $khachhang->KHACHHANG_NGAYCAPCMND }}<br>
                                <span class="form-label fw-bold">Ngày sinh:</span>
                                {{ $khachhang->KHACHHANG_NGAYSINHNDD }}<br>
                                <span class="form-label fw-bold">Ngày hoạt động:</span>
                                {{ $khachhang->KHACHHANG_NGAYHOATDONG }}
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col subheading">
                                <span class="form-label fw-bold">Ngày tạo lập:</span>
                                {{ $khachhang->NGAYTAOLAP }}
                                <hr>
                            </div>
                        </div>
                    </div>
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


