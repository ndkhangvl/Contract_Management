<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử hành động</title>

    <!-- CSS Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    @include('header2')
    @include('sidebar')
    <div id="main" class="container">
        <h1>Nhật kí thay đổi thông tin</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Tài Khoản</th>
                    <th>Hành động</th>
                    <th>Khối thực hiện</th>
                    <th>Ghi chú</th>
                    <th>Thời gian thực hiện</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                    <tr>
                        <td>{{ $history->ten_nd }}</td>
                        <td>{{ $history->action }}</td>
                        <td>{{ $history->model_type }}</td>
                        <td>{{ $history->description }}</td>
                        <td>{{ $history->Time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('footer')
    <!-- JavaScript Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
