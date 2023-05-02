@extends('admin.layouts.admin')
@section("push_css")
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection
@section('content')
    <div>
        <div><h3>Hôm nay</h3></div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($today["amount"]) }}đ</h3>
                        <p>Tổng nhận</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($today["amount_paid"]) }}đ</h3>
                        <p>Tổng trả</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ number_format($eventCurrentDay) }}đ</h3>
                        <p>Trả Event</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ number_format(($todayAmountFail["amount"] ?? 0) - ($revenueToday["amount"] ?? 0)) }}đ</h3>
                        <p>Doanh thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div><h3>Hôm qua</h3></div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($lastDay["amount"]) }}đ</h3>
                        <p>Tổng nhận</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($lastDay["amount_paid"]) }}đ</h3>
                        <p>Tổng trả</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ number_format($eventLastDay) }}đ</h3>
                        <p>Trả Event</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ number_format(($lastDayAmountFail["amount"] ?? 0) - ($revenueLastDay["amount"] ?? 0)) }}đ</h3>
                        <p>Doanh thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div>--}}
{{--        <div><h3>Từ: {{ $startWeek }} Đến: {{ $endWeek }}</h3></div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-info">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{ number_format($currentWeek["amount"]) }}đ</h3>--}}
{{--                        <p>Tổng nhận</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="ion ion-bag"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-success">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{ number_format($currentWeek["amount_paid"]) }}đ</h3>--}}
{{--                        <p>Tổng trả</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="ion ion-stats-bars"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-warning">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>0</h3>--}}
{{--                        <p>Trả Event</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="ion ion-person-add"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-danger">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{ number_format($currentWeek["amount"] - $currentWeek["amount_paid"]) }}đ</h3>--}}
{{--                        <p>Doanh thu</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="ion ion-pie-graph"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div>
        <div><h3>Tháng này</h3></div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($currentMonth["amount"]) }}đ</h3>
                        <p>Tổng nhận</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($currentMonth["amount_paid"]) }}đ</h3>
                        <p>Tổng trả</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ number_format($eventCurrentMonth) }}đ</h3>
                        <p>Trả Event</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ number_format(($currentMonthAmountFail["amount"] ?? 0) - ($revenueCurrentMonth["amount"] ?? 0)) }}đ</h3>
                        <p>Doanh thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="h__title_page">
            <h2 class="m-0">Danh Sách Người Chơi</h2>
        </div>
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
    </div>

@endsection
