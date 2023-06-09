<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* #side_nav {
            background: #000;
            min-width: 250px;
            max-width: 250px;
        } */
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    {{-- @include('header2')
    @include('header') --}}
    <button class="btn btn-warning"></button>
    <div class="sidebar" role="cdb-sidebar">
        <div class="sidebar-container">
          <div class="sidebar-header">
            <a class="sidebar-brand">Contrast</a>
            <a class="sidebar-toggler"><i class="fa fa-bars"></i></a>
          </div>
          <div class="sidebar-nav">
            <div class="sidenav">
              <a class="sidebar-item">
                <div class="sidebar-item-content">
                  <i class="fa fa-th-large sidebar-icon sidebar-icon-lg"></i>
                  <span>Dashboard</span>
                  <div class="suffix">
                    <div class="badge rounded-pill bg-danger">new</div>
                  </div>
                </div>
              </a>
              <a class="sidebar-item">
                <div class="sidebar-item-content">
                  <i class="fa fa-sticky-note sidebar-icon"></i>
                  <span>Components</span>
                </div>
              </a>
              <a class="sidebar-item">
                <div class="sidebar-item-content">
                  <i class="fa fa-sticky-note sidebar-icon"></i>
                  <span>Bootstrap</span>
                </div>
              </a>
            </div>
            <div class="sidebar-footer">Sidebar Footer</div>
          </div>
        </div>
      </div>
</body>
</html>