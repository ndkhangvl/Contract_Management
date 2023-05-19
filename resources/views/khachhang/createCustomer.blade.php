<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    @include('header')
    <div class="container">
        <form action="/action_page.php">
            <h1 class="text-success">Thêm mới khách hàng</h1>
            <div class="mb-3 mt-3">
                <label for="loaikh" class="form-label fw-bold">Loại khách hàng:</label>
                <input type="text" class="form-control" id="email" placeholder="Nhập thông tin loại khách hàng" name="email">
              </div>
            <div class="mb-3 mt-3">
                <label for="owner" class="form-label fw-bold">Chủ sỡ hữu:</label>
                <input type="text" class="form-control" id="email" placeholder="Nhập vào chủ sỡ hữu" name="email">
              </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <label for="tenkhang" class="form-label fw-bold">Tên khách hàng:</label>
                    <input type="text" class="form-control" placeholder="Nhập tên" name="email">
                </div>
                <div class="col">
                    <label for="diachi" class="form-label fw-bold">Địa chỉ:</label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="pswd">
                </div>
              </div>
              <div class="row mb-3 mt-3">
                <div class="col">
                    <label for="sdt" class="form-label fw-bold">SĐT:</label>
                    <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="email">
                </div>
                <div class="col">
                    <label for="email" class="form-label fw-bold">Email:</label>
                    <input type="email" class="form-control" placeholder="Nhập email" name="pswd">
                </div>
              </div>
              <div class="row mb-3 mt-3">
                <div class="col">
                    <label for="ngaysinh" class="form-label fw-bold">Ngày sinh:</label>
                    <input type="date" class="form-control" placeholder="Nhập tên" name="email">
                </div>
                <div class="col">
                    <label for="cccd" class="form-label fw-bold">CCCD:</label>
                    <input type="text" pattern="[0-9]+" class="form-control" placeholder="Nhập số diện thoại" name="pswd">
                </div>
                <div class="col">
                    <label for="ngaycap" class="form-label fw-bold">Ngày cấp:</label>
                    <input type="date" class="form-control" placeholder="Nhập số diện thoại" name="pswd">
                </div>
              </div>
            <div class="mb-3 mt-3">
              <label for="ngdaidien" class="form-label fw-bold">Người đại diện:</label>
              <input type="text" class="form-control" id="email" placeholder="Nhập tên người đại diện" name="email">
            </div>
            <div class="mb-3">
              <label for="ngayhdong" class="form-label fw-bold">Ngày hoạt động:</label>
              <input type="date" class="form-control" id="pwd" placeholder="Chọn ngày hoạt động" name="pswd">
            </div>
            <div class="mb-3">
                <label for="masothue" class="form-label fw-bold">Mã số thuế:</label>
                <input type="text" class="form-control" id="pwd" placeholder="Nhập mã số thuế" name="pswd">
              </div>
            </div>
            <button type="submit" class="btn btn-lg btn-success mx-auto d-block mb-3 mt-3">Thêm mới</button>
          </form>
    </div>
</body>
</html>