<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    {{-- <script src="/Scripts/jquery-3.3.1.min.js"></script> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid vh-100">
        <div class="" style="margin-top:100px">
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                    <div class="text-center">
                        <h3 class="text-primary">Quản Lý Hợp Đồng</h3>
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
                                <span class="input-group-text bg-primary"><i
                                        class="bi bi-person-plus-fill text-white"></i></span>
                                <input type="text" class="form-control" name="ma_nd" placeholder="Tên tài khoản"
                                value="{{old('ma_nd')}}">
                            </div>
                            <span class="invalid-feedback">@error('ma_nd') {{$message}} @enderror</span>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary"><i
                                        class="bi bi-key-fill text-white"></i></span>
                                <input type="password" class="form-control" name="matkhau" placeholder="Mật khẩu">
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
                            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ghi nhớ tôi
                                </label>
                            </div> --}}
                            <button class="btn btn-primary text-center mx-auto d-block mt-2" type="submit">
                                Đăng nhập
                            </button>
                            <p class="text-center text-primary">{{ __('msg.forgotpassword')}}</p>
                            {{-- <div class="mx-auto d-flex justify-content-center">
                                <a href="javascript:void(0)" onclick="changeLanguage('vi')" class="imgvi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                <a href="javascript:void(0)" onclick="changeLanguage('en')" class="imgen" style="background-image: url({{ asset('img/en.png') }});"></a>
                            </div> --}}
                            <div class="mx-auto d-flex justify-content-center">
                                <a href="{{ route('setlocale', 'vi') }}" class="imgvi" style="background-image: url({{ asset('img/vi.png') }});"></a>
                                <a href="{{ route('setlocale', 'en') }}" class="imgen" style="background-image: url({{ asset('img/en.png') }});"></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>