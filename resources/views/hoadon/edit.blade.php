<title>Cập nhật hóa đơn | {{$hoadon->HOADON_SO}}</title>
@include('header2')
@include('sidebar')
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
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
                width: 70px;
        }
        
        
        .bodyfake{
                max-width: 1000px;
                margin: auto;
                padding: 20px;
        }
        
        .contentcenter {
                text-align: center;
        }
</style>
<div id="main">
<div class="container bg-white shadow">
<a href="/hoadon/{{$hoadon->HOADON_SO}}"><b><i class="bi bi-arrow-return-left"></i>{{$hoadon->HOADON_SO}}</a></b>
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
                <div class="row mb-3 mt-3">
                        <div class="col">
                                <label class="form-label fw-bold">Hợp đồng:</label>
                                <input class="form-control" type="text" name="sohopdong" required value="{{$hoadon->HOPDONG_SO}}" readonly>
                        </div>
                        <div class="col">
                                <label class="form-label fw-bold">Hóa đơn số:</label>
                                <input class="form-control" type="text" name="sohoadon" required value="{{$hoadon->HOADON_SO}}" readonly id="inputsohoadon" oninput="this.value = this.value.toUpperCase()">
                                <span class="invalid-feedback" id="sohoadon_error"></span>
                                <div class="alert alert-danger" id="error_" style="display: none"></div>
                        </div>
                </div>
                <div class="row mb-3 mt-3">
                        <div class="col">
                                <label class="form-label fw-bold">File hóa đơn:</label>
                                <a href="{{asset('storage/'.$hoadon->HOADON_FILE)}}"  target="_blank">{{$hoadon->HOADON_FILE}}</a>
                        </div>
                        <div class="col">
                                <div id="wrapper">
                                        <label class="form-label fw-bold">Bạn có muốn cập nhật file mới không?</label>
                                        <p><input type="radio" name="fileadd_yes_no" id="radY" value="1">Có</input></p>
                                        <p><input type="radio" name="fileadd_yes_no" id="radN" value="0" checked>Không</input></p>
                                </div>
                        </div>
                </div>
                <div class="row mb-3 mt-3">
                        <div class="col">
                                <label class="form-label fw-bold">File mới:</label>
                                <input class="form-control" type="file" name="filehoadon" id="filehoadon" disabled required>
                        </div>
                </div>
                <div class="row mb-3 mt-3">
                        <div class="col">
                                <label class="form-label fw-bold">Thuế (%):</label>
                                <input class="form-control" id="thuesuat" required type="number" name="thuesuat" min="0" value="{{$hoadon->HOADON_THUESUAT}}">
                        </div>
                        <div class="col">
                                <label class="form-label fw-bold">Tổng tiền (VNĐ):</label>
                                <input class="form-control" required type="text" name="tongtien" id="tongtien" value="{{$hoadon->HOADON_TONGTIEN}}" readonly>
                        </div>
                </div>
                <div class="row mb-3 mt-3">
                        <div class="col">
                                <label class="form-label fw-bold">Tiền thuế (VNĐ):</label>
                                <input class="form-control" required type="text" name="tienthue" id="tienthue" value="{{$hoadon->HOADON_TIENTHUE}}" readonly>
                        </div>
                        <div class="col">
                                <label class="form-label fw-bold">Tổng tiền có thuế (VNĐ):</label>
                                <input class="form-control" required type="text" name="tongtiencothue" id="tongtiencothue" value="{{$hoadon->HOADON_TONGTIEN_COTHUE}}" readonly>
                        </div>
                </div>
                <div class="row mb-3 mt-3">
                        <div class="col">
                                <label class="form-label fw-bold">Số tiền (bằng chữ):</label>
                                <input class="form-control" required value="{{$hoadon->HOADON_SOTIENBANGCHU}}" type="text" id="sotienbangchu" name="sotienbangchu" readonly>
                        </div>
                </div>
                <div class="row mb-3 mt-3">
                        <div class="col">
                                <label class="form-label fw-bold">Người tạo:</label>
                                <input class="form-control" required value="{{$hoadon->HOADON_NGUOITAO}}" type="text" name="nguoitao">
                        </div>
                        <div class="col">
                                <label class="form-label fw-bold">Người mua hàng:</label>
                                <input class="form-control" required value="{{$hoadon->HOADON_NGUOIMUAHANG}}" type="text" name="nguoimuahang">
                        </div>
                </div>
                
                <div>
                        <hr>
                        <label>Trạng thái hóa đơn:</label>
                        <select name="trangthaihoadon">
                                @if($hoadon->HOADON_TRANGTHAI == 0)
                                        <option value=0 selected>Chưa thanh toán</option>  
                                        <option value=1>Đã thanh toán</option> 
                                @elseif ($hoadon->HOADON_TRANGTHAI == 1)
                                        <option value=0>Chưa thanh toán</option>  
                                        <option value=1 selected>Đã thanh toán</option> 
                                @endif       
                        </select>
                        <hr>
                </div>
                <h1>Danh sách chi tiết</h1>
                <hr>
                Số lượng loại sản phẩm:
                <input class="form-control" type="number" name="soluongchitiet" value="{{$cnt}}" min="0" id="slct" required readonly><hr>
                <button class="btn btn-primary" onclick="addRowEdit()" type="button">Thêm hàng</button>
                <div class="table-responsive">
                <table id='tablechitiet' class="contentcenter">
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
                                <td><input type="text" class="inputstt" name="stt{{$cthd->STT}}" id="stt{{$cthd->STT}}" value="{{$cthd->STT}}" readonly class="inputstt"></td>
                                <td><input type="text" name="noidung{{$cthd->STT}}" id="noidung{{$cthd->STT}}" value="{{$cthd->NOIDUNG}}"></td>
                                <td><input type="number" class="soluong inputstt" name="soluong{{$cthd->STT}}" id="soluong{{$cthd->STT}}" value="{{$cthd->SOLUONG}}" min="0"></td>
                                <td><input type="text" name="donvitinh{{$cthd->STT}}" id="donvitinh{{$cthd->STT}}" value="{{$cthd->DVT}}"></td>
                                <td><input type="number" class="dongia" name="dongia{{$cthd->STT}}" id="dongia{{$cthd->STT}}" value="{{$cthd->DONGIA}}" min="0"></td>
                                <td><input type="text" name="thanhtien{{$cthd->STT}}" readonly id="thanhtien{{$cthd->STT}}" value="{{$cthd->THANHTIEN}}"></td>
                                <td><button type="button" name="btnxoa{{$cthd->STT}}" id="btnxoa{{$cthd->STT}}" class="btn btn-danger" onclick="delRowEdit(this.id.replace('btnxoa',''))">Xóa</button></td>
                        </tr>
                        @endforeach
                </table>
                </div>
                <hr>
                <button class="btn btn-primary" type="submit">Cập nhật hóa đơn</button>
                <hr>
        </form>
</div>
</div>
</div>
<script>
        function calHoaDonEdit() {
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
                to_VNese_currency_Edit();
        }
        document.getElementById("thuesuat").addEventListener('input', calHoaDonEdit);
        var soluongs = document.getElementsByClassName('soluong');
        var dongias = document.getElementsByClassName('dongia');
        for (var i = 0; i < soluongs.length; i++) {
                soluongs[i].addEventListener('input', calHoaDonEdit);
                dongias[i].addEventListener('input', calHoaDonEdit);
        }
        function addRowEdit(){
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
                $soluong.addEventListener('input', calHoaDonEdit);
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
                $dongia.addEventListener('input', calHoaDonEdit);
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
                
                $xoa.setAttribute('onclick', 'delRowEdit(this.id.replace("btnxoa",""))');
                $xoa.setAttribute('type', 'button');
                $cell7.appendChild($xoa);

                document.getElementById("slct").value = $length;
                calHoaDonEdit();

                var soluongs = document.getElementsByClassName('soluong');
                var dongias = document.getElementsByClassName('dongia');
                for (var i = 0; i < soluongs.length; i++) {
                        soluongs[i].addEventListener('input', calHoaDonEdit);
                        dongias[i].addEventListener('input', calHoaDonEdit);
                }
        }

        function delRowEdit(x){
                
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
                calHoaDonEdit();
        }

        $radButtons = document.querySelectorAll("input[name=fileadd_yes_no]");
        $radButtons.forEach(rb=>rb.addEventListener("change",function(){
                //alert("Change");
                //console.log("value of rad: " + document.querySelector('input[name="fileadd_yes_no"]:checked').value);
                if(document.querySelector('input[name="fileadd_yes_no"]:checked').value == "1"){
                        document.getElementById("filehoadon").removeAttribute("disabled");
                        //console.log("Cho phep them file");
                }
                else if (document.querySelector('input[name="fileadd_yes_no"]:checked').value == "0"){
                        document.getElementById("filehoadon").setAttribute("disabled", "disabled");
                        //console.log("KHONG cho phep them file");
                        document.getElementById('filehoadon').value = null;
                }
        }));


        /*************************** */
        /*Test tiền sang tiền chữ VND*/
        /*************************** */
        const defaultNumbers =' hai ba bốn năm sáu bảy tám chín';
        const chuHangDonVi = ('1 một' + defaultNumbers).split(' ');
        const chuHangChuc = ('lẻ mười' + defaultNumbers).split(' ');
        const chuHangTram = ('không một' + defaultNumbers).split(' ');

        function convert_block_three(number) {
                if(number == '000') return '';
                var _a = number + ''; //Convert biến 'number' thành kiểu string
                //Kiểm tra độ dài của khối
                switch (_a.length) {
                        case 0: return '';
                        case 1: return chuHangDonVi[_a];
                        case 2: return convert_block_two(_a);
                        case 3: 
                        var chuc_dv = '';
                        if (_a.slice(1,3) != '00') {
                                chuc_dv = convert_block_two(_a.slice(1,3));
                        }
                        var tram = chuHangTram[_a[0]] + ' trăm';
                        return tram + ' ' + chuc_dv;
                }
        }

        function convert_block_two(number) {
                var dv = chuHangDonVi[number[1]];
                var chuc = chuHangChuc[number[0]];
                var append = '';
                // Nếu chữ số hàng đơn vị là 5
                if (number[0] > 0 && number[1] == 5) {
                        dv = 'lăm'
                }
        // Nếu số hàng chục lớn hơn 1
                if (number[0] > 1) {
                        append = ' mươi';
                        if (number[1] == 1) {
                                dv = ' mốt';
                        }
                }
                return chuc + '' + append + ' ' + dv; 
        }

        const dvBlock = '1 nghìn triệu tỷ'.split(' ');

        function to_VNese_currency_Edit() {
                var number = document.getElementById("tongtiencothue").value;
                var str = parseInt(number) + '';
                var i = 0;
                var arr = [];
                var index = str.length;
                var result = [];
                var rsString = '';

                if (index == 0 || str == 'NaN') {
                        return '';
                }

                // Chia chuỗi số thành một mảng từng khối có 3 chữ số
                while (index >= 0) {
                        arr.push(str.substring(index, Math.max(index - 3, 0)));
                        index -= 3;
                }

                // Lặp từng khối trong mảng trên và convert từng khối đấy ra chữ Việt Nam
                for (i = arr.length - 1; i >= 0; i--) {
                        if (arr[i] != '' && arr[i] != '000') {
                                result.push(convert_block_three(arr[i]));

                                // Thêm đuôi của mỗi khối
                                if (dvBlock[i]) {
                                        result.push(dvBlock[i]);
                                }
                        }
                }

                // Join mảng kết quả lại thành chuỗi string
                rsString = result.join(' ');
                
                // Trả về kết quả kèm xóa những ký tự thừa
                finalval = rsString.replace(/[0-9]/g, '').replace(/ /g,' ').replace(/ $/,'') + " đồng";
                finalval = finalval.charAt(0).toUpperCase() + finalval.slice(1);
                document.getElementById("sotienbangchu").value = finalval;
                
        };
 
</script>

@if ($errors->any())
      <div>
        @foreach ($errors->all() as $error)
          <p class="text-danger">
            {{ $error }}
          </p>
        @endforeach
      </div>
@endif
