<title>Hóa đơn</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<style>
    .content {
        margin: 15px;
        font-weight: bold;
        text-align: center;
    }

    .pagination {
        justify-content: center;
    }

    

    th {
        background: #337ab7;
        color: white;
        text-align: center;
    }

    td {
        background: #cce0df;
        

    }

    .inputstt {
    
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


    table {
        width: 100%;
        max-width: 100%;
        table-layout: fixed;
    }
</style>
@include('header2')
@include('sidebar')
<div id="main">
<div style="display: none">
    Danh sách số hóa đơn đã có
    @for ($i = 0; $i < $cnt; $i++)
        <div class="shdexists" id="{{$dssohoadon[$i]->HOADON_SO}}">{{$dssohoadon[$i]->HOADON_SO}}</div>
    @endfor
</div>
    <div class="container shadow bg-white">
        <div class="content p-3">
            <label>Chọn hợp đồng cần tạo hóa đơn</label>
            <span id="selecthopdong" onclick="selectHopDong()">
                <select name="sohopdongsl" id="sohopdongsl" class="js-example-placeholder-single js-states"
                    style="width: 20%;">
                    @foreach ($hopdongs as $hd)
                        <option value="{{ $hd->HOPDONG_SO }}">{{ $hd->HOPDONG_SO }}</option>
                    @endforeach
                </select>
            </span>
            <script>
                $(document).ready(function() {
                    $('#sohopdongsl').select2({
                        placeholder: "Chọn loại hợp đồng",
                        matcher: matchCustom,
                        allowClear: true,
                        language: {
                            noResults: function() {
                                return "Không tìm thấy kết quả";
                            }
                        }
                    });
                });
            </script>
            {{--<button type="button" class="btn btn-primary" onclick="moveToCreate()">Thêm mới (trang mới)</button>--}}
            <button type="button" class="btn btn-primary" id="btnCreateHDon" onclick="openCreateHDon()">Thêm mới hóa
                đơn</button>
            <a href="/ExportHoaDon">
                <button type="button" class="btn btn-info">
                    Tải về Excel
                </button>
            </a>
            <div id="errorsohopdong"></div>
        </div>
        <!--Modal create-->
        <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Thêm mới Hoá đơn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="/createHoaDonModal" method="POST" enctype="multipart/form-data"
                                id="hoaDonForm">
                                @csrf
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Hợp đồng:</label>
                                        <input class="form-control" type="text" name="sohopdong" id="sohopdong"
                                            value="" readonly>
                                        <span class="invalid-feedback" id="sohopdong_error"></span>
                                    </div>
                                    <div class="col">
                                    <label class="form-label fw-bold">Hóa đơn số:</label>
                                        <input class="form-control" type="text" name="sohoadon" placeholder="Số hóa đơn" id="inputsohoadon" oninput="this.value = this.value.toUpperCase()">
                                        <span class="invalid-feedback" id="sohoadon_error"></span>
                                        <div class="alert alert-danger" id="error_" style="display: none"></div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">File:</label>
                                        <input class="form-control" type="file" name="filehoadon">
                                        <span class="invalid-feedback" id="filehoadon_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Thuế:</label>
                                        <input class="form-control" id="thuesuat" type="number" name="thuesuat" min="0"
                                            value="0">
                                        <span class="invalid-feedback" id="thuesuat_error"></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Tổng tiền (VNĐ):</label>
                                        <input class="form-control" type="text" name="tongtien" id="tongtien"
                                        value="" readonly>
                                        <span class="invalid-feedback" id="tongtien_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Tiền thuế (VNĐ):</label>
                                        <input class="form-control" type="text" name="tienthue" id="tienthue"
                                        value="" readonly>
                                        <span class="invalid-feedback" id="tienthue_error"></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Tổng tiền có thuế (VNĐ):</label>
                                        <input class="form-control" type="text" name="tongtiencothue" id="tongtiencothue"
                                        value="" readonly>
                                        <span class="invalid-feedback" id="tongtiencothue_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Số tiền (bằng chữ):</label>
                                        <input class="form-control" value="" type="text"
                                        id="sotienbangchu" name="sotienbangchu" readonly>
                                        <span class="invalid-feedback" id="sotienbangchu_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Người tạo:</label>
                                        <input class="form-control" value="" type="text"
                                        name="nguoitao">
                                        <span class="invalid-feedback" id="nguoitao_error"></span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Người mua hàng:</label>
                                        <input class="form-control" value="" type="text"            
                                        name="nguoimuahang">
                                        <span class="invalid-feedback" id="nguoimuahang_error"></span>
                                    </div>
                                </div>
                                
                                <div>
                                    <hr>
                                    <label class="form-label fw-bold">Trạng thái hóa đơn:</label>
                                    <select name="trangthaihoadon">
                                        @if (old('trangthaihoadon') == 0)
                                            <option value=0 selected>Chưa thanh toán</option>
                                            <option value=1>Đã thanh toán</option>
                                        @elseif (old('trangthaihoadon') == 1)
                                            <option value=0>Chưa thanh toán</option>
                                            <option value=1 selected>Đã thanh toán</option>
                                        @endif
                                    </select>
                                    <hr>
                                </div>
                                <h1>Danh sách chi tiết</h1>
                                <hr>
                                Số lượng loại sản phẩm:
                                <input class="form-control" type="number" name="soluongchitiet"
                                    value="" min="0" id="slct" required
                                    readonly>
                                <hr>
                                <button class="btn btn-primary" onclick="addRow()" type="button">Thêm hàng</button>
                                <table id='tablechitiet' class="contentcenter">
                                    <tr>
                                        <th>STT</th>
                                        <th>Nội dung</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị tính</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Xóa</th>
                                    </tr>
                                </table>
                                <hr>
                                <div class="mb-3 mt-3 pb-2 text-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="btnsubmithd"
                                        class="btn btn-success btn-block mb-3 mt-3"><i
                                            class="fas fa-plus me-2"></i>Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal create-->
        <!-- Modal update -->
        <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Cập nhật Hoá đơn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="#" method="post" enctype="multipart/form-data" id="updateHoaDonForm" onsubmit="return confirmUpdate()">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3 mt-3">
                                    <div class="col">
                                            <label class="form-label fw-bold">Hợp đồng:</label>
                                            <input class="form-control" type="text" name="sohopdong" required readonly id="getSohopdong">
                                    </div>
                                    <div class="col">
                                            <label class="form-label fw-bold">Hóa đơn số:</label>
                                            <input class="form-control" type="text" name="sohoadon" required readonly id="inputsohoadon" oninput="this.value = this.value.toUpperCase()">
                                            <span class="invalid-feedback" id="sohoadon_error"></span>
                                            <div class="alert alert-danger" id="error_" style="display: none"></div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                        <div class="col">
                                                <label class="form-label fw-bold">File hóa đơn:</label>
                                                <a href=""  target="_blank" id="filehoadonlink"></a>
                                        </div>
                                        <div class="col">
                                                <div id="wrapper">
                                                        <label class="form-label fw-bold">Bạn có muốn cập nhật file mới không?</label>
                                                        <p><input type="radio" name="fileadd_yes_no" id="radY" value="1">Có</input></p>
                                                        <p><input type="radio" name="fileadd_yes_no" id="radN" value="0" checked>Không</input></p>
                                                </div>
                                        </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                        <div class="col">
                                                <label class="form-label fw-bold">File mới:</label>
                                                <input class="form-control" type="file" name="filehoadon" id="filehoadon" disabled required>
                                        </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                        <div class="col">
                                                <label class="form-label fw-bold">Thuế (%):</label>
                                                <input class="form-control" id="thuesuat" required type="number" name="thuesuat" min="0" >
                                        </div>
                                        <div class="col">
                                                <label class="form-label fw-bold">Tổng tiền (VNĐ):</label>
                                                <input class="form-control" required type="number" name="tongtien" id="tongtien" readonly>
                                        </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                        <div class="col">
                                                <label class="form-label fw-bold">Tiền thuế (VNĐ):</label>
                                                <input class="form-control" required type="number" name="tienthue" id="tienthue" readonly>
                                        </div>
                                        <div class="col">
                                                <label class="form-label fw-bold">Tổng tiền có thuế (VNĐ):</label>
                                                <input class="form-control" required type="number" name="tongtiencothue" id="tongtiencothue" readonly>
                                        </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                        <div class="col">
                                                <label class="form-label fw-bold">Số tiền (bằng chữ):</label>
                                                <input class="form-control" required type="text" id="sotienbangchu" name="sotienbangchu" readonly>
                                        </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                        <div class="col">
                                                <label class="form-label fw-bold">Người tạo:</label>
                                                <input class="form-control" required type="text" name="nguoitao" id="nguoitao">
                                        </div>
                                        <div class="col">
                                                <label class="form-label fw-bold">Người mua hàng:</label>
                                                <input class="form-control" required type="text" name="nguoimuahang" id="nguoimuahang">
                                        </div>
                                </div>
                                
                                <div>
                                        <hr>
                                        <label>Trạng thái hóa đơn:</label>
                                        <select name="trangthaihoadon" id="trangthaihoadon">
                                               
                                                <option value=0 selected>Chưa thanh toán</option>  
                                                <option value=1>Đã thanh toán</option> 
                                                
                                        </select>
                                        <hr>
                                </div>
                                <h1>Danh sách chi tiết</h1>
                                <hr>
                                Số lượng loại sản phẩm:
                                <input class="form-control" type="number" name="soluongchitiet" min="0" id="slct" required readonly value=""><hr>
                                <button class="btn btn-primary" onclick="addRow2()" type="button">Thêm hàng</button>

                                <table id='tablechitiet' class="contentcenter">
                                        <tr>
                                        <th>STT</th>
                                        <th>Nội dung</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị tính</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Xóa</th>
                                        </tr>
                                        <tbody id="tableBody"></tbody>
                
                                        
                                </table>
                                <hr>
                                <div class="mb-3 mt-3 pb-2 text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                onclick="">Close</button>
                                    <button class="btn btn-primary" type="submit">
                                        Cập nhật hóa đơn
                                    </button>
                                </div>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal update-->
        <!--modal detail-->
        <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Thông tin hóa đơn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <div class="table-responsive">
                            <div class="col-auto">
                                <img src="https://itvnpt.vn/wp-content/uploads/2021/11/Logo-VNPT-TP-HCM-1.png" alt="logo" width="100" height="43.25">
                            </div>
                            <div class="col text-center">
                                <h5 class="fs-3">HÓA ĐƠN DỊCH VỤ</h5>
                            </div>
                            <hr style="border-top: 2px dashed black;"/>
                            <div class="contentcenter">Ngày tạo: <b id="dtngaytao"></b></div>
                            <div class="contentright">Số: <b id="dtsohoadon" style="color: red; padding-right:20px"></b></div>
                            <div class="col text-center">
                                <b id="dttrangthai"></b>
                            </div>
                            <div class="">
                                <table class="table table-auto table-hover">
                                    <tbody>
                                        <tr class="notprint">
                                            <td class="info-td col-4">File hóa đơn</td>
                                            <td class="info-td col-8"><b><a id="dtfilelink" href="" target="_blank"></a></b></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Khách hàng</td>
                                            <td class="info-td col-8 fw-bold" id="dtkhachhang"></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Điện thoại</td>
                                            <td class="info-td col-8 fw-bold" id="dtdienthoai"></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Địa chỉ</td>
                                            <td class="info-td col-8 fw-bold" id="dtdiachi"></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Hợp đồng số</td>
                                            <td class="info-td col-8 fw-bold"><a id="dtsohopdong" href=""></a></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Gói thầu</td>
                                            <td class="info-td col-8 fw-bold" id="dtgoithau"></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Dự án</td>
                                            <td class="info-td col-8 fw-bold" id="dtduan"></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Người tạo</td>
                                            <td class="info-td col-8 fw-bold text-uppercase" id="dtnguoitao"></td>
                                        </tr>
                                        <tr>
                                            <td class="info-td col-4">Người mua hàng</td>
                                            <td class="info-td col-8 fw-bold text-uppercase" id="dtnguoimuahang"></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th class="text-center text-nowrap" style="color: black">STT</th>
                                        <th class="text-center text-nowrap" style="color: black">Nội dung</th>
                                        <th class="text-center text-nowrap" style="color: black">Số lượng</th>
                                        <th class="text-center text-nowrap" style="color: black">Đơn vị tính</th>
                                        <th class="text-center text-nowrap" style="color: black">Đơn giá (VNĐ)</th>
                                        <th class="text-center text-nowrap" style="color: black">Thành tiền (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody id="dtcthd"></tbody>
                                    <tr>
                                    <td colspan="5" class="text-end">Cộng tiền hàng hóa dịch vụ:</td>
                                    <td class="text-end"><span id="dttongtien"></span> VNĐ</td>
                                    </tr>
                                    <tr>
                                    <td colspan="5" class="text-end">Thuế <span id="dtthuesuat"></span> %:</td>
                                    <td class="text-end"><span id="dttienthue"></span> VNĐ</td>
                                    </tr>
                                    <tr>
                                    <td colspan="5" class="text-end">Tổng cộng tiền thanh toán:</td>
                                    <td class="text-end"><b><span id="dttongtiencothue"></span> VNĐ</b></td>
                                    </tr>
                                    <tr>
                                    <td colspan="6" class="text-end">Số tiền (bằng chữ):
                                    <b><span id="dtsotienbangchu"></span></b></td>
                                    </tr>
                                </tbody>
                                </table>
                                <hr>
                                <div class="mb-3 mt-3 pb-2 text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                onclick="">Close</button>
                                    <a class="btn btn-primary" href="" id="dtbtnxuatpdf">
                                        Xuất hóa đơn
                                    </a>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal detail-->
        <hr />
        <h1>Danh sách Hóa đơn</h1>
        <hr />
        <form>
            <div class="content">
                <h5>Nhập số hợp đồng/hóa đơn cần tìm</h5>
                <input class="" name="find" id="find" placeholder="Số hợp đồng/hóa đơn" value="{{ request()->input('find') }}">
                <select name="state">
                    @if(request()->has('state'))
                        @switch(request()->input('state'))
                            @case('2')
                                <option value=2 selected>Toàn bộ</option>
                                <option value=0>Chưa thanh toán</option>
                                <option value=1>Đã thanh toán</option>
                                @break
                            @case('0')
                                <option value=2>Toàn bộ</option>
                                <option value=0 selected>Chưa thanh toán</option>
                                <option value=1>Đã thanh toán</option>
                                @break  
                            @case('1')
                                <option value=2>Toàn bộ</option>
                                <option value=0>Chưa thanh toán</option>
                                <option value=1 selected>Đã thanh toán</option>
                                @break  
                        @endswitch
                    @else
                        <option value=2 selected>Toàn bộ</option>
                        <option value=0>Chưa thanh toán</option>
                        <option value=1>Đã thanh toán</option>
                    @endif
                </select>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <table id="danhsachhoadon" class="table table-striped table-hover">
            <tr>
                <th style="background: #077DCE">Hóa đơn số</th>
                <th style="background: #077DCE">Thuộc hợp đồng</th>
                <th style="background: #077DCE">Trạng thái</th>
                <th style="background: #077DCE">Tổng thanh toán</th>
                <th style="background: #077DCE">Ngày tạo hóa đơn</th>
                <th style="background: #077DCE">Chi tiết</th>
            </tr>
            @foreach ($hoadons as $hdd)
                <tr>
                    <td>{{ $hdd->HOADON_SO }}</td>
                    <td>{{ $hdd->HOPDONG_SO }}</td>
                    @if ($hdd->HOADON_TRANGTHAI == 1)
                        <td>Đã thanh toán</td>
                    @else
                        <td><b style="color: red">Chưa thanh toán</b></td>
                    @endif
                    <td>{{ $hdd->HOADON_TONGTIEN_COTHUE }} VNĐ</td>
                    <td>{{ $hdd->HOADON_NGAYTAO }}</td>
                    <td class="text-center w-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <form>
                                {{--<a href="/hoadon/{{ $hdd->HOADON_SO }}"
                                    class="btn btn-success btn-icon-only" aria-label="Xem chi tiết"
                                    title="Xem chi tiết"><i class="fas fa-file-signature"
                                        style="color: #000000;"></i>
                                </a>--}}
                                <a href="" data-id="{{$hdd->HOADON_ID}}" class="btn btn-success btn-icon-only" 
                                    data-bs-toggle="modal" data-bs-target="#detailModal">
                                    <i class="fas fa-file-signature" style="color: #000000;"></i>
                                </a>
                            </form>
                            {{--<a href="/hoadon/{{ $hdd->HOADON_SO }}/edit"
                                class="btn btn-info btn-icon-only" aria-label="Sửa"
                                onclick="" title="Sửa hóa đơn"><i class="fas fa-edit"></i>
                            </a>--}}
                            <form>
                            <a href="" data-id="{{$hdd->HOADON_ID}}" class="btn btn-info btn-icon-only" 
                                data-bs-toggle="modal" data-bs-target="#updateModal"
                                onclick="
                                    var form = document.getElementById('updateHoaDonForm');
                                    form.action = '/updateHoaDonModal/{{$hdd->HOADON_ID}}';
                                ">
                                <i class="fas fa-edit"></i>
                            </a>
                            </form>
                            <form action="/hoadon/{{$hdd->HOADON_ID}}" method="post" onsubmit="return confirmDelete()">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" id="submitDel"  title="Xóa hóa đơn"
                                        class="btn btn-warning btn-icon-only">
                                        <i class="fas fa-trash"></i>
                                    </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <hr>
        <div>
            {{ $hoadons->appends(request()->all())->links() }}
        </div>
        <script>
            function confirmDelete() {
                return confirm('Bạn có chắc chắn muốn xóa hóa đơn?');
            }
            function confirmUpdate(){
                calHoaDon2();
            }
            $(document).ready(function() {
                $('#hoaDonForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    var form = $('#hoaDonForm')[0];
                    // Create an FormData object 
                    var data = new FormData(form);

                    $.ajax({
                        url: $(this).attr("action"),
                        type: 'POST',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false, // Important!
                        contentType: false,
                        success: function(success) {
                            if (success) {
                                alert('Thêm mới hóa đơn thành công');
                                $('#hoaDonForm input').val('');
                                location.reload();
                            } else {
                                alert('Thất bại: Số hóa đơn đã tồn tại! Vui lòng nhập lại');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                $('.invalid-feedback').empty();
                                var response = JSON.parse(xhr.responseText);
                                var errors = response.errors;
                                for (var field in errors) {
                                    if (errors.hasOwnProperty(field)) {
                                        var errorMessage = errors[field][0];
                                        $('#' + field + '_error').text(errorMessage).show();
                                    }
                                }
                            }
                        }
                    });
                });
                $('#createModal').on('show.bs.modal', function(event) {
                    $('#createModal #tablechitiet tr').slice(1).remove();
                    $('#slct').val(0);
                });
                $('#updateModal').on('show.bs.modal', function(event) {
                    $('#updateModal #tablechitiet tr').slice(1).remove();
                    var button = $(event.relatedTarget); 
                    var itemId = button.data('id'); 

                    var sohopdong = $('#updateModal #getSohopdong');
                    var inputsohoadon = $('#updateModal #inputsohoadon');
                    var filehoadonlink = $('#updateModal #filehoadonlink');
                    var tongtien = $('#updateModal #tongtien');
                    var thuesuat = $('#updateModal #thuesuat');
                    var tienthue = $('#updateModal #tienthue');
                    var tongtiencothue = $('#updateModal #tongtiencothue');
                    var sotienbangchu = $('#updateModal #sotienbangchu');
                    var nguoitao = $('#updateModal #nguoitao');
                    var nguoimuahang = $('#updateModal #nguoimuahang');
                    var trangthaihoadon = $('#updateModal #trangthaihoadon');
                    var slct = $('#updateModal #slct');
                    // Make an AJAX request to get the item details
                    $.ajax({
                        url: '/gethoadon/' + itemId,
                        type: 'GET',
                        success: function(response) {
                            var hoadon = response.hoadon;
                            var cthd = response.chitiethoadon;
                            var cntcthd = response.cntcthd;

                            // Update the modal content with the item details
                            sohopdong.val(hoadon.HOPDONG_SO);
                            inputsohoadon.val(hoadon.HOADON_SO);
                            filehoadonlink.attr('href', '{{ asset("storage/") }}' + "/" + hoadon.HOADON_FILE);
                            filehoadonlink.text(hoadon.HOADON_FILE);
                            tongtien.val(hoadon.HOADON_TONGTIEN);
                            thuesuat.val(hoadon.HOADON_THUESUAT);
                            tienthue.val(hoadon.HOADON_TIENTHUE);
                            tongtiencothue.val(hoadon.HOADON_TONGTIEN_COTHUE);
                            sotienbangchu.val(hoadon.HOADON_SOTIENBANGCHU);
                            nguoitao.val(hoadon.HOADON_NGUOITAO);
                            nguoimuahang.val(hoadon.HOADON_NGUOIMUAHANG);
                            trangthaihoadon.val(hoadon.HOADON_TRANGTHAI);
                            slct.val(cntcthd);

                            for (var i = 1; i <= cntcthd; i++) {
                                var row = '<tr>' +
                                    '<td><input type="text" class="inputstt" name="stt' + i + '" id="stt' + i + '" value="" readonly class="inputstt"></td>' +
                                    '<td><input type="text" name="noidung' + i + '" id="noidung' + i + '" value=""></td>' +
                                    '<td><input type="number" class="soluong inputstt" name="soluong' + i + '" id="soluong' + i + '" value="" min="0"></td>' +
                                    '<td><input type="text" name="donvitinh' + i + '" id="donvitinh' + i + '" value=""></td>' +
                                    '<td><input type="number" class="dongia" name="dongia' + i + '" id="dongia' + i + '" value="" min="0"></td>' +
                                    '<td><input type="number" class="thanhtien" name="thanhtien' + i + '" readonly id="thanhtien' + i + '" value=""></td>' +
                                    '<td><button type="button" name="btnxoa' + i + '" id="btnxoa' + i + '" class="btn btn-danger" onclick="delRow2(this.id.replace(\'btnxoa\',\'\'))">Xóa</button></td>' +
                                    '</tr>';

                                $('#tableBody').append(row);
                            }
                            for (var i = 0; i < cthd.length; i++) {
                                var item = cthd[i];
                                var strstt = 'stt'+(i+1);
                                var strnd = 'noidung'+(i+1);
                                var strsl = 'soluong'+(i+1);
                                var strdvt = 'donvitinh'+(i+1);
                                var strdg = 'dongia'+(i+1);
                                var strtt = 'thanhtien'+(i+1);

                                var stt = $('#tableBody #'+strstt);
                                var nd = $('#tableBody #'+strnd);
                                var sl = $('#tableBody #'+strsl);
                                var dvt = $('#tableBody #'+strdvt);
                                var dg = $('#tableBody #'+strdg);
                                var tt = $('#tableBody #'+strtt);
                                stt.val(item.STT);
                                nd.val(item.NOIDUNG);
                                sl.val(item.SOLUONG);
                                dvt.val(item.DVT);
                                dg.val(item.DONGIA);
                                tt.val(item.THANHTIEN);
                            }
                            var modal = document.getElementById("updateModal");
                            var soluongs = modal.querySelectorAll('.soluong');
                            var dongias = modal.querySelectorAll('.dongia');
                            for (var i = 0; i < soluongs.length; i++) {
                                soluongs[i].addEventListener('input', calHoaDon2);
                                dongias[i].addEventListener('input', calHoaDon2);
                            }
                        }
                    });
                });

                $('#detailModal').on('show.bs.modal', function(event) {
                    $('#dtcthd').empty();
                    var button = $(event.relatedTarget); 
                    var itemId = button.data('id'); 

                    var ngaytao = $('#detailModal #dtngaytao');
                    var sohoadon = $('#detailModal #dtsohoadon');
                    var trangthai = $('#detailModal #dttrangthai');
                    var filelink = $('#detailModal #dtfilelink');
                    var khachhang = $('#detailModal #dtkhachhang');
                    var dienthoai = $('#detailModal #dtdienthoai');
                    var diachi = $('#detailModal #dtdiachi');
                    var sohopdong = $('#detailModal #dtsohopdong');
                    var goithau = $('#detailModal #dtgoithau');
                    var duan = $('#detailModal #dtduan');
                    var nguoitao = $('#detailModal #dtnguoitao');
                    var nguoimuahang = $('#detailModal #dtnguoimuahang');
                    var tongtien = $('#detailModal #dttongtien');
                    var thuesuat = $('#detailModal #dtthuesuat');
                    var tienthue = $('#detailModal #dttienthue');
                    var tongtiencothue = $('#detailModal #dttongtiencothue');
                    var sotienbangchu = $('#detailModal #dtsotienbangchu');
                    var xuathoadon = $('#detailModal #dtbtnxuatpdf');
                    // Make an AJAX request to get the item details
                    $.ajax({
                        url: '/gethoadon/' + itemId,
                        type: 'GET',
                        success: function(response) {
                            var hoadon = response.hoadon2;
                            var cthd = response.chitiethoadon2;
                            var cntcthd = response.cntcthd;

                            ngaytao.text(hoadon.HOADON_NGAYTAO);
                            sohoadon.text(hoadon.HOADON_SO);
                            if(hoadon.HOADON_TRANGTHAI == 1){
                                trangthai.css('color', 'green');
                                trangthai.text("Đã thanh toán");
                            } else {
                                trangthai.css('color', 'red');
                                trangthai.text("Chưa thanh toán");
                            }
                            filelink.attr('href', '{{ asset("storage/") }}' + "/" + hoadon.HOADON_FILE);
                            filelink.text(hoadon.HOADON_FILE);
                            khachhang.text(hoadon.KHACHHANG_TEN);
                            dienthoai.text(hoadon.KHACHHANG_SDT);
                            diachi.text(hoadon.KHACHHANG_DIACHI);
                            sohopdong.attr('href', '/hopdong' + "/" + hoadon.HOPDONG_SO);
                            sohopdong.text(hoadon.HOPDONG_SO);
                            goithau.text(hoadon.HOPDONG_TENGOITHAU);
                            duan.text(hoadon.HOPDONG_TENDUAN);
                            nguoitao.text(hoadon.HOADON_NGUOITAO);
                            nguoimuahang.text(hoadon.HOADON_NGUOIMUAHANG);
                            tongtien.text(hoadon.HOADON_TONGTIEN);
                            thuesuat.text(hoadon.HOADON_THUESUAT);
                            tienthue.text(hoadon.HOADON_TIENTHUE);
                            tongtiencothue.text(hoadon.HOADON_TONGTIEN_COTHUE);
                            sotienbangchu.text(hoadon.HOADON_SOTIENBANGCHU);

                            for (var i = 0; i < cthd.length; i++) {
                                var item = cthd[i];
                                var tr = $("<tr>");
                                var tdSTT = $("<td>").text(item.STT);
                                tr.append(tdSTT);
                                var tdNOIDUNG = $("<td>").text(item.NOIDUNG);
                                tr.append(tdNOIDUNG);
                                var tdSOLUONG = $("<td>").text(item.SOLUONG);
                                tr.append(tdSOLUONG);
                                var tdDVT = $("<td>").text(item.DVT);
                                tr.append(tdDVT);
                                var tdDONGIA = $("<td>").text(item.DONGIA);
                                tr.append(tdDONGIA);
                                var tdTHANHTIEN = $("<td>").text(item.THANHTIEN);
                                tr.append(tdTHANHTIEN);
                                $("#dtcthd").append(tr);
                            }

                            xuathoadon.attr('href', '/hoadon' + "/" + hoadon.HOADON_ID+ "/" + "pdf");
                        }
                    });
                });

                $('#updateHoaDonForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    var form = $('#updateHoaDonForm')[0];
                    // Create an FormData object 
                    var data = new FormData(form);
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false, // Important!
                        contentType: false,
                    });
                    location.reload();
                });
            });
        </script>
        <script>
            function moveToCreate() {
                if (document.getElementById("sohopdongsl").value == "-1")
                    document.getElementById("errorsohopdong").innerHTML = 'Chưa chọn hợp đồng cần tạo hóa đơn';
                else {
                    window.location = '/hoadon/create?hopdong=' + document.getElementById("sohopdongsl").value;
                }
            }

            function selectHopDong() {
                if (document.getElementById("sohopdongsl").value == "-1" || document.getElementById("sohopdongsl").value == "") {
                    
                    document.getElementById("sohopdong").value = "";
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-toggle", "");
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-target", "");
                } else {
                    
                    document.getElementById("sohopdong").value = document.getElementById("sohopdongsl").value;
                    document.getElementById("errorsohopdong").innerHTML = '';
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-toggle", "modal");
                    document.getElementById("btnCreateHDon").setAttribute("data-bs-target", "#createModal");
                }
            }

            function openCreateHDon() {
                selectHopDong();
                if (document.getElementById("sohopdongsl").value == "-1") {
                    document.getElementById("errorsohopdong").innerHTML = 'Chưa chọn hợp đồng cần tạo hóa đơn';
                }
            }

            function calHoaDon() {
                $cnt = document.getElementById("slct").value;
                $thue = document.getElementById("thuesuat").value;
                $tongtien = 0;
                $tienthue = 0;
                $tongtiencothue = 0;
                for ($i = 1; $i <= $cnt; $i++) {
                    $sluong = "soluong" + $i;
                    $dgia = "dongia" + $i;
                    $ttien = "thanhtien" + $i;
                    $sl = document.getElementById($sluong).value;
                    $dg = document.getElementById($dgia).value;
                    $cal = parseInt($sl) * parseInt($dg);
                    if (isNaN($cal)) $cal = 0;
                    document.getElementById($ttien).value = $cal;
                    $tongtien = $tongtien + $cal;
                }
                $tienthue = $tongtien / 100 * $thue;
                $tongtiencothue = $tongtien + $tienthue;
                document.getElementById("tongtien").value = $tongtien;
                document.getElementById("tienthue").value = $tienthue;
                document.getElementById("tongtiencothue").value = $tongtiencothue;
                to_VNese_currency();
            }

            document.getElementById("thuesuat").addEventListener('input', calHoaDon);

            function addRow() {
                $table = document.getElementById("tablechitiet");
                $length = document.getElementById("tablechitiet").rows.length;

                $row = $table.insertRow($length);

                $cell1 = $row.insertCell(0);
                $stt = document.createElement('input');
                $stt.value = $length;
                $stt.readOnly = true;
                $stt.type = "text";
                $stt.name = "stt" + $length;
                $stt.id = "stt" + $length;
                $stt.className = "inputstt";
                $cell1.appendChild($stt);

                $cell2 = $row.insertCell(1);
                $noidung = document.createElement('input');
                $noidung.type = "text";
                $noidung.name = "noidung" + $length;
                $noidung.id = "noidung" + $length;
                $cell2.appendChild($noidung);

                $cell3 = $row.insertCell(2);
                $soluong = document.createElement('input');
                $soluong.type = "number";
                $soluong.min = 0;
                $soluong.name = "soluong" + $length;
                $soluong.id = "soluong" + $length;
                $soluong.className = "soluong inputstt";
                $soluong.addEventListener('input', calHoaDon);
                $cell3.appendChild($soluong);

                $cell4 = $row.insertCell(3);
                $donvitinh = document.createElement('input');
                $donvitinh.type = "text";
                $donvitinh.name = "donvitinh" + $length;
                $donvitinh.id = "donvitinh" + $length;
                $cell4.appendChild($donvitinh);

                $cell5 = $row.insertCell(4);
                $dongia = document.createElement('input');
                $dongia.type = "number";
                $dongia.min = "0";
                $dongia.name = "dongia" + $length;
                $dongia.id = "dongia" + $length;
                $dongia.className = "dongia";
                $dongia.addEventListener('input', calHoaDon);
                $cell5.appendChild($dongia);

                $cell6 = $row.insertCell(5);
                $thanhtien = document.createElement('input');
                $thanhtien.readOnly = true;
                $thanhtien.type = "text";
                $thanhtien.name = "thanhtien" + $length;
                $thanhtien.id = "thanhtien" + $length;
                $cell6.appendChild($thanhtien);

                $cell7 = $row.insertCell(6);
                $xoa = document.createElement('button');
                $xoa.id = "btnxoa" + $length;
                $xoa.name = "btnxoa" + $length;
                $xoa.innerHTML = "Xóa";
                $xoa.className = 'btn btn-danger';

                $xoa.setAttribute('onclick', 'delRow(this.id.replace("btnxoa",""))');
                $xoa.setAttribute('type', 'button');
                $cell7.appendChild($xoa);

                document.getElementById("slct").value = $length;
                calHoaDon();

                var soluongs = document.getElementsByClassName('soluong');
                var dongias = document.getElementsByClassName('dongia');
                for (var i = 0; i < soluongs.length; i++) {
                    soluongs[i].addEventListener('input', calHoaDon);
                    dongias[i].addEventListener('input', calHoaDon);
                }
            }

            function delRow(x) {

                $table = document.getElementById("tablechitiet");
                $length = document.getElementById("tablechitiet").rows.length;

                for ($i = parseInt(x); $i < $length - 1; $i++) {
                    $sohang = parseInt($i);
                    $sohangsau = parseInt($i) + 1;
                    document.getElementById("noidung" + $sohang).value = document.getElementById("noidung" + $sohangsau).value;
                    document.getElementById("soluong" + $sohang).value = document.getElementById("soluong" + $sohangsau).value;
                    document.getElementById("donvitinh" + $sohang).value = document.getElementById("donvitinh" + $sohangsau)
                        .value;
                    document.getElementById("dongia" + $sohang).value = document.getElementById("dongia" + $sohangsau).value;
                    document.getElementById("thanhtien" + $sohang).value = document.getElementById("thanhtien" + $sohangsau)
                        .value;
                }

                $table.deleteRow($length - 1);
                document.getElementById("slct").value = $length - 2;
                calHoaDon();
            }

            /*************************** */
            /*Test tiền sang tiền chữ VND*/
            /*************************** */
            const defaultNumbers = ' hai ba bốn năm sáu bảy tám chín';
            const chuHangDonVi = ('1 một' + defaultNumbers).split(' ');
            const chuHangChuc = ('lẻ mười' + defaultNumbers).split(' ');
            const chuHangTram = ('không một' + defaultNumbers).split(' ');

            function convert_block_three(number) {
                if (number == '000') return '';
                var _a = number + ''; //Convert biến 'number' thành kiểu string
                //Kiểm tra độ dài của khối
                switch (_a.length) {
                    case 0:
                        return '';
                    case 1:
                        return chuHangDonVi[_a];
                    case 2:
                        return convert_block_two(_a);
                    case 3:
                        var chuc_dv = '';
                        if (_a.slice(1, 3) != '00') {
                            chuc_dv = convert_block_two(_a.slice(1, 3));
                        }
                        var tram = chuHangTram[_a[0]] + ' trăm';
                        return tram + ' ' + chuc_dv;
                }
            }

            function convert_block_two(number) {
                var dv = chuHangDonVi[number[1]];
                var chuc = chuHangChuc[number[0]];
                var append = '';
                // Nếu chữ số hàng đơn vị là 5
                if (number[0] > 0 && number[1] == 5) {
                    dv = 'lăm'
                }
                // Nếu số hàng chục lớn hơn 1
                if (number[0] > 1) {
                    append = ' mươi';
                    if (number[1] == 1) {
                        dv = ' mốt';
                    }
                }
                return chuc + '' + append + ' ' + dv;
            }

            const dvBlock = '1 nghìn triệu tỷ'.split(' ');

            function to_VNese_currency() {
                var number = document.getElementById("tongtiencothue").value;
                var str = parseInt(number) + '';
                var i = 0;
                var arr = [];
                var index = str.length;
                var result = [];
                var rsString = '';

                if (index == 0 || str == 'NaN') {
                    return '';
                }

                // Chia chuỗi số thành một mảng từng khối có 3 chữ số
                while (index >= 0) {
                    arr.push(str.substring(index, Math.max(index - 3, 0)));
                    index -= 3;
                }

                // Lặp từng khối trong mảng trên và convert từng khối đấy ra chữ Việt Nam
                for (i = arr.length - 1; i >= 0; i--) {
                    if (arr[i] != '' && arr[i] != '000') {
                        result.push(convert_block_three(arr[i]));

                        // Thêm đuôi của mỗi khối
                        if (dvBlock[i]) {
                            result.push(dvBlock[i]);
                        }
                    }
                }

                // Join mảng kết quả lại thành chuỗi string
                rsString = result.join(' ');

                // Trả về kết quả kèm xóa những ký tự thừa
                finalval = rsString.replace(/[0-9]/g, '').replace(/ /g, ' ').replace(/ $/, '') + " đồng";
                finalval = finalval.charAt(0).toUpperCase() + finalval.slice(1);
                document.getElementById("sotienbangchu").value = finalval;

            };

            function matchCustom(params, data) {
                if ($.trim(params.term) === '') {
                    return data;
                }

                var searchTerm = params.term.toLowerCase();
                var dataText = data.text.toLowerCase();

                if (dataText.indexOf(searchTerm) > -1) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.text += ' (phù hợp)';
                    return modifiedData;
                }

                return null;
            }
            function convert_vi_to_en(str) {
                str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
                str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
                str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
                str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
                str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
                str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
                str = str.replace(/đ/g, "d");
                str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
                str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
                str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
                str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
                str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
                str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
                str = str.replace(/Đ/g, "D");
                str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
                str = str.replace(/  +/g, ' ');
                return str;
            }
            $(document).on('keyup', '[id=inputsohoadon]', function () {
                var obj = $(this);
                $('[id=inputsohoadon]').val(convert_vi_to_en(obj.val()).toUpperCase().replace(/ /g, "-"));
            });

            function checkSHDExists() {
                var hoadontontai = document.getElementsByClassName('shdexists');
                $shd = document.getElementById("inputsohoadon").value;
                document.getElementById("error_").setAttribute('style','display: none');
                document.getElementById("error_").innerHTML = "";
                document.getElementById("btnsubmithd").removeAttribute('disabled', 'true');
                for(var i=0; i < hoadontontai.length; i++){
                        if ($shd == hoadontontai[i].id){
                                document.getElementById("error_").removeAttribute('style','display: none');
                                document.getElementById("error_").innerHTML = "Số hóa đơn đã tồn tại, vui lòng nhập lại!";
                                document.getElementById("btnsubmithd").setAttribute('disabled', 'true');
                        }
                }
            }
            document.getElementById("inputsohoadon").addEventListener('input', checkSHDExists);
///////////////////////////////////////////////////////////////////////////////////////////
//////////////////////Phan nay cua Modal UPDATE........lam gon lai sau huhu////////////////
///////////////////////////////////////////////////////////////////////////////////////////
            function calHoaDon2() {
                var modal = document.getElementById("updateModal");
                var cnt = modal.querySelector("#slct").value;
                var thue = modal.querySelector("#thuesuat").value;
                var tongtien = 0;
                var tienthue = 0;
                var tongtiencothue = 0;
                
                for (var i = 1; i <= cnt; i++) {
                    var sluong = "soluong" + i;
                    var dgia = "dongia" + i;
                    var ttien = "thanhtien" + i;
                    
                    var sl = modal.querySelector("#" + sluong).value;
                    var dg = modal.querySelector("#" + dgia).value;
                    
                    var cal = parseInt(sl) * parseInt(dg);
                    if (isNaN(cal)) cal = 0;
                    
                    modal.querySelector("#" + ttien).value = cal;
                    tongtien = tongtien + cal;
                }
                
                tienthue = tongtien / 100 * thue;
                tongtiencothue = tongtien + tienthue;
                
                modal.querySelector("#tongtien").value = tongtien;
                modal.querySelector("#tienthue").value = tienthue;
                modal.querySelector("#tongtiencothue").value = tongtiencothue;
                
                to_VNese_currency2();
            }

            document.querySelector("#updateModal #thuesuat").addEventListener('input', calHoaDon2);
            
            function addRow2() {
                var modal = document.getElementById("updateModal");
                var table = modal.querySelector("#tablechitiet");
                var length = table.rows.length;

                var row = table.insertRow(length);

                var cell1 = row.insertCell(0);
                var stt = document.createElement('input');
                stt.value = length;
                stt.readOnly = true;
                stt.type = "text";
                stt.name = "stt" + length;
                stt.id = "stt" + length;
                stt.className = "inputstt";
                cell1.appendChild(stt);

                var cell2 = row.insertCell(1);
                var noidung = document.createElement('input');
                noidung.type = "text";
                noidung.name = "noidung" + length;
                noidung.id = "noidung" + length;
                cell2.appendChild(noidung);

                var cell3 = row.insertCell(2);
                var soluong = document.createElement('input');
                soluong.type = "number";
                soluong.min = 0;
                soluong.name = "soluong" + length;
                soluong.id = "soluong" + length;
                soluong.className = "soluong inputstt";
                soluong.addEventListener('input', calHoaDon);
                cell3.appendChild(soluong);

                var cell4 = row.insertCell(3);
                var donvitinh = document.createElement('input');
                donvitinh.type = "text";
                donvitinh.name = "donvitinh" + length;
                donvitinh.id = "donvitinh" + length;
                cell4.appendChild(donvitinh);

                var cell5 = row.insertCell(4);
                var dongia = document.createElement('input');
                dongia.type = "number";
                dongia.min = "0";
                dongia.name = "dongia" + length;
                dongia.id = "dongia" + length;
                dongia.className = "dongia";
                dongia.addEventListener('input', calHoaDon);
                cell5.appendChild(dongia);

                var cell6 = row.insertCell(5);
                var thanhtien = document.createElement('input');
                thanhtien.readOnly = true;
                thanhtien.type = "text";
                thanhtien.name = "thanhtien" + length;
                thanhtien.id = "thanhtien" + length;
                cell6.appendChild(thanhtien);

                var cell7 = row.insertCell(6);
                var xoa = document.createElement('button');
                xoa.id = "btnxoa" + length;
                xoa.name = "btnxoa" + length;
                xoa.innerHTML = "Xóa";
                xoa.className = 'btn btn-danger';

                xoa.setAttribute('onclick', 'delRow2(this.id.replace("btnxoa",""))');
                xoa.setAttribute('type', 'button');
                cell7.appendChild(xoa);

                modal.querySelector("#slct").value = length;
                calHoaDon2();

                var modal = document.getElementById("updateModal");
                var soluongs = modal.querySelectorAll('.soluong');
                var dongias = modal.querySelectorAll('.dongia');
                for (var i = 0; i < soluongs.length; i++) {
                    soluongs[i].addEventListener('input', calHoaDon2);
                    dongias[i].addEventListener('input', calHoaDon2);
                }
            }

            function delRow2(x) {
                var modal = document.querySelector("#updateModal");
                var table = modal.querySelector("#tablechitiet");
                var length = table.rows.length;

                for (var i = parseInt(x); i < length - 1; i++) {
                    var sohang = parseInt(i);
                    var sohangsau = parseInt(i) + 1;
                    modal.querySelector("#noidung" + sohang).value = modal.querySelector("#noidung" + sohangsau).value;
                    modal.querySelector("#soluong" + sohang).value = modal.querySelector("#soluong" + sohangsau).value;
                    modal.querySelector("#donvitinh" + sohang).value = modal.querySelector("#donvitinh" + sohangsau).value;
                    modal.querySelector("#dongia" + sohang).value = modal.querySelector("#dongia" + sohangsau).value;
                    modal.querySelector("#thanhtien" + sohang).value = modal.querySelector("#thanhtien" + sohangsau).value;
                }

                table.deleteRow(length - 1);
                modal.querySelector("#slct").value = length - 2;
                calHoaDon2();
            }

            function to_VNese_currency2() {
                var modal = document.querySelector("#updateModal");
                var number = modal.querySelector("#tongtiencothue").value;
                var str = parseInt(number) + '';
                var i = 0;
                var arr = [];
                var index = str.length;
                var result = [];
                var rsString = '';

                if (index == 0 || str == 'NaN') {
                    return '';
                }

                // Chia chuỗi số thành một mảng từng khối có 3 chữ số
                while (index >= 0) {
                    arr.push(str.substring(index, Math.max(index - 3, 0)));
                    index -= 3;
                }

                // Lặp từng khối trong mảng trên và convert từng khối đấy ra chữ Việt Nam
                for (i = arr.length - 1; i >= 0; i--) {
                    if (arr[i] != '' && arr[i] != '000') {
                        result.push(convert_block_three(arr[i]));

                        // Thêm đuôi của mỗi khối
                        if (dvBlock[i]) {
                            result.push(dvBlock[i]);
                        }
                    }
                }

                // Join mảng kết quả lại thành chuỗi string
                rsString = result.join(' ');

                // Trả về kết quả kèm xóa những ký tự thừa
                finalval = rsString.replace(/[0-9]/g, '').replace(/ /g, ' ').replace(/ $/, '') + " đồng";
                finalval = finalval.charAt(0).toUpperCase() + finalval.slice(1);
                modal.querySelector("#sotienbangchu").value = finalval;

            };
            var modal = document.querySelector("#updateModal");
            $radButtons = modal.querySelectorAll("input[name=fileadd_yes_no]");
            $radButtons.forEach(rb=>rb.addEventListener("change",function(){
                    //alert("Change");
                    //console.log("value of rad: " + document.querySelector('input[name="fileadd_yes_no"]:checked').value);
                    if(modal.querySelector('input[name="fileadd_yes_no"]:checked').value == "1"){
                            modal.querySelector("#filehoadon").removeAttribute("disabled");
                            //console.log("Cho phep them file");
                    }
                    else if (modal.querySelector('input[name="fileadd_yes_no"]:checked').value == "0"){
                            modal.querySelector("#filehoadon").setAttribute("disabled", "disabled");
                            //console.log("KHONG cho phep them file");
                            modal.querySelector("#filehoadon").value = null;
                    }
            }));

        </script>
    </div>
</div>
@include('footer')
