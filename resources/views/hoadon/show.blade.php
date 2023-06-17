<title>Chi tiết hóa đơn | {{$hoadon->HOADON_SO}}</title>
@include('header2')
@include('sidebar')
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
    
    .bodyfake{
        max-width: 900px;
        margin: auto;
        padding: 20px;
    }
    
    .contentcenter {
        text-align: center;
        
    }
    .contentright {
        text-align: right;
        
    }
    .contentleft {
        text-align: left;
        
    }

    @media print {
        
        .navbar-brand, footer, .notprint, .container, .nav-item, header{
            display:none;
        }
        
        
        #xuatpdf {
            display: block;
        }
    }
</style>
<div id="main">
    <div class="container bg-white shadow">
        <div class="bodyfake">
            <div class="notprint">
                <div class="contentleft">
                    {{--<button type="button" class="btn btn-primary" onclick="window.print()">Xuất hóa đơn</button>--}}
                    <a href="/hoadon/{{$hoadon->HOADON_ID}}/pdf" class="btn btn-primary">Xuất hóa đơn</a>
                </div>
                <div class="contentright">
                    <a href="/hoadon/{{$hoadon->HOADON_SO}}/edit"><button type="button" class="btn btn-primary">Cập nhật Thông tin</button></a>
                    <br>
                    <form action="/hoadon/{{$hoadon->HOADON_ID}}" method="post" onsubmit="return confirmDelete()">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
            <div class="container-fluid">
                    <div class="border">
                      <div class="">
                        <div class="mt-2">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="logo" width="100" height="43.25">
                              </div>
                              <div class="col text-center">
                                <h4 class="fs-2">Hóa Đơn Dịch Vụ</h4>
                              </div>
                            </div>
                          </div>
                            <hr style="border-top: 2px dashed black;"/>
                            <div class="contentcenter">
                                Ngày tạo: <b>{{$hoadon->HOADON_NGAYTAO}}</b>
                            </div>
                                <div class="contentright">Số: <b style="color: red; padding-right:20px">{{$hoadon->HOADON_SO}}</b></div>
                            </div>
                            <div class="col text-center">
                                @if ($hoadon->HOADON_TRANGTHAI == 1)
                                    <b style="color: green">Đã thanh toán</b>
                                @else
                                    <b style="color: red">Chưa thanh toán</b>
                                @endif
                            </div>
                      </div>
                      <div class="">
                        <table class="table mt-4 info-border border-0">
                            <tbody>
                                <tr class="notprint">
                                    <td class="info-td col-4">File hóa đơn</td>
                                    <td class="info-td col-8"><b><a href="{{asset('storage/'.$hoadon->HOADON_FILE)}}">{{$hoadon->HOADON_FILE}}</a></b></td>
                                </tr>
                                <tr>
                                    <td class="info-td col-4">Khách hàng</td>
                                    <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_TEN}}</td>
                                </tr>
                                <tr>
                                    <td class="info-td col-4">Điện thoại</td>
                                    <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_SDT}}</td>
                                </tr>
                                <tr>
                                    <td class="info-td col-4">Địa chỉ</td>
                                    <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_DIACHI}}</td>
                                </tr>
                                <tr>
                                    <td class="info-td col-4">Hợp đồng số</td>
                                    <td class="info-td col-8 fw-bold"><a href="/hopdong/{{$hoadon->HOPDONG_SO}}">{{$hoadon->HOPDONG_SO}}</a></td>
                                </tr>
                                <tr>
                                    <td class="info-td col-4">Gói thầu</td>
                                    <td class="info-td col-8 fw-bold">{{$hoadon->HOPDONG_TENGOITHAU}}</td>
                                </tr>
                                <tr>
                                    <td class="info-td col-4">Dự án</td>
                                    <td class="info-td col-8 fw-bold">{{$hoadon->HOPDONG_TENDUAN}}</td>
                                </tr>
                                <tr>
                                    <td class="info-td col-4">Người tạo</td>
                                    <td class="info-td col-8 fw-bold text-uppercase">{{$hoadon->HOADON_NGUOITAO}}</td>
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
                              <td class="text-end">{{$hoadon->HOADON_TONGTIEN}} VNĐ</td>
                            </tr>
                            <tr>
                              <td colspan="5" class="text-end">Thuế {{$hoadon->HOADON_THUESUAT}} %:</td>
                              <td class="text-end">{{$hoadon->HOADON_TIENTHUE}} VNĐ</td>
                            </tr>
                            <tr>
                              <td colspan="5" class="text-end">Tổng cộng tiền thanh toán:</td>
                              <td class="text-end"><b>{{$hoadon->HOADON_TONGTIEN_COTHUE}} VNĐ</b></td>
                            </tr>
                            <tr>
                              <td colspan="6" class="text-end">Số tiền (bằng chữ):
                              <b>{{$hoadon->HOADON_SOTIENBANGCHU}}</b></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xóa hóa đơn?');
    }
</script>
@include('footer')