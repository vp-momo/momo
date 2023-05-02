@extends('admin.layouts.admin')
@section('content')
    <div>
        <div class="h__mb_10">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Thêm Link Hỗ Trợ
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Link Hỗ Trợ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label class="h__required">Tên</label>
                                <input type="text" class="form-control" id="h_name" maxlength="50">
                                <span class="text-danger h__err h__err_name"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Link</label>
                                <input type="text" class="form-control" id="h_url" maxlength="100">
                                <span class="text-danger h__err h__err_url"></span>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="create()">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-responsive">
            <thead class="thead-light">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Link</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" style="width: 150px"></th>
                    <th scope="col" style="width: 100px"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a>
                    </td>
                    <td>{{ $item->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    <td>
                        <div>
                            @if($item->status == 1)
                                <button class="btn btn-sm btn-dark" onclick="update({{$item->id}}, 0)">Tắt hoạt động</button>
                            @else
                                <button class="btn btn-sm btn-primary" onclick="update({{$item->id}}, 1)">Bật hoạt động</button>
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
@endsection
@section('push_js')
    <script>
        const create = function (){
            let msg = 'Vui lòng nhập!';
            $(".h__err").html("");
            let name = $("#h_name").val();
            let url = $("#h_url").val();

            if(name.trim() === ""){
                $(".h__err_name").html(msg);
                return false;
            }
            if(url.trim() === ""){
                $(".h__err_url").html(msg);
                return false;
            }
            axios.post('{{ route('admin.axios.support.create') }}', {
                name: name,
                url: url
            }).then((res) => {
                console.log(res);
                alert(res.message);
                location.reload();
            }).catch((err) => {
                alert(server_error)
            });
        }
        const update = function (id, status){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.support.update') }}', {
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
                axios.post('{{ route('admin.axios.support.delete') }}', {
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
