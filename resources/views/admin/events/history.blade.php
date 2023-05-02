@extends('admin.layouts.admin')
@section('content')
    <div class="h__paginate">
        <table class="table table-responsive h__main_table h__main_table_all_nw">
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Ngày</th>
                <th scope="col">Momo chuyển</th>
                <th scope="col">Momo nhận</th>
                <th scope="col">Mốc thưởng</th>
                <th scope="col">Tiền thưởng</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Thời gian</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <th scope="row">{{ $total - $key - $limit*((request()->get('page') ?? 1) - 1) }}</th>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->id_momo }}</td>
                    <td>{{ number_format($item->hook) }}đ</td>
                    <td>{{ number_format($item->reward) }}đ</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
            @if(count($list) == 0)
                <tr>
                    <td class="text-center" colspan="8">Không Tìm Thấy Dữ Liệu</td>
                </tr>
            @endif
            </tbody>
        </table>
        {{ $list->withQueryString()->links() }}
    </div>
@endsection
@section('push_js')
@endsection
