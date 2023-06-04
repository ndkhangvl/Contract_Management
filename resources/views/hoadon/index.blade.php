<title>Hóa đơn</title>
@include('header2')
@include('header')
<style>
    .content {
        margin:15px;
        font-weight: bold;
        text-align: center;
    }
    .pagination {
        justify-content: center;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }  
    
    th {
        background: #337ab7; 
        color:white;
        text-align:center;
    }

    td {
        background: #cce0df;
        padding: 5px;
        
    }
    .inputstt {
        width: 100px;
    }
</style>
<div class="content">
    <label>Chọn hợp đồng cần tạo hóa đơn</label>
    <span  id="selecthopdong" onclick="selectHopDong()">
        <select name="sohopdongsl" id="sohopdongsl">
            <option value="-1">--Chọn hợp đồng--</option>
        @foreach ($hopdongs as $hd)
            <option value="{{ $hd->HOPDONG_SO }}">{{ $hd->HOPDONG_SO }}</option>    
        @endforeach                                
        </select>
    </span>
    <button  type="button" class="btn btn-primary" onclick="moveToCreate()">Thêm mới (trang mới)</button>
    <button type="button" class="btn btn-primary" id="btnCreateHDon" onclick="openCreateHDon()">Thêm mới hóa đơn (Modal)</button>
    <div id="errorsohopdong"></div>
</div>
<!--Modal-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm mới Hoá đơn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="/hoadon" method="post" enctype="multipart/form-data" id="hoaDonForm">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        Hợp đồng số: 
                        <input class="form-control" type="text" name="sohopdong" id="sohopdong" required value="" readonly>
                        Hóa đơn số: 
                        <input class="form-control" type="text" name="sohoadon" required placeholder="Số hóa đơn">
                        File: 
                        <input class="form-control" required type="file" name="filehoadon">
                        Thuế (%):
                        <input class="form-control" id="thuesuat" required type="number" name="thuesuat" min="0" value="{{ old('thuesuat') }}">
                        Tổng tiền (VNĐ): 
                        <input class="form-control" required type="text" name="tongtien" id="tongtien" value="{{ old('tongtien') }}" readonly>
                        Tiền thuế (VNĐ): 
                        <input class="form-control" required type="text" name="tienthue" id="tienthue" value="{{ old('tienthue') }}" readonly>
                        Tổng tiền có thuế (VNĐ): 
                        <input class="form-control" required type="text" name="tongtiencothue" id="tongtiencothue" value="{{ old('tongtiencothue') }}" readonly>
                        Số tiền (bằng chữ): 
                        <input class="form-control" required value="{{ old('sotienbangchu') }}" type="text" name="sotienbangchu">
                        Người tạo: 
                        <input class="form-control" required value="{{ old('nguoitao') }}" type="text" name="nguoitao">
                        Người mua hàng: 
                        <input class="form-control" required value="{{ old('nguoimuahang') }}" type="text" name="nguoimuahang">
                        <div>
                            <hr>
                            <label>Trạng thái hóa đơn:</label>
                            <select name="trangthaihoadon">
                                @if(old('trangthaihoadon') == 0)
                                        <option value=0 selected>Chưa thanh toán</option>  
                                        <option value=1>Đã thanh toán</option> 
                                @elseif (old('trangthaihoadon') == 1)
                                        <option value=0>Chưa thanh toán</option>  
                                        <option value=1 selected>Đã thanh toán</option> 
                                @endif       
                            </select>
                            <hr>
                        </div>
                        <h1>Danh sách chi tiết</h1>
                        <hr>
                        Số lượng loại sản phẩm:
                        <input class="form-control" type="number" name="soluongchitiet" value="{{ old('soluongchitiet') }}" min="0" id="slct" required readonly>
                        <hr>
                        <button class="btn btn-primary" onclick="addRow()" type="button">Thêm hàng</button>
                        <table id='tablechitiet'>
                            <tr>
                                <th>STT</th>
                                <th>Nội dung</th>
                                <th>Số lượng</th>
                                <th>Đơn vị tính</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
            
                            @for ($i = 1; $i <= old('soluongchitiet'); $i++)
                                <tr>
                                    <td><input type="text" class="inputstt" name="stt{{$i}}" id="stt{{$i}}" value="{{$i}}" readonly class="inputstt"></td>
                                    <td><input type="text" name="noidung{{$i}}" id="noidung{{$i}}" value="{{ old('noidung'.$i) }}"></td>
                                    <td><input type="number" class="soluong inputstt" name="soluong{{$i}}" id="soluong{{$i}}" value="{{ old('soluong'.$i) }}" min="0"></td>
                                    <td><input type="text" name="donvitinh{{$i}}" id="donvitinh{{$i}}" value="{{ old('donvitinh'.$i) }}"></td>
                                    <td><input type="number" class="dongia" name="dongia{{$i}}" id="dongia{{$i}}" value="{{ old('dongia'.$i) }}" min="0"></td>
                                    <td><input type="text" name="thanhtien{{$i}}" readonly id="thanhtien{{$i}}" value="{{ old('thanhtien'.$i) }}"></td>
                                    <td><button type="button" name="btnxoa{{$i}}" id="btnxoa{{$i}}" class="btn btn-danger" onclick="delRow(this.id.replace('btnxoa',''))">Xóa</button></td>
                                </tr>
                            @endfor
                        </table>
                        <hr>
                        <div class="mb-3 mt-3 pb-2 text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="btnSubmit" class="btn btn-success btn-block mb-3 mt-3"><i class="fas fa-plus me-2"></i>Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<hr/>
<h1>Danh sách Hóa đơn</h1>
<hr/>
<form action="">
    <div class="content">
        <h5>Nhập số hợp đồng cần tìm</h5>
        <input class="" name="find" id="find" placeholder="Số hợp đồng...">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
    </div>
</form>
<table id="danhsachhoadon" class="table table-striped table-hover">
    <tr>
        <th style="background: #077DCE">Hóa đơn số</th>
        <th style="background: #077DCE">Thuộc hợp đồng</th>
        <th style="background: #077DCE">Trạng thái</th>
        <th style="background: #077DCE">Tổng thanh toán</th>
        <th style="background: #077DCE">Ngày tạo hóa đơn</th>
        <th style="background: #077DCE">Chi tiết</th>
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
        <td><a href="/hoadon/{{$hdd->HOADON_SO}}"><button type="button" class="btn btn-info">Chi tiết</button></a></td>
    </tr>
    @endforeach
</table>
<hr>
<div>
    {{ $hoadons->appends(request()->all())->links() }}
</div>

<script>
    function moveToCreate(){
        if(document.getElementById("sohopdongsl").value == "-1")
            document.getElementById("errorsohopdong").innerHTML = 'Chưa chọn hợp đồng cần tạo hóa đơn';
        else {
            window.location = '/hoadon/create?hopdong='+ document.getElementById("sohopdongsl").value;
        }
    }
    
    function selectHopDong(){
        if(document.getElementById("sohopdongsl").value == "-1"){
            document.getElementById("find").value = "";
            document.getElementById("sohopdong").value = "";
            document.getElementById("btnCreateHDon").setAttribute("data-bs-toggle", "");
            document.getElementById("btnCreateHDon").setAttribute("data-bs-target", "");
        }else {
            document.getElementById("find").value = document.getElementById("sohopdongsl").value;
            document.getElementById("sohopdong").value = document.getElementById("sohopdongsl").value;
            document.getElementById("errorsohopdong").innerHTML = '';
            document.getElementById("btnCreateHDon").setAttribute("data-bs-toggle", "modal");
            document.getElementById("btnCreateHDon").setAttribute("data-bs-target", "#staticBackdrop");
        }
    }
    
    function openCreateHDon() {
        if(document.getElementById("sohopdongsl").value == "-1") {
            document.getElementById("errorsohopdong").innerHTML = 'Chưa chọn hợp đồng cần tạo hóa đơn';
        }
    }

    function calHoaDon() {
        $cnt = document.getElementById("slct").value;
        $thue = document.getElementById("thuesuat").value;
        $tongtien = 0;
        $tienthue = 0;
        $tongtiencothue = 0;
        for($i = 1; $i <= $cnt; $i++){
            $sluong = "soluong"+$i;
            $dgia = "dongia"+$i;
            $ttien = "thanhtien"+$i;
            $sl = document.getElementById($sluong).value;
            $dg = document.getElementById($dgia).value;
            $cal = parseInt($sl) * parseInt($dg);
            if(isNaN($cal)) $cal=0;
            document.getElementById($ttien).value = $cal;
            $tongtien = $tongtien + $cal;
        }
            $tienthue = $tongtien/100*$thue;
            $tongtiencothue = $tongtien+$tienthue;
            document.getElementById("tongtien").value= $tongtien;
            document.getElementById("tienthue").value= $tienthue;
            document.getElementById("tongtiencothue").value= $tongtiencothue;
    }

    document.getElementById("thuesuat").addEventListener('input', calHoaDon);
    var soluongs = document.getElementsByClassName('soluong');
    var dongias = document.getElementsByClassName('dongia');
    for (var i = 0; i < soluongs.length; i++) {
        soluongs[i].addEventListener('input', calHoaDon);
        dongias[i].addEventListener('input', calHoaDon);
    }

    function addRow(){
        $table = document.getElementById("tablechitiet");
        $length = document.getElementById("tablechitiet").rows.length;
                
        $row = $table.insertRow($length);
                
        $cell1 = $row.insertCell(0);
        $stt = document.createElement('input');
        $stt.value = $length;
        $stt.readOnly = true;
        $stt.type = "text";
        $stt.name = "stt"+$length;
        $stt.id = "stt"+$length;
        $stt.className = "inputstt";
        $cell1.appendChild($stt);
                
        $cell2 = $row.insertCell(1);
        $noidung = document.createElement('input');
        $noidung.type = "text";
        $noidung.name = "noidung"+$length;
        $noidung.id = "noidung"+$length;
        $cell2.appendChild($noidung);

        $cell3 = $row.insertCell(2);
        $soluong = document.createElement('input');
        $soluong.type = "number";
        $soluong.min = 0;
        $soluong.name = "soluong"+$length;
        $soluong.id = "soluong"+$length;
        $soluong.className = "soluong inputstt";
        $soluong.addEventListener('input', calHoaDon);
        $cell3.appendChild($soluong);

        $cell4 = $row.insertCell(3);
        $donvitinh = document.createElement('input');
        $donvitinh.type = "text";
        $donvitinh.name = "donvitinh"+$length;
        $donvitinh.id = "donvitinh"+$length;
        $cell4.appendChild($donvitinh);

        $cell5 = $row.insertCell(4);
        $dongia = document.createElement('input');
        $dongia.type = "number";
        $dongia.min = "0";
        $dongia.name = "dongia"+$length;
        $dongia.id = "dongia"+$length;
        $dongia.className = "dongia";
        $dongia.addEventListener('input', calHoaDon);
        $cell5.appendChild($dongia);

        $cell6 = $row.insertCell(5);
        $thanhtien = document.createElement('input');
        $thanhtien.readOnly = true;
        $thanhtien.type = "text";
        $thanhtien.name = "thanhtien"+$length;
        $thanhtien.id = "thanhtien"+$length;
        $cell6.appendChild($thanhtien);

        $cell7 = $row.insertCell(6);
        $xoa = document.createElement('button');
        $xoa.id = "btnxoa"+$length;
        $xoa.name = "btnxoa"+$length;
        $xoa.innerHTML = "Xóa";
        $xoa.className = 'btn btn-danger';
                
        $xoa.setAttribute('onclick', 'delRow(this.id.replace("btnxoa",""))');
        $xoa.setAttribute('type', 'button');
        $cell7.appendChild($xoa);

        document.getElementById("slct").value = $length;
        calHoaDon();
    }

    function delRow(x){
                
        $table = document.getElementById("tablechitiet");
        $length = document.getElementById("tablechitiet").rows.length;
                
        for($i = parseInt(x); $i< $length-1; $i++){
            $sohang = parseInt($i);
            $sohangsau = parseInt($i)+1;
            document.getElementById("noidung"+$sohang).value = document.getElementById("noidung"+$sohangsau).value;
            document.getElementById("soluong"+$sohang).value = document.getElementById("soluong"+$sohangsau).value;
            document.getElementById("donvitinh"+$sohang).value = document.getElementById("donvitinh"+$sohangsau).value;
            document.getElementById("dongia"+$sohang).value = document.getElementById("dongia"+$sohangsau).value;
            document.getElementById("thanhtien"+$sohang).value = document.getElementById("thanhtien"+$sohangsau).value;
        }
                
        $table.deleteRow($length-1);
        document.getElementById("slct").value = $length-2;
        calHoaDon();
    }
</script>
@include('footer')