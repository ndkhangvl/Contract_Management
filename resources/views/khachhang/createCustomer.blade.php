<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .otp-input {
            width: 40px;
            text-align: center;
            color: red;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    @include('header2')
    @include('header')
    <div class="container shadow">
        <form action="/khachhang" method="POST" id="cusForm">
        @csrf
            <h1 class="text-success">Thêm mới khách hàng</h1>
              <div>
                <label for="owner" class="form-label fw-bold">Loại KH:</label>
                <select name="loaikhachhang_id" id="loaiKH" class="js-example-placeholder-single js-states form-control form-select form-select-sm" required>
                  {{-- <option value="" disabled selected> -- Chọn loại khách hàng  -- </option> --}}
                  @foreach ($loaikhachhang as $loai)
                    <option value="{{ $loai->LOAIKHACHHANG_ID }}">
                      {{ $loai->LOAIKHACHHANG_TEN }}
                    </option>    
                  @endforeach                                
                </select>
                <script>    
                  $(document).ready(function() {
                    $('#loaiKH').select2({
                    placeholder: "Select a state",
                    allowClear: true
                  });
                });
                </script>
            </div>
            <div class="mb-3 mt-3">
                <label for="owner" class="form-label fw-bold">Chủ sỡ hữu:</label>
                <input type="text" class="form-control" id="email" placeholder="Nhập vào chủ sỡ hữu" name="khachhang_chusohuu" required>
              </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <label for="tenkhang" class="form-label fw-bold">Tên khách hàng:</label>
                    <input type="text" class="form-control" placeholder="Nhập tên" name="khachhang_ten" required>
                </div>
                <div class="col">
                    <label for="diachi" class="form-label fw-bold">Địa chỉ:</label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="khachhang_diachi" required>
                </div>
              </div>
              <div class="row mb-3 mt-3">
                <div class="col">
                    <label for="sdt" class="form-label fw-bold">Số điện thoại:</label>
                    <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="khachhang_sdt" required>
                </div>
                <div class="col">
                    <label for="email" class="form-label fw-bold">Email:</label>
                    <input type="email" class="form-control" placeholder="Nhập email" name="khachhang_email" required>
                </div>
              </div>
              <div class="row mb-3 mt-3">
                <div class="col">
                    <label for="ngaysinh" class="form-label fw-bold">Ngày sinh:</label>
                    <input type="date" class="form-control" placeholder="Nhập tên" name="khachhang_ngaysinhndd" required>
                </div>
                <div class="col">
                    <label for="cccd" class="form-label fw-bold">CCCD:</label>
                    <input type="text" pattern="[0-9]+" class="form-control" placeholder="Nhập số diện thoại" name="khachhang_cmnd" required>
                </div>
                <div class="col">
                    <label for="ngaycap" class="form-label fw-bold">Ngày cấp:</label>
                    <input type="date" class="form-control" placeholder="Nhập số diện thoại" name="khachhang_ngaycapcmnd" required>
                </div>
              </div>
            <div class="mb-3 mt-3">
              <label for="ngdaidien" class="form-label fw-bold">Người đại diện:</label>
              <input type="text" class="form-control" id="email" placeholder="Nhập tên người đại diện" name="khachhang_nguoidaidien" required>
            </div>
            <div class="mb-3">
                <label for="masothue" class="form-label fw-bold">Mã số thuế:</label>
                <div class="row justify-content-left">
                    <div class="col-auto">
                      <div class="input-group" id="otp-input-group">
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
                        <input type="text" class="otp-input" maxlength="1" required>
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
              </div>
            <div class="mb-3">
              <label for="ngayhdong" class="form-label fw-bold">Ngày hoạt động:</label>
              <input type="date" class="form-control" id="pwd" placeholder="Chọn ngày hoạt động" name="khachhang_ngayhoatdong" required>
            </div>
            <div class="mb-3 mt-3 pb-2 text-center">
                <button type="submit" onclick="getData()" class="btn btn-success btn-block mb-3 mt-3"><i class="fas fa-plus me-2"></i>Thêm mới</button>
                <button type="reset" class="btn btn-secondary btn-block mb-3 mt-3"><i class="fas fa-redo me-2"></i>Soạn lại</button>
            </div>
          </form>
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
</html>