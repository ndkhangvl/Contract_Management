<h1>History</h1>
    <table>
        <thead>
            <tr>
                <th>Tên Tài Khoảng</th>
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
