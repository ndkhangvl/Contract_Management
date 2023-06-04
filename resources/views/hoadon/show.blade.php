<title>Chi tiết hóa đơn | {{$hoadon->HOADON_SO}}</title>
@include('header2')
@include('header')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    
    /* .info-border {
    border: none;
    }

    .info-border .info-td {
        border-bottom: none;
    } */

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
    {{-- <div class="container-fluid">
            <div class="border">
              <div class="">
                <div class="mt-2">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="logo" width="100" height="43.25">
                      </div>
                      <div class="col text-center">
                        <h4 class="fs-2">Hóa Đơn Bán Hàng</h4>
                      </div>
                    </div>
                  </div>
                    <hr style="border-top: 2px dashed black;"/>
              </div>
              <div class="">
                <table class="table mt-4 info-border border-0">
                    <tbody>
                        <tr>
                            <td class="info-td col-4">Thuộc về hợp đồng số</td>
                            <td class="info-td col-8 fw-bold"><a href="/hopdong/{{$hoadon->HOPDONG_SO}}">{{$hoadon->HOPDONG_SO}}</a></td>
                        </tr>
                        <tr>
                            <td class="info-td col-4">Hóa đơn số</td>
                            <td class="info-td col-8 fw-bold">{{$hoadon->HOADON_SO}}</td>
                        </tr>
                        <tr>
                            <td class="info-td col-4">File</td>
                            <td class="info-td col-8"><a href="{{asset('storage/'.$hoadon->HOADON_FILE)}}">{{$hoadon->HOADON_FILE}}</a></td>
                        </tr>
                        <tr>
                            <td class="info-td col-4">Người tạo</td>
                            <td class="info-td col-8 fw-bold text-uppercase">{{$hoadon->HOADON_NGUOITAO}}</td>
                        </tr>
                        <tr>
                            <td class="info-td col-4">Ngày tạo</td>
                            <td class="info-td col-8 fw-bold">{{$hoadon->HOADON_NGAYTAO}}</td>
                        </tr>
                        <tr>
                            <td class="info-td col-4">Người mua hàng</td>
                            <td class="info-td col-8 fw-bold text-uppercase">{{$hoadon->HOADON_NGUOIMUAHANG}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered mt-4">
                  <thead>
                    <tr>
                        <th class="text-center text-nowrap">STT</th>
                        <th class="text-center text-nowrap">Nội dung</th>
                        <th class="text-center text-nowrap">Số lượng</th>
                        <th class="text-center text-nowrap">Đơn vị tính</th>
                        <th class="text-center text-nowrap">Đơn giá (VNĐ)</th>
                        <th class="text-center text-nowrap">Thành tiền (VNĐ)</th>
                    </tr>
                  </thead>
                  <tbody>
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
                    <tr>
                      <td colspan="5" class="text-end">Cộng tiền hàng hóa dịch vụ:</td>
                      <td>{{$hoadon->HOADON_TONGTIEN}} VNĐ</td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-end">Thuế {{$hoadon->HOADON_THUESUAT}} %:</td>
                      <td>{{$hoadon->HOADON_TIENTHUE}} VNĐ</td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-end">Tổng cộng tiền thanh toán:</td>
                      <td>{{$hoadon->HOADON_TONGTIEN_COTHUE}} VNĐ</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
</div>
@include('footer')