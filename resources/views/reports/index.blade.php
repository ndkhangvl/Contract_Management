<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }  

th {
    background: #337ab7; 
    color:black;
    text-align:center;
    padding: 10px
}

td {
    background: #cce0df;
    padding: 5px;
    margin-left: 10%
    
}
</style>
@include('header2')
@include('header')
<h1>Báo cáo thống kê</h1>
<p>Tổng số hợp đồng: {{ $TongHopDong }}</p>
<p>Tổng tiền của các hóa đơn: {{ $TongHoaDon }} VNĐ</p>
<p>Các hợp đồng hoạt động: {{ $HopDongHoatDong }}</p>
<p>Các hợp đồng ngừng hoạt động: {{ $HopDongNgungHoatDong }}</p>

<h2>Hóa đơn theo tháng</h2>
<table id="bangtkthang">
    <tr>
        <th>Tháng</th>
        <th>Năm</th>
        <th>Tổng số lượng</th>
    </tr>
    @foreach ($HoaDonTheoThang as $hoadon)
    <tr>
        <td class="text-center" style="padding-right: 10px;">{{ $hoadon->Thang }}</td>
        <td class="text-center" style="padding-right: 10px;">{{ $hoadon->Nam }}</td>
        <td class="text-center">{{ $hoadon->SoLuongHoaDon }}</td>
    </tr>
    @endforeach

</table>
