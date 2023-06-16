@include('header2')
@include('sidebar')
<div id="main">
    <div class="container bg-white shadow">
        <style>
            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            th,
            td {
                padding-left: 10px;
                padding-right: 10px;
            }

            table {
                width: 90%;
            }
        </style>
        <h1>Chi tiết Hợp đồng</h1>
        <hr>


        <h4>Hợp đồng số: {{ $hopdong->HOPDONG_SO }} </h4>
        <h4>Khách hàng: {{ $hopdong->KHACHHANG_TEN }}</h4>
        <h4>Loại hợp đồng: {{ $hopdong->LOAIHOPDONG_TEN }}</h4>
        <h4>Ngày ký: {{ $hopdong->HOPDONG_NGAYKY }}</h4>
        <h4>Ngày hiệu lực: {{ $hopdong->HOPDONG_NGAYHIEULUC }}</h4>
        <h4>Ngày kết thúc: {{ $hopdong->HOPDONG_NGAYKETTHUC }}</h4>
        <h4>Gói thầu: {{ $hopdong->HOPDONG_TENGOITHAU }}</h4>
        <h4>Dự án: {{ $hopdong->HOPDONG_TENDUAN }}</h4>
        <h4>Nội dung: {{ $hopdong->HOPDONG_NOIDUNG }}</h4>
        <h4>Đại diện bên A: {{ $hopdong->HOPDONG_DAIDIENBEN_A }}</h4>
        <h4>Đại diện bên B: {{ $hopdong->HOPDONG_DAIDIENBEN_B }}</h4>
        <h4>Người lập: {{ $hopdong->ten_nd }}</h4>
        <h4>Thời gian thực hiện: {{ $hopdong->HOPDONG_THOIGIANTHUCHIEN }}</h4>
        <h4>Tổng giá trị: {{ $hopdong->HOPDONG_TONGGIATRI }} VNĐ</h4>
        <h4>Hình thức thanh toán: {{ $hopdong->HOPDONG_HINHTHUCTHANHTOAN }}</h4>
        <h4>Ghi chú: {{ $hopdong->HOPDONG_GHICHU }}</h4>
        <h4>Trạng thái hợp đồng: {{ $hopdong->TRANGTHAI_TEN }}</h4>
        <h4>File: <b><a href="{{asset('storage/'.$hopdong->HOPDONG_FILE)}}">{{ $hopdong->HOPDONG_FILE }}</a></b></h4>


        <h1>Danh sách hóa đơn</h1>
        <a href="/hoadon/create?hopdong={{ $hopdong->HOPDONG_SO }}">
            <button type="button" class="btn btn-primary">
                Thêm mới hóa đơn
            </button>
        </a>
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

        <hr>
    </div>
</div>
