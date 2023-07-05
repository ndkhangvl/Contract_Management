<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử hành động</title>
    <!-- JavaScript Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    @include('sidebar')
    @include('header2')
    <div id="main">
        <h1 class="">Lịch sử chỉnh sửa</h1>
        <div class="container bg-white shadow rounded">
            <div class="form-group p-2 d-flex justify-content-end">
                <input type="text" class="border form-control" id="searchHistory" name="searchHistory"
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
                        {{-- @if ($histories)
                            @foreach ($histories as $history)
                                <tr>
                                    <td class="text-center align-middle">{{ $history->ten_nd }}</td>
                                    <td class="text-center align-middle">{{ $history->action }}</td>
                                    <td class="text-center align-middle">{{ $history->model_type }}</td>
                                    <td class="text-center align-middle">{{ $history->description }}
                                    <td class="text-center align-middle">{{ $history->Time }}</td>
                                </tr>
                            @endforeach
                        @endif --}}
                        @include('lichsu.history_data')
                    </tbody>
                </table>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                {{-- @if (empty($request->search))
                    {{ $histories->links() }}
                @endif --}}
            </div>
        </div>
        <script>
            $(document).ready(function() {
                function searchHistory(page, query) {
                    $.ajax({
                        // type: 'GET',
                        url: 'history/searchHistory?page=' + page + '&search=' + query,
                        success: function(histories) {
                            $('tbody').html('');
                            $('tbody').html(histories);
                        }
                    });
                }
                var timeout = null;
                $('#searchHistory').on('keyup', function() {
                    var value = $('#searchHistory').val();
                    var page = $('#hidden_page').val();
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        searchHistory(page, value);
                    }, 600);
                    // searchHistory(page, value);
                });

                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    //$('#hidden_page').val(page);

                    var query = $('#searchHistory').val();
                    $('li').removeClass('active');
                    $(this).parent().addClass('active');
                    searchHistory(page, query);
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
        </script>
    </div>
    @include('footer')
</body>

</html>
