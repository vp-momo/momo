@extends('admin.layouts.admin')
@section('content')
    <div>
        <div class="h__mb_10">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Thêm GIFTCODE
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm GIFTCODE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label class="h__required">Tài khoản Momo trả tiền</label>
                                <select class="form-control" id="h_momo_reward">
                                    <option value="">Chọn SĐT momo</option>
                                    @foreach($momoList as $momo)
                                        <option value="{{$momo->phone}}">{{$momo->phone}} - {{number_format($momo->sodu)}}đ</option>
                                    @endforeach
                                </select>
                                <span class="text-danger h__err h__err_momo_reward"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Mã Code</label>
                                <input type="text" class="form-control" id="h_code" maxlength="100">
                                <span class="text-danger h__err h__err_code"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Số tiền mỗi người nhận khi nhập code</label>
                                <input type="number" class="form-control" id="h_money" min="0" max="1000000">
                                <span class="text-danger h__err h__err_money"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Giới hạn số người nhập CODE</label>
                                <input type="number" class="form-control" id="h_limit_import" min="0" max="100">
                                <span class="text-danger h__err h__err_limit_import"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Nội dung</label>
                                <input type="text" class="form-control" id="h_comment">
                                <span class="text-danger h__err h__err_comment"></span>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="create()">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-responsive h__main_table_all_nw">
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">CODE</th>
                <th scope="col">MOMO</th>
                <th scope="col">SỐ TIỀN NHẬN</th>
                <th scope="col">TIỀN ĐÃ PHÁT</th>
                <th scope="col">SỐ NGƯỜI NHẬP</th>
                <th scope="col">GIỚI HẠN</th>
                <th scope="col">NỘI DUNG</th>
                <th scope="col">STATUS</th>
                <th scope="col">THỜI GIAN TẠO</th>
                <th scope="col" style="width: 150px"></th>
                <th scope="col" style="width: 100px"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->momo_reward }}</td>
                    <td>{{ $item->money }}</td>
                    <td>{{ $item->entered * $item->money }}</td>
                    <td>{{ $item->entered }}</td>
                    <td>{{ $item->limit_import }}</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->status == 'on' ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <div>
                            @if($item->status == 'on')
                                <button class="btn btn-sm btn-dark" onclick="update({{$item->id}}, 'off')">Tắt hoạt động</button>
                            @else
                                <button class="btn btn-sm btn-primary" onclick="update({{$item->id}}, 'on')">Bật hoạt động</button>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div>
                            <button class="btn btn-sm btn-danger" onclick="remove({{$item->id}})">Gỡ</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="h__title_page">
        <h2 class="m-0">Lịch Sử Nhận Code</h2>
    </div>
    <div>
        <table class="table table-responsive h__main_table_all_nw">
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">CODE</th>
                <th scope="col">MOMO NHẬN</th>
                <th scope="col">MOMO TRẢ THƯỞNG</th>
                <th scope="col">NGÀY</th>
                <th scope="col">SỐ TIỀN NHẬN</th>
                <th scope="col">THỜI GIAN</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listHistory as $key => $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->momo }}</td>
                    <td>{{ $item->momo_reward }}</td>
                    <td>{{ $item->day }}</td>
                    <td>{{ $item->money }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $listHistory->withQueryString()->links() }}
    </div>
@endsection
@section('push_js')
    <script>
        const create = function (){
            let msg = 'Vui lòng nhập!';
            let msg_number = 'Vui lòng nhập số > 0!';
            $(".h__err").html("");
            let momo_reward = $("#h_momo_reward").val();
            let code = $("#h_code").val();
            let money = $("#h_money").val();
            let limit_import = $("#h_limit_import").val();
            let comment = $("#h_comment").val();

            if(momo_reward.trim() === ""){
                $(".h__err_momo_reward").html(msg);
                return false;
            }
            if(code.trim() === ""){
                $(".h__err_code").html(msg);
                return false;
            }
            if(money <= 0){
                $(".h__err_money").html(msg_number);
                return false;
            }
            if(limit_import <= 0){
                $(".h__err_limit_import").html(msg_number);
                return false;
            }
            if(comment.trim() == ""){
                $(".h__err_comment").html(msg);
                return false;
            }
            axios.post('{{ route('admin.axios.giftCode.create') }}', {
                momo_reward: momo_reward,
                code: code,
                money: money,
                limit_import: limit_import,
                comment: comment
            }).then((res) => {
                console.log(res);
                alert(res.message);
                location.reload();
            }).catch((err) => {
                if(err.response){
                    console.log(err.response);
                    alert(err.response.data?.message ?? server_error);
                }else{
                    alert(server_error);
                }
            });
        }
        const update = function (id, status){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.giftCode.update') }}', {
                    id: id,
                    status: status
                }).then((res) => {
                    console.log(res);
                    alert(res.message);
                    location.reload();
                }).catch((err) => {
                    alert(server_error)
                });
            }
        }
        const remove = function (id){
            if(confirm(confirm_remove)){
                axios.post('{{ route('admin.axios.giftCode.delete') }}', {
                    id: id
                }).then((res) => {
                    console.log(res);
                    alert(res.message);
                    location.reload();
                }).catch((err) => {
                    alert(server_error)
                });
            }
        }
    </script>
@endsection
