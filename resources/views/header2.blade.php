{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

<style>
    .logo-img {
        width: 150px;
        height: auto;
    }

    a.imgen {
        background: no-repeat top left;
        /* display: block; */
        width: 25px;
        height: 25px;
        text-indent: -9999px;
        float: left;
        margin-left: 10px;
        margin-top: 10px;
    }

    a.imgvi {
        background: no-repeat top left;
        /* display: none; */
        width: 25px;
        height: 25px;
        text-indent: -9999px;
        float: left;
        margin-left: 10px;
        margin-top: 10px;
    }

    ;
</style>
{{-- <header class="bg-white py-3" style="padding-left: 300px;">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="logo-header">
                    <a class="logo" href="/khachhang" title="Trang chủ">
                        <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" class="logo-img" alt="logo"></a>
                </div>
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="fas fa-bars"></i>
                    </a>
                </header>
            </div>
            <div class="col-6 d-inline">
                <div class="d-flex float-end">
                    <div class="dropdown d-inline-block mr-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" style="margin-top: 25%" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Session::get('infoUser')['ma_nd'] }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userMenuDropdown">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#infoModal" id="infoBtn">{{trans('msg.info')}}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('en')">{{ trans('msg.english') }}</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('vi')">{{ trans('msg.vietnamese') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout">{{__('msg.logout')}}</a></li>
                        </ul>
                    </div>
                    <a href="/khachhang" class="d-inline-block mr-2" >
                        <img src="https://testing.ctu.edu.vn/theme/image.php/lambda/core/1684852385/u/f1" class="d-inline-block rounded-circle" width="80" height="80" alt="" data-selected="true" data-label-id="0" data-metatip="true">
                    </a>                    
                </div>
            </div>
        </div>
    </div> --}}
<header class="bg-white d-flex justify-content-between">
    <div class="d-inline-block mr-2 m-2 text-center">
        <a href="#" class="burger-btn mt-2">
            <i class="fas fa-bars" style="display: inline-block; font-size: 40px;"></i>
        </a>
    </div>
    <div class="float-end d-flex align-items-center">
        <div class="dropdown d-inline-block mr-2 mb-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" style="margin-top: 5%" id="userMenuDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Session::get('infoUser')['ten_nd'] }} ({{ Session::get('infoUser')['ma_nd'] }})
            </button>
            <ul class="dropdown-menu" aria-labelledby="userMenuDropdown">
                <li> <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#infoModal">
                        {{ trans('msg.infomation') }}
                    </button></li>
                <li> <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#updatePasswd">
                        {{ trans('msg.updatepw') }}
                    </button></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/logout">{{ __('msg.logout') }}</a></li>
            </ul>
        </div>
        <div class="d-inline-block mr-2">
            <a href="javascript:void(0)" class="imgvi" onclick="changeLanguage('en')" data-locale="en"
                style="background-image: url({{ asset('img/vi.png') }});"></a>
            <a href="javascript:void(0)" class="imgen" onclick="changeLanguage('vi')" data-locale="vi"
                style="background-image: url({{ asset('img/en.png') }});"></a>
        </div>
        {{-- <a href="javascript:void(0)" class="img-lang imgvi" onclick="changeLanguage('en')" data-locale="vi"
            style="background-image: url({{ asset('img/vi.png') }});">
            <img src="{{ asset('img/en.png') }}" alt="Language Icon" id="flag-en" />
            <img src="{{ asset('img/vi.png') }}" alt="Language Icon" id="flag-vi" />
        </a> --}}
        <a href="/khachhang" class="d-inline-block mr-2">
            <img src="https://testing.ctu.edu.vn/theme/image.php/lambda/core/1684852385/u/f1"
                class="d-inline-block rounded-circle m-2" width="40" height="40" alt=""
                data-selected="true" data-label-id="0" data-metatip="true">
        </a>
    </div>
    <div class="modal fade" id="infoModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Thông tin tài khoản</h5>
                </div>
                {{-- <div class="modal-body">
                <p>Tên người dùng: {{ Session::get('infoUser')['ma_nd'] }}</p>
                <p>Mã người dùng: {{ Session::get('infoUser')['ten_nd'] }}<span id="userInfoMaND"></span></p>
                <p>Mật khẩu: {{ Session::get('infoUser')['matkhau'] }}<span id="userInfoMatKhau"></span></p>
                <p>Trạng thái: {{ Session::get('infoUser')['trangthai'] }}<span id="userInfoTrangThai"></span></p>
            </div> --}}
                <div class="modal-body">
                    <p><span class="text-primary fw-bold">Tên người dùng:</span>
                        {{ Session::get('infoUser')['ten_nd'] }}</p>
                    <p><span class="text-primary fw-bold">Mã người dùng:</span> {{ Session::get('infoUser')['ma_nd'] }}
                    </p>
                    <p><span class="text-primary fw-bold">Trạng thái:</span> @php
                        $trangthai = Session::get('infoUser')['trangthai'];
                    @endphp @if ($trangthai == 1)
                            <span class="fw-bold text-success">Đang hoạt động</span>
                            @else 
                            <span class="fw-bold text-danger">Không hoạt động</span>
                        @endif
                    </p>
                    <p><span class="text-primary fw-bold">Email:</span>
                        {{ Session::get('infoUser')['nguoidung_email'] }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Change Password --}}
    <div class="modal fade" id="updatePasswd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePasswdLabel">Đổi mật khẩu</h5>
                </div>
                <div class="modal-body">
                    <form action="#" id="updatePass" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="passwd_new" class="form-label">Mật khẩu mới:</label>
                            <input type="password" class="form-control" id="passwd_new"
                                placeholder="Nhập vào mật khẩu mới" name="passwd_new">
                            <span class="invalid-feedback" id="passwd_new_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Nhập lại mật khẩu:</label>
                            <input type="password" class="form-control" id="confirm_passwd_new"
                                placeholder="Xác nhận mật khẩu" name="confirm_passwd_new">
                            <span class="invalid-feedback" id="confirm_passwd_new_error"></span>
                        </div>
                        <div class="mb-3 mt-3 pb-2 text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    function changeLanguage(culture) {
        var jsondata = {
            culture: culture
        };
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "/updatelocale",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: jsondata,
            success: function(response) {
                if (response.success) {
                    console.log(response.test);
                    //localStorage.setItem('selectedLanguage', response.test);
                    window.location.reload();
                }
            }
        });
    }

    $(document).ready(function() {
        $('#updatePass').on('submit', function(e) {
            e.preventDefault();
            var formupdateData = $(this).serialize();
            var form = $('#updatePass')[0];
            // Create an FormData object 
            var data = new FormData(form);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/updatePassWd",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                type: 'POST',
                data: data,
                processData: false, // Important!
                contentType: false,
                success: function(success) {
                    Swal.close();
                    if (success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thay đổi mật khẩu!',
                                text: 'Đổi mật khẩu thành công'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thay đổi mật khẩu!',
                                text: 'Đã xảy ra lỗi, không thể đổi mật khẩu'
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

    document.addEventListener('DOMContentLoaded', function() {
        var locale = '{{ Session::get('locale') ?: 'vi' }}';
        if (locale === 'vi') {
            document.querySelector('.imgen').style.display = 'none';
            document.querySelector('.imgvi').style.display = 'block';
        } else if (locale === 'en') {
            document.querySelector('.imgen').style.display = 'block';
            document.querySelector('.imgvi').style.display = 'none';
        }
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     var closeButton = document.querySelector('#infoModal .modal-footer button[data-dismiss="modal"]');
    //     closeButton.addEventListener('click', function() {
    //         var body = document.getElementsByTagName('body')[0];
    //         body.classList.remove('modal-open');
    //         var modalBackdrop = document.getElementsByClassName('modal-backdrop');
    //         while (modalBackdrop[0]) {
    //             modalBackdrop[0].parentNode.removeChild(modalBackdrop[0]);
    //         }
    //         var infoModal = document.getElementById('infoModal');
    //         var infoModalInstance = bootstrap.Modal.getInstance(infoModal);
    //         infoModalInstance.hide();
    //     });

    // });
</script>
