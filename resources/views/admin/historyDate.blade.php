@extends('admin.layouts.admin')
@section('content')
    <div class="h__paginate r row">
        <div class="col-6">
            <div class="row h__mb_10">
                <div class="col-11">
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
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Tổng chơi</th>
                    <th scope="col">Tổng win</th>
                    <th scope="col">Doanh thu</th>
                    <th scope="col">Số giao dịch</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $key => $item)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $item->id_momo }}</td>
                        <td>{{ number_format($item->amount) }}đ</td>
                        <td>{{ number_format($item->amount_paid) }}đ</td>
                        <td>{{ number_format($item->amount - $item->amount_paid) }}đ</td>
                        <td>{{ $item->sumID }}</td>
                    </tr>
                @endforeach
                @if(count($list) == 0)
                    <tr>
                        <td class="text-center" colspan="6">Không Tìm Thấy Dữ Liệu</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $list->withQueryString()->links() }}
        </div>
        <div class="col-6">
            <div class="row h__mb_10">
                <div class="col-11">
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
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Số tiền sai nội dung</th>
                    <th scope="col">Số tiền hoàn</th>
                    <th scope="col">Doanh thu</th>
                    <th scope="col">Số giao dịch</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list2 as $key => $item)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $item->id_momo }}</td>
                        <td>{{ number_format($item->amount) }}đ</td>
                        <td>{{ number_format(($item->amount ?? 0)*$refund/100 ) }}đ</td>
                        <td>{{ number_format(($item->amount ?? 0)*(100-$refund)/100 ) }}đ</td>
                        <td>{{ $item->sumID }}</td>
                    </tr>
                @endforeach
                @if(count($list2) == 0)
                    <tr>
                        <td class="text-center" colspan="6">Không Tìm Thấy Dữ Liệu</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $list2->withQueryString()->links() }}
        </div>
    </div>
@endsection
