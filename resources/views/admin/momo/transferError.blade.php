@extends('admin.layouts.admin')
@section('content')
    <div class="h__paginate">
        <div class="h__mb_10">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Gửi tiền đến Momo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="h__required">Momo gửi</label>
                                <select class="form-control" id="h_phone">
                                    <option value="">Chọn SĐT momo</option>
                                    @foreach($momoList as $momo)
                                        <option value="{{$momo->phone}}">{{ $momo->phone }} - {{ number_format($momo->sodu) }}đ</option>
                                    @endforeach
                                </select>
                                <span class="text-danger h__err h__err_phone"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Momo nhận</label>
                                <input type="text" class="form-control" id="h_id_momo" disabled>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Số tiền</label>
                                <input type="number" class="form-control" id="h_amount" disabled>
                                <span class="text-danger h__err h__err_amount"></span>
                            </div>
                            <input type="hidden" id="h_history_id">
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="transfer()">Gửi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <table class="table table-responsive h__main_table h__main_table_all_nw">
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Mã giao dịch</th>
                <th scope="col">Mã random</th>
                <th scope="col">Tiền chơi</th>
                <th scope="col">Tiền thưởng</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Game</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Active</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <th scope="row">{{ $total - $key - $limit*((request()->get('page') ?? 1) - 1) }}</th>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->id_tran }}</td>
                    <td>{{ $item->sys_ran }}</td>
                    <td>{{ number_format($item->amount) }}đ</td>
                    <td>{{ number_format($item->amount_paid) }}đ</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->id_game }}</td>
                    <td>{!! getStatusHistory($item->status) !!}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                                onclick="setDataModal('{{$item->id_momo}}', '{{ $item->amount }}', '{{ $item->id }}')">
                            Thanh Toán
                        </button>
                        <button class="btn btn-danger" onclick="setTransfer('{{ $item->id }}')">Thanh toán tay</button>
                    </td>
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
@section('push_js')
    <script>
        const setDataModal = (id_momo, amount, history_id) => {
            $("#h_id_momo").val(id_momo);
            $("#h_amount").val(amount);
            $("#h_history_id").val(history_id);
        }
        const transfer = function (){
            let msg = 'Vui lòng nhập!';
            $(".h__err").html("");
            let phone = $("#h_phone").val();

            if(phone.trim() === ""){
                $(".h__err_phone").html(msg);
                return false;
            }
            axios.post('{{ route('admin.axios.transfer.reTransfer') }}', {
                phone: phone,
                id: $("#h_history_id").val()
            }).then((res) => {
                console.log(res);
                alert(res.message);
                location.reload();
            }).catch((err) => {
                if(err.response){
                    console.log(err.response);
                    alert(err.response.data?.message ?? server_error);
                }else{
                    if(err.response){
                        console.log(err.response);
                        alert(err.response.data?.message ?? server_error);
                    }else{
                        alert(server_error);
                    }
                }
            });
        }
        const setTransfer = function (id){
            axios.post('{{ route('admin.axios.transfer.update') }}', {
                id: id
            }).then((res) => {
                console.log(res);
                alert(res.message);
                location.reload();
            }).catch((err) => {
                if(err.response){
                    console.log(err.response);
                    alert(err.response.data?.message ?? server_error);
                }else{
                    if(err.response){
                        console.log(err.response);
                        alert(err.response.data?.message ?? server_error);
                    }else{
                        alert(server_error);
                    }
                }
            });
        }
    </script>
@endsection
