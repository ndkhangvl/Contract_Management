@include('header2')
@include('sidebar')
<div id="main">
    <div class="container bg-white shadow">
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
                font-family: Arial, sans-serif;
            }

            th, td {
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            td {
                border-bottom: 1px solid #ddd;
            }

            .container {
                padding: 20px;
                margin-top: 20px;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .btn {
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                color: #fff;
                font-size: 16px;
                margin-bottom: 20px
            }

            .btn-primary {
                background-color: #007bff;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .btn-info {
                background-color: #17a2b8;
            }

            .btn-info:hover {
                background-color: #11707e;
            }
            .subheading {
                font-size: 18px;
                margin-bottom: 5px;
            }
            .row {
                display: flex;
                justify-content: space-between;
            }

            .column {
                width: 48%;
            }
        </style>

        <hr>

        <div class="container-fluid">
            <div class="border" style="padding-left:100px; padding-right:100px">
                <div class="mt-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="logo" width="100" height="43.25">
                        </div>
                        <div class="col text-center">
                            <h4 class="fs-2">Chi tiết Hợp đồng</h4>
                        </div>
                    </div>
                    
                    <hr style="border-top: 2px dashed black;"/>
                    <div class="text-start">
                                <b>Ngày ký: </b>{{ $hopdong->HOPDONG_NGAYKY }}<br>
                                <b>Hợp đồng số: </b><b style="color: red">{{ $hopdong->HOPDONG_SO }}</b><br>
                                <b>Trạng thái: </b>{{ $hopdong->TRANGTHAI_TEN }}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Khách hàng:</span>
                            {{ $hopdong->KHACHHANG_TEN }}
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold">Loại hợp đồng:</span>
                            {{ $hopdong->LOAIHOPDONG_TEN }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Ngày hiệu lực:</span>
                            {{ $hopdong->HOPDONG_NGAYHIEULUC }}
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold">Ngày kết thúc:</span>
                            {{ $hopdong->HOPDONG_NGAYKETTHUC }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Thời gian thực hiện:</span>
                            {{ $hopdong->HOPDONG_THOIGIANTHUCHIEN }}
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold">Tổng giá trị:</span>
                            {{ $hopdong->HOPDONG_TONGGIATRI }} VNĐ
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Hình thức thanh toán:</span>
                            {{ $hopdong->HOPDONG_HINHTHUCTHANHTOAN }}
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold">Ghi chú:</span>
                            {{ $hopdong->HOPDONG_GHICHU }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <label class="form-label fw-bold">File:</label>
                            </b> <a href="{{ asset('storage/'.$hopdong->HOPDONG_FILE) }}">{{ $hopdong->HOPDONG_FILE }}</a></b>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <label class="form-label fw-bold">Gói thầu:</label>
                            {{ $hopdong->HOPDONG_TENGOITHAU }}
                            <br>
                            <label class="form-label fw-bold">Dự án:</label>
                            {{ $hopdong->HOPDONG_TENDUAN }}
                            <br>
                            <label class="form-label fw-bold">&nbsp;</label>
                            &nbsp;
                            <hr>
                        </div>
                        <div class="col subheading">
                            <label class="form-label fw-bold">Đại diện bên A:</label>
                            {{ $hopdong->HOPDONG_DAIDIENBEN_A }}
                            <br>
                            <label class="form-label fw-bold">Đại diện bên B:</label>
                            {{ $hopdong->HOPDONG_DAIDIENBEN_B }}
                            <br>
                            <label class="form-label fw-bold">Người lập:</label>
                            {{ $hopdong->ten_nd }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <label class="form-label fw-bold">Nội dung:</label><br>
                            {{ $hopdong->HOPDONG_NOIDUNG }}
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
        <h1 style="color: blue;">Danh sách hóa đơn</h1>
        <hr>
        <a href="/hoadon/create?hopdong={{ $hopdong->HOPDONG_SO }}">
            <button type="button" class="btn btn-primary">
                Thêm mới hóa đơn
            </button>
        </a>
        <table>
            <tr>
                <th>Hóa đơn số</th>
                <th>Trạng thái</th>
                <th>Tổng thanh toán</th>
                <th>Ngày tạo hóa đơn</th>
                <th>Chi tiết</th>
            </tr>
            @foreach ($hoadons as $hdd)
                <tr>
                    <td>{{ $hdd->HOADON_SO }}</td>
                    @if ($hdd->HOADON_TRANGTHAI == 1)
                        <td>Đã thanh toán</td>
                    @else
                        <td>Chưa thanh toán</td>
                    @endif
                    <td>{{ $hdd->HOADON_TONGTIEN_COTHUE }} VNĐ</td>
                    <td>{{ $hdd->HOADON_NGAYTAO }}</td>
                    <td>
                        <a href="/hoadon/{{ $hdd->HOADON_SO }}">
                            <button type="button" class="btn btn-info">
                                Chi tiết
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <hr>
    </div>
</div>
