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
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}
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
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="toggleTable()">
                <i class="fas fa-plus" style="margin-right: 5px;"></i>Thêm mới
            </button>
                </div>
            </div>
            <div class="container shadow">
            <div id="tableContainer">

            </div>
            </div>
            <hr />
            <div id="data-container">
                <div id="formTab" style="display: none;">
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

    
                        <div class="text-center">
                            <button type="submit" id="insert" class="btn btn-success btn-block mb-3 mt-3"><i
                                    class="fas fa-plus me-2"></i>Thêm mới</button>
                        </div>
                    </form>
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
                            <tr id="row{{ $loaikhachhang->LOAIKHACHHANG_ID }}">
                                <td class="text-center align-middle">{{ $loaikhachhang->LOAIKHACHHANG_ID }}</td>
                                <td class="text-center align-middle">{{ $loaikhachhang->LOAIKHACHHANG_MA }}</td>
                                <td>{{ $loaikhachhang->LOAIKHACHHANG_TEN }}</td>
                                <td class="text-center align-middle">{{ $loaikhachhang->LOAIKHACHHANG_ID_CSS }}</td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('id.delete', ['id' => $loaikhachhang->LOAIKHACHHANG_ID]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block mb-3 mt-3">
                                            <i class="fas fa-minus me-2"></i>Xóa
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" id="editButton" class="btn btn-warning btn-block mb-3 mt-3">
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
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
            }
}
        </script>
        </div>
    @include('footer')
</body>

</html>
