@extends('admin.layouts.admin')
@section('push_css')
    <style>
        .ck-editor__editable {
            min-height: 300px !important;
            max-height: 800px !important;
        }
    </style>
@endsection
@section('content')
    <div>
        <div class="row">
            @foreach($list as $item)
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Tiền thưởng mốc {{ $item->position }}</label>
                        <input type="number" class="form-control"
                               name="reward[]"
                               value="{{ $item->reward ?? 0 }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Mốc {{ $item->position }}</label>
                        <input type="number" class="form-control"
                               name="hook[]"
                               value="{{ $item->hook ?? 0 }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Trạng thái: </label>
                        <select class="form-control" name="status[]">
                            <option value="0" {{ ($item && $item->status == 0) ? 'selected' : '' }}>OFF</option>
                            <option value="1" {{ ($item && $item->status == 1) ? 'selected' : '' }}>ON</option>
                        </select>
                    </div>
                </div>
            @endforeach
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
            const hooks = $("input[name='hook[]']")
                .map(function(){
                    return $(this).val();
                }).get();
            const rewards = $("input[name='reward[]']")
                .map(function(){
                    return $(this).val();
                }).get();
            const statuss = $("select[name='status[]']")
                .map(function(){
                    return $(this).val();
                }).get();
            const list = hooks.map((a,b) =>  {
                return {
                    type: 'day',
                    position: b+1,
                    reward: rewards[b],
                    hook: hooks[b],
                    status: statuss[b]
                }
            })
            axios.post('{{ route('admin.axios.event.update') }}', {
                list: list
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
