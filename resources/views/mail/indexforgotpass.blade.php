<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="" style="margin-top:100px">
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light shadow">
                        <div class="card-body p-6">
                            <div class="mb-4">
                                <h3 class="text-primary fx-bold">Quên mật khẩu</h3>
                                <p>Điền tài khoản email để lấy lại mật khẩu.</p>
                            </div>
                            <form action="{{route('forgot-pass')}}" method="POST">
                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}
                                @endif
                                @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="text" id="email" class="form-control" name="nd_email" placeholder="Điền email">
                                </div>
                                <div class="mb-3 mx-auto text-center">
                                    <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                                </div>
                                <span>Trở về <a href="/login" class="fw-bold text-decoration-none">đăng nhập</span>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>