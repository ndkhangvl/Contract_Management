{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="{{ asset('js/change_currency.js') }}"></script>
@include('header2')
@include('sidebar')

<style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    td {
        border-bottom: 1px solid #ddd;
    }

    .container {
        padding: 20px;
        margin-top: 20px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    /* .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    color: #fff;
    font-size: 16px;
    margin-bottom: 20px
} */

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-info {
        background-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #11707e;
    }

    .subheading {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .row {
        display: flex;
        justify-content: space-between;
    }

    .column {
        width: 48%;
    }
</style>
<div id="main">
    <div class="container bg-white shadow">
        <hr>
        <!--Modal create-->
        <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Thêm mới Hoá đơn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="/createHoaDonModal" method="POST" enctype="multipart/form-data"
                                id="hoaDonForm">
                                @csrf
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Hợp đồng:</label>
                                        <input class="form-control" type="text" name="sohopdong" id="sohopdong"
                                            value="{{ $hopdong->HOPDONG_SO }}" readonly>
                                        <span class="invalid-feedback" id="sohopdong_error"></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Hóa đơn số:</label>
                                        <input class="form-control" type="text" name="sohoadon"
                                            placeholder="Số hóa đơn" id="inputsohoadon"
                                            oninput="this.value = this.value.toUpperCase()">
                                        <span class="invalid-feedback" id="sohoadon_error"></span>
                                        <div class="alert alert-danger" id="error_" style="display: none"></div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Người tạo:</label>
                                        <input class="form-control" value="" type="text" name="nguoitao">
                                        <span class="invalid-feedback" id="nguoitao_error"></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Người mua hàng:</label>
                                        <input class="form-control" value="" type="text" name="nguoimuahang">
                                        <span class="invalid-feedback" id="nguoimuahang_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Thuế:</label>
                                        <input class="form-control" id="thuesuat" type="number" name="thuesuat"
                                            min="0" value="0">
                                        <span class="invalid-feedback" id="thuesuat_error"></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Tổng tiền (VNĐ):</label>
                                        <input class="form-control textnumber" type="text" name="tongtien"
                                            id="tongtien" value="" readonly>
                                        <span class="invalid-feedback" id="tongtien_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Tiền thuế (VNĐ):</label>
                                        <input class="form-control textnumber" type="text" name="tienthue"
                                            id="tienthue" value="" readonly>
                                        <span class="invalid-feedback" id="tienthue_error"></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Tổng tiền có thuế (VNĐ):</label>
                                        <input class="form-control textnumber" type="text" name="tongtiencothue"
                                            id="tongtiencothue" value="" readonly>
                                        <span class="invalid-feedback" id="tongtiencothue_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Số tiền (bằng chữ):</label>
                                        <input class="form-control" value="" type="text" id="sotienbangchu"
                                            name="sotienbangchu" readonly>
                                        <span class="invalid-feedback" id="sotienbangchu_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">File hóa đơn (nếu có):</label>
                                        <input class="form-control" type="file" name="filehoadon">
                                        <span class="invalid-feedback" id="filehoadon_error"></span>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                    <label class="form-label fw-bold">Trạng thái hóa đơn:</label>
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
                                <input class="form-control" type="number" name="soluongchitiet" value=""
                                    min="0" id="slct" required readonly>
                                <hr>
                                <button class="btn btn-primary" onclick="addRowIndexCreate()" type="button">Thêm
                                    hàng</button>
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
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3 mt-3 pb-2 text-center">
                                    <button type="button" class="btn btn-secondary btn-block mb-3 mt-3"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="btnsubmithd"
                                        class="btn btn-success btn-block mb-3 mt-3"><i
                                            class="fas fa-plus me-2"></i>Thêm
                                        mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal create-->
        <div class="container-fluid">
            <div class="border" style="padding-left:100px; padding-right:100px">
                <div class="mt-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png"
                                alt="logo" width="100" height="43.25">
                        </div>
                        <div class="col text-center">
                            <h4 class="fs-2">Chi tiết Hợp đồng</h4>
                        </div>
                    </div>

                    <hr style="border-top: 2px dashed black;" />
                    <div class="text-start">
                        <b>Ngày ký: </b>{{ $hopdong->HOPDONG_NGAYKY }}<br>
                        <b>Hợp đồng số: </b><b style="color: red">{{ $hopdong->HOPDONG_SO }}</b><br>
                        <b>Trạng thái: </b>{{ $hopdong->TRANGTHAI_TEN }}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Khách hàng:</span>
                            <a href="/khachhang/{{$hopdong->KHACHHANG_ID}}">
                                {{ $hopdong->KHACHHANG_TEN }}
                            </a>
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold">Loại hợp đồng:</span>
                            {{ $hopdong->LOAIHOPDONG_TEN }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Ngày hiệu lực:</span>
                            {{ $hopdong->HOPDONG_NGAYHIEULUC }}
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold">Ngày kết thúc:</span>
                            {{ $hopdong->HOPDONG_NGAYKETTHUC }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Thời gian thực hiện:</span>
                            {{ $hopdong->HOPDONG_THOIGIANTHUCHIEN }}
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold textnumber" >Tổng giá trị:</span>
                            <span data-format="number">{{ $hopdong->HOPDONG_TONGGIATRI }}</span> VNĐ
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <span class="form-label fw-bold">Hình thức thanh toán:</span>
                            {{ $hopdong->HOPDONG_HINHTHUCTHANHTOAN }}
                            <hr>
                        </div>
                        <div class="col subheading">
                            <span class="form-label fw-bold">Ghi chú:</span>
                            {{ $hopdong->HOPDONG_GHICHU }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <label class="form-label fw-bold">File:</label>
                            </b> <a
                                href="{{ asset('storage/' . $hopdong->HOPDONG_FILE) }}">{{ $hopdong->HOPDONG_FILE }}</a></b>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <label class="form-label fw-bold">Gói thầu:</label>
                            {{ $hopdong->HOPDONG_TENGOITHAU }}
                            <br>
                            <label class="form-label fw-bold">Dự án:</label>
                            {{ $hopdong->HOPDONG_TENDUAN }}
                            <br>
                            <label class="form-label fw-bold">&nbsp;</label>
                            &nbsp;
                            <hr>
                        </div>
                        <div class="col subheading">
                            <label class="form-label fw-bold">Đại diện bên A:</label>
                            {{ $hopdong->HOPDONG_DAIDIENBEN_A }}
                            <br>
                            <label class="form-label fw-bold">Đại diện bên B:</label>
                            {{ $hopdong->HOPDONG_DAIDIENBEN_B }}
                            <br>
                            <label class="form-label fw-bold">Người lập:</label>
                            {{ $hopdong->ten_nd }}
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col subheading">
                            <label class="form-label fw-bold">Nội dung:</label><br>
                            {{ $hopdong->HOPDONG_NOIDUNG }}
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <h1 style="color: blue;">Danh sách hóa đơn</h1>
        <hr>

        <button type="button" class="btn btn-info btn-icon-only p-2 mb-2" aria-label="Sửa" data-bs-toggle="modal"
            data-bs-target="#createModal">
            Thêm mới hóa đơn
        </button>

        <table>
            <tr>
                <th>Hóa đơn số</th>
                <th>Trạng thái</th>
                <th>Tổng thanh toán</th>
                <th>Ngày tạo hóa đơn</th>
                <th>Chi tiết</th>
            </tr>
            @foreach ($hoadons as $hdd)
                <tr>
                    <td>{{ $hdd->HOADON_SO }}</td>
                    @if ($hdd->HOADON_TRANGTHAI == 1)
                        <td>Đã thanh toán</td>
                    @else
                        <td>Chưa thanh toán</td>
                    @endif
                    <td><span data-format="number">{{ $hdd->HOADON_TONGTIEN_COTHUE }}</span> VNĐ</td>
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
    </div>
</div>
<script>
    function formatNumber(number) {
        return numeral(number).format('0,0').replace(/,/g, '.');
    }

    function formatNumberInputs() {
        var numberInputs = document.querySelectorAll('input[type="text"][class~="textnumber"]');
        numberInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                var value = this.value.replace(/\D/g, '');
                var formattedValue = formatNumber(value);
                this.value = formattedValue;
            });
        });
    };

    function formatSpanElements() {
      var spans = document.querySelectorAll('span[data-format="number"]');
      spans.forEach(function(span) {
        var value = span.textContent.trim().replace(/\D/g, '');
        var formattedValue = formatNumber(value);
        span.textContent = formattedValue;
      });
    }

    window.addEventListener('DOMContentLoaded', function() {
        formatNumberInputs();
        formatSpanElements();
    });

    $(document).ready(function() {

        $('#hoaDonForm').on('submit', function(e) {
            $('#hoaDonForm .textnumber').each(function() {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(value);
            });
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var data = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Đang xử lý...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        },
                        onClose: () => {
                            Swal.hideLoading();
                        }
                    });
                },
                success: function(success) {
                    Swal.close();
                    if (success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đã thêm mới!',
                            text: 'Hóa đơn mới đã được tạo'
                        }).then(() => {
                            form[0].reset();
                            location.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Không thể thêm hóa đơn!',
                            text: 'Hóa đơn không thể thêm mới, kiểm tra thông tin nhập vào'
                        });
                    }
                },
                error: function(xhr) {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Có lỗi xảy ra trong quá trình xử lý, vui lòng thực hiện lại sau'
                    });
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
        $('#createModal').on('show.bs.modal', function(event) {
            $('#createModal #tablechitiet tr').slice(1).remove();
            $('#slct').val(0);
            $("#createModal #thuesuat").on('input', calHoaDonIndexCreate);
            $('#createModal').on('input', '#inputsohoadon', checkSHDExistsIndexCreate);
            $('#createModal').on('keyup', '[id=inputsohoadon]', function() {
                var obj = $(this);
                obj.val(convert_vi_to_en(obj.val()).toUpperCase().replace(/ /g, "-"));
            });
        });
        $('#createModal').on('hide.bs.modal', function(event) {
            $('#createModal input').val('');
        });
    });

    function calHoaDonIndexCreate() {
        var modal = document.getElementById("createModal");
        $cnt = modal.querySelector("#slct").value;
        $thue = modal.querySelector("#thuesuat").value;
        $tongtien = 0;
        $tienthue = 0;
        $tongtiencothue = 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $sluong = "soluong" + $i;
            $dgia = "dongia" + $i;
            $ttien = "thanhtien" + $i;
            $sl = modal.querySelector("#" + $sluong).value.replace(/\./g, "");
            $dg = modal.querySelector("#" + $dgia).value.replace(/\./g, "");
            console.log("soluong va dongia: " + $sl + "-" + $dg);
            $cal = parseInt($sl) * parseInt($dg);
            if (isNaN($cal)) $cal = 0;
            modal.querySelector("#" + $ttien).value = $cal;
            $tongtien = $tongtien + $cal;
        }
        $tienthue = $tongtien / 100 * $thue;
        $tongtiencothue = $tongtien + $tienthue;
        modal.querySelector("#tongtien").value = $tongtien;
        modal.querySelector("#tienthue").value = $tienthue;
        modal.querySelector("#tongtiencothue").value = $tongtiencothue;
        to_VNese_currency_IndexCreate();
        var thanhtiens = modal.querySelectorAll('.textnumber');
        for (var i = 0; i < thanhtiens.length; i++) {
            var value = thanhtiens[i].value.replace(/\D/g, '');
            var formattedValue = formatNumber(value);
            thanhtiens[i].value = formattedValue;
        }

    }

    function addRowIndexCreate() {
        var modal = document.getElementById("createModal");
        $table = modal.querySelector("#tablechitiet");
        $length = modal.querySelector("#tablechitiet").rows.length;

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
        $soluong.type = "text";
        $soluong.min = 0;
        $soluong.name = "soluong" + $length;
        $soluong.id = "soluong" + $length;
        $soluong.className = "soluong inputstt textnumber";
        $soluong.addEventListener('input', calHoaDonIndexCreate);
        $cell3.appendChild($soluong);

        $cell4 = $row.insertCell(3);
        $donvitinh = document.createElement('input');
        $donvitinh.type = "text";
        $donvitinh.name = "donvitinh" + $length;
        $donvitinh.id = "donvitinh" + $length;
        $cell4.appendChild($donvitinh);

        $cell5 = $row.insertCell(4);
        $dongia = document.createElement('input');
        $dongia.type = "text";
        $dongia.min = "0";
        $dongia.name = "dongia" + $length;
        $dongia.id = "dongia" + $length;
        $dongia.className = "dongia textnumber";
        $dongia.addEventListener('input', calHoaDonIndexCreate);
        $cell5.appendChild($dongia);

        $cell6 = $row.insertCell(5);
        $thanhtien = document.createElement('input');
        $thanhtien.readOnly = true;
        $thanhtien.type = "text";
        $thanhtien.name = "thanhtien" + $length;
        $thanhtien.id = "thanhtien" + $length;
        $thanhtien.className = "thanhtien textnumber";
        $cell6.appendChild($thanhtien);

        $cell7 = $row.insertCell(6);
        $xoa = document.createElement('button');
        $xoa.id = "btnxoa" + $length;
        $xoa.name = "btnxoa" + $length;
        $xoa.innerHTML = "Xóa";
        $xoa.className = 'btn btn-danger';

        $xoa.setAttribute('onclick', 'delRowIndexCreate(this.id.replace("btnxoa",""))');
        $xoa.setAttribute('type', 'button');
        $cell7.appendChild($xoa);

        modal.querySelector("#slct").value = $length;
        calHoaDonIndexCreate();
        formatNumberInputs();
        var soluongs = modal.querySelectorAll('.soluong');
        var dongias = modal.querySelectorAll('.dongia');
        for (var i = 0; i < soluongs.length; i++) {
            soluongs[i].addEventListener('input', calHoaDonIndexCreate);
            dongias[i].addEventListener('input', calHoaDonIndexCreate);
        }
    }

    function delRowIndexCreate(x) {
        var modal = document.getElementById("createModal");
        $table = modal.querySelector("#tablechitiet");
        $length = modal.querySelector("#tablechitiet").rows.length;

        for ($i = parseInt(x); $i < $length - 1; $i++) {
            $sohang = parseInt($i);
            $sohangsau = parseInt($i) + 1;
            modal.querySelector("#noidung" + $sohang).value = modal.querySelector("#noidung" + $sohangsau).value;
            modal.querySelector("#soluong" + $sohang).value = modal.querySelector("#soluong" + $sohangsau).value;
            modal.querySelector("#donvitinh" + $sohang).value = modal.querySelector("#donvitinh" + $sohangsau).value;
            modal.querySelector("#dongia" + $sohang).value = modal.querySelector("#dongia" + $sohangsau).value;
            modal.querySelector("#thanhtien" + $sohang).value = modal.querySelector("#thanhtien" + $sohangsau).value;
        }

        $table.deleteRow($length - 1);
        modal.querySelector("#slct").value = $length - 2;
        calHoaDonIndexCreate();
    }

    function to_VNese_currency_IndexCreate() {
        var modal = document.getElementById("createModal");
        var number = modal.querySelector("#tongtiencothue").value;
        var str = parseInt(number);
        var rsString = convertNumberToCurrency(str);
        modal.querySelector("#sotienbangchu").value = rsString;
    };

    function checkSHDExistsIndexCreate() {
        var hoadontontai = document.getElementsByClassName('shdexists');
        var modal = document.getElementById("createModal");
        $shd = modal.querySelector("#inputsohoadon").value;
        modal.querySelector("#error_").setAttribute('style', 'display: none');
        modal.querySelector("#error_").innerHTML = "";
        modal.querySelector("#btnsubmithd").removeAttribute('disabled', 'true');
        for (var i = 0; i < hoadontontai.length; i++) {
            if ($shd == hoadontontai[i].id) {
                modal.querySelector("#error_").removeAttribute('style', 'display: none');
                modal.querySelector("#error_").innerHTML = "Số hóa đơn đã tồn tại, vui lòng nhập lại!";
                modal.querySelector("#btnsubmithd").setAttribute('disabled', 'true');
            }
        }
    };

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
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g,
            " ");
        str = str.replace(/  +/g, ' ');
        return str;
    }
</script>
