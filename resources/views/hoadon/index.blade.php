<title>Hóa đơn</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@include('header2')
@include('sidebar')
<style>
    .content {
        margin: 15px;
        font-weight: bold;
        text-align: center;
    }

    .pagination {
        justify-content: center;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th {
        background: #337ab7;
        color: white;
        text-align: center;
    }

    td {
        background: #cce0df;
        padding: 5px;

    }

    .inputstt {
        width: 100px;
    }
</style>
<div id="main">
<div style="display: none">
    Danh sách số hóa đơn đã có
    @for ($i = 0; $i < $cnt; $i++)
        <div class="shdexists" id="{{$dssohoadon[$i]->HOADON_SO}}">{{$dssohoadon[$i]->HOADON_SO}}</div>
    @endfor
</div>
    <div class="container shadow bg-white">
        <div class="content p-3">
            <label>Chọn hợp đồng cần tạo hóa đơn</label>
            <span id="selecthopdong" onclick="selectHopDong()">
                <select name="sohopdongsl" id="sohopdongsl" class="js-example-placeholder-single js-states"
                    style="width: 20%;">
                    {{-- <option value="-1">--Chọn hợp đồng--</option> --}}
                    @foreach ($hopdongs as $hd)
                        <option value="{{ $hd->HOPDONG_SO }}">{{ $hd->HOPDONG_SO }}</option>
                    @endforeach
                </select>
            </span>
            <script>
                $(document).ready(function() {
                    $('#sohopdongsl').select2({
                        placeholder: "Chọn loại hợp đồng",
                        matcher: matchCustom,
                        allowClear: true,
                        language: {
                            noResults: function() {
                                return "Không tìm thấy kết quả";
                            }
                        }
                    });
                });
            </script>
            {{--<button type="button" class="btn btn-primary" onclick="moveToCreate()">Thêm mới (trang mới)</button>--}}
            <button type="button" class="btn btn-primary" id="btnCreateHDon" onclick="openCreateHDon()">Thêm mới hóa
                đơn</button>
            <a href="/ExportHoaDon">
                <button type="button" class="btn btn-info">
                    Tải về Excel
                </button>
            </a>
            <div id="errorsohopdong"></div>
        </div>
        <!--Modal-->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Thêm mới Hoá đơn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="/createHoaDonModal" method="POST" enctype="multipart/form-data"
                                id="hoaDonForm">
                                @csrf

                                Hợp đồng số:
                                <input class="form-control" type="text" name="sohopdong" id="sohopdong"
                                    value="" readonly>
                                <span class="invalid-feedback" id="sohopdong_error"></span></br>
                                Hóa đơn số:
                                <input class="form-control" type="text" name="sohoadon" placeholder="Số hóa đơn" id="inputsohoadon" oninput="this.value = this.value.toUpperCase()">
                                <span class="invalid-feedback" id="sohoadon_error"></span></br>
                                <div class="alert alert-danger" id="error_" style="display: none"></div>
                                File:
                                <input class="form-control" type="file" name="filehoadon">
                                <span class="invalid-feedback" id="filehoadon_error"></span></br>
                                Thuế (%):
                                <input class="form-control" id="thuesuat" type="number" name="thuesuat" min="0"
                                    value="{{ old('thuesuat') }}">
                                <span class="invalid-feedback" id="thuesuat_error"></span></br>
                                Tổng tiền (VNĐ):
                                <input class="form-control" type="text" name="tongtien" id="tongtien"
                                    value="{{ old('tongtien') }}" readonly>
                                <span class="invalid-feedback" id="tongtien_error"></span></br>
                                Tiền thuế (VNĐ):
                                <input class="form-control" type="text" name="tienthue" id="tienthue"
                                    value="{{ old('tienthue') }}" readonly>
                                <span class="invalid-feedback" id="tienthue_error"></span></br>
                                Tổng tiền có thuế (VNĐ):
                                <input class="form-control" type="text" name="tongtiencothue" id="tongtiencothue"
                                    value="{{ old('tongtiencothue') }}" readonly>
                                <span class="invalid-feedback" id="tongtiencothue_error"></span></br>
                                Số tiền (bằng chữ):
                                <input class="form-control" value="{{ old('sotienbangchu') }}" type="text"
                                    id="sotienbangchu" name="sotienbangchu" readonly>
                                <span class="invalid-feedback" id="sotienbangchu_error"></span></br>
                                Người tạo:
                                <input class="form-control" value="{{ old('nguoitao') }}" type="text"
                                    name="nguoitao">
                                <span class="invalid-feedback" id="nguoitao_error"></span></br>
                                Người mua hàng:
                                <input class="form-control" value="{{ old('nguoimuahang') }}" type="text"
                                    name="nguoimuahang">
                                <span class="invalid-feedback" id="nguoimuahang_error"></span></br>
                                <div>
                                    <hr>
                                    <label>Trạng thái hóa đơn:</label>
                                    <select name="trangthaihoadon">
                                        @if (old('trangthaihoadon') == 0)
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
                                <input class="form-control" type="number" name="soluongchitiet"
                                    value="{{ old('soluongchitiet') }}" min="0" id="slct" required
                                    readonly>
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
                                            <td><input type="text" class="inputstt" name="stt{{ $i }}"
                                                    id="stt{{ $i }}" value="{{ $i }}" readonly
                                                    class="inputstt"></td>
                                            <td><input type="text" name="noidung{{ $i }}"
                                                    id="noidung{{ $i }}"
                                                    value="{{ old('noidung' . $i) }}">
                                            </td>
                                            <td><input type="number" class="soluong inputstt"
                                                    name="soluong{{ $i }}"
                                                    id="soluong{{ $i }}"
                                                    value="{{ old('soluong' . $i) }}" min="0"></td>
                                            <td><input type="text" name="donvitinh{{ $i }}"
                                                    id="donvitinh{{ $i }}"
                                                    value="{{ old('donvitinh' . $i) }}"></td>
                                            <td><input type="number" class="dongia"
                                                    name="dongia{{ $i }}" id="dongia{{ $i }}"
                                                    value="{{ old('dongia' . $i) }}" min="0"></td>
                                            <td><input type="text" name="thanhtien{{ $i }}" readonly
                                                    id="thanhtien{{ $i }}"
                                                    value="{{ old('thanhtien' . $i) }}"></td>
                                            <td><button type="button" name="btnxoa{{ $i }}"
                                                    id="btnxoa{{ $i }}" class="btn btn-danger"
                                                    onclick="delRow(this.id.replace('btnxoa',''))">Xóa</button></td>
                                        </tr>
                                    @endfor
                                </table>
                                <hr>
                                <div class="mb-3 mt-3 pb-2 text-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="btnsubmithd"
                                        class="btn btn-success btn-block mb-3 mt-3"><i
                                            class="fas fa-plus me-2"></i>Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr />
        <h1>Danh sách Hóa đơn</h1>
        <hr />
        <form>
            <div class="content">
                <h5>Nhập số hợp đồng cần tìm</h5>
                <input class="" name="find" id="find" placeholder="Số hợp đồng..." onclick="selectHopDong()">
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
                    <td>{{ $hdd->HOADON_SO }}</td>
                    <td>{{ $hdd->HOPDONG_SO }}</td>
                    @if ($hdd->HOADON_TRANGTHAI == 1)
                        <td>Đã thanh toán</td>
                    @else
                        <td>Chưa thanh toán</td>
                    @endif
                    <td>{{ $hdd->HOADON_TONGTIEN_COTHUE }} VNĐ</td>
                    <td>{{ $hdd->HOADON_NGAYTAO }}</td>
                    <td>
                        <a href="/hoadon/{{ $hdd->HOADON_SO }}">
                            <button type="button" class="btn btn-info">
                                Chi tiết
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <hr>
        <div>
            {{ $hoadons->appends(request()->all())->links() }}
        </div>
        <script>
            $(document).ready(function() {
                $('#hoaDonForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    var form = $('#hoaDonForm')[0];
                    // Create an FormData object 
                    var data = new FormData(form);

                    $.ajax({
                        url: $(this).attr("action"),
                        type: 'POST',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false, // Important!
                        contentType: false,
                        success: function(success) {
                            if (success) {
                                alert('Thêm mới hóa đơn thành công');
                                $('#hoaDonForm input').val('');
                                location.reload();
                            } else {
                                alert('Thất bại: Số hóa đơn đã tồn tại! Vui lòng nhập lại');
                            }
                        },
                        error: function(xhr) {
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
        </script>
        <script>
            function moveToCreate() {
                if (document.getElementById("sohopdongsl").value == "-1")
                    document.getElementById("errorsohopdong").innerHTML = 'Chưa chọn hợp đồng cần tạo hóa đơn';
                else {
                    window.location = '/hoadon/create?hopdong=' + document.getElementById("sohopdongsl").value;
                }
            }

            function selectHopDong() {
                if (document.getElementById("sohopdongsl").value == "-1") {
                    //document.getElementById("find").value = "";
                    document.getElementById("sohopdong").value = "";
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-toggle", "");
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-target", "");
                } else {
                    //document.getElementById("find").value = document.getElementById("sohopdongsl").value;
                    document.getElementById("sohopdong").value = document.getElementById("sohopdongsl").value;
                    document.getElementById("errorsohopdong").innerHTML = '';
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-toggle", "modal");
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-target", "#staticBackdrop");
                }
            }

            function openCreateHDon() {
                selectHopDong();
                if (document.getElementById("sohopdongsl").value == "-1") {
                    document.getElementById("errorsohopdong").innerHTML = 'Chưa chọn hợp đồng cần tạo hóa đơn';
                }
            }

            function calHoaDon() {
                $cnt = document.getElementById("slct").value;
                $thue = document.getElementById("thuesuat").value;
                $tongtien = 0;
                $tienthue = 0;
                $tongtiencothue = 0;
                for ($i = 1; $i <= $cnt; $i++) {
                    $sluong = "soluong" + $i;
                    $dgia = "dongia" + $i;
                    $ttien = "thanhtien" + $i;
                    $sl = document.getElementById($sluong).value;
                    $dg = document.getElementById($dgia).value;
                    $cal = parseInt($sl) * parseInt($dg);
                    if (isNaN($cal)) $cal = 0;
                    document.getElementById($ttien).value = $cal;
                    $tongtien = $tongtien + $cal;
                }
                $tienthue = $tongtien / 100 * $thue;
                $tongtiencothue = $tongtien + $tienthue;
                document.getElementById("tongtien").value = $tongtien;
                document.getElementById("tienthue").value = $tienthue;
                document.getElementById("tongtiencothue").value = $tongtiencothue;
                to_VNese_currency();
            }

            document.getElementById("thuesuat").addEventListener('input', calHoaDon);
            var soluongs = document.getElementsByClassName('soluong');
            var dongias = document.getElementsByClassName('dongia');
            for (var i = 0; i < soluongs.length; i++) {
                soluongs[i].addEventListener('input', calHoaDon);
                dongias[i].addEventListener('input', calHoaDon);
            }

            function addRow() {
                $table = document.getElementById("tablechitiet");
                $length = document.getElementById("tablechitiet").rows.length;

                $row = $table.insertRow($length);

                $cell1 = $row.insertCell(0);
                $stt = document.createElement('input');
                $stt.value = $length;
                $stt.readOnly = true;
                $stt.type = "text";
                $stt.name = "stt" + $length;
                $stt.id = "stt" + $length;
                $stt.className = "inputstt";
                $cell1.appendChild($stt);

                $cell2 = $row.insertCell(1);
                $noidung = document.createElement('input');
                $noidung.type = "text";
                $noidung.name = "noidung" + $length;
                $noidung.id = "noidung" + $length;
                $cell2.appendChild($noidung);

                $cell3 = $row.insertCell(2);
                $soluong = document.createElement('input');
                $soluong.type = "number";
                $soluong.min = 0;
                $soluong.name = "soluong" + $length;
                $soluong.id = "soluong" + $length;
                $soluong.className = "soluong inputstt";
                $soluong.addEventListener('input', calHoaDon);
                $cell3.appendChild($soluong);

                $cell4 = $row.insertCell(3);
                $donvitinh = document.createElement('input');
                $donvitinh.type = "text";
                $donvitinh.name = "donvitinh" + $length;
                $donvitinh.id = "donvitinh" + $length;
                $cell4.appendChild($donvitinh);

                $cell5 = $row.insertCell(4);
                $dongia = document.createElement('input');
                $dongia.type = "number";
                $dongia.min = "0";
                $dongia.name = "dongia" + $length;
                $dongia.id = "dongia" + $length;
                $dongia.className = "dongia";
                $dongia.addEventListener('input', calHoaDon);
                $cell5.appendChild($dongia);

                $cell6 = $row.insertCell(5);
                $thanhtien = document.createElement('input');
                $thanhtien.readOnly = true;
                $thanhtien.type = "text";
                $thanhtien.name = "thanhtien" + $length;
                $thanhtien.id = "thanhtien" + $length;
                $cell6.appendChild($thanhtien);

                $cell7 = $row.insertCell(6);
                $xoa = document.createElement('button');
                $xoa.id = "btnxoa" + $length;
                $xoa.name = "btnxoa" + $length;
                $xoa.innerHTML = "Xóa";
                $xoa.className = 'btn btn-danger';

                $xoa.setAttribute('onclick', 'delRow(this.id.replace("btnxoa",""))');
                $xoa.setAttribute('type', 'button');
                $cell7.appendChild($xoa);

                document.getElementById("slct").value = $length;
                calHoaDon();
            }

            function delRow(x) {

                $table = document.getElementById("tablechitiet");
                $length = document.getElementById("tablechitiet").rows.length;

                for ($i = parseInt(x); $i < $length - 1; $i++) {
                    $sohang = parseInt($i);
                    $sohangsau = parseInt($i) + 1;
                    document.getElementById("noidung" + $sohang).value = document.getElementById("noidung" + $sohangsau).value;
                    document.getElementById("soluong" + $sohang).value = document.getElementById("soluong" + $sohangsau).value;
                    document.getElementById("donvitinh" + $sohang).value = document.getElementById("donvitinh" + $sohangsau)
                        .value;
                    document.getElementById("dongia" + $sohang).value = document.getElementById("dongia" + $sohangsau).value;
                    document.getElementById("thanhtien" + $sohang).value = document.getElementById("thanhtien" + $sohangsau)
                        .value;
                }

                $table.deleteRow($length - 1);
                document.getElementById("slct").value = $length - 2;
                calHoaDon();
            }

            /*************************** */
            /*Test tiền sang tiền chữ VND*/
            /*************************** */
            const defaultNumbers = ' hai ba bốn năm sáu bảy tám chín';
            const chuHangDonVi = ('1 một' + defaultNumbers).split(' ');
            const chuHangChuc = ('lẻ mười' + defaultNumbers).split(' ');
            const chuHangTram = ('không một' + defaultNumbers).split(' ');

            function convert_block_three(number) {
                if (number == '000') return '';
                var _a = number + ''; //Convert biến 'number' thành kiểu string
                //Kiểm tra độ dài của khối
                switch (_a.length) {
                    case 0:
                        return '';
                    case 1:
                        return chuHangDonVi[_a];
                    case 2:
                        return convert_block_two(_a);
                    case 3:
                        var chuc_dv = '';
                        if (_a.slice(1, 3) != '00') {
                            chuc_dv = convert_block_two(_a.slice(1, 3));
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
                finalval = rsString.replace(/[0-9]/g, '').replace(/ /g, ' ').replace(/ $/, '') + " đồng";
                finalval = finalval.charAt(0).toUpperCase() + finalval.slice(1);
                document.getElementById("sotienbangchu").value = finalval;

            };

            function matchCustom(params, data) {
                if ($.trim(params.term) === '') {
                    return data;
                }

                var searchTerm = params.term.toLowerCase();
                var dataText = data.text.toLowerCase();

                if (dataText.indexOf(searchTerm) > -1) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.text += ' (phù hợp)';
                    return modifiedData;
                }

                return null;
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
        </script>
    </div>
</div>
@include('footer')
