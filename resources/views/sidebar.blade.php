<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    {{-- @include('header2')
    @include('header') --}}
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between mb-2">
                    <div class="logo">
                        <a href="/khachhang"><img class="logo-img"
                                src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="Logo"
                                srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
            <h3 class="text-center text-white fw-bold" style="font-size: 25px">{{trans('msg.title-login')}}</h3>
            <hr style="height: 3px; background-color: white;">
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-item active ">
                        <a href="/khachhang" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>{{trans('msg.customer')}}</span>
                        </a>
                    </li>

                    <li class="sidebar-item  ">
                        <a href="/hopdong" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>{{trans('msg.contract')}}</span>
                        </a>
                    </li>

                    <li class="sidebar-item  ">
                        <a href="/hoadon" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>{{trans('msg.bill')}}</span>
                        </a>
                    </li>

                    <li class="sidebar-item  ">
                        <a href="/baocao" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>{{trans('msg.statistical')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
</body>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var w = window.innerWidth;
        if (w < 1200) {
            document.getElementById('sidebar').classList.remove('active');
        }
    });
    window.addEventListener('resize', (event) => {
        var w = window.innerWidth;
        if (w < 1200) {
            document.getElementById('sidebar').classList.remove('active');
        } else {
            document.getElementById('sidebar').classList.add('active');
        }
    });

</script>

</html>
