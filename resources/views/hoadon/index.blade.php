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
    body{
        max-width: 900px;
        margin: auto;
        padding:20px;
    }
</style>
<h1>Danh sách Hóa đơn</h1>
<hr/>

<div id="selecthopdong" onclick="selectHopDong()">
    <label>Số hợp đồng:</label>
    <select name="sohopdong" id="sohopdong">
        <option value="-1">
            --Chọn hợp đồng--
        </option>
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

<table id="danhsachhoadon">
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
        <td>{{$hdd->HOPDONG_SO}}</td>
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
    
    function selectHopDong(){
        //console.log(document.getElementById("sohopdong").value);
        $tab = document.getElementById("danhsachhoadon");
        $length = document.getElementById("danhsachhoadon").rows.length;
        if(document.getElementById("sohopdong").value == -1)
            document.getElementById("errorsohopdong").innerHTML = "";
        else {
            document.getElementById("errorsohopdong").innerHTML = 'Danh sách hóa đơn cho hợp đồng số: ' + document.getElementById("sohopdong").value;
        }
        for($i=1;$i<$length;$i++){
            //console.log($tab.rows[$i].cells[1].innerHTML);
            if(document.getElementById("sohopdong").value != "-1"){
                if($tab.rows[$i].cells[1].innerHTML == document.getElementById("sohopdong").value){
                    $tab.rows[$i].removeAttribute("hidden");
                } else $tab.rows[$i].setAttribute("hidden", "hidden");
            }
            else $tab.rows[$i].removeAttribute("hidden");
            
        }
    }
    
</script>