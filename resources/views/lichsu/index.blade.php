<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử hành động</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    @include('sidebar')
    @include('header2')
    <div id="main">
        <h1>Lịch sử chỉnh sửa</h1>
        <div class="container bg-white shadow">
            <div class="form-group p-2 d-flex justify-content-end">
                <input type="text" class="border" id="searchHistory" name="searchHistory"
                    placeholder="Nhập vào tìm kiếm"></input>
            </div>
            <div class="table-responsive">
                <table class="table table-auto table-striped table-hover" id="search-results">
                    <thead>
                        <tr>
                            <th class="text-center text-nowrap">Người thực hiện</th>
                            <th class="text-center text-nowrap">Hành động </th>
                            <th class="text-center text-nowrap">Danh mục</th>
                            <th class="text-center text-nowrap">Ghi chú</th>
                            <th class="text-center text-nowrap">Thời gian thực hiện </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($histories)
                            @foreach ($histories as $history)
                                <tr>
                                    <td class="text-center align-middle">{{ $history->ten_nd }}</td>
                                    <td class="text-center align-middle">{{ $history->action }}</td>
                                    <td class="text-center align-middle">{{ $history->model_type }}</td>
                                    <td class="text-center align-middle">{{ $history->description }}
                                    <td class="text-center align-middle">{{ $history->Time }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{-- @if (empty($request->search))
                    {{ $histories->links() }}
                @endif --}}
            </div>
        </div>
        <script>
            $('#searchHistory').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/searchHistory',
                    data: {
                        'search': $value
                    },
                    success: function(response) {
                        var html = '';
                        $.each(response.histories, function(index, history) {
                            html += '<tr>';
                            html += '<td class="text-center align-middle">' + history.ten_nd +
                                '</td>';
                            html += '<td class="text-center align-middle">' + history.action +
                                '</td>';
                            html += '<td class="text-center align-middle">' + history.model_type +
                                '</td>';
                            html += '<td class="text-center align-middle">' + history.description +
                                '</td>';
                            html += '<td class="text-center align-middle">' + history.Time +
                                '</td>';
                            html += '</tr>';
                        });
                        $('#search-results tbody').html(html);

                        // var pagination = '';
                        // for (var i = 1; i <= response.histories.last_page; i++) {
                        //     pagination += '<li class="page-item ' + (response.histories.current_page == i ?
                        //             'active' : '') + '"><a class="page-link" href="?page=' + i + '">' + i +
                        //         '</a></li>';
                        // }
                        // $('#pagination').html(pagination);
                    }
                });
            })

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

        </script>
    </div>
    @include('footer')
    <!-- JavaScript Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
