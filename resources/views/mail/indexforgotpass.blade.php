<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <style>
        body {
            background-image: url('img/bg-login.png');
            background-repeat: no-repeat;
            background-position: 50% 0;
            background-size: 100% auto;
        }

        .custom-width {
            width: 128px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
                <div class="p-4">
                    <form action="{{ route('forgot-pass') }}" method="POST">
                        @if (Session::has('success'))
                            <div id="success_message" class="alert alert-success">{{ Session::get('success') }}
                        @endif
                        @if (Session::has('fail'))
                            <div id="error_message" class="alert alert-danger">{{ Session::get('fail') }}
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="text" id="nd_email" name="nd_email" class="form-control"
                                placeholder="Điền email">
                            <div class="w-100">
                                @error('nd_email')
                                    <span class="text-danger" id="nd_email_error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 mx-auto text-center">
                            <button type="submit" class="btn btn-primary">{{ trans('msg.submit-forgot') }}</button>
                        </div>
                        <span>{{ trans('msg.return-login') }}<a href="/login" class="fw-bold text-decoration-none">{{ trans('msg.login-a') }}</span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById("nd_email").addEventListener('input', function() {
        document.getElementById('nd_email_error').innerText = '';
    });
</script>

</html>
