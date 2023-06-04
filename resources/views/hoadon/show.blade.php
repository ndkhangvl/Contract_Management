<title>Chi tiết hóa đơn | {{$hoadon->HOADON_SO}}</title>
@include('header2')
@include('header')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding-left: 10px;
        padding-right: 10px;
    }
    table {
        width:90%;
    }
    .bodyfake{
        max-width: 900px;
        margin: auto;
        padding: 20px;
    }
    
    .cthdso {
        text-align: center;
    }
    .contentright {
        text-align: right;
    }

    @media print {
        .navbar-brand, footer, .notprint, .container, .nav-item{
            display:none;
        }
        
        #xuatpdf {
            display: block;
        }
    }
</style>
<div class="bodyfake">
    <div class="notprint">
        <div class="contentleft">
            <button type="button" class="btn btn-primary" onclick="window.print()">Xuất hóa đơn</button>
        </div>
        <div class="contentright">
            <a href="/hoadon/{{$hoadon->HOADON_SO}}/edit"><button type="button" class="btn btn-primary">Cập nhật Thông tin</button></a>
            <br>
            <form action="/hoadon/{{$hoadon->HOADON_ID}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
        </div>
    </div>

    <div id="xuatpdf">
        <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="logo" width="100" height="43.25">
        <hr>
        <h2 class="cthdso">Hóa đơn {{$hoadon->HOADON_SO}}</h2>
        <h4>Thuộc về hợp đồng số: <a href="/hopdong/{{$hoadon->HOPDONG_SO}}">{{$hoadon->HOPDONG_SO}}</a></h4>
        <h4>Hóa đơn số: {{$hoadon->HOADON_SO}}</h4>
        <div class="notprint">
            <h4>File: </h4> <a href="{{asset('storage/'.$hoadon->HOADON_FILE)}}">{{$hoadon->HOADON_FILE}}</a>
        </div>
        @if ($hoadon->HOADON_TRANGTHAI == 1)
            <h4>Trạng thái: Đã thanh toán</h4>
        @elseif ($hoadon->HOADON_TRANGTHAI == 0)
            <h4>Trạng thái: Chưa thanh toán</h4>
        @endif
        <h4>Tổng tiền: {{$hoadon->HOADON_TONGTIEN}} VNĐ</h4>
        <h4>Thuế suất: {{$hoadon->HOADON_THUESUAT}} %</h4>
        <h4>Tiền thuế: {{$hoadon->HOADON_TIENTHUE}} VNĐ</h4>
        <h4>Tổng tiền thực (bao gồm thuế): {{$hoadon->HOADON_TONGTIEN_COTHUE}} VNĐ</h4>
        <h4>Số tiền (bằng chữ): {{$hoadon->HOADON_SOTIENBANGCHU}}</h4>
        <h4>Người tạo: {{$hoadon->HOADON_NGUOITAO}}</h4>
        <h4>Ngày tạo: {{$hoadon->HOADON_NGAYTAO}}</h4>
        <h4>Người mua hàng: {{$hoadon->HOADON_NGUOIMUAHANG}}</h4>
        <h1>Danh sách</h1>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Nội dung</th>
                <th>Số lượng</th>
                <th>Đơn vị tính</th>
                <th>Đơn giá (VNĐ)</th>
                <th>Thành tiền (VNĐ)</th>
            </tr>
            </thead>
            @foreach ($chitiethoadon as $cthd)
            <tr>
                <td>{{$cthd->STT}}</td>
                <td>{{$cthd->NOIDUNG}}</td>
                <td>{{$cthd->SOLUONG}}</td>
                <td>{{$cthd->DVT}}</td>
                <td>{{$cthd->DONGIA}}</td>
                <td>{{$cthd->THANHTIEN}}</td>
            </tr>
            @endforeach
        </table>
        <hr>
    </div>
</div>
@include('footer')