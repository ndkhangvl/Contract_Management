<!DOCTYPE html>
<html>

<head>
    <title>Danh mục loại khách hàng</title>
    <style>
        .selected {
            background-color: #077DCE;
        }

        #infoForm select {
            margin-bottom: 20px; b
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
    @include('sidebar')
    @include('header2')
    <div id="main">
        <div class="container bg-white shadow p-2">
            <h1>Loại khách hàng</h1>
            <div class="d-flex p-2">
                <div class="me-1">
                    <a href="/khachhang" class="btn text-white" style="background-color: #435EBE;">
                        <i class="fas fa-list" style="margin-right: 5px;"></i>Khách hàng
                    </a>
                </div>
                <div class="mb-2 ms-1">
                    <button type="button" class="btn text-white" style="background-color: #435EBE;"
                    data-bs-toggle="modal" data-bs-target="#addloaikh">
                <i class="fas fa-plus" style="margin-right: 5px;"></i>Thêm mới
            </button>
                </div>
            </div>
            <div class="container shadow">
            <div id="tableContainer">

            </div>
            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            </div>
            <hr />
            <div id="data-container">
                <div id="formTab" style="display: none;">
                </div>
                <table class="table table-striped table-hover" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center text-nowrap">ID</th>
                            <th class="text-center text-nowrap">Mã</th>
                            <th class="text-center text-nowrap">Tên loại khách hàng</th>
                            <th class="text-center text-nowrap">ID CSS</th>
                            <th class="text-center text-nowrap">Xóa</th>
                            <th class="text-center text-nowrap">Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loaikhachhangs as $loaikhachhang)
                      <tr id="row{{ $loaikhachhang->LOAIKHACHHANG_ID }}" class="editable-row">
                                <td class="text-center align-middle text-truncate  test">{{ $loaikhachhang->LOAIKHACHHANG_ID }}</td>
                                <td class="text-center align-middle text-truncate test">{{ $loaikhachhang->LOAIKHACHHANG_MA }}</td>
                                <td class="text-center align-middle text-truncate test" style="max-width: 100px">{{ $loaikhachhang->LOAIKHACHHANG_TEN }}</td>
                                <td class="text-center align-middle text-truncate test">{{ $loaikhachhang->LOAIKHACHHANG_ID_CSS }}</td>
                                <td class="text-center align-middle" style="max-width: 50px">
                                    <form id="deleteform" action="{{ route('id.delete', ['id' => $loaikhachhang->LOAIKHACHHANG_ID]) }}" method="POST" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block">
                                            <i class="fas fa-minus me-2"></i>Xóa
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center align-middle buttonsua" style="max-width: 50px">
                                    <button type="button" class="btn btn-warning btn-block editButton" data-bs-toggle="modal" data-bs-target="#editloaikh">
                                        <i class="fas fa-edit me-2"></i>Sửa
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                
            </div>
            <div id="pagination-links" class="d-flex justify-content-center">
                {{ $loaikhachhangs->appends(request()->all())->links() }}
            </div>
        </div>
                <!--Modal cho them loại khach hang-->
                <div class="modal fade" id="addloaikh">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addnewcustype">Thêm Loại Khách Hàng</h5>
                            </div>
                            <div class="modal-body">
                                <form id="infoForm" action="{{ route('loaikhachhang.insert') }}" method="POST">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="id" class="form-label fw-bold">ID loại khách hàng: </label>
                                        <input type="text" class="form-control" id="id" name="loaikhachhangid">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="code" class="form-label fw-bold">Mã loại khách hàng: </label>
                                        <input type="text" class="form-control" id="code" name="loaikhachhangma">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label fw-bold">Tên loại khách hàng: </label>
                                        <input type="text" class="form-control" id="name" name="loaikhachhangten">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="cssid" class="form-label fw-bold">ID CSS: </label>
                                        <input type="text" class="form-control" id="cssId" name="loaikhachhangidcss">
                                    </div>
            
                                    
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" id="insert" class="btn btn-success btn-block mb-3 mt-3"><i
                                                class="fas fa-plus me-2"></i>Thêm mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!------->
        <!--Modal cho sua loại khach hang-->
        <div class="modal fade" id="editloaikh">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatenewcustype">Sửa Loại Khách Hàng</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="{{ route('loaikhachhang.update') }}" method="POST">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="id" class="form-label fw-bold">ID loại khách hàng cần sửa: </label>
                                <input type="text" class="form-control" id="idsua" name="loaikhachhangid">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="code" class="form-label fw-bold">Mã loại khách hàng: </label>
                                <input type="text" class="form-control" id="codesua" name="loaikhachhangma">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label fw-bold">Tên loại khách hàng: </label>
                                <input type="text" class="form-control" id="namesua" name="loaikhachhangten">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="cssid" class="form-label fw-bold">ID CSS: </label>
                                <input type="text" class="form-control" id="cssIdsua" name="loaikhachhangidcss">
                            </div>
    
                            
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" id="edit" class="btn btn-warning btn-block mb-3 mt-3 "><i
                                        class="fas fa-edit me-2"></i>Sửa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        
        $(document).ready(function() {
            $('#infoForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var form = $('#infoForm')[0];
                var data = new FormData(form);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                   
                    beforeSend: function() {
                    Swal.fire({
                        title: 'Đang xử lý...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        },
                        onClose: () => {
                            Swal.hideLoading();
                        }
                    });
                    },
                    success: function(success) {
                        Swal.close();
                        if (success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Đã thêm mới!',
                                text: 'Loại khách hàng mới đã được tạo'
                            }).then(() => {
                                $('#infoForm').val('');
                                location.reload();
                            });

                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Vui lòng kiểm tra kỹ thông tin nhập vào, hoặc loại khách hàng đã tồn tại'
                        });
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
        });
        $(document).ready(function() {
            $('#deleteform').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var form = $('#deleteform')[0];
                var data = new FormData(form);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                   
                    beforeSend: function() {
                    Swal.fire({
                        title: 'Đang xử lý...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        },
                        onClose: () => {
                            Swal.hideLoading();
                        }
                    });
                    },
                    success: function(success) {
                        Swal.close();
                        if (success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Đã Xóa',
                                text: 'Loại khách hàng đã xóa thành công'
                            }).then(() => {
                                $('#deleteform').val('');
                                location.reload();
                            });

                        }},
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Không thể xóa Loại Khách Hàng vì có Khách Hàng mang loại này'
                        });
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
        });
        $(document).ready(function() {
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var form = $('#editForm')[0];
                var data = new FormData(form);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                   
                    beforeSend: function() {
                    Swal.fire({
                        title: 'Đang xử lý...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        },
                        onClose: () => {
                            Swal.hideLoading();
                        }
                    });
                    },
                    success: function(success) {
                        Swal.close();
                        if (success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: 'Chỉnh loại khách hàng thành công'
                            }).then(() => {
                                $('#editForm').val('');
                                location.reload();
                            });

                        }},
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Chỉnh loại khách hàng không thành công'
                        });
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
        });

            $(document).ready(function() {
                let selectedRow = null;

                $('#dataTable tr').click(function() {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                        selectedRow = null;
                        clearForm();
                    } else {
                        $('#dataTable tr').removeClass('selected');
                        $(this).addClass('selected');
                        selectedRow = $(this);
                        fillForm();
                    }
                });
            

                $('#codeDropdown').change(function() {
                    const code = $(this).val();

                    if (code === '') {
                        $('#dataTable tbody tr').show();
                    } else {
                        $('#dataTable tbody tr').hide();
                        $('#dataTable tbody tr:contains(' + code + ')').show();
                    }
                });

                function fillForm() {
                    const id = selectedRow.find('td:nth-child(1)').text();
                    const code = selectedRow.find('td:nth-child(2)').text();
                    const name = selectedRow.find('td:nth-child(3)').text();
                    const cssId = selectedRow.find('td:nth-child(4)').text();

                    $('#idsua').val(id);
                    $('#codesua').val(code);
                    $('#namesua').val(name);
                    $('#cssIdsua').val(cssId);
                }

                function clearForm() {
                    $('#id').val('');
                    $('#code').val('');
                    $('#name').val('');
                    $('#cssId').val('');
                }
                function toggleTable() {
        var table = document.getElementById("tableContainer");
        table.style.display = (table.style.display === "none") ? "block" : "none";
    }
                // Remove rows with the same data
                $('#dataTable tbody tr').each(function() {
                    const currentRow = $(this);
                    const currentCode = currentRow.find('td:nth-child(2)').text();
                    const currentName = currentRow.find('td:nth-child(3)').text();
                    const currentCssId = currentRow.find('td:nth-child(4)').text();
                    const sameDataRows = $('#dataTable tbody tr').filter(function() {
                        const code = $(this).find('td:nth-child(2)').text();
                        const name = $(this).find('td:nth-child(3)').text();
                        const cssId = $(this).find('td:nth-child(4)').text();
                        return code === currentCode && name === currentName && cssId === currentCssId;
                    });

                    if (sameDataRows.length > 1) {
                        sameDataRows.not(currentRow).remove();
                    }
                });
            });
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
            function toggleTable() {
            var table = document.getElementById("tableContainer");
            var formTab = document.getElementById("formTab");
            if (table.style.display === "none") {
                table.style.display = "block";
                formTab.style.display = "none";
            } else {
                table.style.display = "none";
                formTab.style.display = "block";
            }}
            function confirmDelete() {
                    return confirm('Bạn có chắc chắn muốn xóa loại khách hàng?');
                }
                $(document).ready(function() {
  $('.editButton').click(function() {
    // Get the row data
    var id = $(this).closest('tr').find('.test:eq(0)').text();
    var code = $(this).closest('tr').find('.test:eq(1)').text();
    var name = $(this).closest('tr').find('.test:eq(2)').text();
    var cssId = $(this).closest('tr').find('.test:eq(3)').text();

    // Set the modal input values
    $('#idsua').val(id);
    $('#codesua').val(code);
    $('#namesua').val(name);
    $('#cssIdsua').val(cssId);
  });
});
  </script>
        </div>
    @include('footer')
</body>

</html>
