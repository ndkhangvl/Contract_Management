<head>
        <title>Thêm mới hóa đơn | hợp đồng số {{$hopdongso}}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
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
                        
                }
                
                .bodyfake{
                        max-width: 1000px;
                        margin: auto;
                        /* padding: 10px; */
                }
                table {
                        width: 100%;
                        max-width: 100%;
                        table-layout: fixed;
                }
                .contentcenter {
                        text-align: center;
                }
        </style>
</head>
<body>
@include('header2')
@include('sidebar')
        <div id="main">
                <div class="container bg-white shadow">
                <a href="/hopdong/{{$hopdongso}}"><b><i class="bi bi-arrow-return-left"></i>Hợp đồng {{$hopdongso}}</a></b>
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
                                        <div class="row mb-3 mt-3">
                                                <div class="col">
                                                        <label class="form-label fw-bold">Hợp đồng số:</label>
                                                        <input class="form-control" type="text" name="sohopdong" value="{{$hopdongso}}" readonly>
                                                        @error('sohopdong')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                                <div class="col">
                                                        <label class="form-label fw-bold">Hóa đơn số:</label>
                                                        <input class="form-control" id="inputsohoadon" type="text" name="sohoadon" placeholder="Số hóa đơn"  value="{{ old('sohoadon') }}" oninput="this.value = this.value.toUpperCase()">
                                                        <div class="alert alert-danger" id="error_" style="display: none"></div>
                                                        @error('sohoadon')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                                <div class="col">
                                                        <label class="form-label fw-bold">File (nếu có):</label>
                                                        <input class="form-control" type="file" name="filehoadon">
                                                        @error('filehoadon')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                                <div class="col">
                                                        <label class="form-label fw-bold">Thuế (%):</label>
                                                        <input class="form-control" id="thuesuat" type="number" name="thuesuat" min="0" value="{{ old('thuesuat') }}">
                                                        @error('thuesuat')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                                <div class="col">
                                                        <label class="form-label fw-bold">Tổng tiền (VNĐ):</label>
                                                        <input class="form-control" type="text" name="tongtien" id="tongtien" value="{{ old('tongtien') }}" readonly>
                                                        @error('tongtien')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                                <div class="col">
                                                        <label class="form-label fw-bold">Tiền thuế (VNĐ):</label>
                                                        <input class="form-control" type="text" name="tienthue" id="tienthue" value="{{ old('tienthue') }}" readonly>
                                                        @error('tienthue')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                                <div class="col">
                                                        <label class="form-label fw-bold">Tổng tiền có thuế (VNĐ):</label>
                                                        <input class="form-control" type="text" name="tongtiencothue" id="tongtiencothue" value="{{ old('tongtiencothue') }}" readonly>
                                                        @error('tongtiencothue')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                                <div class="col">
                                                        <label class="form-label fw-bold">Số tiền (bằng chữ):</label>
                                                        <input class="form-control" value="{{ old('sotienbangchu') }}" type="text" id="sotienbangchu" name="sotienbangchu" readonly>
                                                        @error('sotienbangchu')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                                <div class="col">
                                                        <label class="form-label fw-bold">Người tạo:</label>
                                                        <input class="form-control" value="{{ old('nguoitao') }}" type="text" name="nguoitao">
                                                        @error('nguoitao')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                                <div class="col">
                                                        <label class="form-label fw-bold">Người mua hàng:</label>
                                                        <input class="form-control" value="{{ old('nguoimuahang') }}" type="text" name="nguoimuahang">
                                                        @error('nguoimuahang')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                        </div>
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
                                
                                        <table id='tablechitiet' class='contentcenter'>
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
                                                        <td><input type="text" class="inputnd" name="noidung{{$i}}" id="noidung{{$i}}" value="{{ old('noidung'.$i) }}"></td>
                                                        <td><input type="number" class="soluong inputstt" name="soluong{{$i}}" id="soluong{{$i}}" value="{{ old('soluong'.$i) }}" min="0"></td>
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
                </div>
        </div>
</body>

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

                var soluongs = document.getElementsByClassName('soluong');
                var dongias = document.getElementsByClassName('dongia');
                for (var i = 0; i < soluongs.length; i++) {
                        soluongs[i].addEventListener('input', calHoaDon);
                        dongias[i].addEventListener('input', calHoaDon);
                }
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

        function convert_vi_to_en(str) {
                str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
                str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
                str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
                str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
                str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
                str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
                str = str.replace(/đ/g, "d");
                str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
                str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
                str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
                str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
                str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
                str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
                str = str.replace(/Đ/g, "D");
                str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
                str = str.replace(/  +/g, ' ');
                return str;
        }
        $(document).on('keyup', '[id=inputsohoadon]', function () {
                var obj = $(this);
                $('[id=inputsohoadon]').val(convert_vi_to_en(obj.val()).toUpperCase().replace(/ /g, "-"));
        });

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



