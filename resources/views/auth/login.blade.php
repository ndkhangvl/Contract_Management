<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập hệ thống</title>
    <style>
        a.imgvi {
            background: no-repeat top left;
            display: block;
            width: 25px;
            height: 25px;
            text-indent: -9999px;
            float: left;
            margin-left: 10px;
        }

        body {
            background-image: url('img/bg-login.png');
            background-repeat: no-repeat;
            background-position: 50% 0;
            background-size: 100% auto;
        }

        .custom-width {
            width: 128px;
        }

        a.imgen {
            background: no-repeat top left;
            display: block;
            width: 25px;
            height: 25px;
            text-indent: -9999px;
            float: left;
            margin-left: 10px;
        }

        #loadingContainer {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            display: flex;
            background-color: rgba(255, 255, 255, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        ;
    </style>
    {{-- <script>
        window.onload = function() {
            var currentLocale = "{{ app()->getLocale() }}";
            console.log(currentLocale);
        }
    </script> --}}
    {{-- <script src="/Scripts/jquery-3.3.1.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container-sm">
        <div class="rounded d-flex justify-content-center" style="margin-top:80px">
            <div class="col-md-4 col-sm-12 bg-white border border-primary rounded-3">
                <div class="text-center py-2 rounded-top" style="background: #E9E9E9">
                    <div class="mg-2">
                        <img src="/img/ctu.png" class="img-fluid custom-width mb-1" />
                    </div>
                    <h2 class="fw-bold" style="color: #004F9E; font-family: 'Be Vietnam Pro', sans-serif;">
                        {{ trans('msg.title-login') }}</h2>
                </div>
                <div class="py-2">
                    {{-- @if (Session::has('success')) --}}
                    <div class="ps-4"><span class="text-danger fw-bold" id="error_pass">
                        </span></div>
                    <form action="{{ route('user-login') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="p-4">
                            <div id="loadingContainer" class="bg-white shadow" style="display: none;">
                                {{-- <i class="fas fa-spinner fa-spin"></i>{{ trans('msg.loading') }} --}}
                                <img src="img/loading.svg" style="width: 100px; height: 100px" />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary"><i class="fas fa-user-alt"
                                        style="color: #ffffff;"></i></span>
                                <input type="text" class="form-control" id="ma_nd" name="ma_nd"
                                    placeholder="{{ trans('msg.username') }}" value="{{ old('ma_nd') }}">
                                <div class="w-100"> <span class="text-danger" id="ma_nd_error">
                                    </span></div>
                            </div>
                            {{-- <span class="text-danger" id="fail_error"> @error('ma_nd')
                                {{ $message }}
                            @enderror
                        </span> --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary"><i class="fas fa-key"
                                        style="color: #ffffff;"></i></span>
                                <input type="password" class="form-control" id="matkhau" name="matkhau"
                                    placeholder="{{ trans('msg.passwd') }}">
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                                <div class="w-100"> <span class="text-danger" id="matkhau_error">
                                    </span></div>
                            </div>
                            {{-- <span class="text-danger" id="fail_error"> @error('matkhau')
                                {{ $message }}
                            @enderror
                        </span> --}}
                            <div class="form-group">
                                <div class="captcha">
                                    <span>{!! Captcha::img() !!}</span>
                                    <button type="button" id="refresh">
                                        <span class="material-symbols-outlined">
                                            refresh
                                        </span>
                                    </button>
                                </div>
                                <input id="captcha" type="text" class="form-control mt-2"
                                    placeholder="{{ trans('msg.captcha') }}" name="captcha">
                            </div>
                            <div class="w-100"> <span class="text-danger" id="captcha_error">
                                </span></div>
                            <script>
                                document.getElementById('refresh').addEventListener('click', function() {
                                    var captchaImg = document.querySelector('.captcha img');
                                    captchaImg.src = captchaImg.src + '?' + Date.now();
                                });
                            </script>
                            {{-- <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ghi nhớ tôi
                                    </label>
                                </div> --}}
                            <button class="btn btn-primary text-center mx-auto d-block mt-2" type="submit">
                                {{ trans('msg.btnLogin') }}
                            </button>
                            <a href="/forgotpass"
                                class="text-center text-primary text-decoration-none fw-bold">{{ trans('msg.forgotpassword') }}</a>
                            <div class="mx-auto d-flex justify-content-center">
                                <a href="javascript:void(0)" class="imgvi" onclick="changeLanguage('vi')"
                                    data-locale="vi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                <a href="javascript:void(0)" class="imgen" onclick="changeLanguage('en')"
                                    data-locale="en" style="background-image: url({{ asset('img/en.png') }});"></a>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
<script>
    document.getElementById("matkhau").addEventListener('input', doThing);
    document.getElementById("ma_nd").addEventListener('input', function() {
        $('#ma_nd_error').text('');
    });

    document.getElementById("captcha").addEventListener('input', function() {
        $('#captcha_error').text('');
    });

    function doThing() {
        $('#error_pass').text('');
        $('#matkhau_error').text('');
    }

    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn hành vi submit mặc định của form

            $('#loadingContainer').show();
            $('#ma_nd_error').text('');
            $('#matkhau_error').text('');
            $('#captcha_error').text('');
            $('#error_pass').text('');
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success == true) {
                        window.location.href = response.redirect;
                    } else if (response.success == false && response.captcha == false) {
                        $('#error_pass').text(response.message).show();
                        var captchaImg = document.querySelector('.captcha img');
                        captchaImg.src = captchaImg.src + '?' + Date.now();
                        $('#captcha').val('');
                        $('#captcha').focus();
                    } else if (response.success == false) {
                        $('#error_pass').text(response.message).show();
                        $('#matkhau').focus();
                        var captchaImg = document.querySelector('.captcha img');
                        captchaImg.src = captchaImg.src + '?' + Date.now();
                        $('#captcha').val('');
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        $('#ma_nd').focus();
                        $('.invalid-feedback').empty();
                        var response = JSON.parse(xhr.responseText);
                        var errors = response.errors;

                        //$('#loadingContainer').hide();
                        for (var field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                var errorMessage = errors[field][0];
                                $('#' + field + '_error').text(errorMessage).show();
                            }
                        }
                    }
                },
                complete: function() {
                    $('#loadingContainer').hide();
                }
            });
        });
    });

    function password_show_hide() {
        var x = document.getElementById("matkhau");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }

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
                    // console.log(response.test);
                    // console.log('Locale updated successfully');
                    window.location.reload();
                }
            }
        });
    }
</script>

</html>
