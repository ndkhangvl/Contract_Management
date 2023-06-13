<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding-left: 10px;
            padding-right: 10px;
        }

        .otp-input {
            width: 40px;
            text-align: center;
            color: red;
            border: 1px solid #ccc;
        }

        .select2-container {
            max-width: 100%;
        }

        /* .select2-dropdown {
      max-width: 100%;
      overflow: auto;
    } */
        .select2-selection--single .select2-selection__rendered {
            max-width: 100%;
        }
    </style>
</head>

<body>
    @include('sidebar')
    @include('header2')
    <div id="main">

        {{-- @include('header') --}}
        <div class="container bg-white shadow rounded-1">
            {{-- <h1>Danh sách Khách Hàng</h1> --}}
            <div class="d-flex p-2">
                {{-- <div class="me-1">
                    <a href="/loaikhachhangs" class="btn text-white" style="background-color: #435EBE;">
                        <i class="fas fa-list" style="margin-right: 5px;"></i>Loại khách hàng
                    </a>
                </div> --}}
                <div class="mb-2 ms-1">
                    <button type="button" class="btn text-white" style="background-color: #435EBE;"
                        data-bs-toggle="modal" data-bs-target="#hoadonModal">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i>Thêm mới
                    </button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="hoadonModal" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="hoadonModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hoadonModalLabel">Thêm hợp đồng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="/hopdong" method="POST" id="contractForm">
                                    {{-- @if ($errors->any())
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                    @endif --}}
                                    @csrf
                                    {{-- <label for="owner" class="form-label fw-bold">Loại KH:</label>
                                    <div>
                                        <select id="loaiKH" name="loaikhachhang_id" style="width: 100%;"
                                            class="js-example-placeholder-single js-states form-control form-select form-select-sm">
                                            @foreach ($loaikhachhang as $loai)
                                                <option value="{{ $loai->LOAIKHACHHANG_ID }}">
                                                    {{ $loai->LOAIKHACHHANG_TEN }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('#loaiKH').select2({
                                                placeholder: "Chọn loại khách hàng",
                                                dropdownParent: $("#hoadonModal"),
                                                matcher: matchCustom,
                                                allowClear: true,
                                                language: {
                                                    noResults: function() {
                                                        return "Không tìm thấy kết quả";
                                                    }
                                                }
                                            });
                                        });
                                    </script> --}}
                                    <div class="mb-3 mt-3">
                                        <label for="owner" class="form-label fw-bold">Hợp đồng số:</label>
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Nhập vào số hợp đồng" name="hopdong_so">
                                        <span class="invalid-feedback" id="hopdong_so_error"></span>
                                    </div>
                                    <div>
                                        <label>Loại hợp đồng:</label>
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
                                    <label for="owner" class="form-label fw-bold">Khách hàng:</label>
                                    <div>
                                        <select id="tenKH" name="khachhang_id" style="width: 100%;"
                                            class="js-example-placeholder-single js-states form-control form-select form-select-sm">
                                            @foreach ($khachhangs as $khachhang)
                                                <option value="{{ $khachhang->KHACHHANG_ID }}">
                                                    {{ $khachhang->KHACHHANG_TEN }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col">
                                            <label for="ngaysinh" class="form-label fw-bold">Ngày ký:</label>
                                            <input type="date" class="form-control"
                                                name="hopdong_ngayky">
                                            <span class="invalid-feedback" id="hopdong_ngayky_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="cccd" class="form-label fw-bold">Ngày hiệu lực:</label>
                                            <input type="date" class="form-control"
                                                placeholder="Nhập CMND/CCCD" name="hopdong_ngayhieuluc">
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
                                            <input type="text" class="form-control" placeholder="Nhập tên gói thầu"
                                                name="hopdong_tengoithau">
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
                                            <label for="sdt" class="form-label fw-bold">Nội dung:</label>
                                            <input type="text" class="form-control" placeholder="Nội dung"
                                                name="hopdong_noidung">
                                            <span class="invalid-feedback" id="hopdong_noidung_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="email" class="form-label fw-bold">Thời gian thực hiện:</label>
                                            <input type="text" class="form-control" placeholder="Nhập số thời gian"
                                                name="hopdong_thoigianthuchien">
                                            <span class="invalid-feedback" id="hopdong_thoigianthuchien_error"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col">
                                            <label for="ngaysinh" class="form-label fw-bold">Bên A:</label>
                                            <input type="text" class="form-control" placeholder="Nhập tên bên A"
                                                name="hopdong_daidienben_a">
                                            <span class="invalid-feedback" id="hopdong_daidienben_a_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="cccd" class="form-label fw-bold">Bên B:</label>
                                            <input type="text" class="form-control" placeholder="Nhập tên bên B"
                                                placeholder="Nhập CMND/CCCD" name="hopdong_daidienben_b">
                                            <span class="invalid-feedback" id="hopdong_daidienben_b_error"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="ngdaidien" class="form-label fw-bold">Tổng giá trị:</label>
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Nhập tổng giá trị" name="hopdong_tonggiatri">
                                        <span class="invalid-feedback" id="hopdong_tonggiatri_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ngayhdong" class="form-label fw-bold">Hình thức thanh toán:</label>
                                        <select name="hopdong_hinhthucthanhtoan">
                                            @if (old('hopdong_hinhthucthanhtoan') == 0)
                                                <option value="Chuyển khoản" selected>Chuyển khoản ngân hàng</option>
                                                <option value="Tiền mặt">Tiền mặt</option>
                                            @elseif (old('hopdong_hinhthucthanhtoan') == 1)
                                                <option value="Chuyển khoản">Chuyển khoản ngân hàng</option>
                                                <option value="Tiền mặt" selected>Tiền mặt</option>
                                            @endif
                                        </select>
                                        {{-- <input type="text" class="form-control" id="pwd"
                                            placeholder="Nhập hình thức thanh toán" name="hopdong_hinhthucthanhtoan"> --}}
                                        <span class="invalid-feedback" id="hopdong_hinhthucthanhtoan_error"></span>
                                    </div>
                                    <label for="owner" class="form-label fw-bold">Trạng thái:</label>
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
                                    <div class="mb-3">
                                        <label for="ngayhdong" class="form-label fw-bold">Ghi chú:</label>
                                        <input type="text" class="form-control" id="pwd"
                                            placeholder="Chọn ngày hoạt động" name="hopdong_ghichu">
                                        <span class="invalid-feedback" id="hopdong_ghichu_error"></span>
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
                        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" onclick="getData()" class="btn btn-success btn-block mb-3 mt-3"><i class="fas fa-plus me-2"></i>Thêm mới</button>
            <button type="reset" class="btn btn-secondary btn-block mb-3 mt-3"><i class="fas fa-redo me-2"></i>Soạn lại</button>
        </div> --}}
                    </div>
                </div>
            </div>
            {{-- <a href="/khachhang/create">
    <button  type="button" class="btn btn-primary">
        Thêm mới
    </button>
</a> --}}

            <hr />
            <div class="table-responsive">
                <table class="table table-auto table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center text-nowrap">ID</th>
                            <th class="text-center text-nowrap">HĐ số</th>
                            <th class="text-center text-nowrap">Ngày ký</th>
                            <th class="text-center text-nowrap">Ngày hiệu lực</th>
                            <th class="text-center text-nowrap">Tên gói thầu</th>
                            <th class="text-center text-nowrap">Tên dự án</th>
                            <th class="text-center text-nowrap">Nội dung</th>
                            <th class="text-center text-nowrap">Đại diện bên A</th>
                            <th class="text-center text-nowrap">Đại diện bên B</th>
                            <th class="text-center text-nowrap">Thời gian thực hiện</th>
                            <th class="text-center text-nowrap">Tổng giá trị</th>
                            <th class="text-center text-nowrap">Hình thức thanh toán</th>
                            <th class="text-center text-nowrap">File</th>
                            <th class="text-center text-nowrap">Ghi chú</th>
                            <th class="text-center text-nowrap">Người lập</th>
                            <th class="text-center text-nowrap">Trạng thái hợp đồng</th>
                            <th class="text-center text-nowrap">Xem chi tiết</th>
                        </tr>
                    </thead>
                    @foreach ($hopdongs as $hopdong)
                        <tr>
                            <td class="text-center align-middle" style="width: 5%;">{{ $hopdong->HOPDONG_ID }}</td>
                            <td class="align-middle text-truncate" style="max-width: 100px">
                                {{ $hopdong->HOPDONG_SO }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_NGAYKY }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_NGAYHIEULUC }}</td>
                            <td class="w-auto text-truncate" style="max-width: 100px;">{{ $hopdong->HOPDONG_TENGOITHAU }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_TENDUAN }}</td>
                            <td class="align-middle text-truncate" style="max-width: 250px;">{{ $hopdong->HOPDONG_NOIDUNG }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_DAIDIENBEN_A }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_DAIDIENBEN_B }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_THOIGIANTHUCHIEN }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_TONGGIATRI }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_HINHTHUCTHANHTOAN }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_FILE }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_GHICHU }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->ten_nd }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->TRANGTHAI_TEN }}</td>
                            <td class="text-center w-auto">
                                <a href="/hopdong/{{ $hopdong->HOPDONG_SO }}">
                                    <button type="button" class="btn btn-info">
                                        Chi tiết
                                    </button>
                                </a>
                            </td>
                            {{-- <td
                                class="@if ($khachhang->TRANGTHAI_TEN == 'Đang hoạt động') text-success @elseif($khachhang->TRANGTHAI_TEN == 'Bị khóa') text-danger @elseif($khachhang->TRANGTHAI_TEN == 'Tạm ngưng hoạt động') text-warning @elseif($khachhang->TRANGTHAI_TEN == 'Đã giải thể') text-gray-500 @endif fw-bold text-nowrap text-center w-auto">
                                {{ $khachhang->TRANGTHAI_TEN }}</td> --}}
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#contractForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(success) {
                        if (success) {
                            alert('Thêm mới hợp đồng thành công');
                            $('#contractForm input').val('');
                            location.reload();
                        } else {
                            alert('Thất bại');
                        }
                    },
                    error: function(xhr) {
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
    </script>
    <script>

        function matchCustom(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }

            var txtSelect = removeVietnameseTones(params.term.toLowerCase());
            var txtDataSelect = removeVietnameseTones(data.text.toLowerCase());

            if (txtDataSelect.indexOf(txtSelect) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (phù hợp)';
                return modifiedData;
            }

            return null;
        }


        function resetForm() {
            $('#cusForm')[0].reset();
            $('.invalid-feedback').empty();
        }

        function clearForm() {
            $('.invalid-feedback').empty();
        }
        window.addEventListener('DOMContentLoaded', (event) => {
            var w = window.innerWidth;
            if (w < 1200) {
                document.getElementById('sidebar').classList.remove('active');
            }
        });
        window.addEventListener('resize', (event) => {
            var w = window.innerWidth;
            if (w < 1200) {
                document.getElementById('sidebar').classList.remove('active');
            } else {
                document.getElementById('sidebar').classList.add('active');
            }
        });
        document.querySelector('.burger-btn').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        })
        document.querySelector('.sidebar-hide').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');

        })
    </script>
@include('footer')
</body>
</html>
