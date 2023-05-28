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
<h1>Danh sách Hóa đơn</h1>
<hr/>

<div>
    <label>Số hợp đồng:</label>
    <select name="sohopdong" id="sohopdong">
        <option value="-1">
            --Chọn hợp đồng--
        </opton>
    @foreach ($hopdongs as $hd)
        <option value="{{ $hd->HOPDONG_SO }}">
        {{ $hd->HOPDONG_SO }}
        </option>    
    @endforeach                                
    </select>
    <button  type="button" class="btn btn-primary" onclick="moveToCreate()">
        Thêm mới hóa đơn
    </button>
    <div id="errorsohopdong"></div>
</div>

<hr/>

<table>
    <tr>
        <th>Hóa đơn số</th>
        <th>Thuộc hợp đồng</th>
        <th>Trạng thái</th>
        <th>Tổng thanh toán</th>
        <th>Ngày tạo hóa đơn</th>
        <th>Chi tiết</th>
    </tr>
    @foreach ($hoadons as $hdd)
    <tr>
        <td>{{$hdd->HOADON_SO}}</td>
        <td><a href="/hopdong/{{$hdd->HOPDONG_SO}}">{{$hdd->HOPDONG_SO}}</a></td>
        @if ($hdd->HOADON_TRANGTHAI == 1)
            <td>Đã thanh toán</td>
        @else
        <td>Chưa thanh toán</td>
        @endif
        <td>{{$hdd->HOADON_TONGTIEN_COTHUE}} VNĐ</td>
        <td>{{$hdd->HOADON_NGAYTAO}}</td>
        <td>
        <a href="/hoadon/{{$hdd->HOADON_SO}}">
            <button type="button" class="btn btn-info">
                Chi tiết
            </button>
        </a>
        </td>
    </tr>
    @endforeach
</table>

<script>
    function moveToCreate(){
        if(document.getElementById("sohopdong").value == -1)
            document.getElementById("errorsohopdong").innerHTML = 'Chưa chọn hợp đồng cần tạo hóa đơn';
        else {
            document.getElementById("errorsohopdong").innerHTML = document.getElementById("sohopdong").value;
            window.location = '/hoadon/create?hopdong='+ document.getElementById("sohopdong").value;
        }
    }
    
</script>