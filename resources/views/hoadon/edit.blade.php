@include('header2')
@include('header')

<style>
        form {
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
        width: 30px;
    }
    
    table {
        width: 70%;
    }
    .bodyfake{
        max-width: 1000px;
        margin: auto;
        padding: 20px;
    }
</style>
<div class="bodyfake">
<h1>Cập nhật Hoá đơn</h1>
<form action="/hoadon/{{$hoadon->HOADON_ID}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
    <h4>{{$error}}</h4>
    @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
    Hợp đồng số: 
    <input class="form-control" 
            type="text" name="sohopdong" required
            value="{{$hoadon->HOPDONG_SO}}" readonly>
    Hóa đơn số: <input class="form-control" 
            type="text" name="sohoadon" required
            value="{{$hoadon->HOADON_SO}}" readonly>

    File: <a href="{{asset('storage/'.$hoadon->HOADON_FILE)}}">{{$hoadon->HOADON_FILE}}</a><br>
    <div id="wrapper">
        <label>Bạn có muốn cập nhật file mới không?</label>
        <p>
        <input type="radio" name="fileadd_yes_no" id="radY" value="1">Có</input>
        </p>
        <p>
        <input type="radio" name="fileadd_yes_no" id="radN" value="0" checked>Không</input>
        </p>
    </div>
    File mới: <input class="form-control" 
            type="file" name="filehoadon" id="filehoadon" disabled
            >

    Thuế (%): <button class="btn btn-primary" onclick="calHoaDon()" type="button">
        Tính toán
    </button>
    <input class="form-control" id="thuesuat" required
            type="number" name="thuesuat" min="0"
            value="{{$hoadon->HOADON_THUESUAT}}">
    Tổng tiền (VNĐ): 
    <input class="form-control" required
            type="text" name="tongtien" id="tongtien"
            value="{{$hoadon->HOADON_TONGTIEN}}"
            readonly>
    Tiền thuế (VNĐ): 
    <input class="form-control" required
            type="text" name="tienthue" id="tienthue"
            value="{{$hoadon->HOADON_TIENTHUE}}"
            readonly>
    Tổng tiền có thuế (VNĐ): 
    <input class="form-control" required
            type="text" name="tongtiencothue" id="tongtiencothue"
            value="{{$hoadon->HOADON_TONGTIEN_COTHUE}}"
            readonly>
    Số tiền (bằng chữ): <input class="form-control" required
    value="{{$hoadon->HOADON_SOTIENBANGCHU}}"
            type="text" name="sotienbangchu">
    Người tạo: <input class="form-control" required
    value="{{$hoadon->HOADON_NGUOITAO}}"
            type="text" name="nguoitao">
    Người mua hàng: <input class="form-control" required
    value="{{$hoadon->HOADON_NGUOIMUAHANG}}"
            type="text" name="nguoimuahang">
    <div>
    <hr>
    <label>Trạng thái hóa đơn:</label>
    <select name="trangthaihoadon">
        @if($hoadon->HOADON_TRANGTHAI == 0)
                <option value=0 selected>
                Chưa thanh toán
                </option>  
                <option value=1>
                Đã thanh toán
                </option> 
        @elseif ($hoadon->HOADON_TRANGTHAI == 1)
                <option value=0>
                Chưa thanh toán
                </option>  
                <option value=1 selected>
                Đã thanh toán
                </option> 
        @endif       
    </select>
    <hr>
    </div>
    <h1>Danh sách chi tiết</h1>
    <hr>
    Số lượng loại sản phẩm:
    <input class="form-control" 
            type="number" name="soluongchitiet" value="{{$cnt}}" min="0" id="slct" required readonly><hr>
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
        
        @foreach ($chitiethoadon as $cthd)
             <tr>
                <td><input type="text" name="stt{{$cthd->STT}}" id="stt{{$cthd->STT}}" value="{{$cthd->STT}}" readonly class="inputstt"></td>
                <td><input type="text" name="noidung{{$cthd->STT}}" id="noidung{{$cthd->STT}}" value="{{$cthd->NOIDUNG}}"></td>
                <td><input type="number" name="soluong{{$cthd->STT}}" id="soluong{{$cthd->STT}}" value="{{$cthd->SOLUONG}}" min="0"></td>
                <td><input type="text" name="donvitinh{{$cthd->STT}}" id="donvitinh{{$cthd->STT}}" value="{{$cthd->DVT}}"></td>
                <td><input type="number" name="dongia{{$cthd->STT}}" id="dongia{{$cthd->STT}}" value="{{$cthd->DONGIA}}" min="0"></td>
                <td><input type="text" name="thanhtien{{$cthd->STT}}" readonly id="thanhtien{{$cthd->STT}}" value="{{$cthd->THANHTIEN}}"></td>
                <td><button type="button" name="btnxoa{{$cthd->STT}}" id="btnxoa{{$cthd->STT}}" class="btn btn-danger" onclick="delRow(this.id.replace('btnxoa',''))">Xóa</button></td>
            </tr>
        @endforeach
    </table>
    <hr>
    <button class="btn btn-primary" type="submit">
        Cập nhật hóa đơn
    </button>
    <button class="btn btn-primary" onclick="calHoaDon()" type="button">
        Tính toán
    </button><hr>
        <script>
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

        $radButtons = document.querySelectorAll("input[name=fileadd_yes_no]");
        $radButtons.forEach(rb=>rb.addEventListener("change",function(){
                //alert("Change");
                //console.log("value of rad: " + document.querySelector('input[name="fileadd_yes_no"]:checked').value);
                if(document.querySelector('input[name="fileadd_yes_no"]:checked').value == "1"){
                        document.getElementById("filehoadon").removeAttribute("disabled");
                        console.log("Cho phep them file");
                }
                else if (document.querySelector('input[name="fileadd_yes_no"]:checked').value == "0"){
                        document.getElementById("filehoadon").setAttribute("disabled", "disabled");
                        console.log("KHONG cho phep them file");
                        document.getElementById('filehoadon').value = null;
                }
        }))
        </script>

</form>


@if ($errors->any())
      <div>
        @foreach ($errors->all() as $error)
          <p class="text-danger">
            {{ $error }}
          </p>
        @endforeach
      </div>
    @endif

</div>