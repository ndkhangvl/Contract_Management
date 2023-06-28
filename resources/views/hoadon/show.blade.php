<title>Chi tiết hóa đơn | {{$hoadon->HOADON_SO}}</title>

{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
table,
th,
td {
    border: 1px solid black;

}

/* .info-border {
    border: none;
    }

    .info-border .info-td {
        border-bottom: none;
    } */

th,
td {
    padding-left: 10px;
    padding-right: 10px;
}

.bodyfake {
    max-width: 900px;
    margin: auto;
    padding: 20px;
}

.contentcenter {
    text-align: center;

}

.contentright {
    text-align: right;

}

.contentleft {
    text-align: left;

}

@media print {

    .navbar-brand,
    footer,
    .notprint,
    .container,
    .nav-item,
    header {
        display: none;
    }


    #xuatpdf {
        display: block;
    }
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
    width: 70px;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@include('header2')
@include('sidebar')
<div id="main">
    <div class="container bg-white shadow">
        <!--Update hoa don modal-->
        <div class="modal fade" id="updateHoaDon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cập nhật Hoá đơn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="/updateHoaDonModal/{{ $hoadon->HOADON_ID }}" method="post"
                                enctype="multipart/form-data" id="updateHoaDonForm">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Hợp đồng:</label>
                                        <input class="form-control" type="text" name="sohopdong" required readonly>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Hóa đơn số:</label>
                                        <input class="form-control" type="text" name="sohoadon" required readonly
                                            id="inputsohoadon" oninput="this.value = this.value.toUpperCase()">
                                        <span class="invalid-feedback" id="sohoadon_error"></span>
                                        <div class="alert alert-danger" id="error_" style="display: none"></div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Người tạo:</label>
                                        <input class="form-control" required type="text" name="nguoitao">
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Người mua hàng:</label>
                                        <input class="form-control" required type="text" name="nguoimuahang">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Thuế (%):</label>
                                        <input class="form-control" id="thuesuat" required type="number" name="thuesuat"
                                            min="0">
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Tổng tiền (VNĐ):</label>
                                        <input class="form-control" required type="number" name="tongtien" id="tongtien"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Tiền thuế (VNĐ):</label>
                                        <input class="form-control" required type="number" name="tienthue" id="tienthue"
                                            readonly>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Tổng tiền có thuế (VNĐ):</label>
                                        <input class="form-control" required type="number" name="tongtiencothue"
                                            id="tongtiencothue" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Số tiền (bằng chữ):</label>
                                        <input class="form-control" required type="text" id="sotienbangchu"
                                            name="sotienbangchu" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">File hóa đơn:</label>
                                        <a href="{{asset('storage/')}}" target="_blank" id="filehoadonlink"></a>
                                    </div>
                                    <div class="col">
                                        <div id="wrapper">
                                            <label class="form-label fw-bold">Bạn có muốn cập nhật file mới
                                                không?</label>
                                            <p><input type="radio" name="fileadd_yes_no" id="radY" value="1">Có</input>
                                            </p>
                                            <p><input type="radio" name="fileadd_yes_no" id="radN" value="0"
                                                    checked>Không</input></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">File mới:</label>
                                        <input class="form-control" type="file" name="filehoadon" id="filehoadon"
                                            disabled required>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                    <label>Trạng thái hóa đơn:</label>
                                    <select name="trangthaihoadon">

                                        <option value=0 selected>Chưa thanh toán</option>
                                        <option value=1>Đã thanh toán</option>

                                    </select>
                                    <hr>
                                </div>
                                <h1>Danh sách chi tiết</h1>
                                <hr>
                                Số lượng loại sản phẩm:
                                <input class="form-control" type="number" name="soluongchitiet" min="0" id="slct"
                                    required readonly value="{{$cnt}}">
                                <hr>
                                <button class="btn btn-primary" onclick="addRowShow()" type="button">Thêm hàng</button>
                                <div class="table-responsive">
                                    <table id='tablechitiet' class="contentcenter" style=" border: 0px;">
                                        <tr>
                                            <th>STT</th>
                                            <th>Nội dung</th>
                                            <th>Số lượng</th>
                                            <th>Đơn vị tính</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                            <th>Xóa</th>
                                        </tr>
                                        @foreach ($chitiethoadon2 as $cthd)
                                        <tr>
                                            <td><input type="text" class="inputstt" name="stt{{$cthd->STT}}"
                                                    id="stt{{$cthd->STT}}" value="{{$cthd->STT}}" readonly
                                                    class="inputstt"></td>
                                            <td><input type="text" name="noidung{{$cthd->STT}}"
                                                    id="noidung{{$cthd->STT}}" value="{{$cthd->NOIDUNG}}"></td>
                                            <td><input type="number" class="soluong inputstt"
                                                    name="soluong{{$cthd->STT}}" id="soluong{{$cthd->STT}}"
                                                    value="{{$cthd->SOLUONG}}" min="0"></td>
                                            <td><input type="text" name="donvitinh{{$cthd->STT}}"
                                                    id="donvitinh{{$cthd->STT}}" value="{{$cthd->DVT}}"></td>
                                            <td><input type="number" class="dongia" name="dongia{{$cthd->STT}}"
                                                    id="dongia{{$cthd->STT}}" value="{{$cthd->DONGIA}}" min="0"></td>
                                            <td><input type="number" class="thanhtien" name="thanhtien{{$cthd->STT}}"
                                                    readonly id="thanhtien{{$cthd->STT}}" value="{{$cthd->THANHTIEN}}">
                                            </td>
                                            <td><button type="button" name="btnxoa{{$cthd->STT}}"
                                                    id="btnxoa{{$cthd->STT}}" class="btn btn-danger"
                                                    onclick="delRowShow(this.id.replace('btnxoa',''))">Xóa</button></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3 mt-3 pb-2 text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="resetForm()">Close</button>
                                    <button class="btn btn-primary" type="submit">Cập nhật hóa đơn</button>
                                </div>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal update-->
        <div class="bodyfake">
            <div class="notprint">
                <div class="contentleft">
                    {{--<button type="button" class="btn btn-primary" onclick="window.print()">Xuất hóa đơn</button>--}}
                    <a href="/hoadon/{{$hoadon->HOADON_ID}}/pdf" class="btn btn-primary">Xuất hóa đơn</a>
                </div>
                <div class="contentright">
                    {{--<a href="/hoadon/{{$hoadon->HOADON_SO}}/edit"><button type="button" class="btn btn-primary">Cập
                        nhật Thông tin</button></a>--}}
                    <a href="" class="btn btn-info btn-icon-only" aria-label="Sửa" data-bs-toggle="modal"
                        data-bs-target="#updateHoaDon" onclick="
                                    var modal = document.getElementById('updateHoaDon'); 
                                    var form = document.getElementById('updateHoaDonForm'); 
                                    
                                    hoadon_so = document.querySelector('#updateHoaDon input[name=\'sohoadon\']'); 
                                    hoadonSoData = '{{ $hoadon->HOADON_SO }}'; 
                                    hoadon_so.value = hoadonSoData;
                                    hopdong_so = document.querySelector('#updateHoaDon input[name=\'sohopdong\']'); 
                                    hopdongSoData = '{{ $hoadon->HOPDONG_SO }}'; 
                                    hopdong_so.value = hopdongSoData;
                                    filelink = document.querySelector('#updateHoaDon [id=\'filehoadonlink\']'); 
                                    filehoadonlink = '{{asset('storage/'.$hoadon->HOADON_FILE)}}';
                                    filelink.href = filehoadonlink;
                                    filelink.innerHTML = '{{$hoadon->HOADON_FILE}}';
                                    thuesuat = document.querySelector('#updateHoaDon input[name=\'thuesuat\']'); 
                                    thueSuatData = '{{ $hoadon->HOADON_THUESUAT }}'; 
                                    thuesuat.value = thueSuatData.replaceAll('.','');
                                    tongtien = document.querySelector('#updateHoaDon input[name=\'tongtien\']'); 
                                    tongtienData = '{{ $hoadon->HOADON_TONGTIEN }}'; 
                                    tongtien.value = tongtienData.replaceAll('.','');
                                    tienthue = document.querySelector('#updateHoaDon input[name=\'tienthue\']'); 
                                    tienthueData = '{{ $hoadon->HOADON_TIENTHUE }}'; 
                                    tienthue.value = tienthueData.replaceAll('.','');
                                    tongtiencothue = document.querySelector('#updateHoaDon input[name=\'tongtiencothue\']'); 
                                    tongtiencothueData = '{{ $hoadon->HOADON_TONGTIEN_COTHUE }}'; 
                                    tongtiencothue.value = tongtiencothueData.replaceAll('.','');
                                    sotienbangchu = document.querySelector('#updateHoaDon input[name=\'sotienbangchu\']'); 
                                    sotienbangchuData = '{{ $hoadon->HOADON_SOTIENBANGCHU }}'; 
                                    sotienbangchu.value = sotienbangchuData.replaceAll('.','');
                                    nguoitao = document.querySelector('#updateHoaDon input[name=\'nguoitao\']'); 
                                    nguoitaoData = '{{ $hoadon->HOADON_NGUOITAO }}'; 
                                    nguoitao.value = nguoitaoData;
                                    nguoimuahang = document.querySelector('#updateHoaDon input[name=\'nguoimuahang\']'); 
                                    nguoimuahangData = '{{ $hoadon->HOADON_NGUOIMUAHANG }}'; 
                                    nguoimuahang.value = nguoimuahangData;
                                    trangthaihoadon = document.querySelector('#updateHoaDon select[name=\'trangthaihoadon\']'); 
                                    trangthaihoadonData = '{{ $hoadon->HOADON_TRANGTHAI }}'; 
                                    trangthaihoadon.value = trangthaihoadonData;
                                    ; 
                                " title="Sửa hóa đơn">Cập nhật Thông tin
                    </a>
                    <br>
                    <form action="/hoadon/{{$hoadon->HOADON_ID}}" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
            <div class="container-fluid">
                <div class="border">
                    <div class="">
                        <div class="mt-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png"
                                        alt="logo" width="100" height="43.25">
                                </div>
                                <div class="col text-center">
                                    <h4 class="fs-2">Hóa Đơn Dịch Vụ</h4>
                                </div>
                            </div>
                        </div>
                        <hr style="border-top: 2px dashed black;" />
                        <div class="contentcenter">
                            Ngày tạo: <b>{{$hoadon->HOADON_NGAYTAO}}</b>
                        </div>
                        <div class="contentright">Số: <b
                                style="color: red; padding-right:20px">{{$hoadon->HOADON_SO}}</b></div>
                    </div>
                    <div class="col text-center">
                        @if ($hoadon->HOADON_TRANGTHAI == 1)
                        <b style="color: green">Đã thanh toán</b>
                        @else
                        <b style="color: red">Chưa thanh toán</b>
                        @endif
                    </div>
                </div>
                <div class="">
                    <table class="table mt-4 info-border border-0">
                        <tbody>
                            <tr class="notprint">
                                <td class="info-td col-4">File hóa đơn</td>
                                <td class="info-td col-8"><b><a href="{{asset('storage/'.$hoadon->HOADON_FILE)}}"
                                            target="_blank">{{$hoadon->HOADON_FILE}}</a></b></td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Khách hàng</td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_TEN}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Điện thoại</td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_SDT}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Địa chỉ</td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_DIACHI}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Hợp đồng số</td>
                                <td class="info-td col-8 fw-bold"><a
                                        href="/hopdong/{{$hoadon->HOPDONG_SO}}">{{$hoadon->HOPDONG_SO}}</a></td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Gói thầu</td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->HOPDONG_TENGOITHAU}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Dự án</td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->HOPDONG_TENDUAN}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Người tạo</td>
                                <td class="info-td col-8 fw-bold text-uppercase">{{$hoadon->HOADON_NGUOITAO}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4">Người mua hàng</td>
                                <td class="info-td col-8 fw-bold text-uppercase">{{$hoadon->HOADON_NGUOIMUAHANG}}</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap" style="color: black">STT</th>
                                    <th class="text-center text-nowrap" style="color: black">Nội dung</th>
                                    <th class="text-center text-nowrap" style="color: black">Số lượng</th>
                                    <th class="text-center text-nowrap" style="color: black">Đơn vị tính</th>
                                    <th class="text-center text-nowrap" style="color: black">Đơn giá (VNĐ)</th>
                                    <th class="text-center text-nowrap" style="color: black">Thành tiền (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chitiethoadon as $cthd)
                                <tr>
                                    <td>{{$cthd->STT}}</td>
                                    <td>{{$cthd->NOIDUNG}}</td>
                                    <td>{{$cthd->SOLUONG}}</td>
                                    <td>{{$cthd->DVT}}</td>
                                    <td>{{$cthd->DONGIA}}</td>
                                    <td>{{$cthd->THANHTIEN}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-end">Cộng tiền hàng hóa dịch vụ:</td>
                                    <td class="text-end">{{$hoadon->HOADON_TONGTIEN}} VNĐ</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">Thuế {{$hoadon->HOADON_THUESUAT}} %:</td>
                                    <td class="text-end">{{$hoadon->HOADON_TIENTHUE}} VNĐ</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">Tổng cộng tiền thanh toán:</td>
                                    <td class="text-end"><b>{{$hoadon->HOADON_TONGTIEN_COTHUE}} VNĐ</b></td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-end">Số tiền (bằng chữ):
                                        <b>{{$hoadon->HOADON_SOTIENBANGCHU}}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#updateHoaDonForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var form = $('#updateHoaDonForm')[0];
        var data = new FormData(form);

        Swal.fire({
            title: 'Cập nhật hóa đơn {{$hoadon->HOADON_SO}}?',
            text: "Thông tin hóa đơn sẽ được cập nhật!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Cập nhật',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
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

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(success) {
                        if (success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Đã cập nhật!',
                                text: 'Hóa đơn {{$hoadon->HOADON_SO}} đã được cập nhật'
                            }).then(() => {
                                $('#hoaDonForm input').val('');
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Không thể cập nhật!',
                                text: 'Hóa đơn không thể cập nhật, kiểm tra thông tin nhập vào'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Có lỗi xảy ra trong quá trình xử lý, vui lòng thực hiện lại sau'
                        });
                    }
                });
            }
        });
    });
});
$(document).ready(function() {
    $('[id^="deleteForm"]').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn sự kiện submit mặc định

        var form = $(this);

        Swal.fire({
            title: 'Xóa hóa đơn {{$hoadon->HOADON_SO}}?',
            text: "Bạn sẽ không thể khôi phục lại hóa đơn này!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
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
                // Gửi yêu cầu xóa bằng AJAX
                $.ajax({
                    url: form.attr('action'), // Sử dụng action của form làm URL
                    type: 'DELETE',
                    data: form.serialize(),
                    success: function(success) {
                        if(success){
                            Swal.fire(
                                'Đã xóa!',
                                'Hóa đơn {{$hoadon->HOADON_SO}} đã được xóa',
                                'success'
                            ).then(() => {
                                window.location.href =
                                    '/hopdong/{{$hoadon->HOPDONG_SO}}'; // Chuyển hướng về trang /

                            });
                        } else {
                            Swal.fire(
                                'Không thể xóa!',
                                'Hóa đơn {{$hoadon->HOADON_SO}} không thể xóa',
                                'error'
                            );
                        }
                        
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Lỗi!',
                            'Có lỗi xảy ra trong quá trình xử lý, vui lòng thực hiện lại sau',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
<script>
function calHoaDonShow() {
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
    to_VNese_currency_Show();
}
document.getElementById("thuesuat").addEventListener('input', calHoaDonShow);
var soluongs = document.getElementsByClassName('soluong');
var dongias = document.getElementsByClassName('dongia');
for (var i = 0; i < soluongs.length; i++) {
    soluongs[i].addEventListener('input', calHoaDonShow);
    dongias[i].addEventListener('input', calHoaDonShow);
}

function addRowShow() {
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
    $soluong.addEventListener('input', calHoaDonShow);
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
    $dongia.addEventListener('input', calHoaDonShow);
    $cell5.appendChild($dongia);

    $cell6 = $row.insertCell(5);
    $thanhtien = document.createElement('input');
    $thanhtien.readOnly = true;
    $thanhtien.type = "number";
    $thanhtien.name = "thanhtien" + $length;
    $thanhtien.id = "thanhtien" + $length;
    $cell6.appendChild($thanhtien);

    $cell7 = $row.insertCell(6);
    $xoa = document.createElement('button');
    $xoa.id = "btnxoa" + $length;
    $xoa.name = "btnxoa" + $length;
    $xoa.innerHTML = "Xóa";
    $xoa.className = 'btn btn-danger';

    $xoa.setAttribute('onclick', 'delRowShow(this.id.replace("btnxoa",""))');
    $xoa.setAttribute('type', 'button');
    $cell7.appendChild($xoa);

    document.getElementById("slct").value = $length;
    calHoaDonShow();
}

function delRowShow(x) {

    $table = document.getElementById("tablechitiet");
    $length = document.getElementById("tablechitiet").rows.length;

    for ($i = parseInt(x); $i < $length - 1; $i++) {
        $sohang = parseInt($i);
        $sohangsau = parseInt($i) + 1;
        document.getElementById("noidung" + $sohang).value = document.getElementById("noidung" + $sohangsau).value;
        document.getElementById("soluong" + $sohang).value = document.getElementById("soluong" + $sohangsau).value;
        document.getElementById("donvitinh" + $sohang).value = document.getElementById("donvitinh" + $sohangsau).value;
        document.getElementById("dongia" + $sohang).value = document.getElementById("dongia" + $sohangsau).value;
        document.getElementById("thanhtien" + $sohang).value = document.getElementById("thanhtien" + $sohangsau).value;

    }

    $table.deleteRow($length - 1);
    document.getElementById("slct").value = $length - 2;
    calHoaDonShow();
}

$radButtons = document.querySelectorAll("input[name=fileadd_yes_no]");
$radButtons.forEach(rb => rb.addEventListener("change", function() {
    //alert("Change");
    //console.log("value of rad: " + document.querySelector('input[name="fileadd_yes_no"]:checked').value);
    if (document.querySelector('input[name="fileadd_yes_no"]:checked').value == "1") {
        document.getElementById("filehoadon").removeAttribute("disabled");
        //console.log("Cho phep them file");
    } else if (document.querySelector('input[name="fileadd_yes_no"]:checked').value == "0") {
        document.getElementById("filehoadon").setAttribute("disabled", "disabled");
        //console.log("KHONG cho phep them file");
        document.getElementById('filehoadon').value = null;
    }
}));

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

function to_VNese_currency_Show() {
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
</script>
@include('footer')