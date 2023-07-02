@if ($histories->isEmpty())
    <tr>
        <td colspan="5" class="text-center align-middle">Không tìm thấy kết quả</td>
    </tr>
@else
    @foreach ($histories as $history)
        <tr>
            <td class="text-center align-middle">{{ $history->ten_nd }}</td>
            <td class="text-center align-middle">{{ $history->action }}</td>
            <td class="text-center align-middle">{{ $history->model_type }}</td>
            <td class="text-center align-middle">{{ $history->description }}</td>
            <td class="text-center align-middle">{{ $history->Time }}</td>
        </tr>
    @endforeach
    <tr class="bg-white">
        <td class="align-middle" colspan="5">
            <div class="d-flex justify-content-center">
                {{ $histories->links() }}
            </div>
        </td>
    </tr>
@endif