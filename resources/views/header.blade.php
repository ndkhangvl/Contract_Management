<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #077DCE;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/khachhang">CTU-Contract</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->is('khachhang') ? 'active' : '' }} fw-bold" href="/khachhang">{{ Session::get('locale') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('khachhang') ? 'active' : '' }} fw-bold" href="/khachhang">{{trans('msg.customer')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('hopdong') ? 'active' : '' }} fw-bold" href="/hopdong">{{trans('msg.contract')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('hoadon') ? 'active' : '' }} fw-bold" href="/hoadon">{{trans('msg.bill')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('baocao') ? 'active' : '' }} fw-bold" href="/baocao">{{trans('msg.statistical')}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
<script>
  function setActive(event) {
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.classList.remove('active');
    });
    const clickedLink = event.target;
    clickedLink.classList.add('active');
  }
</script>
</html>