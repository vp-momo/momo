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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên trang</label>
                    <input type="text" class="form-control"
                           id="h_title"
                           maxlength="255"
                           value="{{ $item->title ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mô tả trang</label>
                    <input type="text" class="form-control"
                           id="h_description"
                           maxlength="255"
                           value="{{ $item->description ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Keywords</label>
                    <input type="text" class="form-control"
                           id="h_keywords"
                           maxlength="255"
                           value="{{ $item->keywords ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Text RUN</label>
                    <input type="text" class="form-control"
                           id="h_text_run"
                           maxlength="255"
                           value="{{ $item->text_run ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Logo</label>
                    <input type="text" class="form-control"
                           id="h_logo"
                           maxlength="255"
                           value="{{ $item->logo ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Màu trang</label>
                    <input type="color" class="form-control"
                           id="h_color"
                           value="{{ $item->color ?? '#000000' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nội dung trả thưởng</label>
                    <input type="text" class="form-control"
                           id="h_comment_back_money"
                           maxlength="255"
                           value="{{ $item->comment_back_money ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tỉ lệ hoàn tiền</label>
                    <select class="form-control" id="h_refund">
                        @for($i = 0; $i <= 9; $i++)
                            <option value="{{ $i*10 }}" {{ $i*10 == $item->refund ? 'selected' : '' }}>{{ $i*10 }}%</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nội dung hoàn tiền</label>
                    <input type="text" class="form-control"
                           id="h_comment_refund"
                           maxlength="255"
                           value="{{ $item->comment_refund ?? '' }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Thông báo</label>
                    <textarea class="form-control" id="h_note">{{ $item->note ?? '' }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>WEB: </label>
                    <select class="form-control" id="h_active">
                        <option value="0" {{ ($item && $item->active == 0) ? 'selected' : '' }}>OFF</option>
                        <option value="1" {{ ($item && $item->active == 1) ? 'selected' : '' }}>ON</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Hũ: </label>
                    <select class="form-control" id="h_hu">
                        <option value="0" {{ ($item && $item->hu == 0) ? 'selected' : '' }}>OFF</option>
                        <option value="1" {{ ($item && $item->hu == 1) ? 'selected' : '' }}>ON</option>
                    </select>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <script>
        var n_content = '';
        ClassicEditor
            .create(document.querySelector('#h_note'),{
                ckfinder: {
                    uploadUrl: '',
                }
            })
            .then( editor => {
                n_content = editor;
            } )
            .catch(error => {
                console.error(error);
                n_content = '';
            });
        const update = function (){
            let content_note = '';
            if(n_content !== ''){
                content_note = n_content.getData();
            }
            axios.post('{{ route('admin.axios.setting.update') }}', {
                title: $("#h_title").val(),
                description: $("#h_description").val(),
                keywords: $("#h_keywords").val(),
                text_run: $("#h_text_run").val(),
                logo: $("#h_logo").val(),
                color: $("#h_color").val(),
                note: content_note,
                comment_back_money: $("#h_comment_back_money").val(),
                refund: $("#h_refund").val(),
                comment_refund: $("#h_comment_refund").val(),
                active: $("#h_active").val(),
                hu: $("#h_hu").val(),
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
