
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết hóa đơn | {{$hoadon->HOADON_SO}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            width:100%;
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

    </style>
</head>
<body>
    <div class="bodyfake">
        <div class="container-fluid">
                <div class="">
                <div class="">
                    <div class="mt-2">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="logo" width="100" height="43.25">
                        </div>
                        <div class="contentcenter">
                            <h2>Hóa Đơn Dịch Vụ</h2>
                        </div>
                        </div>
                    </div>
                        <hr style="border-top: 2px dashed black;"/>
                        <div class="contentcenter">
                            Ngày tạo: {{$hoadon->HOADON_NGAYTAO}}
                        </div>
                            <div class="contentright">Số: <b style="padding-right:20px">{{$hoadon->HOADON_SO}}</b></div>
                        </div>
                        <div class="contentcenter">
                            @if ($hoadon->HOADON_TRANGTHAI == 1)
                                <b>Đã thanh toán</b>
                            @else
                                <b>Chưa thanh toán</b>
                            @endif
                        </div>
                </div>
                <div class="">
                    <table class="table mt-4 info-border border-0">
                        <tbody>
                            <tr>
                                <td class="info-td col-4"><b>Khách hàng</b></td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_TEN}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4"><b>Điện thoại</b></td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_SDT}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4"><b>Địa chỉ</b></td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->KHACHHANG_DIACHI}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4"><b>Hợp đồng số</b></td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->HOPDONG_SO}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4"><b>Gói thầu</b></td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->HOPDONG_TENGOITHAU}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4"><b>Dự án</b></td>
                                <td class="info-td col-8 fw-bold">{{$hoadon->HOPDONG_TENDUAN}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4"><b>Người tạo</b></td>
                                <td class="info-td col-8 fw-bold text-uppercase">{{$hoadon->HOADON_NGUOITAO}}</td>
                            </tr>
                            <tr>
                                <td class="info-td col-4"><b>Người mua hàng</b></td>
                                <td class="info-td col-8 fw-bold text-uppercase">{{$hoadon->HOADON_NGUOIMUAHANG}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
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
                            <td class="contentcenter">{{$cthd->STT}}</td>
                            <td>{{$cthd->NOIDUNG}}</td>
                            <td class="contentright">{{$cthd->SOLUONG}}</td>
                            <td>{{$cthd->DVT}}</td>
                            <td class="contentright">{{$cthd->DONGIA}}</td>
                            <td class="contentright">{{$cthd->THANHTIEN}}</td>
                        </tr>
                        @endforeach
                        <tr>
                        <td colspan="6" class="contentcenter">-------------------------------------------------------</td>
                        </tr>
                        <tr>
                        <td colspan="5" class="contentright">Cộng tiền hàng hóa dịch vụ:</td>
                        <td class="contentright">{{$hoadon->HOADON_TONGTIEN}} VNĐ</td>
                        </tr>
                        <tr>
                        <td colspan="5" class="contentright">Thuế {{$hoadon->HOADON_THUESUAT}} %:</td>
                        <td class="contentright">{{$hoadon->HOADON_TIENTHUE}} VNĐ</td>
                        </tr>
                        <tr>
                        <td colspan="5" class="contentright">Tổng cộng tiền thanh toán:</td>
                        <td class="contentright"><b>{{$hoadon->HOADON_TONGTIEN_COTHUE}} VNĐ</b></td>
                        </tr>
                        <tr>
                        <td colspan="6" class="contentright">Số tiền (bằng chữ):
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
    <footer>
        <hr style="border-top: 2px dashed black;"/>
        <div class="contentright"><i>*Ngày in: {{$ngayin}}</i></div>
    </footer>
</body>