@extends('admin.layouts.admin')
@section('content')
    <div>
        <div class="h__mb_10">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Thêm Momo Vào Hệ Thống
            </button>

            @if(count($list) > 0)
            <button type="button" class="btn btn-success" onclick="loadBalance()">Load All Số Dư</button>
            @endif
            <button type="button" class="btn btn-danger" onclick="startJobSend()">Cron thanh toán: đang {{$sendMoney}}</button>
            <button type="button" class="btn btn-dark" onclick="startJobSendError()">Cron thanh toán bill lỗi: đang {{$sendError}}</button>
            <button type="button" class="btn btn-info" onclick="startJobLoadBill()">Cron load bill: đang {{$loadBill}}</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Momo Vào Hệ Thống</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="h__required">Số điện thoại</label>
                                <input type="text" class="form-control" id="h_phone" maxlength="12">
                                <span class="text-danger h__err h__err_phone"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">Mật khẩu</label>
                                <input type="number" class="form-control" id="h_pass">
                                <span class="text-danger h__err h__err_pass"></span>
                            </div>
                            <div class="form-group">
                                <label class="h__required">OTP</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="h_otp" maxlength="10">
                                    <button style="width: 100px" class="btn btn-success" type="button" onclick="sendOTP()">Lấy OTP</button>
                                </div>
                                <span class="text-danger h__err h__err_otp"></span>
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
                <th scope="col">MOMO</th>
                <th scope="col">SỐ DƯ</th>
                <th scope="col">HẠN MỨC</th>
                <th scope="col">SỐ LẦN</th>
                <th scope="col">MIN-MAX</th>
                <th scope="col">HẠN MỨC THÁNG</th>
                <th scope="col">TRẠNG THÁI</th>
                <th scope="col" style="width: 150px">ĐĂNG NHẬP</th>
                <th scope="col" style="width: 100px">BẬT/TẮT HOẠT ĐỘNG</th>
                <th scope="col" style="width: 100px">CHỈNH SỬA MOMO</th>
                <th scope="col" style="width: 100px">XÓA</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->phone }}</td>
                    <td>{{ number_format($item->sodu) }}đ</td>
                    <td>{{ number_format($item->gd_day ?? 0)."đ/".number_format($item->max_day ?? 0) }}đ</td>
                    <td>{{ $item->gd }}</td>
                    <td>{{ number_format($item->min)."đ/".number_format($item->max) }}đ</td>
                    <td>{{ number_format($item->gd_month ?? 0)."đ/".number_format($item->max_month ?? 0) }}đ</td>
                    <td>{{ $item->trangthai }}</td>
                    <td>
                        <div>
                            <button class="btn btn-sm btn-primary" onclick="login('{{ $item->phone }}')">Đăng nhập</button>
                        </div>
                    </td>
                    <td>
                        <div>
                            @if($item->trangthai == 'run')
                                <button class="btn btn-sm btn-dark" onclick="update({{$item->id}}, 'walt')">Tắt hoạt động</button>
                            @else
                                <button class="btn btn-sm btn-primary" onclick="update({{$item->id}}, 'run')">Bật hoạt động</button>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.momo.show', $item->id) }}">Chỉnh sửa</a>
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
            let phone = $("#h_phone").val();
            let pass = $("#h_pass").val();
            let otp = $("#h_otp").val();

            if(phone.trim() === ""){
                $(".h__err_phone").html(msg);
                return false;
            }
            if(!/(84|0[3|5|7|8|9])+([0-9]{8})\b/g.test(phone)){
                $(".h__err_phone").html('Số điện thoại không đúng định dạng!');
                return false;
            }
            if(!pass){
                $(".h__err_pass").html(msg);
                return false;
            }
            if(otp.trim() === ""){
                $(".h__err_otp").html(msg);
                return false;
            }
            axios.post('{{ route('admin.axios.momo.create') }}', {
                phone: phone,
                pass: pass,
                otp: otp,
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
        const sendOTP = function (){
            let msg = 'Vui lòng nhập!';
            $(".h__err").html("");
            let phone = $("#h_phone").val();
            let pass = $("#h_pass").val();

            if(phone.trim() === ""){
                $(".h__err_phone").html(msg);
                return false;
            }
            if(!/(84|0[3|5|7|8|9])+([0-9]{8})\b/g.test(phone)){
                $(".h__err_phone").html('Số điện thoại không đúng định dạng!');
                return false;
            }
            if(!pass){
                $(".h__err_pass").html(msg);
                return false;
            }

            axios.post('{{ route('admin.axios.momo.sendOTP') }}', {
                phone: phone,
                pass: pass,
            }).then((res) => {
                console.log(res);
                alert(res.message);
            }).catch((err) => {
                if(err.response){
                    console.log(err.response);
                    alert(err.response.data?.message ?? server_error);
                }else{
                    alert(server_error);
                }
            });
        }
        const update = function (id, status, type = "status"){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.momo.update') }}', {
                    id: id,
                    status: status,
                    type: type
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
                axios.post('{{ route('admin.axios.momo.delete') }}', {
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
        const login = function (phone){
            console.log(phone);
            axios.post('{{ route('admin.axios.momo.login') }}', {
                phone: phone
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
        const loadBalance = function (){
            axios.post('{{ route('admin.axios.momo.loadBalance') }}')
                .then((res) => {
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
        const startJobSend = function (){
            if(confirm('Xác nhận thực hiện?')){
                axios.post('{{ route('admin.axios.momo.startJobSend') }}')
                    .then((res) => {
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
        }
        const startJobSendError = function (){
            if(confirm('Xác nhận thực hiện?')){
                axios.post('{{ route('admin.axios.momo.startJobSendError') }}')
                    .then((res) => {
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
        }
        const startJobLoadBill = function (){
            if(confirm('Xác nhận thực hiện?')){
                axios.post('{{ route('admin.axios.momo.startJobLoadBill') }}')
                    .then((res) => {
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
        }
    </script>
@endsection
