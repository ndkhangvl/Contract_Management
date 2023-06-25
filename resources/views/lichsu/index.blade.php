<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử hành động</title>
</head>
<body>
    @include('header2')
    @include('sidebar')
    <div id="main">
        <h1>History</h1>
    <table>
        <thead>
            <tr>
                <th>Tên Tài Khoản</th>
                <th>Hành động </th>
                <th>Khối thực hiện </th>
                <th>Ghi chú</th>
                <th>Thời gian thực hiện </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $history->ten_nd }}</td>
                    <td>{{ $history->action }}</td>
                    <td>{{ $history->model_type }}</td>
                    <td>{{ $history->description }}
                    <td>{{ $history->Time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    @include('footer')
</body>
</html>