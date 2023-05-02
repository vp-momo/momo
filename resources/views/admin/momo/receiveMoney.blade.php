@extends('admin.layouts.admin')
@section('content')
    <div class="h__paginate">
        <div class="row h__mb_10">
            <div class="col-md-4 col-sm-6">
                <form action="" method="GET">
                    <div class="h__group_search">
                        <input type="text" class="form-control" name="search" placeholder="Nhập SĐT hoặc MGD momo để kiểm tra" value="{{ $search }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-responsive h__main_table">
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Số hệ thống</th>
                <th scope="col">Số người chơi</th>
{{--                <th scope="col">Tên người chơi</th>--}}
                <th scope="col">Mã giao dịch</th>
                <th scope="col">Mã random</th>
                <th scope="col">Tiền chơi</th>
                <th scope="col">Tiền thưởng</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Game</th>
                <th scope="col">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <th scope="row">{{ $total - $key - $limit*((request()->get('page') ?? 1) - 1) }}</th>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->id_momo }}</td>
{{--                    <td>{{ "" }}</td>--}}
                    <td>{{ $item->id_tran }}</td>
                    <td>{{ $item->sys_ran }}</td>
                    <td>{{ number_format($item->amount) }}đ</td>
                    <td>{{ number_format($item->amount_paid) }}đ</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->id_game }}</td>
                    <td>{!! getStatusHistory($item->status) !!}</td>
                </tr>
            @endforeach
            @if(count($list) == 0)
                <tr>
                    <td class="text-center" colspan="11">Không Tìm Thấy Dữ Liệu</td>
                </tr>
            @endif
            </tbody>
        </table>
        {{ $list->withQueryString()->links() }}
    </div>
@endsection
