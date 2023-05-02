@extends('admin.layouts.admin')
@section('content')
    <div class="h__paginate">
        <div class="h__mb_10">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Gửi tiền đến Momo
            </button>

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
                                <input type="text" class="form-control" id="h_id_momo" maxlength="12">
                                <span class="text-danger h__err h__err_id_momo"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Số tiền</label>
                                <input type="number" class="form-control" id="h_amount" min="100" max="48000000" value="100">
                                <span class="text-danger h__err h__err_amount"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Lời nhắn</label>
                                <input type="text" class="form-control" id="h_comment" maxlength="150">
                                <span class="text-danger h__err h__err_comment"></span>
                            </div>
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
        <table class="table table-responsive h__main_table">
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Momo chuyển</th>
                <th scope="col">Momo nhận</th>
                <th scope="col">Số tiền</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Thời gian</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <th scope="row">{{ $total - $key - $limit*((request()->get('page') ?? 1) - 1) }}</th>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->id_momo }}</td>
                    <td>{{ number_format($item->amount) }}đ</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->created_at }}</td>
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
@endsection
@section('push_js')
    <script>
        const transfer = function (){
            let msg = 'Vui lòng nhập!';
            let msg_number = 'Vui lòng nhập số tiền >= 100!';
            $(".h__err").html("");
            let phone = $("#h_phone").val();
            let id_momo = $("#h_id_momo").val();
            let amount = $("#h_amount").val();
            let comment = $("#h_comment").val();

            if(phone.trim() === ""){
                $(".h__err_phone").html(msg);
                return false;
            }
            if(id_momo.trim() === ""){
                $(".h__err_id_momo").html(msg);
                return false;
            }
            if(!/(84|0[3|5|7|8|9])+([0-9]{8})\b/g.test(id_momo)){
                $(".h__err_id_momo").html('Momo nhận không định dạng!');
                return false;
            }
            if(amount < 100){
                $(".h__err_amount").html(msg_number);
                return false;
            }
            if(comment.trim() === ""){
                $(".h__err_comment").html(msg);
                return false;
            }
            axios.post('{{ route('admin.axios.transfer.create') }}', {
                phone: phone,
                id_momo: id_momo,
                amount: amount,
                comment: comment,
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
