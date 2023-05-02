@extends('admin.layouts.admin')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Fake : </label>
                    <select class="form-control" id="h_fake">
                        <option value="0" {{ ($item && $item->fake == 0) ? 'selected' : '' }}>OFF</option>
                        <option value="1" {{ ($item && $item->fake == 1) ? 'selected' : '' }}>ON</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Thưởng top</label>
                    <input type="number" class="form-control"
                           id="h_thuong"
                           value="{{ $item->thuong ?? 0 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Hệ số fake top</label>
                    <input type="number" class="form-control"
                           id="h_heso"
                           value="{{ $item->heso ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>SĐT fake top</label>
                    <input type="text" class="form-control"
                           id="h_sotop"
                           maxlength="12"
                           value="{{ $item->sotop ?? '' }}">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="update()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('push_js')
    <script>
        const update = function (){
            axios.post('{{ route('admin.axios.rank.update') }}', {
                rank: 4,
                fake: $("#h_fake").val(),
                thuong: $("#h_thuong").val(),
                heso: $("#h_heso").val(),
                sotop: $("#h_sotop").val(),
            }).then((res) => {
                console.log(res);
                alert(res.message);
                location.reload();
            }).catch((err) => {
                alert(server_error)
            });
        }
    </script>
@endsection

