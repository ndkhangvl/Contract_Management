<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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

<h1>Chi tiết hóa đơn</h1>
<hr>

    <h4>Thuộc về hợp đồng số: {{$hoadon->HOPDONG_SO}}</h4>
    <h4>Hóa đơn số: {{$hoadon->HOADON_SO}}</h4>
    <h4>File: {{$hoadon->HOADON_FILE}}</h4>
    @if ($hoadon->HOADON_TRANGTHAI == 1)
        <h4>Trạng thái: Đã thanh toán</h4>
    @elseif ($hoadon->HOADON_TRANGTHAI == 0)
        <h4>Trạng thái: Chưa thanh toán</h4>
    @endif
    <h4>Tổng tiền: {{$hoadon->HOADON_TONGTIEN}} VNĐ</h4>
    <h4>Thuế suất: {{$hoadon->HOADON_THUESUAT}} %</h4>
    <h4>Tiền thuế: {{$hoadon->HOADON_TIENTHUE}} VNĐ</h4>
    <h4>Tổng tiền thực (bao gồm thuế): {{$hoadon->HOADON_TONGTIEN_COTHUE}} VNĐ</h4>
    <h4>Số tiền (bằng chữ): {{$hoadon->HOADON_SOTIENBANGCHU}}</h4>
    <h4>Người tạo: {{$hoadon->HOADON_NGUOITAO}}</h4>
    <h4>Ngày tạo: {{$hoadon->HOADON_NGAYTAO}}</h4>
    <h4>Người mua hàng: {{$hoadon->HOADON_NGUOIMUAHANG}}</h4>


<h1>Danh sách</h1>
<hr>

<table>
    <tr>
        <th>STT</th>
        <th>Nội dung</th>
        <th>Số lượng</th>
        <th>Đơn vị tính</th>
        <th>Đơn giá (VNĐ)</th>
        <th>Thành tiền (VNĐ)</th>
    </tr>
    @foreach ($chitiethoadon as $cthd)
    <tr>
        <td>{{$cthd->STT}}</td>
        <td>{{$cthd->NOIDUNG}}</td>
        <td>{{$cthd->SOLUONG}}</td>
        <td>{{$cthd->DVT}}</td>
        <td>{{$cthd->DONGIA}}</td>
        <td>{{$cthd->THANHTIEN}}</td>
    </tr>
    @endforeach
</table>

<hr>