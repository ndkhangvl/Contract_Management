{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
<style>
    .logo-img {
        width: 200px;
        height: auto;
    };
</style>
<header class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="logo-header">
                    <a class="logo" href="https://127.0.0.1:8000/khachhang" title="Trang chủ">
                        <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" class="logo-img" alt="logo"></a>
                </div>
            </div>
            <div class="col-6 d-inline">
                <div class="d-flex float-end">
                    <div class="dropdown d-inline-block mr-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Session::get('infoUser')['ma_nd'] }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userMenuDropdown">
                          <li><a class="dropdown-item" href="#">Thông tin</a></li>
                          <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="logout">Đăng xuất</a></li>
                        </ul>
                      </div>
                      <a href="/khachhang" class="d-inline-block mr-2">
                        <img src="https://testing.ctu.edu.vn/theme/image.php/lambda/core/1684852385/u/f1" class="d-inline-block" width="80" height="80" alt="" data-selected="true" data-label-id="0" data-metatip="true">
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>