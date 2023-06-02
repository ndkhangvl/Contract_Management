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
        /* #wrap {
            min-height: 680px;
            background: url({{ asset('img/bg-login.png') }}) no-repeat 50% 100% / 100%;
        } */
        a.imgen { 
            background: no-repeat top left;
            display: block;
            width: 25px;
            height: 25px;
            text-indent: -9999px;
            float: left;
            margin-left: 10px;
        };
    </style>
    <script>
        window.onload = function() {
            var currentLocale = "{{ app()->getLocale() }}";
            console.log(currentLocale);
        }
    </script>
    {{-- <script src="/Scripts/jquery-3.3.1.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container-sm">
        {{-- <div class="" style="margin-top:100px"> --}}
            <div class="rounded d-flex justify-content-center" style="margin-top:80px">
                <div class="col-md-4 col-sm-12 bg-white border border-primary rounded-3">
                    <div class="text-center py-2 rounded-top" style="background: #E9E9E9">
                        <div class="mg-2">
                            <img src="/img/ctu.png" class="img-fluid custom-width mb-1"/>
                        </div>
                        <h2 class="fw-bold" style="color: #004F9E">Quản Lý Hợp Đồng</h2>
                    </div>
                    <form action="{{route('user-login')}}" method="POST">
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}
                        @endif
                        @csrf
                        <div class="p-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary"><i class="fas fa-user-alt" style="color: #ffffff;"></i></span>
                                <input type="text" class="form-control" name="ma_nd" placeholder="Tên tài khoản" value="{{old('ma_nd')}}" required>
                            </div>
                            <span class="invalid-feedback">@error('ma_nd') {{$message}} @enderror</span>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary"><i class="fas fa-key" style="color: #ffffff;"></i></span>
                                <input type="password" class="form-control" id="password" name="matkhau" placeholder="Mật khẩu" required>
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                  </span>
                            </div>
                            <span class="invalid-feedback">@error('matkhau') {{$message}} @enderror</span>
                            <div class="form-group">
                                <div class="captcha">
                                    <span>{!! Captcha::img() !!}</span>
                                    <button type="button" id="refresh">
                                        <span class="material-symbols-outlined">
                                            refresh
                                        </span>
                                    </button>
                                </div>
                                <input id="captcha" type="text" class="form-control mt-2" placeholder="{{ __('Nhập mã') }}" name="captcha" required>
                            </div>
                            <span class="text-danger">@error('captcha') {{$message}} @enderror</span>
                            <script>
                                document.getElementById('refresh').addEventListener('click', function() {
                                    var captchaImg = document.querySelector('.captcha img');
                                    captchaImg.src = captchaImg.src + '?' + Date.now();
                                });
                            </script>
                            {{--<div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ghi nhớ tôi
                                </label>
                            </div>--}}
                            <button class="btn btn-primary text-center mx-auto d-block mt-2" type="submit">
                                Đăng nhập
                            </button>
                            <a href="/forgotpass" class="text-center text-primary text-decoration-none fw-bold">{{ __('msg.forgotpassword')}}</a>
                            {{-- <div class="mx-auto d-flex justify-content-center">
                                <a href="javascript:void(0)" onclick="changeLanguage('vi')" class="imgvi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                <a href="javascript:void(0)" onclick="changeLanguage('en')" class="imgen" style="background-image: url({{ asset('img/en.png') }});"></a>
                            </div> --}}
                            <div class="mx-auto d-flex justify-content-center">
                                <a href="{{ route('setlocale', 'vi') }}" class="imgvi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                <a href="{{ route('setlocale', 'en') }}" class="imgen" style="background-image: url({{ asset('img/en.png') }});"></a>
                            </div>    
                    <div class="py-2">
                        <form action="{{route('user-login')}}" method="POST">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}
                            @endif
                            @if(Session::has('fail'))
                                <div class="alert alert-danger">{{Session::get('fail')}}
                            @endif
                            @csrf
                            <div class="p-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i class="fas fa-user-alt" style="color: #ffffff;"></i></span>
                                    <input type="text" class="form-control" id="ma_nd" name="ma_nd" placeholder="Tên tài khoản" value="{{old('ma_nd')}}">
                                </div>
                                <span class="invalid-feedback">@error('ma_nd') {{$message}} @enderror</span>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i class="fas fa-key" style="color: #ffffff;"></i></span>
                                    <input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Mật khẩu">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                      </span>
                                </div>
                                <span class="invalid-feedback">@error('matkhau') {{$message}} @enderror</span>
                                <div class="form-group">
                                    <div class="captcha">
                                        <span>{!! Captcha::img() !!}</span>
                                        <button type="button" id="refresh">
                                            <span class="material-symbols-outlined">
                                                refresh
                                            </span>
                                        </button>
                                    </div>
                                    <input id="captcha" type="text" class="form-control mt-2" placeholder="{{ __('Nhập mã') }}" name="captcha">
                                </div>
                                <span class="text-danger">@error('captcha') {{$message}} @enderror</span>
                                <script>
                                    document.getElementById('refresh').addEventListener('click', function() {
                                        var captchaImg = document.querySelector('.captcha img');
                                        captchaImg.src = captchaImg.src + '?' + Date.now();
                                    });
                                </script>
                                {{--<div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ghi nhớ tôi
                                    </label>
                                </div>--}}
                                <button class="btn btn-primary text-center mx-auto d-block mt-2" type="submit">
                                    Đăng nhập
                                </button>
                                <a href="/forgotpass" class="text-center text-primary text-decoration-none fw-bold">{{ __('msg.forgotpassword')}}</a>
                                {{-- <div class="mx-auto d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="changeLanguage('vi')" class="imgvi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                    <a href="javascript:void(0)" onclick="changeLanguage('en')" class="imgen" style="background-image: url({{ asset('img/en.png') }});"></a>
                                </div> --}}
                                <div class="mx-auto d-flex justify-content-center">
                                    {{-- <a href="{{ route('setlocale', 'vi') }}" class="imgvi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                    <a href="{{ route('setlocale', 'en') }}" class="imgen" style="background-image: url({{ asset('img/en.png') }});"></a> --}}
                                    <a href="#" class="imgvi" data-locale="vi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                    <a href="#" class="imgen" data-locale="en" style="background-image: url({{ asset('img/en.png') }});"></a>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                            $('.imgvi, .imgen').click(function(e) {
                                                e.preventDefault();
                                                var selectedLocale = $(this).data('locale');
                                    
                                                $.ajax({
                                                    url: "{{ route('updateLocale') }}",
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': csrfToken
                                                    },
                                                    data: { locale: selectedLocale },
                                                    success: function(response) {
                                                    console.log('AJAX Response:', response);

                                                    if (response && response.success) {
                                                        console.log('Locale updated successfully');
                                                        location.reload();
                                                    } else {
                                                        console.log('Locale update failed');
                                                    }
                                                },
                                                    error: function(response) {
                                                    console.log(response.success);
                                                }
                                                });
                                            });
                                        });
                                    </script>
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
function password_show_hide() {
  var x = document.getElementById("password");
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
</script>
</html>