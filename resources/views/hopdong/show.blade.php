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
            .fixed-button {
                position: fixed;
                right: 20px;
                bottom: 20px;
                z-index: 999;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background-color: #007bff;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .fixed-button:hover {
                background-color: #0056b3;
            }

            .fixed-button-icon {
                color: #fff;
                font-size: 24px;
            }
        </style>
                <h1 style="color: blue;">Chi tiết Hợp đồng</h1>

        <hr>

        <div class="row">
            <div class="column">
                <div class="subheading"><b>Hợp đồng số:</b> {{ $hopdong->HOPDONG_SO }}</div>
                <div class="subheading"><b>Khách hàng:</b> {{ $hopdong->KHACHHANG_TEN }}</div>
                <div class="subheading"><b>Loại hợp đồng:</b> {{ $hopdong->LOAIHOPDONG_TEN }}</div>
                <div class="subheading"><b>Ngày ký:</b> {{ $hopdong->HOPDONG_NGAYKY }}</div>
                <div class="subheading"><b>Ngày hiệu lực:</b> {{ $hopdong->HOPDONG_NGAYHIEULUC }}</div>
                <div class="subheading"><b>Ngày kết thúc:</b> {{ $hopdong->HOPDONG_NGAYKETTHUC }}</div>
                <div class="subheading"><b>Thời gian thực hiện:</b> {{ $hopdong->HOPDONG_THOIGIANTHUCHIEN }}</div>
                <div class="subheading"><b>Tổng giá trị:</b> {{ $hopdong->HOPDONG_TONGGIATRI }} VNĐ</div>
                <div class="subheading"><b>Hình thức thanh toán:</b> {{ $hopdong->HOPDONG_HINHTHUCTHANHTOAN }}</div>
                <div class="subheading"><b>Ghi chú:</b> {{ $hopdong->HOPDONG_GHICHU }}</div>
                <div class="subheading"><b>Trạng thái hợp đồng:</b> {{ $hopdong->TRANGTHAI_TEN }}</div>
                <div class="subheading"><b>File:</b> <a href="{{ asset('storage/'.$hopdong->HOPDONG_FILE) }}">{{ $hopdong->HOPDONG_FILE }}</a></b></div>
            </div>
            <div class="column">
                <div class="subheading"><b>Gói thầu:</b> {{ $hopdong->HOPDONG_TENGOITHAU }}</div>
                <div class="subheading"><b>Dự án:</b> {{ $hopdong->HOPDONG_TENDUAN }}</div>
                <div class="subheading"><b>Đại diện bên A:</b> {{ $hopdong->HOPDONG_DAIDIENBEN_A }}</div>
                <div class="subheading"><b>Đại diện bên B:</b> {{ $hopdong->HOPDONG_DAIDIENBEN_B }}</div>
                <div class="subheading"><b>Người lập:</b> {{ $hopdong->ten_nd }}</div>
                <div class="subheading"><b>Nội dung:</b> {{ $hopdong->HOPDONG_NOIDUNG }}</div>
            </div>
        </div>
    
        <hr>
        <h1 style="color: blue;">Danh sách hóa đơn</h1>
        <hr>

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
            <div class="fixed-button">
                <a href="/hoadon/create?hopdong={{ $hopdong->HOPDONG_SO }}">
                    <i class="fixed-button-icon fas fa-plus"></i>
                </a>
            </div>

        <hr>
    </div>
</div>
