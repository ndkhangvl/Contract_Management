<!DOCTYPE html>
<html>
<head>
    <title>Danh mục loại khách hàng</title>
    <style>
        /* body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            text-align: center;
            padding: 10px;
            background-color: #f2f2f2;
        }

        .content {
            flex: 1;
            overflow: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            white-space: nowrap;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        hr {
            border: 1px solid black;
            margin: 20px 0;
        }

        table {
            cursor: pointer;
        } */

        .selected {
            background-color: #077DCE;
            /* color: white; */
        }

        #infoForm select {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
@include('header2')
@include('header')
<div class="container">
    {{-- <div class="header">
        <h2>Loại khách hàng</h2>
        <form id="infoForm" action="{{ route('testconnect.insert') }}" method="POST">
            @csrf
            <br>
            <label for="id">ID:</label>
            <input type="text" id="id" name="loaikhachhangid">
            <label for="code">Mã:</label>
            <input type="text" id="code" name="loaikhachhangma">
            <label for="cssId">ID CSS:</label>
            <input type="text" id="cssId" name="loaikhachhangidcss">
            <select id="codeDropdown">
                <option value="">All Codes</option>
                @foreach ($loaikhachhangs as $loaikhachhang)
                    <option value="{{ $loaikhachhang->LOAIKHACHHANG_MA }}">{{ $loaikhachhang->LOAIKHACHHANG_MA }}</option>
                @endforeach
            </select>
            <button type="submit" id="insert">Thêm</button>
            <button type="button" id="editButton">Sửa</button>
            <button type="button" id="deleteButton">Xóa</button><br>
            <label for="name">Tên loại khách hàng:</label>
            <input type="text" id="name" name="loaikhachhangten" style="width: 725px;">
        </form>
    </div> --}}
    {{-- Sửa lại CSS với boostrap5 để đồng bộ --}}
    <h1>Loại khách hàng</h1>
    <div class="container shadow">
        <form id="infoForm" action="{{ route('testconnect.insert') }}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
                <label for="id" class="form-label fw-bold">ID: </label>
                <input type="text" class="form-control" id="id" name="loaikhachhangid">
              </div>
            <div class="mb-3 mt-3">
                <label for="code" class="form-label fw-bold">Mã: </label>
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
            <select id="codeDropdown">
                <option value="">All Codes</option>
                @foreach ($loaikhachhangs as $loaikhachhang)
                    <option value="{{ $loaikhachhang->LOAIKHACHHANG_MA }}">{{ $loaikhachhang->LOAIKHACHHANG_MA }}</option>
                @endforeach
            </select>
            <div class="text-center">
                <button type="submit" id="insert" class="btn btn-success btn-block mb-3 mt-3"><i class="fas fa-plus me-2"></i>Thêm mới</button>
                <button type="button" id="editButton" class="btn btn-warning btn-block mb-3 mt-3"><i class="fas fa-edit me-2"></i>Sửa</button>
                <button type="button" id="deleteButton" class="btn btn-danger btn-block mb-3 mt-3"><i class="fas fa-minus me-2"></i>Xóa</button>
            </div>
        </form>
    </div>
<hr/>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable">
                <thead>
                <tr>
                    <th class="text-center text-nowrap">ID</th>
                    <th class="text-center text-nowrap">Mã</th>
                    <th class="text-center text-nowrap">Tên loại khách hàng</th>
                    <th class="text-center text-nowrap">ID CSS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($loaikhachhangs as $loaikhachhang)
                    <tr id="row{{ $loaikhachhang->LOAIKHACHHANG_ID }}">
                        <td class="text-center align-middle"> {{ $loaikhachhang->LOAIKHACHHANG_ID }}</td>
                        <td class="text-center align-middle"> {{ $loaikhachhang->LOAIKHACHHANG_MA }}</td>
                        <td>{{ $loaikhachhang->LOAIKHACHHANG_TEN }}</td>
                        <td class="text-center align-middle" > {{ $loaikhachhang->LOAIKHACHHANG_ID_CSS }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let selectedRow = null;

    $('#dataTable tr').click(function () {
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
    $('#editButton').click(function () {
    if (selectedRow !== null) 
    {
        const id = selectedRow.find('td:nth-child(1)').text();
        const code = $('#code').val();
        const name = $('#name').val();
        const cssId = $('#cssId').val();

        $.ajax({
            url: "{{ route('testconnect.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                loaikhachhangid: id,
                loaikhachhangma: code,
                loaikhachhangten: name,
                loaikhachhangidcss: cssId
            },
            success: function () {
                selectedRow.find('td:nth-child(2)').text(code);
                selectedRow.find('td:nth-child(3)').text(name);
                selectedRow.find('td:nth-child(4)').text(cssId);
                clearForm();
                selectedRow = null;
            },
            error: function () {
                alert('Failed to update the data.');
            }
        });
    }
});

    $('#deleteButton').click(function () {
        if (selectedRow !== null) {
            const id = selectedRow.find('td:nth-child(1)').text();

            $.ajax({
                url: "{{ route('testconnect.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    loaikhachhangid: id
                },
                success: function () {
                    selectedRow.remove();
                    selectedRow = null;
                    clearForm();
                },
                error: function () {
                    alert('Failed to delete the data.');
                }
            });
        }
    });

    $('#codeDropdown').change(function () {
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

        $('#id').val(id);
        $('#code').val(code);
        $('#name').val(name);
        $('#cssId').val(cssId);
    }

    function clearForm() {
        $('#id').val('');
        $('#code').val('');
        $('#name').val('');
        $('#cssId').val('');
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
</script>
@include('footer')
</body>
</html>
