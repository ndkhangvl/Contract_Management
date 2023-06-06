<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }  

th {
    background: #337ab7; 
    color:black;
    text-align:center;
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
@include('header')
<h1>Báo cáo thống kê</h1>
<p>Tổng số hợp đồng: {{ $TongHopDong }}</p>
<p>Tổng tiền của các hóa đơn: {{ $TongHoaDon }} VNĐ</p>
<p>Các hợp đồng hoạt động: {{ $HopDongHoatDong }}</p>
<p>Các hợp đồng ngừng hoạt động: {{ $HopDongNgungHoatDong }}</p>
<hr>
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
<div class="clear"></div>

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


