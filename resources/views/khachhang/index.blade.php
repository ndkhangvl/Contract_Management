{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
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
</style>
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Thêm mới khách hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form action="/khachhang" method="POST" id="cusForm">
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            @foreach ($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                @csrf
                      <div>
                        <label for="owner" class="form-label fw-bold">Loại KH:</label>
                        <select name="loaikhachhang_id" class="form-select form-select-sm">
                          <option value="" disabled selected> -- Chọn loại khách hàng  -- </option>
                          @foreach ($loaikhachhang as $loai)
                            <option value="{{ $loai->LOAIKHACHHANG_ID }}">
                              {{ $loai->LOAIKHACHHANG_TEN }}
                            </option>    
                          @endforeach                                
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="owner" class="form-label fw-bold">Chủ sỡ hữu:</label>
                        <input type="text" class="form-control" id="email" placeholder="Nhập vào chủ sỡ hữu" name="khachhang_chusohuu" >
                        <span class="invalid-feedback">@error('khachhang_chusohuu') {{$message}} @enderror</span>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="tenkhang" class="form-label fw-bold">Tên khách hàng:</label>
                            <input type="text" class="form-control" placeholder="Nhập tên" name="khachhang_ten">
                        </div>
                        <div class="col">
                            <label for="diachi" class="form-label fw-bold">Địa chỉ:</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="khachhang_diachi">
                        </div>
                      </div>
                      <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="sdt" class="form-label fw-bold">Số điện thoại:</label>
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="khachhang_sdt">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label fw-bold">Email:</label>
                            <input type="email" class="form-control" placeholder="Nhập email" name="khachhang_email">
                        </div>
                      </div>
                      <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="ngaysinh" class="form-label fw-bold">Ngày sinh:</label>
                            <input type="date" class="form-control" placeholder="Nhập tên" name="khachhang_ngaysinhndd">
                        </div>
                        <div class="col">
                            <label for="cccd" class="form-label fw-bold">CCCD:</label>
                            <input type="text" pattern="[0-9]+" class="form-control" placeholder="Nhập CMND/CCCD" name="khachhang_cmnd">
                        </div>
                        <div class="col">
                            <label for="ngaycap" class="form-label fw-bold">Ngày cấp:</label>
                            <input type="date" class="form-control" placeholder="Nhập số diện thoại" name="khachhang_ngaycapcmnd">
                        </div>
                      </div>
                    <div class="mb-3 mt-3">
                      <label for="ngdaidien" class="form-label fw-bold">Người đại diện:</label>
                      <input type="text" class="form-control" id="email" placeholder="Nhập tên người đại diện" name="khachhang_nguoidaidien">
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
                      </div>
                    <div class="mb-3">
                      <label for="ngayhdong" class="form-label fw-bold">Ngày hoạt động:</label>
                      <input type="date" class="form-control" id="pwd" placeholder="Chọn ngày hoạt động" name="khachhang_ngayhoatdong">
                    </div>
                    <div class="mb-3 mt-3 pb-2 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnSubmit" onclick="getData()" class="btn btn-success btn-block mb-3 mt-3"><i class="fas fa-plus me-2"></i>Thêm mới</button>
                        <button type="reset" class="btn btn-secondary btn-block mb-3 mt-3"><i class="fas fa-redo me-2"></i>Soạn lại</button>
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
                <td class="text-center align-middle">{{ $khachhang->KHACHHANG_ID }}</td>
                <td>{{ $khachhang->LOAIKHACHHANG_TEN }}</td>
                <td>{{ $khachhang->KHACHHANG_TEN }}</td>
                <td>{{ $khachhang->KHACHHANG_DIACHI }}</td>
                <td>{{ $khachhang->KHACHHANG_SDT }}</td>
                <td>{{ $khachhang->KHACHHANG_EMAIL }}</td>
                <td class="text-center">
                    <a href="/khachhang/{{$khachhang->KHACHHANG_ID}}">
                        <button type="button" class="btn btn-info">
                            Chi tiết
                        </button>
                    </a>
                </td>
                <td class="text-success text-nowrap">{{ $khachhang->TRANGTHAI_TEN }}</td>
            </tr>
        
        @endforeach
    </table>
</div>
</div>
@include('footer')
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
</body>