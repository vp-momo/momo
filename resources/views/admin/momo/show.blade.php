@extends('admin.layouts.admin')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Số Momo</label>
                    <input type="text" class="form-control"
                           maxlength="255"
                           disabled
                           value="{{ $item->phone ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mật Khẩu</label>
                    <input type="text" class="form-control"
                           disabled
                           placeholder="Mật Khẩu Không Thể Thay Đổi Vui Lòng Xóa Đi Add Lại"
                           maxlength="255">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>GIAO DỊCH NGÀY</label>
                    <input type="text" class="form-control"
                           disabled
                           value="{{ $item->gd_day ?? 0 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>MAX GIAO DỊCH NGÀY</label>
                    <input type="number" class="form-control"
                           max="48000000"
                           min="0"
                           id="h_max_day"
                           value="{{ $item->max_day ?? 48000000 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>GIAO DỊCH THÁNG</label>
                    <input type="text" class="form-control"
                           disabled
                           value="{{ $item->gd_month ?? 0 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>MAX GIAO DỊCH THÁNG</label>
                    <input type="number" class="form-control"
                           max="98000000"
                           min="0"
                           id="h_max_month"
                           value="{{ $item->max_month ?? 90000000 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>MIN</label>
                    <input type="number" class="form-control"
                           min="0"
                           id="h_min"
                           value="{{ $item->min ?? 10000 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>MAX</label>
                    <input type="number" class="form-control"
                           min="0"
                           id="h_max"
                           value="{{ $item->max ?? 1000000 }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Số lần GD trong ngày</label>
                    <input type="number" class="form-control"
                           min="0"
                           id="h_gd"
                           value="{{ $item->gd ?? 0 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="update()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('push_js')
    <script>
        const id = '{{ $id }}';
        const update = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.momo.update') }}', {
                    id: id,
                    type: "hanmuc",
                    max_day: $("#h_max_day").val(),
                    max_month: $("#h_max_month").val(),
                    min: $("#h_min").val(),
                    max: $("#h_max").val(),
                    gd: $("#h_gd").val(),
                }).then((res) => {
                    console.log(res);
                    alert(res.message);
                    location.href = '{{ route('admin.momo.manager') }}';
                }).catch((err) => {
                    alert(server_error)
                });
            }
        }
    </script>
@endsection
