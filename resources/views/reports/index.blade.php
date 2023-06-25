{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<title>Thống kê báo cáo</title>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th {
        background: #337ab7;
        color: black;
        text-align: center;
        padding: 10px
    }

    td {
        background: #cce0df;
        padding: 5px;
        margin-left: 10%
    }

    .small-chart {
        width: 400px;
        height: 300px;
    }

    .column {
        float: left;
        width: 50%;
        padding: 10px;
    }

    .clear {
        clear: both;
    }
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
        font-size: 16px;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-info {
        background-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #11707e;
    }
    .custom-form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    max-width: 300px;
    margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="date"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
        font-size: 16px;
        background-color: #007bff;
    }

    button:hover {
        background-color: #0056b3;
    }
    .modal-body {
        height: 200px;
        overflow-y: ;
    }
    .hovercard {
        transition: transform 0.3s;
    }

    .hovercard:hover {
        transform: scale(1.1);
    }
    


</style>
@include('header2')
@include('sidebar')
<div id="main">
    <div class="contaienr-fluid">
        <div class="d-sm flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Thống kê</h1>
        </div>
        <form class="custom-form">
            <div class="form-group">
                <label for="start_date">Ngày bắt đầu:</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">Ngày kết thúc:</label>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" required>
            </div>
            <button type="submit" id="btnThongKe" class="btn btn-primary">Thống kê</button>
        </form>        
        {{-- Row Dashboard --}}
        <div class="row">
            {{-- Các hợp đồng mới tạo --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-orange);" data-toggle="modal" data-target="#myModal1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Hợp đồng Mới Tạo
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $HopDongMoiTao }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Các hợp đồng nghiệm thu --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-warning);" data-toggle="modal" data-target="#myModal2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Hợp đồng nghiệm thu
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $HopDongNghiemThu }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Các hợp đồng xuất hóa đơn --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-orange);" data-toggle="modal" data-target="#myModal3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Hợp đồng xuất hóa đơn
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $HopDongXuatHoaDon }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-export fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Các hợp đồng thanh lý --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-warning);" data-toggle="modal" data-target="#myModal4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Hợp đồng thanh lý
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $HopDongThanhLy }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder-minus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tổng số hợp đồng --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-primary);" data-toggle="modal" data-target="#myModal5">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Tổng số hợp đồng
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $TongHopDong }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-archive fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tổng tiền của các hợp đồng --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-success);" data-toggle="modal" data-target="#myModal6">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Tổng thu của các hóa đơn
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $TongThuHoaDonFormatted  }} VNĐ</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tổng số hóa đơn --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-primary);" data-toggle="modal" data-target="#myModal7">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Tổng số hóa đơn
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $TongHoaDon }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-archive fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Số hóa đơn chưa thanh toán --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hovercard" style="border-left: 0.25rem solid var(--bs-red);" data-toggle="modal" data-target="#myModal8">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-danger text-uppercase mb-1" style="font-size: .7rem;">
                                    Số hóa đơn chưa thanh toán
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $TongChuaThanhToan  }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-thumbtack fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Model card --}}
            <div class="modal" id="myModal1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                    <b><h3>Danh sách hợp đồng</h3></b>
                </div>
                <div class="modal-body" style="height: 500px; overflow-y: auto;">
                    @foreach ($ThongtinHD as $hopDong)
                    @if($hopDong->HOPDONG_TRANGTHAI == 1)
                        <div>
                            <b><p>Hợp đồng số:</b> <b style="color: #007bff">{{ $hopDong->HOPDONG_SO }}</b></p>
                            <p>Ngày ký: {{ $hopDong->HOPDONG_NGAYKY  }}</p>
                            <p>Tên gói thầu: {{ $hopDong->HOPDONG_TENGOITHAU }}</p>
                            <p>Tên dự án: {{ $hopDong->HOPDONG_TENDUAN }}</p>
                            <p>Đai diện bên A: {{ $hopDong->HOPDONG_DAIDIENBEN_A }}</p>
                            <p>Đai diện bên B: {{ $hopDong->HOPDONG_DAIDIENBEN_B  }}</p>
                            <p>Thời gian thực hiện: {{ $hopDong->HOPDONG_THOIGIANTHUCHIEN  }}</p>
                            <p>Tổng giá trị: {{ $hopDong->HOPDONG_TONGGIATRI  }} VNĐ</p>
                            <hr>
                        </div>
                    @endif
                    @endforeach
                </div>
              </div>
            </div>
            </div>
          
            <div class="modal" id="myModal2">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Danh sách hợp đồng</h3>
                    </div>
                    <div class="modal-body" style="height: 500px; overflow-y: auto;">
                        @foreach ($ThongtinHD as $hopDong)
                        @if($hopDong->HOPDONG_TRANGTHAI == 2)
                            <div>
                                <b><p>Hợp đồng số:</b> <b style="color: #007bff">{{ $hopDong->HOPDONG_SO }}</b></p>
                                <p>Ngày ký: {{ $hopDong->HOPDONG_NGAYKY  }}</p>
                                <p>Tên gói thầu: {{ $hopDong->HOPDONG_TENGOITHAU }}</p>
                                <p>Tên dự án: {{ $hopDong->HOPDONG_TENDUAN }}</p>
                                <p>Đai diện bên A: {{ $hopDong->HOPDONG_DAIDIENBEN_A }}</p>
                                <p>Đai diện bên B: {{ $hopDong->HOPDONG_DAIDIENBEN_B  }}</p>
                                <p>Thời gian thực hiện: {{ $hopDong->HOPDONG_THOIGIANTHUCHIEN  }}</p>
                                <p>Tổng giá trị: {{ $hopDong->HOPDONG_TONGGIATRI  }} VNĐ</p>
                                <hr>
                            </div>
                        @endif
                        @endforeach
                    </div>
                  </div>
                </div>
            </div>

                <div class="modal" id="myModal3">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Danh sách hợp đồng</h3>
                        </div>
                        <div class="modal-body" style="height: 500px; overflow-y: auto;">
                            @foreach ($ThongtinHD as $hopDong)
                            @if($hopDong->HOPDONG_TRANGTHAI == 3)
                                <div>
                                    <b><p>Hợp đồng số:</b> <b style="color: #007bff">{{ $hopDong->HOPDONG_SO }}</b></p>
                                    <p>Ngày ký: {{ $hopDong->HOPDONG_NGAYKY  }}</p>
                                    <p>Tên gói thầu: {{ $hopDong->HOPDONG_TENGOITHAU }}</p>
                                    <p>Tên dự án: {{ $hopDong->HOPDONG_TENDUAN }}</p>
                                    <p>Đai diện bên A: {{ $hopDong->HOPDONG_DAIDIENBEN_A }}</p>
                                    <p>Đai diện bên B: {{ $hopDong->HOPDONG_DAIDIENBEN_B  }}</p>
                                    <p>Thời gian thực hiện: {{ $hopDong->HOPDONG_THOIGIANTHUCHIEN  }}</p>
                                    <p>Tổng giá trị: {{ $hopDong->HOPDONG_TONGGIATRI  }} VNĐ</p>
                                    <hr>
                                </div>
                            @endif
                            @endforeach
                        </div>
                      </div>
                    </div>
                </div>
          
                    <div class="modal" id="myModal4">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Danh sách hợp đồng</h3>
                            </div>
                            <div class="modal-body" style="height: 500px; overflow-y: auto;">
                                @foreach ($ThongtinHD as $hopDong)
                                @if($hopDong->HOPDONG_TRANGTHAI == 4)
                                    <div>
                                        <b><p>Hợp đồng số:</b> <b style="color: #007bff">{{ $hopDong->HOPDONG_SO }}</b></p>
                                        <p>Ngày ký: {{ $hopDong->HOPDONG_NGAYKY  }}</p>
                                        <p>Tên gói thầu: {{ $hopDong->HOPDONG_TENGOITHAU }}</p>
                                        <p>Tên dự án: {{ $hopDong->HOPDONG_TENDUAN }}</p>
                                        <p>Đai diện bên A: {{ $hopDong->HOPDONG_DAIDIENBEN_A }}</p>
                                        <p>Đai diện bên B: {{ $hopDong->HOPDONG_DAIDIENBEN_B  }}</p>
                                        <p>Thời gian thực hiện: {{ $hopDong->HOPDONG_THOIGIANTHUCHIEN  }}</p>
                                        <p>Tổng giá trị: {{ $hopDong->HOPDONG_TONGGIATRI  }} VNĐ</p>
                                        <hr>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                          </div>
                        </div>
                    </div>

                        <div class="modal" id="myModal5">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Danh sách hợp đồng</h3>
                                </div>
                                <div class="modal-body" style="height: 500px; overflow-y: auto;">
                                    @foreach ($ThongtinHD as $hopDong)
                                        <div>
                                            <b><p>Hợp đồng số:</b> <b style="color: #007bff">{{ $hopDong->HOPDONG_SO }}</b></p>
                                            <p>Ngày ký: {{ $hopDong->HOPDONG_NGAYKY  }}</p>
                                            <p>Tên gói thầu: {{ $hopDong->HOPDONG_TENGOITHAU }}</p>
                                            <p>Tên dự án: {{ $hopDong->HOPDONG_TENDUAN }}</p>
                                            <p>Đai diện bên A: {{ $hopDong->HOPDONG_DAIDIENBEN_A }}</p>
                                            <p>Đai diện bên B: {{ $hopDong->HOPDONG_DAIDIENBEN_B  }}</p>
                                            <p>Thời gian thực hiện: {{ $hopDong->HOPDONG_THOIGIANTHUCHIEN  }}</p>
                                            <p>Tổng giá trị: {{ $hopDong->HOPDONG_TONGGIATRI  }} VNĐ</p>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                              </div>
                            </div>
                        </div>
          
                        <div class="modal" id="myModal6">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tổng thu các hóa đơn</h3>
                                </div>
                                <div class="modal-body" style="height: 500px; overflow-y: auto;">
                                    @foreach ($ThongtinHoaDon as $hoadon)
                                        <div>
                                            <b><p>Hóa đơn số:</b> <b style="color: #007bff">{{ $hoadon->HOADON_SO }}</b></p>
                                            <p>Ngày tạo hóa đơn: {{ $hoadon->HOADON_NGAYTAO  }}</p>
                                            <p>Thuộc về họp đồng số: {{ $hoadon->HOPDONG_SO }}
                                            <p>Tổng tiền chưa thuế: {{ $hoadon->HOADON_TONGTIEN = number_format($hoadon->HOADON_TONGTIEN, 0, '.', '.') }} VNĐ</p>
                                            <p>Thuế: {{ $hoadon->HOADON_THUESUAT }}%</p>
                                            <p>Tiền thuế: {{ $hoadon->HOADON_TIENTHUE = number_format($hoadon->HOADON_TIENTHUE, 0, '.', '.') }} VNĐ</p>
                                            <p>Tổng tiền có thuế: {{ $hoadon->HOADON_TONGTIEN_COTHUE = number_format($hoadon->HOADON_TONGTIEN_COTHUE, 0, '.', '.') }} VNĐ</p>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                              </div>
                            </div>
                        </div>
                        
                        <div class="modal" id="myModal7">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Số hóa đơn</h3>
                                </div>
                                <div class="modal-body" style="height: 500px; overflow-y: auto;">
                                    @foreach ($ThongtinHoaDon as $hoadon)
                                        <div>
                                            <b><p>Hóa đơn số:</b> <b style="color: #007bff">{{ $hoadon->HOADON_SO }}</b></p>
                                            <p>Ngày tạo hóa đơn: {{ $hoadon->HOADON_NGAYTAO  }}</p>
                                            <p>Người tạo hóa đơn: {{ $hoadon->HOADON_NGUOITAO  }}</p>
                                            <p>Người mua hàng: {{ $hoadon->HOADON_NGUOIMUAHANG }}</p>
                                            <p>Thành tiền: {{ $hoadon->HOADON_TONGTIEN_COTHUE }} VNĐ</p>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                              </div>
                            </div>
                        </div>
                        
                        <div class="modal" id="myModal8">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Số hóa đơn chưa thanh toán</h3>
                                    </div>
                                    <div class="modal-body" style="height: 500px; overflow-y: auto;">
                                        @foreach ($ThongtinHoaDon as $hoadon)
                                            @if ($hoadon->HOADON_TRANGTHAI == 0)
                                                <div>
                                                    <b><p>Hóa đơn số:</b> <b style="color: #007bff">{{ $hoadon->HOADON_SO }}</b></p>
                                                    <p>Ngày tạo hóa đơn: {{ $hoadon->HOADON_NGAYTAO }}</p>
                                                    <p>Người tạo hóa đơn: {{ $hoadon->HOADON_NGUOITAO }}</p>
                                                    <p>Người mua hàng {{ $hoadon->HOADON_NGUOIMUAHANG }}</p>
                                                    <p>Tổng tiền: {{ $hoadon->HOADON_TONGTIEN_COTHUE }} VNĐ</p>
                                                    <i style="color: red">Hóa đơn chưa được thanh toán!</i>
                                                    <hr>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        

          {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.card-clickable');
                const modal = document.querySelector('#myModal');
        
                cards.forEach(function(card) {
                    card.addEventListener('click', function() {
                        modal.style.display = 'block';
                    });
                });
        
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            });
        </script>
        
          


        {{-- Thống kê --}}
        <div class="row">
            {{-- <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">
                            Hóa đơn theo tháng
                        </h6>
                    </div>
                    <div class="card-body">
                        <table id="bangtkthang">
                            <tr>
                                <th>Tháng</th>
                                <th>Năm</th>
                                <th>Tổng số lượng</th>
                            </tr>
                            @foreach ($HoaDonTheoThang as $hoadon)
                                <tr>
                                    <td class="text-center" style="padding-right: 10px;">{{ $hoadon->Thang }}</td>
                                    <td class="text-center" style="padding-right: 10px;">{{ $hoadon->Nam }}</td>
                                    <td class="text-center">{{ $hoadon->SoLuongHoaDon }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div> --}}
            {{-- Chart --}}
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">
                            Sơ đồ
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas class="chartjs-render-monitor" id="columnChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        {{-- <h1>Báo cáo thống kê</h1>
        <p>Tổng số hợp đồng: {{ $TongHopDong }}</p>
        <p>Tổng tiền của các hóa đơn: {{ $TongHoaDon }} VNĐ</p>
        <p>Các hợp đồng hoạt động: {{ $HopDongHoatDong }}</p>
        <p>Các hợp đồng ngừng hoạt động: {{ $HopDongNgungHoatDong }}</p> --}}
        {{-- <hr>
        <h2>Hóa đơn theo tháng</h2>
        <hr>
        <div class="column">
            <table id="bangtkthang">
                <tr>
                    <th>Tháng</th>
                    <th>Năm</th>
                    <th>Tổng số lượng</th>
                </tr>
                @foreach ($HoaDonTheoThang as $hoadon)
                    <tr>
                        <td class="text-center" style="padding-right: 10px;">{{ $hoadon->Thang }}</td>
                        <td class="text-center" style="padding-right: 10px;">{{ $hoadon->Nam }}</td>
                        <td class="text-center">{{ $hoadon->SoLuongHoaDon }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="column" style=" width: 500px; height: 400px;">
            <canvas id="columnChart"></canvas>
        </div>
        <div class="clear"></div> --}}
    </div>
</div>
@include('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var HoaDonTheoThang = {!! json_encode($HoaDonTheoThang) !!};

    var data = HoaDonTheoThang.map(function(hoadon) {
        return hoadon.SoLuongHoaDon;
    });

    var labels = HoaDonTheoThang.map(function(hoadon) {
        return hoadon.Thang + '/' + hoadon.Nam;
    });

    var ctx = document.getElementById('columnChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Số Lượng Hóa Đơn',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 3
            }, {
                label: 'Sự thay đổi',
                data: data,
                type: 'line',
                fill: false,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            barPercentage: 0.4,
            categoryPercentage: 0.8,
            barSpacing: 0
        }
    });
    /////////////////////////////////////////////
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
        document.querySelector('.burger-btn').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        })
        document.querySelector('.sidebar-hide').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');

        })
</script>
