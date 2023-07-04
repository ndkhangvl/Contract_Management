<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .otp-input {
            width: 40px;
            text-align: center;
            color: red;
            border: 1px solid #ccc;
        };
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
    @include('header2')
    @include('sidebar')
<div id="main">
  <div class="container bg-white shadow">
    <form action="/khachhang/{{$khhang->KHACHHANG_ID}}" method="POST" id="cusForm">
    @csrf
    @method('PUT')
        <h1 class="text-success">Cập nhật thông tin khách hàng</h1>
          <div class="mt-3 mb-3">
            <label class="form-label fw-bold">Loại khách hàng:</label>
            <select name="loaikhachhang_id" class="form-select form-select-sm">
                @foreach ($loaikhachhang as $loai)
                @if ($loai->LOAIKHACHHANG_ID == $khhang->LOAIKHACHHANG_ID)
                <option value="{{ $loai->LOAIKHACHHANG_ID }}" selected>
                  {{ $loai->LOAIKHACHHANG_TEN }}
                </option>  
                @else
                <option value="{{ $loai->LOAIKHACHHANG_ID }}" >
                  {{ $loai->LOAIKHACHHANG_TEN }}
                </option>    
                @endif
              @endforeach                                  
            </select>
        </div>
        <div class="mt-3 mb-3">
            <label class="form-label fw-bold">Trạng thái:</label>
            <select name="khachhang_trangthai" class="form-select form-select-sm">
              @foreach ($trangthaikh as $trangthai)
                @if ($trangthai->TRANGTHAI_ID == $khhang->KHACHHANG_TRANGTHAI)
                <option value="{{ $trangthai->TRANGTHAI_ID }}" selected>
                  {{ $trangthai->TRANGTHAI_TEN }}
                </option>  
                @else
                <option value="{{ $trangthai->TRANGTHAI_ID }}" >
                {{ $trangthai->TRANGTHAI_TEN }}
                </option>    
                @endif
              @endforeach                                
            </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="owner" class="form-label fw-bold">Chủ sỡ hữu:</label>
            <input type="text" class="form-control" id="email" value="{{$khhang->KHACHHANG_CHUSOHUU}}" placeholder="Nhập vào chủ sỡ hữu" name="khachhang_chusohuu">
          </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="tenkhang" class="form-label fw-bold">Tên khách hàng:</label>
                <input type="text" class="form-control" value="{{$khhang->KHACHHANG_TEN}}"  placeholder="Nhập tên" name="khachhang_ten">
            </div>
            <div class="col">
                <label for="diachi" class="form-label fw-bold">Địa chỉ:</label>
                <input type="text" class="form-control" value="{{$khhang->KHACHHANG_DIACHI}}" placeholder="Nhập địa chỉ" name="khachhang_diachi">
            </div>
          </div>
          <div class="row mb-3 mt-3">
            <div class="col">
                <label for="sdt" class="form-label fw-bold">Số điện thoại:</label>
                <input type="text" class="form-control" value="{{$khhang->KHACHHANG_SDT}}" placeholder="Nhập số điện thoại" name="khachhang_sdt">
            </div>
            <div class="col">
                <label for="email" class="form-label fw-bold">Email:</label>
                <input type="email" class="form-control" value="{{$khhang->KHACHHANG_EMAIL}}" placeholder="Nhập email" name="khachhang_email">
            </div>
          </div>
          <div class="row mb-3 mt-3">
            <div class="col">
                <label for="ngaysinh" class="form-label fw-bold">Ngày sinh:</label>
                <input type="date" class="form-control" value="{{$khhang->KHACHHANG_NGAYSINHNDD}}" placeholder="Nhập tên" name="khachhang_ngaysinhndd">
            </div>
            <div class="col">
                <label for="cccd" class="form-label fw-bold">CCCD:</label>
                <input type="text" pattern="[0-9]+" class="form-control" value="{{$khhang->KHACHHANG_CMND}}" placeholder="Nhập số diện thoại" name="khachhang_cmnd">
            </div>
            <div class="col">
                <label for="ngaycap" class="form-label fw-bold">Ngày cấp:</label>
                <input type="date" class="form-control" value="{{$khhang->KHACHHANG_NGAYCAPCMND}}" placeholder="Nhập số diện thoại" name="khachhang_ngaycapcmnd">
            </div>
          </div>
        <div class="mb-3 mt-3">
          <label for="ngdaidien" class="form-label fw-bold">Người đại diện:</label>
          <input type="text" class="form-control" value="{{$khhang->KHACHHANG_NGUOIDAIDIEN}}" placeholder="Nhập tên người đại diện" name="khachhang_nguoidaidien">
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
                    var masothue = "{{$khhang->KHACHHANG_MASOTHUE}}";
                    var masothueStr = masothue.toString();
                    var masothueArr = masothueStr.split("");
                    console.log(masothueArr);
                    var inputs = document.getElementsByClassName("otp-input");
                    for (var i = 0; i < inputs.length; i++) {
                      if (masothueArr[i]) {
                        inputs[i].type = "text";
                        console.log(masothueArr[1]);
                        inputs[i].value = masothueArr[i];
                      }
                    }
                  </script>
                  <script>
                    var inputs = document.getElementsByClassName('otp-input');
                    for (var i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('input', function(event) {
                        var maxLength = parseInt(this.getAttribute('maxlength'));
                        var currentLength = this.value.length;

                        if (currentLength >= maxLength) {
                        var nextInput = this.nextElementSibling;
                        if (nextInput !== null) {
                            nextInput.focus();
                        }
                        }
                    });

                    inputs[i].addEventListener('keydown', function(event) {
                        if (event.key === 'Backspace') {
                        var previousInput = this.previousElementSibling;
                        if (previousInput !== null && this.value.length === 0) {
                            event.preventDefault();
                            previousInput.focus();
                            previousInput.value = '';
                        }
                        }

                        if (event.key === 'ArrowLeft') {
                        var previousInput = this.previousElementSibling;
                        if (previousInput !== null) {
                            event.preventDefault();
                            previousInput.focus();
                        }
                        }

                        if (event.key === 'ArrowRight') {
                        var nextInput = this.nextElementSibling;
                        if (nextInput !== null) {
                            event.preventDefault();
                            nextInput.focus();
                        }
                        }
                    });
                    }
                </script>
                </div>
              </div>
          </div>
        <div class="mb-3">
          <label for="ngayhdong" class="form-label fw-bold">Ngày hoạt động:</label>
          <input type="date" class="form-control" id="pwd" value="{{$khhang->KHACHHANG_NGAYHOATDONG}}" placeholder="Chọn ngày hoạt động" name="khachhang_ngayhoatdong">
        </div>
        <div class="mb-3 mt-3 pb-2">
            <button type="submit" onclick="getData()" class="btn btn-success mx-auto d-block mb-3 mt-3"><i class="fas fa-pen me-2"></i>Cập nhật</button>
        </div>
      </form>
</div>
</div>
    @include('footer')
</body>
<script>
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
</script>
<script>
    $(document).ready(function() {
    $('#cusForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var form = $('#cusForm')[0];
        var data = new FormData(form);

        Swal.fire({
            title: 'Cập nhật khách hàng {{$khhang->KHACHHANG_TEN}}?',
            text: "Thông tin khách hàng sẽ được cập nhật!",
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
                                text: 'Khách hàng {{$khhang->KHACHHANG_TEN}} đã được cập nhật'
                            }).then(() => {
                                $('#hoaDonForm input').val('');
                                //history.go(-1);
                                //location.reload();
                                window.location.replace('/khachhang/{{$khhang->KHACHHANG_ID}}');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Không thể cập nhật!',
                                text: 'Khách hàng không thể cập nhật, kiểm tra thông tin nhập vào'
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
</script>
</html>