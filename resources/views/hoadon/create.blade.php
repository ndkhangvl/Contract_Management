<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<h1>Thêm mới Hoá đơn</h1>
<style>
        form {
                width: 80%;
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
        width:90%;
    }
</style>

<form action="/hoadon" method="post" enctype="multipart/form-data">
@csrf
    <!--<h3>Hợp đồng số: {{$hopdongso}}</h3>-->
    <h4>{{$error}}</h4>
    @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
    Hợp đồng số: 
    <input class="form-control" 
            type="text" name="sohopdong" required
            value="{{$hopdongso}}" readonly>
    Hóa đơn số: <input class="form-control" 
            type="text" name="sohoadon" required
            placeholder="Số hóa đơn">
    File: <input class="form-control" required
            type="file" name="filehoadon"
            >
    Thuế (%): <button class="btn btn-primary" onclick="calHoaDon()" type="button">
        Tính toán
    </button>
    <input class="form-control" id="thuesuat" required
            type="number" name="thuesuat" min="0"
            value="{{ old('thuesuat') }}">
    Tổng tiền (VNĐ): 
    <input class="form-control" required
            type="text" name="tongtien" id="tongtien"
            value="{{ old('tongtien') }}"
            readonly>
    Tiền thuế (VNĐ): 
    <input class="form-control" required
            type="text" name="tienthue" id="tienthue"
            value="{{ old('tienthue') }}"
            readonly>
    Tổng tiền có thuế (VNĐ): 
    <input class="form-control" required
            type="text" name="tongtiencothue" id="tongtiencothue"
            value="{{ old('tongtiencothue') }}"
            readonly>
    Số tiền (bằng chữ): <input class="form-control" required
    value="{{ old('sotienbangchu') }}"
            type="text" name="sotienbangchu">
    Người tạo: <input class="form-control" required
    value="{{ old('nguoitao') }}"
            type="text" name="nguoitao">
    Người mua hàng: <input class="form-control" required
    value="{{ old('nguoimuahang') }}"
            type="text" name="nguoimuahang">
    <div>
    <hr>
    <label>Trạng thái hóa đơn:</label>
    <select name="trangthaihoadon">
        @if(old('trangthaihoadon') == 0)
                <option value=0 selected>
                Chưa thanh toán
                </option>  
                <option value=1>
                Đã thanh toán
                </option> 
        @elseif (old('trangthaihoadon') == 1)
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
            type="number" name="soluongchitiet" value="{{ old('soluongchitiet') }}" min="0" id="slct" required readonly><hr>
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
                <td><input type="text" name="stt{{$i}}" id="stt{{$i}}" value="{{$i}}" readonly class="inputstt"></td>
                <td><input type="text" name="noidung{{$i}}" id="noidung{{$i}}" value="{{ old('noidung'.$i) }}"></td>
                <td><input type="number" name="soluong{{$i}}" id="soluong{{$i}}" value="{{ old('soluong'.$i) }}" min="0"></td>
                <td><input type="text" name="donvitinh{{$i}}" id="donvitinh{{$i}}" value="{{ old('donvitinh'.$i) }}"></td>
                <td><input type="number" name="dongia{{$i}}" id="dongia{{$i}}" value="{{ old('dongia'.$i) }}" min="0"></td>
                <td><input type="text" name="thanhtien{{$i}}" readonly id="thanhtien{{$i}}" value="{{ old('thanhtien'.$i) }}"></td>
                <td><button type="button" name="btnxoa{{$i}}" id="btnxoa{{$i}}" class="btn btn-danger" onclick="delRow(this.id.replace('btnxoa',''))">Xóa</button></td>
            </tr>
        @endfor
    </table>
    <hr>
    <button class="btn btn-primary" type="submit">
        Tạo hóa đơn
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