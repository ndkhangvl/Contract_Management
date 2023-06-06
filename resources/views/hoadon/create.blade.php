<head>
        <title>Thêm mới hóa đơn | hợp đồng số {{$hopdongso}}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
</head>
<body>
@include('header2')
@include('header')
        <div class="bodyfake">
                <div style="display: none">
                        Danh sách số hóa đơn đã có
                        @for ($i = 0; $i < $cnt; $i++)
                                <div class="shdexists" id="{{$dssohoadon[$i]->HOADON_SO}}">{{$dssohoadon[$i]->HOADON_SO}}</div>
                        @endfor
                </div>
                <h1>Thêm mới Hoá đơn</h1>
                <form action="/hoadon" method="post" enctype="multipart/form-data" id="hoaDonForm">
                        @csrf
                        <h4>{{$error}}</h4>
                        @if (session('error'))
                                <div class="alert alert-danger">
                                        {{ session('error') }}
                                </div>
                        @endif
                        <div class="alert alert-danger" id="error_" style="display: none"></div>
                        Hợp đồng số: 
                        <input class="form-control" type="text" name="sohopdong" required value="{{$hopdongso}}" readonly>
                        <span class="invalid-feedback" id="sohopdong_error"></span>
                        <br/>
                        Hóa đơn số:
                        <input class="form-control" id="inputsohoadon" type="text" name="sohoadon" required placeholder="Số hóa đơn">
                        <span class="invalid-feedback" id="sohoadon_error"></span>
                        <br/>
                        File: 
                        <input class="form-control" required type="file" name="filehoadon">
                        <span class="invalid-feedback" id="filehoadon_error"></span>
                        <br/>
                        Thuế (%):
                        <input class="form-control" id="thuesuat" required type="number" name="thuesuat" min="0" value="{{ old('thuesuat') }}">
                        <span class="invalid-feedback" id="thuesuat_error"></span>
                        <br/>
                        Tổng tiền (VNĐ): 
                        <input class="form-control" required type="text" name="tongtien" id="tongtien" value="{{ old('tongtien') }}" readonly>
                        <span class="invalid-feedback" id="tongtien_error"></span>
                        <br/>
                        Tiền thuế (VNĐ): 
                        <input class="form-control" required type="text" name="tienthue" id="tienthue" value="{{ old('tienthue') }}" readonly>
                        <span class="invalid-feedback" id="tienthue_error"></span>
                        <br/>
                        Tổng tiền có thuế (VNĐ): 
                        <input class="form-control" required type="text" name="tongtiencothue" id="tongtiencothue" value="{{ old('tongtiencothue') }}" readonly>
                        <span class="invalid-feedback" id="tongtiencothue_error"></span>
                        <br/>
                        Số tiền (bằng chữ): 
                        <input class="form-control" required value="{{ old('sotienbangchu') }}" type="text" id="sotienbangchu" name="sotienbangchu" readonly>
                        <span class="invalid-feedback" id="sotienbangchu_error"></span>
                        <br/>
                        Người tạo: 
                        <input class="form-control" required value="{{ old('nguoitao') }}" type="text" name="nguoitao">
                        <span class="invalid-feedback" id="nguoitao_error"></span>
                        <br/>
                        Người mua hàng: 
                        <input class="form-control" required value="{{ old('nguoimuahang') }}" type="text" name="nguoimuahang">
                        <span class="invalid-feedback" id="nguoimuahang_error"></span>
                        <br/>
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
                        <input class="form-control" type="number" name="soluongchitiet" value="{{ old('soluongchitiet') }}" min="0" id="slct" required readonly><hr>
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
                                        <td><input type="number" class="soluong" name="soluong{{$i}}" id="soluong{{$i}}" value="{{ old('soluong'.$i) }}" min="0"></td>
                                        <td><input type="text" name="donvitinh{{$i}}" id="donvitinh{{$i}}" value="{{ old('donvitinh'.$i) }}"></td>
                                        <td><input type="number" class="dongia" name="dongia{{$i}}" id="dongia{{$i}}" value="{{ old('dongia'.$i) }}" min="0"></td>
                                        <td><input type="text" name="thanhtien{{$i}}" readonly id="thanhtien{{$i}}" value="{{ old('thanhtien'.$i) }}"></td>
                                        <td><button type="button" name="btnxoa{{$i}}" id="btnxoa{{$i}}" class="btn btn-danger" onclick="delRow(this.id.replace('btnxoa',''))">Xóa</button></td>
                                </tr>
                                @endfor
                        </table>
                        <hr>
                        <button class="btn btn-primary" type="submit" id="btnsubmithd">
                                Tạo hóa đơn
                        </button>
                        <hr>
                </form>
        </div>
</body>
<script>
        /*
        $(document).ready(function () {
                $('#hoaDonForm').on('submit', function (e) {
                        e.preventDefault();
                        var formData = $(this).serialize();
                        $.ajax({
                                url: $(this).attr('action'),
                                type: 'POST',
                                data: formData,
                                success: function (success) {
                                        if (success) {
                                        alert('Thêm mới hóa đơn thành công');
                                        //$('#hoaDonForm input').val('');
                                        location.reload();
                                        } else {
                                        alert('Thất bại');
                                        }
                                },
                                error: function (xhr) {
                                        if (xhr.status === 422) {
                                                $('.invalid-feedback').empty();
                                                var response = JSON.parse(xhr.responseText);
                                                var errors = response.errors;
                                                
                                                for (var field in errors) {
                                                        if (errors.hasOwnProperty(field)) {
                                                                var errorMessage = errors[field][0];
                                                                $('#' + field + '_error').text(errorMessage).show();
                                                        }
                                                }
                                        }
                                }
                        });
                });
        });
        */
</script>
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
                to_VNese_currency();
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
                $soluong.className = "soluong";
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

        function checkSHDExists() {
                var hoadontontai = document.getElementsByClassName('shdexists');
                $shd = document.getElementById("inputsohoadon").value;
                document.getElementById("error_").setAttribute('style','display: none');
                document.getElementById("error_").innerHTML = "";
                document.getElementById("btnsubmithd").removeAttribute('disabled', 'true');
                for(var i=0; i < hoadontontai.length; i++){
                        if ($shd == hoadontontai[i].id){
                                document.getElementById("error_").removeAttribute('style','display: none');
                                document.getElementById("error_").innerHTML = "Số hóa đơn đã tồn tại, vui lòng nhập lại!";
                                document.getElementById("btnsubmithd").setAttribute('disabled', 'true');
                        }
                }
        }
        document.getElementById("inputsohoadon").addEventListener('input', checkSHDExists);


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

        function to_VNese_currency() {
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

