{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<title>Chi tiết khách hàng</title>
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
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    td {
        border-bottom: 1px solid #ddd;
    }

    .subheading {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .btn-danger {
        margin-right: 10px;
    }

    .btn-primary {
        margin-bottom: 20px;
    }

    .btn-info {
        margin: 0 auto;
    }

    .alert-danger {
        width: 375px;
        border-radius: 50%;
        padding: 10px;
        margin-bottom: 20px;
        position: relative;
    }

    .close {
        position: absolute;
        top: 5px;
        right: 5px;
        color: red;
        cursor: pointer;
    }

    .trangthai-danghoatdong {
        color: green;
    }

    .trangthai-bikhoa {
        color: red;
    }

    .trangthai-tamngunghoatdong {
        color: yellow;
    }

    .trangthai-dagiaithe {
        color: gray;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<div id="main">
    <div class="container bg-white shadow">

        <hr>
        @if (session('error'))
            <div id="alert-danger" class="alert alert-danger" style="width: 375px">
                {{ session('error') }}
                <button type="button" class="close" style="border-radius: 50% red" onclick="closeAlert()">&times;</button>
            </div>
        @endif

        <script>
            function closeAlert() {
                document.getElementById('alert-danger').style.display = 'none';
            }
        </script>

        @foreach ($khachhang as $khachhang)
            <form action="{{ route('idkhachhang.destroy', ['id' => $khachhang->KHACHHANG_ID]) }}" method="POST"
                id="xoaKH">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Xóa!
                </button>
            </form>
            <script>
                function confirmDelete() {
                    return confirm('Bạn có chắc chắn muốn xóa khách hàng?');
                }
            </script>

            <a href="/khachhang/{{ $khachhang->KHACHHANG_ID }}/edit" onclick="moveToNewPage(event)">
                <button type="button" class="btn text-white mb-2" style="background-color: #435EBE;">
                    Cập nhật Thông tin
                </button>
            </a>
            <div class="container-fluid">
                <div class="border" style="padding-left:100px; padding-right:100px">
                    <div class="mt-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png"
                                    alt="logo" width="100" height="43.25">
                            </div>
                            <div class="col text-center">
                                <h4 class="fs-2">Chi tiết Khách hàng</h4>
                            </div>
                        </div>

                        <hr style="border-top: 2px dashed black;" />
                        <div class="text-start">
                            <b>Mã khách hàng: </b><b style="color: red">{{ $khachhang->KHACHHANG_ID }}</b><br>
                            <div
                                class="@if ($khachhang->TRANGTHAI_TEN === 'Đang hoạt động') trangthai-danghoatdong @elseif ($khachhang->TRANGTHAI_TEN === 'Bị khóa') trangthai-bikhoa @elseif ($khachhang->TRANGTHAI_TEN === 'Tạm ngưng hoạt động') trangthai-tamngunghoatdong @else trangthai-dagiaithe @endif">
                                <b style="color: black">Trạng thái: </b><b>{{ $khachhang->TRANGTHAI_TEN }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col subheading">
                                <span class="form-label fw-bold">Loại:</span>
                                {{ $khachhang->LOAIKHACHHANG_TEN }}<br>
                                &nbsp;<br>
                                &nbsp;<br>
                                &nbsp;<br>
                                &nbsp;
                                <hr>
                            </div>
                            <div class="col subheading">
                                <span class="form-label fw-bold">Tên khách hàng:</span>
                                {{ $khachhang->KHACHHANG_TEN }}<br>
                                <span class="form-label fw-bold">Điện thoại:</span>
                                {{ $khachhang->KHACHHANG_SDT }}<br>
                                <span class="form-label fw-bold">Email:</span>
                                {{ $khachhang->KHACHHANG_EMAIL }}<br>
                                <span class="form-label fw-bold">Địa chỉ:</span>
                                {{ $khachhang->KHACHHANG_DIACHI }}<br>
                                <span class="form-label fw-bold">Mã số thuế:</span>
                                <b style="color: red">{{ $khachhang->KHACHHANG_MASOTHUE }}</b>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col subheading">
                                <span class="form-label fw-bold">Chủ sỡ hữu:</span>
                                {{ $khachhang->KHACHHANG_CHUSOHUU }}<br>
                                &nbsp;<br>
                                &nbsp;<br>
                                <span class="form-label fw-bold">Ngày hoạt động:</span>
                                {{ $khachhang->KHACHHANG_NGAYHOATDONG }}
                                <hr>
                            </div>
                            <div class="col subheading">
                                <span class="form-label fw-bold">Người đại diện:</span>
                                {{ $khachhang->KHACHHANG_NGUOIDAIDIEN }}<br>
                                <span class="form-label fw-bold">CMND/CCCD:</span>
                                {{ $khachhang->KHACHHANG_CMND }}<br>
                                <span class="form-label fw-bold">Ngày cấp CMND:</span>
                                {{ $khachhang->KHACHHANG_NGAYCAPCMND }}<br>
                                <span class="form-label fw-bold">Ngày sinh:</span>
                                {{ $khachhang->KHACHHANG_NGAYSINHNDD }}
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col subheading">
                                <span class="form-label fw-bold">Ngày tạo lập:</span>
                                {{ $khachhang->NGAYTAOLAP }}
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Add --}}
            <div class="modal fade" id="hopdongModal" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="hopdongModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hopdongModalLabel">Thêm hợp đồng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="/hopdong" method="POST" id="contractForm" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <label class="form-label fw-bold">Loại hợp đồng:</label>
                                        <select name="loaihopdong_id">
                                            @if (old('loaihopdong_id') == 0)
                                                <option value=1 selected>Đặt mới</option>
                                                <option value=2>Gia hạn</option>
                                            @elseif (old('loaihopdong_Id') == 1)
                                                <option value=0>Đặt mới</option>
                                                <option value=1 selected>Gia hạn</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="owner" class="form-label fw-bold">Hợp đồng số:</label>
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Nhập vào số hợp đồng" name="hopdong_so">
                                        <span class="invalid-feedback" id="hopdong_so_error"></span>
                                    </div>
                                    {{-- <label style="display: none;" for="owner" class="form-label fw-bold">Khách hàng:</label> --}}
                                    <div style="display: none;">
                                        <input type="text" class="form-control" name="khachhang_id"
                                            value="{{ $khachhang->KHACHHANG_ID }}">
                                        {{-- <select id="tenKH" name="khachhang_id" style="width: 100%;"
                                            class="js-example-placeholder-single js-states form-control form-select form-select-sm">
                                            @foreach ($khachhangs as $khachhang)
                                                <option value="{{ $khachhang->KHACHHANG_ID }}">
                                                    {{ $khachhang->KHACHHANG_TEN }}
                                                </option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col">
                                            <label for="ngaysinh" class="form-label fw-bold">Ngày ký:</label>
                                            <input type="date" class="form-control" name="hopdong_ngayky">
                                            <span class="invalid-feedback" id="hopdong_ngayky_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="cccd" class="form-label fw-bold">Ngày hiệu lực:</label>
                                            <input type="date" class="form-control" placeholder="Nhập CMND/CCCD"
                                                name="hopdong_ngayhieuluc">
                                            <span class="invalid-feedback" id="hopdong_ngayhieuluc_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="ngaycap" class="form-label fw-bold">Ngày kết thúc:</label>
                                            <input type="date" class="form-control"
                                                placeholder="Nhập số diện thoại" name="hopdong_ngayketthuc">
                                            <span class="invalid-feedback" id="hopdong_ngayketthuc_error"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col">
                                            <label for="tenkhang" class="form-label fw-bold">Tên gói thầu:</label>
                                            <input type="text" class="form-control"
                                                placeholder="Nhập tên gói thầu" name="hopdong_tengoithau">
                                            <span class="invalid-feedback" id="hopdong_tengoithau_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="diachi" class="form-label fw-bold">Dự án:</label>
                                            <input type="text" class="form-control" placeholder="Nhập dự án"
                                                name="hopdong_tenduan">
                                            <span class="invalid-feedback" id="hopdong_tenduan_error"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col">
                                            <label for="ndung" class="form-label fw-bold">Nội dung:</label>
                                            <input type="text" class="form-control" placeholder="Nhập nội dung"
                                                name="hopdong_noidung">
                                            <span class="invalid-feedback" id="hopdong_noidung_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="tgthien" class="form-label fw-bold">Thời gian thực
                                                hiện:</label>
                                            <input type="text" class="form-control"
                                                placeholder="Nhập số thời gian, ví dụ: 1 tháng, 1 năm,.."
                                                name="hopdong_thoigianthuchien">
                                            <span class="invalid-feedback" id="hopdong_thoigianthuchien_error"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col">
                                            <label for="bena" class="form-label fw-bold">Bên A:</label>
                                            <input type="text" class="form-control" placeholder="Nhập tên bên A"
                                                name="hopdong_daidienben_a">
                                            <span class="invalid-feedback" id="hopdong_daidienben_a_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="benb" class="form-label fw-bold">Bên B:</label>
                                            <input type="text" class="form-control" placeholder="Nhập tên bên B"
                                                name="hopdong_daidienben_b">
                                            <span class="invalid-feedback" id="hopdong_daidienben_b_error"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="tgtri" class="form-label fw-bold">Tổng giá trị:</label>
                                        <input type="number" class="form-control" id="email"
                                            placeholder="Nhập tổng giá trị" name="hopdong_tonggiatri">
                                        <span class="invalid-feedback" id="hopdong_tonggiatri_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="httoan" class="form-label fw-bold">Hình thức thanh toán:</label>
                                        <select name="hopdong_hinhthucthanhtoan">
                                            @if (old('hopdong_hinhthucthanhtoan') == 0)
                                                <option value="Chuyển khoản" selected>Chuyển khoản ngân hàng</option>
                                                <option value="Tiền mặt">Tiền mặt</option>
                                            @elseif (old('hopdong_hinhthucthanhtoan') == 1)
                                                <option value="Chuyển khoản">Chuyển khoản ngân hàng</option>
                                                <option value="Tiền mặt" selected>Tiền mặt</option>
                                            @endif
                                        </select>
                                        <span class="invalid-feedback" id="hopdong_hinhthucthanhtoan_error"></span>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="tthai" class="form-label fw-bold">Trạng thái:</label>
                                        <div>
                                            <select id="tenKH" name="hopdong_trangthai" style="width: 100%;"
                                                class="js-example-placeholder-single js-states form-control form-select form-select-sm">
                                                @foreach ($trangthaihopdongs as $tthdong)
                                                    <option value="{{ $tthdong->TRANGTHAI_ID }}">
                                                        {{ $tthdong->TRANGTHAI_TEN }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gchu" class="form-label fw-bold">Ghi chú:</label>
                                        <input type="text" class="form-control" id="pwd"
                                            placeholder="Điền vào ghi chú" name="hopdong_ghichu">
                                        <span class="invalid-feedback" id="hopdong_ghichu_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hdfile" class="form-label fw-bold">File hợp đồng (nếu
                                            có):</label>
                                        <input type="file" name="filehopdong" class="form-control"
                                            id="filehopdong">
                                        <span class="invalid-feedback" id="hopdong_file_error"></span>
                                    </div>
                                    <div class="mb-3 mt-3 pb-2 text-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            onclick="resetForm()">Close</button>
                                        <button type="submit" id="btnSubmit"
                                            class="btn btn-success btn-block mb-3 mt-3"><i
                                                class="fas fa-plus me-2"></i>Thêm mới</button>
                                        <button type="reset" class="btn btn-secondary btn-block mb-3 mt-3"
                                            onclick="clearForm()"><i class="fas fa-redo me-2"></i>Soạn lại</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal Add --}}
        @endforeach
        <hr>
        <h1>Danh sách Hợp đồng</h1>
        <button type="button" id="addHopDong" class="btn text-white" style="background-color: #435EBE;"
            data-bs-toggle="modal" data-bs-target="#hopdongModal">
            <i class="fas fa-plus" style="margin-right: 5px;"></i>Thêm mới
        </button>
        <hr>
        <table>
            <tr>
                <th class="text-center text-nowrap">Số Hợp đồng</th>
                <th class="text-center text-nowrap">Tên gói thầu</th>
                <th class="text-center text-nowrap">Tên dự án</th>
                <th class="text-center text-nowrap">Chi tiết hợp đồng</th>
            </tr>
            @foreach ($hopdongs as $hopdong)
                <tr>
                    <td>{{ $hopdong->HOPDONG_SO }}</td>
                    <td>{{ $hopdong->HOPDONG_TENGOITHAU }}</td>
                    <td>{{ $hopdong->HOPDONG_TENDUAN }}</td>
                    <td class="text-center text-nowrap">
                        <a href="/hopdong/{{ $hopdong->HOPDONG_SO }}">
                            <button type="button" class="btn btn-info">
                                Chi tiết
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

        <br><br><br>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#contractForm').on('submit', function(e) {
            e.preventDefault();
            $('#contractForm .textnumber').each(function() {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(value);
            });
            var formData = $(this).serialize();
            var form = $('#contractForm')[0];
            // Create an FormData object 
            var data = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: data,
                enctype: 'multipart/form-data',
                processData: false, // Important!
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
                            text: 'Hợp đồng mới đã được tạo'
                        }).then(() => {
                            $('#contractForm input').val('');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Không thể thêm hợp đồng!',
                            text: 'Hợp đồng không thể thêm mới, vui lòng kiểm tra lại thông tin'
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
                        // console.log(response);
                        // console.log(errors);
                        // console.log($('#khachhang_diachi_error'));
                        // if (errors.hasOwnProperty('khachhang_diachi')) {
                        //     var errorMessage = errors['khachhang_diachi'][0];
                        //     console.log(errorMessage);
                        //     $('#khachhang_diachi_error').text(errorMessage).show();
                        // }
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

    $('#hopdongModal').on('show.bs.modal', function(e) {
        var button = e.relatedTarget;
        var trangThaiTen = "<?php echo $khachhang->TRANGTHAI_TEN; ?>";

        if (trangThaiTen !== "Đang hoạt động") {
            e.preventDefault();
            e.stopPropagation();
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Bạn không thể thêm hợp đồng khi trạng thái khác "Đang hoạt động"'
            });
        }
    });

    $(document).ready(function() {
        $('[id^="xoaKH"]').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn sự kiện submit mặc định

            var form = $(this);

            Swal.fire({
                title: 'Xóa khách hàng {{ $khachhang->KHACHHANG_TEN }}?',
                text: "Bạn sẽ không thể khôi phục lại khách hàng này!",
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
                            if (success) {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Khách hàng {{ $khachhang->KHACHHANG_TEN }} đã được xóa',
                                    'success'
                                ).then(() => {
                                    window.location.replace('/khachhang');
                                });
                            } else {
                                Swal.fire(
                                    'Không thể xóa!',
                                    'Khách hàng {{ $khachhang->KHACHHANG_TEN }} không thể xóa. Vì có họp đồng',
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
    function moveToNewPage(event) {
        event.preventDefault();
        const newPageURL = event.target.getAttribute('href');
        window.location.replace('/khachhang/{{$khachhang->KHACHHANG_ID}}/edit');
    }
</script>