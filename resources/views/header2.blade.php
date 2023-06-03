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
                    <a class="logo" href="/khachhang" title="Trang chủ">
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
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#infoModal" id="infoBtn">Thông tin</a></li>
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

<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Thông tin tài khoản</h5>
            </div>
            {{--<div class="modal-body">
                <p>Tên người dùng: {{ Session::get('infoUser')['ma_nd'] }}</p>
                <p>Mã người dùng: {{ Session::get('infoUser')['ten_nd'] }}<span id="userInfoMaND"></span></p>
                <p>Mật khẩu: {{ Session::get('infoUser')['matkhau'] }}<span id="userInfoMatKhau"></span></p>
                <p>Trạng thái: {{ Session::get('infoUser')['trangthai'] }}<span id="userInfoTrangThai"></span></p>
            </div>--}}
            <div class="modal-body">
                <p>Tên người dùng: {{ Session::get('infoUser')['ma_nd'] }}</p>
                <p>Mã người dùng: <span id="userInfoMaND"></span></p>
                <p>Mật khẩu: <span id="userInfoMatKhau"></span></p>
                <p>Trạng thái: <span id="userInfoTrangThai"></span></p>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var infoBtn = document.getElementById('infoBtn');
                    var infoModal = document.getElementById('infoModal');
                    var userInfoMaND = document.getElementById('userInfoMaND');
                    var userInfoMatKhau = document.getElementById('userInfoMatKhau');
                    var userInfoTrangThai = document.getElementById('userInfoTrangThai');
            
                    infoBtn.addEventListener('click', function () {
                        var userId = '{{ Session::get('infoUser')['ma_nd'] }}'; 
                        fetch('/user/' + userId)
                            .then(response => response.json())
                            .then(data => {
                                userInfoMaND.textContent = data.ma_nd;
                                userInfoMatKhau.textContent = data.matkhau;
                                userInfoTrangThai.textContent = data.trangthai;
                                var infoModalInstance = new bootstrap.Modal(infoModal);
                                infoModalInstance.show();
                            })
                            .catch(error => {
                                console.error('Lỗi truy vấn dữ liệu:', error);
                            });
                    });
                });
            </script>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var closeButton = document.querySelector('#infoModal .modal-footer button[data-dismiss="modal"]');
        closeButton.addEventListener('click', function () {
            var body = document.getElementsByTagName('body')[0];
            body.classList.remove('modal-open');
            var modalBackdrop = document.getElementsByClassName('modal-backdrop');
            while (modalBackdrop[0]) {
                modalBackdrop[0].parentNode.removeChild(modalBackdrop[0]);
            }
            var infoModal = document.getElementById('infoModal');
            var infoModalInstance = bootstrap.Modal.getInstance(infoModal);
            infoModalInstance.hide();
    });

    });
</script>