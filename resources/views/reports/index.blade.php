<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
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
</style>
@include('header2')
@include('sidebar')
<div id="main">
    <div class="contaienr-fluid">
        <div class="d-sm flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Thống kê</h1>
        </div>
        {{-- Row Dashboard --}}
        <div class="row">
            {{-- Tổng số hợp đồng --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid var(--bs-primary);">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Tổng số hợp đồng
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $TongHopDong }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tổng tiền của các hợp đồng --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid var(--bs-success);">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Tổng tiền của các hợp đồng
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $TongHoaDon }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Các hợp đồng hoạt động --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid var(--bs-orange);">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Hợp đồng hoạt động
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $HopDongHoatDong }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Các hợp đồng ngừng hoạt động --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid var(--bs-warning);">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: .7rem;">
                                    Hợp đồng ngừng hoạt động
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $HopDongNgungHoatDong }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            Hóa đơn theo tháng
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
</script>
