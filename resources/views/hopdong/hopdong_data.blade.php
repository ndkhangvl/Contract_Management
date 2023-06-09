@if ($hopdongs->isEmpty())
    <tr>
        <td colspan="8" class="text-center align-middle">Không tìm thấy kết quả</td>
    </tr>
@else
    @foreach ($hopdongs as $hopdong)
        <tr>
            <td class="text-center align-middle" style="width: 5%;">{{ $hopdong->HOPDONG_ID }}
            </td>
            <td class="align-middle text-truncate" style="max-width: 100px">
                {{ $hopdong->HOPDONG_SO }}</td>
            <td class="w-auto text-truncate">{{ date('d-m-Y', strtotime($hopdong->HOPDONG_NGAYKY)) }}</td>
            <td class="w-auto text-truncate">{{ date('d-m-Y', strtotime($hopdong->HOPDONG_NGAYHIEULUC)) }}</td>
            {{-- <td class="w-auto text-truncate" style="max-width: 100px;">
                                    {{ $hopdong->HOPDONG_TENGOITHAU }}</td> --}}
            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_TENDUAN }}</td>
            {{-- <td class="align-middle text-truncate" style="max-width: 250px;">
                                {{ $hopdong->HOPDONG_NOIDUNG }}</td> --}}
            {{-- <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_DAIDIENBEN_A }}</td>
                            <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_DAIDIENBEN_B }}</td> --}}
            {{-- <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_THOIGIANTHUCHIEN }}</td> --}}
            <td class="w-auto text-truncate"><span data-format="number">{{ $hopdong->HOPDONG_TONGGIATRI }}</span> VNĐ
            </td>
            {{-- <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_HINHTHUCTHANHTOAN }}</td> --}}
            {{-- <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_FILE }}</td> --}}
            {{-- <td class="w-auto text-truncate">{{ $hopdong->HOPDONG_GHICHU }}</td> --}}
            <td class="w-auto text-truncate">{{ $hopdong->ten_nd }}</td>
            {{-- <td class="w-auto text-truncate">{{ $hopdong->TRANGTHAI_TEN }}</td> --}}
            <td class="w-auto">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/hopdong/{{ $hopdong->HOPDONG_SO }}" class="btn btn-success btn-icon-only"
                        aria-label="Xem chi tiết" title="Xem chi tiết"><i class="fas fa-file-signature"
                            style="color: #000000;"></i></a>
                    <a href="" data-id="{{ $hopdong->HOPDONG_SO }}" class="btn btn-info btn-icon-only"
                        aria-label="Sửa" data-bs-toggle="modal" data-bs-target="#updateHopDong"
                        onclick="
                                            var form = document.getElementById('contractUpdateForm');
                                            form.action = '/updateHopDong/{{ $hopdong->HOPDONG_ID }}';"
                        {{-- onclick="updateContract('{{ $hopdong->HOPDONG_SO }}',
                                            '{{ $hopdong->LOAIHOPDONG_ID }}',
                                            '{{ $hopdong->HOPDONG_SO }}',
                                            '{{ $hopdong->KHACHHANG_ID }}',
                                            '{{ $hopdong->HOPDONG_NGAYKY }}',
                                            '{{ $hopdong->HOPDONG_NGAYHIEULUC }}',
                                            '{{ $hopdong->HOPDONG_NGAYKETTHUC }}',
                                            '{{ $hopdong->HOPDONG_TENGOITHAU }}',
                                            '{{ $hopdong->HOPDONG_TENDUAN }}',
                                            '{{ $hopdong->HOPDONG_NOIDUNG }}',
                                            '{{ $hopdong->HOPDONG_THOIGIANTHUCHIEN }}',
                                            '{{ $hopdong->HOPDONG_DAIDIENBEN_A }}',
                                            '{{ $hopdong->HOPDONG_DAIDIENBEN_B }}',
                                            '{{ $hopdong->HOPDONG_TONGGIATRI }}',
                                            '{{ $hopdong->HOPDONG_HINHTHUCTHANHTOAN }}',
                                            '{{ $hopdong->HOPDONG_TRANGTHAI }}',
                                            '{{ $hopdong->HOPDONG_GHICHU }}',
                                            '{{ $hopdong->HOPDONG_FILE }}')" --}} title="Sửa hợp đồng"><i class="fas fa-edit"></i></a>
                    <!-- Modal 2 -->
                    <div class="modal fade" id="updateHopDong" data-bs-backdrop="static" data-bs-keyboard="false"
                        aria-labelledby="updateHopDong" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateHopDongLabel">Cập nhật hợp
                                        đồng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <form action="#" method="POST" id="contractUpdateForm"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <label class="form-label fw-bold">Loại hợp
                                                    đồng:</label>
                                                <select name="loaihopdong_id" value="">
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
                                            <label for="owner" class="form-label fw-bold">Khách
                                                hàng:</label>
                                            <div>
                                                <select id="tenKH" name="khachhang_id" style="width: 100%;"
                                                    class="js-example-placeholder-single js-states form-control form-select form-select-sm">
                                                    @foreach ($khachhangs as $khachhang)
                                                        <option value="{{ $khachhang->KHACHHANG_ID }}">
                                                            {{ $khachhang->KHACHHANG_TEN }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <script src="{{ asset('js/select2_all.js') }}"></script>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#tenKH').select2({
                                                            placeholder: "Chọn tên khách hàng",
                                                            dropdownParent: $("#hoadonModalLabel"),
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
                                            </div>
                                            <div class="row mb-3 mt-3">
                                                <div class="col">
                                                    <label for="ngaysinh" class="form-label fw-bold">Ngày ký:</label>
                                                    <input type="date" class="form-control" name="hopdong_ngayky">
                                                    <span class="invalid-feedback" id="hopdong_ngayky_error"></span>
                                                </div>
                                                <div class="col">
                                                    <label for="cccd" class="form-label fw-bold">Ngày hiệu
                                                        lực:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Nhập CMND/CCCD" name="hopdong_ngayhieuluc">
                                                    <span class="invalid-feedback"
                                                        id="hopdong_ngayhieuluc_error"></span>
                                                </div>
                                                <div class="col">
                                                    <label for="ngaycap" class="form-label fw-bold">Ngày kết
                                                        thúc:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Nhập số diện thoại" name="hopdong_ngayketthuc">
                                                    <span class="invalid-feedback"
                                                        id="hopdong_ngayketthuc_error"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mt-3">
                                                <div class="col">
                                                    <label for="bena" class="form-label fw-bold">Bên A:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập tên bên A" name="hopdong_daidienben_a">
                                                    <span class="invalid-feedback"
                                                        id="hopdong_daidienben_a_error"></span>
                                                </div>
                                                <div class="col">
                                                    <label for="benb" class="form-label fw-bold">Bên B:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập tên bên B" name="hopdong_daidienben_b">
                                                    <span class="invalid-feedback"
                                                        id="hopdong_daidienben_b_error"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mt-3">
                                                <div class="col">
                                                    <label for="tenkhang" class="form-label fw-bold">Tên gói
                                                        thầu:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập tên gói thầu" name="hopdong_tengoithau">
                                                    <span class="invalid-feedback"
                                                        id="hopdong_tengoithau_error"></span>
                                                </div>
                                                <div class="col">
                                                    <label for="diachi" class="form-label fw-bold">Dự án:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập dự án" name="hopdong_tenduan">
                                                    <span class="invalid-feedback" id="hopdong_tenduan_error"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mt-3">
                                                <div class="col">
                                                    <label for="ndung" class="form-label fw-bold">Nội
                                                        dung:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập nội dung" name="hopdong_noidung">
                                                    <span class="invalid-feedback" id="hopdong_noidung_error"></span>
                                                </div>
                                                <div class="col">
                                                    <label for="tgthien" class="form-label fw-bold">Thời gian thực
                                                        hiện:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập số thời gian, ví dụ: 1 tháng, 1 năm,.."
                                                        name="hopdong_thoigianthuchien">
                                                    <span class="invalid-feedback"
                                                        id="hopdong_thoigianthuchien_error"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="tgtri1" class="form-label fw-bold">Tổng giá
                                                    trị:</label>
                                                <input type="text" class="form-control textnumber" id="tgtri"
                                                    placeholder="Nhập tổng giá trị" name="hopdong_tonggiatri">
                                                <span class="invalid-feedback" id="hopdong_tonggiatri_error"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="httoan" class="form-label fw-bold">Hình thức thanh
                                                    toán:</label>
                                                <select name="hopdong_hinhthucthanhtoan">
                                                    @if (old('hopdong_hinhthucthanhtoan') == 0)
                                                        <option value="Chuyển khoản" selected>
                                                            Chuyển khoản ngân hàng</option>
                                                        <option value="Tiền mặt">Tiền mặt</option>
                                                    @elseif (old('hopdong_hinhthucthanhtoan') == 1)
                                                        <option value="Chuyển khoản">Chuyển khoản
                                                            ngân hàng</option>
                                                        <option value="Tiền mặt" selected>Tiền mặt
                                                        </option>
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback"
                                                    id="hopdong_hinhthucthanhtoan_error"></span>
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="tthai" class="form-label fw-bold">Trạng thái:</label>
                                                <div>
                                                    <select id="tenKH" name="hopdong_trangthai"
                                                        style="width: 100%;"
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
                                                <input type="text" class="form-control"
                                                    placeholder="Điền vào ghi chú" name="hopdong_ghichu">
                                                <span class="invalid-feedback" id="hopdong_ghichu_error"></span>
                                            </div>
                                            <div class="row mb-3 mt-3">
                                                <div class="col">
                                                    <label class="form-label fw-bold">File hợp
                                                        đồng:</label>
                                                    <a href="" target="_blank" id="filehdlink"></a>
                                                </div>
                                                <div class="col">
                                                    <div id="wrapper">
                                                        <label class="form-label fw-bold">Bạn có
                                                            muốn cập nhật file mới không?</label>
                                                        <p><input type="radio" name="fileadd_yes_no" id="radY"
                                                                value="1">Có</input></p>
                                                        <p><input type="radio" name="fileadd_yes_no" id="radN"
                                                                value="0" checked>Không</input></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <label for="hdfile" class="form-label fw-bold">File
                                                hợp đồng (nếu
                                                có):</label>
                                            <input type="file" name="filehopdong" class="form-control"
                                                id="filehopdong">
                                            <span class="invalid-feedback" id="hopdong_file_error"></span>

                                            <div class="mb-3 mt-3 pb-2 text-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal" onclick="resetForm()">Close</button>
                                                <button type="submit" id="btnSubmit"
                                                    class="btn btn-success btn-block mb-3 mt-3"><i
                                                        class="fas fa-plus me-2"></i>Chỉnh
                                                    sửa</button>
                                                <button type="reset" class="btn btn-secondary btn-block mb-3 mt-3"
                                                    onclick="clearForm()"><i class="fas fa-redo me-2"></i>Soạn
                                                    lại</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="deleteForm-{{ $hopdong->HOPDONG_ID }}"
                        action="/hopdong/delete/{{ $hopdong->HOPDONG_ID }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" id="submitDel" class="btn btn-warning btn-icon-only">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    {{-- <a onclick="event.preventDefault(); document.getElementById('deleteForm').submit();" class="btn btn-warning btn-icon-only" aria-label="Xóa" title="Xóa hợp đồng"><i class="fas fa-trash"></i></a> --}}
                </div>
            </td>
            {{-- <td
                                class="@if ($khachhang->TRANGTHAI_TEN == 'Đang hoạt động') text-success @elseif($khachhang->TRANGTHAI_TEN == 'Bị khóa') text-danger @elseif($khachhang->TRANGTHAI_TEN == 'Tạm ngưng hoạt động') text-warning @elseif($khachhang->TRANGTHAI_TEN == 'Đã giải thể') text-gray-500 @endif fw-bold text-nowrap text-center w-auto">
                                {{ $khachhang->TRANGTHAI_TEN }}</td> --}}
        </tr>
    @endforeach
<tr class="bg-white">
    <td class="align-middle" colspan="8">
        <div class="d-flex justify-content-center">
            {{ $hopdongs->links() }}
        </div>
    </td>
</tr>
@endif
<script>
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

    window.addEventListener('DOMContentLoaded', function() {
        formatNumberInputs();
    });

    $(document).ready(function() {
        $('[id^="deleteForm"]').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formId = form.attr('id');
            var itemId = formId.replace('deleteForm-', '');
            Swal.fire({
                title: 'Xóa hợp đồng ' + itemId + "?",
                text: "Bạn sẽ không thể khôi phục lại hợp đồng này!",
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
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: form.serialize(),
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Hợp đồng ' + itemId + ' đã được xóa',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Không thể xóa!',
                                    'Hợp đồng ' + itemId + ' không thể xóa',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
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

    $(document).ready(function() {
        $('#contractUpdateForm').on('submit', function(e) {
            e.preventDefault();
            $('#contractUpdateForm .textnumber').each(function() {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(value);
            });
            var formData = $(this).serialize();
            var form = $('#contractUpdateForm')[0];
            // Create an FormData object 
            var data = new FormData(form);
            Swal.fire({
                title: 'Cập nhật hợp đồng?',
                text: "Thông tin hợp đồng sẽ được cập nhật!",
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
                                    title: 'Đã cập nhật!',
                                    text: 'Hợp đồng cập nhật thành công'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Không thể cập nhật hợp đồng!',
                                    text: 'Đã xảy ra lỗi, vui lòng kiểm tra lại.'
                                });
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
                                        $('#' + field + '_error').text(errorMessage)
                                            .show();
                                    }
                                }
                            }
                        }
                    });
                }
            });
        });
    });

    $('#updateHopDong').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var itemId = button.data('id');

        hopdong_so = document.querySelector('#updateHopDong input[name="hopdong_so"]');
        tenKH = document.querySelector('#updateHopDong select[name="khachhang_id"]');
        selectLoaiHopDong = document.querySelector('#updateHopDong select[name="loaihopdong_id"]');
        selectKH = document.querySelector('#updateHopDong select[name="khachhang_id"]');
        ngayky = document.querySelector('#updateHopDong input[name="hopdong_ngayky"]');
        ngayhieuluc = document.querySelector('#updateHopDong input[name="hopdong_ngayhieuluc"]');
        ngaykthuc = document.querySelector('#updateHopDong input[name="hopdong_ngayketthuc"]');
        tengoithau = document.querySelector('#updateHopDong input[name="hopdong_tengoithau"]');
        duan = document.querySelector('#updateHopDong input[name="hopdong_tenduan"]');
        noidung = document.querySelector('#updateHopDong input[name="hopdong_noidung"]');
        thoigianthuchien = document.querySelector('#updateHopDong input[name="hopdong_thoigianthuchien"]');
        ddiena = document.querySelector('#updateHopDong input[name="hopdong_daidienben_a"]');
        ddienb = document.querySelector('#updateHopDong input[name="hopdong_daidienben_b"]');
        tgiatri = document.querySelector('#updateHopDong input[name="hopdong_tonggiatri"]');
        htttoan = document.querySelector('#updateHopDong select[name="hopdong_hinhthucthanhtoan"');
        tthai = document.querySelector('#updateHopDong select[name="hopdong_trangthai"]');
        gchu = document.querySelector('#updateHopDong input[name="hopdong_ghichu"]');
        filehdlink = document.querySelector('#updateHopDong [id="filehdlink"]');

        $.ajax({
            url: '/gethopdong/' + itemId,
            type: 'GET',
            success: function(response) {
                console.log(response);
                var hopdong = response.hopdong;
                selectLoaiHopDong.value = hopdong.LOAIHOPDONG_ID;
                hopdong_so.value = hopdong.HOPDONG_SO;
                selectKH.value = hopdong.KHACHHANG_ID;
                ngayky.value = hopdong.HOPDONG_NGAYKY;
                ngayhieuluc.value = hopdong.HOPDONG_NGAYHIEULUC;
                ngaykthuc.value = hopdong.HOPDONG_NGAYKETTHUC;
                tengoithau.value = hopdong.HOPDONG_TENGOITHAU;
                duan.value = hopdong.HOPDONG_TENDUAN;
                noidung.value = hopdong.HOPDONG_NOIDUNG;
                thoigianthuchien.value = hopdong.HOPDONG_THOIGIANTHUCHIEN;
                ddiena.value = hopdong.HOPDONG_DAIDIENBEN_A;
                ddienb.value = hopdong.HOPDONG_DAIDIENBEN_B;
                tgiatri.value = hopdong.HOPDONG_TONGGIATRI;
                htttoan.value = hopdong.HOPDONG_HINHTHUCTHANHTOAN;
                tthai.value = hopdong.HOPDONG_TRANGTHAI;
                gchu.value = hopdong.HOPDONG_GHICHU;
                console.log(hopdong.HOPDONG_FILE);
                filehdlink.href = '{{ asset('storage/') }}' + "/" + hopdong.HOPDONG_FILE;
                filehdlink.innerHTML = hopdong.HOPDONG_FILE;
            }
        })
    });
</script>
