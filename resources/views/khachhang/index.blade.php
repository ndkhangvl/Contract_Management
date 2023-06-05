<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Khách hàng</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
  <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
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
@include('header2')
@include('header')
<div class="container">
    <h1>Danh sách Khách Hàng</h1>
<a href="/loaikhachhangs">
    <button type="button" class="btn btn-info">
        Loại khách hàng
    </button>
</a>
<div class="mb-2">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Thêm mới</button>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Thêm mới khách hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form action="/khachhang" method="POST" id="cusForm">
                    {{-- @if ($errors->any())
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                    @endif --}}
                @csrf
                <label for="owner" class="form-label fw-bold">Loại KH:</label>
                      <div>
                        <select id="loaiKH" name="loaikhachhang_id" style="width: 100%;" class="js-example-placeholder-single js-states form-control form-select form-select-sm">
                          {{-- <option value="" disabled selected> -- Chọn loại khách hàng  -- </option> --}}
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
                          dropdownParent: $("#staticBackdrop"),
                          matcher: matchCustom,
                          allowClear: true
                        });
                      });
                      </script>
                    <div class="mb-3 mt-3">
                        <label for="owner" class="form-label fw-bold">Chủ sỡ hữu:</label>
                        <input type="text" class="form-control" id="email" placeholder="Nhập vào chủ sỡ hữu" name="khachhang_chusohuu" >
                        <span class="invalid-feedback" id="khachhang_chusohuu_error"></span>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="tenkhang" class="form-label fw-bold">Tên khách hàng:</label>
                            <input type="text" class="form-control" placeholder="Nhập tên" name="khachhang_ten">
                            <span class="invalid-feedback" id="khachhang_ten_error"></span>
                        </div>
                        <div class="col">
                            <label for="diachi" class="form-label fw-bold">Địa chỉ:</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="khachhang_diachi">
                            <span class="invalid-feedback" id="khachhang_diachi_error"></span>
                        </div>
                      </div>
                      <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="sdt" class="form-label fw-bold">Số điện thoại:</label>
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="khachhang_sdt">
                            <span class="invalid-feedback" id="khachhang_sdt_error"></span>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label fw-bold">Email:</label>
                            <input type="email" class="form-control" placeholder="Nhập email" name="khachhang_email">
                            <span class="invalid-feedback" id="khachhang_email_error"></span>
                        </div>
                      </div>
                      <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="ngaysinh" class="form-label fw-bold">Ngày sinh:</label>
                            <input type="date" class="form-control" placeholder="Nhập tên" name="khachhang_ngaysinhndd">
                            <span class="invalid-feedback" id="khachhang_ngaysinhdd_error"></span>
                        </div>
                        <div class="col">
                            <label for="cccd" class="form-label fw-bold">CCCD:</label>
                            <input type="text" pattern="[0-9]+" class="form-control" placeholder="Nhập CMND/CCCD" name="khachhang_cmnd">
                            <span class="invalid-feedback" id="khachhang_cmnd_error"></span>
                        </div>
                        <div class="col">
                            <label for="ngaycap" class="form-label fw-bold">Ngày cấp:</label>
                            <input type="date" class="form-control" placeholder="Nhập số diện thoại" name="khachhang_ngaycapcmnd">
                            <span class="invalid-feedback" id="khachhang_ngaycapcmnd_error"></span>
                        </div>
                      </div>
                    <div class="mb-3 mt-3">
                      <label for="ngdaidien" class="form-label fw-bold">Người đại diện:</label>
                      <input type="text" class="form-control" id="email" placeholder="Nhập tên người đại diện" name="khachhang_nguoidaidien">
                      <span class="invalid-feedback" id="khachhang_nguoidaidien_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="masothue" class="form-label fw-bold">Mã số thuế:</label>
                        <div class="row justify-content-left">
                            <div class="col-auto">
                              <div class="input-group" id="otp-input-group">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                                <input type="text" class="otp-input" maxlength="1">
                              </div>
                              <script>
                                var inputs = document.getElementsByClassName('otp-input');
                                for (var i = 0; i < inputs.length; i++) {
                                  inputs[i].addEventListener('input', function() {
                                    var maxLength = parseInt(this.getAttribute('maxlength'));
                                    var currentLength = this.value.length;
                              
                                    if (currentLength >= maxLength) {
                                      var nextInput = this.nextElementSibling;
                                      if (nextInput !== null) {
                                        nextInput.focus();
                                      }
                                    }
                                  });
                                }
                              </script>
                            </div>
                          </div>
                          <span class="invalid-feedback" id="khachhang_masothue_error"></span>
                      </div>
                    <div class="mb-3">
                      <label for="ngayhdong" class="form-label fw-bold">Ngày hoạt động:</label>
                      <input type="date" class="form-control" id="pwd" placeholder="Chọn ngày hoạt động" name="khachhang_ngayhoatdong">
                      <span class="invalid-feedback" id="khachhang_ngayhoatdong_error"></span>
                    </div>
                    <div class="mb-3 mt-3 pb-2 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetForm()">Close</button>
                        <button type="submit" id="btnSubmit" onclick="getData()" class="btn btn-success btn-block mb-3 mt-3"><i class="fas fa-plus me-2"></i>Thêm mới</button>
                        <button type="reset" class="btn btn-secondary btn-block mb-3 mt-3" onclick="clearForm()"><i class="fas fa-redo me-2"></i>Soạn lại</button>
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

<hr/>
<div class="table-responsive">
    <table class="table table-auto table-striped table-hover">
        <thead>
        <tr>
            <th class="text-center text-nowrap">Mã KH</th>
            <th class="text-center text-nowrap">Loại KH</th>
            <th class="text-center text-nowrap">Tên</th>
            <th class="text-center text-nowrap">Địa chỉ</th>
            <th class="text-center text-nowrap">Số Điện thoại</th>
            <th class="text-center text-nowrap">Email</th>
            <th class="text-center text-nowrap">Xem chi tiết</th>
            <th class="text-center text-nowrap">Trạng thái</th>
        </tr>
        </thead>
        @foreach ($khachhangs as $khachhang)
        
            <tr>
                <td class="text-center align-middle w-auto">{{ $khachhang->KHACHHANG_ID }}</td>
                <td class="align-middle text-truncate" style="max-width: 250px;">{{ $khachhang->LOAIKHACHHANG_TEN }}</td>
                <td class="w-auto">{{ $khachhang->KHACHHANG_TEN }}</td>
                <td class="w-auto">{{ $khachhang->KHACHHANG_DIACHI }}</td>
                <td class="w-auto">{{ $khachhang->KHACHHANG_SDT }}</td>
                <td class="w-auto">{{ $khachhang->KHACHHANG_EMAIL }}</td>
                <td class="text-center w-auto">
                    <a href="/khachhang/{{$khachhang->KHACHHANG_ID}}">
                        <button type="button" class="btn btn-info">
                            Chi tiết
                        </button>
                    </a>
                </td>
                <td class="@if($khachhang->TRANGTHAI_TEN == 'Đang hoạt động') text-success @elseif($khachhang->TRANGTHAI_TEN == 'Bị khóa') text-danger @elseif($khachhang->TRANGTHAI_TEN == 'Tạm ngưng hoạt động') text-warning @elseif($khachhang->TRANGTHAI_TEN == 'Đã giải thể') text-gray-500 @endif fw-bold text-nowrap text-center w-auto">{{ $khachhang->TRANGTHAI_TEN }}</td>
            </tr>
        
        @endforeach
    </table>
</div>
</div>
@include('footer')
<script>
  $(document).ready(function () {
     $('#cusForm').on('submit', function (e) {
         e.preventDefault();
         var formData = $(this).serialize();
         $.ajax({
             url: $(this).attr('action'),
             type: 'POST',
             data: formData,
             success: function (success) {
                 if (success) {
                  alert('Thêm mới khách hàng thành công');
                  $('#cusForm input').val('');
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

    if (typeof data.text === 'undefined') {
      return null;
    }

    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';

      return modifiedData;
    }

    return null;
  }
    function getData() {
      var inputGroup = document.getElementById('otp-input-group');
      var inputs = inputGroup.getElementsByClassName('otp-input');
      var value = '';
      for (var i = 0; i < inputs.length; i++) {
            value += inputs[i].value;
          }
        console.log(value);
        var targetInput = document.createElement('input');
        targetInput.type = 'hidden';
        targetInput.name = 'khachhang_masothue';
        targetInput.value = value;
        var form = document.getElementById('cusForm');
          form.appendChild(targetInput);
          //form.submit();
    }
    function resetForm() {
      $('#cusForm')[0].reset();
      $('.invalid-feedback').empty();
    }
    function clearForm() {
      $('.invalid-feedback').empty();
    }
</script>
</body>
</html>