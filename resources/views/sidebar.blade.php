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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        < script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" >
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    </script>
</head>

<body>
    {{-- @include('header2')
    @include('header') --}}
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between mb-2">
                    <div class="logo ms-5">
                        <a href="/baocao"><img class="logo-img"
                                src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="Logo"
                                srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
            <h3 class="text-center text-white fw-bold" style="font-size: 25px">{{ trans('msg.title-login') }}</h3>
            <hr class="text-white bg-white" style="height: 3px; background-color: white !important;">
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-item {{ Str::startsWith(request()->path(), 'baocao') ? 'active' : '' }} ">
                        <a href="/baocao" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>{{ trans('msg.statistical') }}</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item has-sub {{ request()->is('khachhang') || request()->is('loaikhachhangs') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>{{ trans('msg.customer') }}</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a class="text-decoration-none text-white" href="/khachhang">{{ trans('msg.info') }}</a>
                            </li>
                            <li class="submenu-item ">
                                <a class="text-decoration-none text-white"
                                    href="/loaikhachhangs">{{ trans('msg.listcus') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ Str::startsWith(request()->path(), 'hopdong') ? 'active' : '' }} ">
                        <a href="/hopdong" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>{{ trans('msg.contract') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Str::startsWith(request()->path(), 'hoadon') ? 'active' : '' }} ">
                        <a href="/hoadon" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>{{ trans('msg.bill') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Str::startsWith(request()->path(), 'history') ? 'active' : '' }} ">
                        <a href="/history" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>{{ trans('msg.history') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
</body>
<script>
    function slideToggle(t, e, o) {
        0 === t.clientHeight ? j(t, e, o, !0) : j(t, e, o)
    }

    function slideUp(t, e, o) {
        j(t, e, o)
    }

    function slideDown(t, e, o) {
        j(t, e, o, !0)
    }

    function j(t, e, o, i) {
        void 0 === e && (e = 400), void 0 === i && (i = !1), t.style.overflow = "hidden", i && (t.style.display =
            "block");
        var p, l = window.getComputedStyle(t),
            n = parseFloat(l.getPropertyValue("height")),
            a = parseFloat(l.getPropertyValue("padding-top")),
            s = parseFloat(l.getPropertyValue("padding-bottom")),
            r = parseFloat(l.getPropertyValue("margin-top")),
            d = parseFloat(l.getPropertyValue("margin-bottom")),
            g = n / e,
            y = a / e,
            m = s / e,
            u = r / e,
            h = d / e;
        window.requestAnimationFrame(function l(x) {
            void 0 === p && (p = x);
            var f = x - p;
            i ? (t.style.height = g * f + "px", t.style.paddingTop = y * f + "px", t.style.paddingBottom = m *
                f + "px", t.style.marginTop = u * f + "px", t.style.marginBottom = h * f + "px") : (t.style
                .height = n - g * f + "px", t.style.paddingTop = a - y * f + "px", t.style.paddingBottom =
                s - m * f + "px", t.style.marginTop = r - u * f + "px", t.style.marginBottom = d - h * f +
                "px"), f >= e ? (t.style.height = "", t.style.paddingTop = "", t.style.paddingBottom = "", t
                .style.marginTop = "", t.style.marginBottom = "", t.style.overflow = "", i || (t.style
                    .display = "none"), "function" == typeof o && o()) : window.requestAnimationFrame(l)
        })
    }

    let sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');
    for (var i = 0; i < sidebarItems.length; i++) {
        let sidebarItem = sidebarItems[i];
        sidebarItems[i].querySelector('.sidebar-link').addEventListener('click', function(e) {
            e.preventDefault();

            let submenu = sidebarItem.querySelector('.submenu');
            if (submenu.classList.contains('active')) submenu.style.display = "block"

            if (submenu.style.display == "none") submenu.classList.add('active')
            else submenu.classList.remove('active')
            slideToggle(submenu, 300)
        })
    }

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
