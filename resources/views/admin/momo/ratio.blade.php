@extends('admin.layouts.admin')
@section("push_css")
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
<style></style>
@section('content')
    <div class="row h__setting_ratio">
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">Chẵn lẻ - Tài xỉu</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $chanleTaixiuMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('CLTX','{{ $chanleTaixiuMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table h__border_bottom">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($chanleTaixiu as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="chanleTaixiu_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="chanleTaixiu_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="chanleTaixiu()">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">Chẵn lẻ 2 - Tài xỉu 2</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $chanleTaixiuV2Mode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('CLTX2','{{ $chanleTaixiuV2Mode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($chanleTaixiuV2 as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="chanleTaixiuV2_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="chanleTaixiuV2_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="chanleTaixiuV2()">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">Tổng số 3</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $tongbasoMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('S' ,'{{ $tongbasoMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($tongbaso as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="tongbaso_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="tongbaso_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="tongbaso()">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">1 phần 3</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $motphanbaMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('1P3','{{ $motphanbaMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($motphanba as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="motphanba_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="motphanba_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="motphanba()">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">Gấp 3</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $gapbaMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('G3','{{ $gapbaMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($gapba as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="gapba_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="gapba_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="gapba()">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">Lô</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $loMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('LO','{{ $loMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($lo as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="lo_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="lo_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="lo()">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">H3</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $hbaMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('H3','{{ $hbaMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($hba as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="hba_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="hba_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="hba()">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">Xiên</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $xienMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('XIEN','{{ $xienMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($xien as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="xien_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="xien_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="xien()">Submit</button>
                </div>
            </div>
        </div>
{{--        <div class="col-sm-4">--}}
{{--            <div class="card">--}}
{{--                <div class="h__card_header">--}}
{{--                    <h5 class="h__card_title">Vận may</h5>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <table class="table">--}}
{{--                        @include('admin.common.gameHeader')--}}
{{--                        <tbody>--}}
{{--                        @foreach($vanmay as $item)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <input type="text"--}}
{{--                                           maxlength="5"--}}
{{--                                           class="h__txt_game"--}}
{{--                                           id="vanmay_comment_{{ $item->h_key }}"--}}
{{--                                           value="{{ $item->comment }}">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @foreach($item->array_ket_qua as $key => $ikq)--}}
{{--                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="text"--}}
{{--                                           maxlength="5"--}}
{{--                                           class="h__txt_game"--}}
{{--                                           id="vanmay_ratio_{{ $item->h_key }}"--}}
{{--                                           value="{{ $item->ratio }}">--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <button class="btn btn-primary h__mt_10" type="button" onclick="vanmay()">Submit</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-sm-4">
            <div class="card">
                <div class="h__card_header">
                    <div class="d-flex align-items-center">
                        <h5 class="h__card_title">Đoán số</h5>
                        <label class="switch ml-3">
                            <input type="checkbox"
                                   {{ $doansoMode->status == 1 ? 'checked' : '' }}
                                   onchange="statusGameMode('DX','{{ $doansoMode->status }}')">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        @include('admin.common.gameHeader')
                        <tbody>
                        @foreach($doanso as $item)
                            <tr>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="doanso_comment_{{ $item->h_key }}"
                                           value="{{ $item->comment }}">
                                </td>
                                <td>
                                    @foreach($item->array_ket_qua as $key => $ikq)
                                        {{ ($key > 0 ? '- ' : '' ) . $ikq }}
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text"
                                           maxlength="5"
                                           class="h__txt_game"
                                           id="doanso_ratio_{{ $item->h_key }}"
                                           value="{{ $item->ratio }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary h__mt_10" type="button" onclick="doanso()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('push_js')
    <script>
        const chanleTaixiu = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.chanleTaixiu') }}', {
                    comment: {
                        a: $("#chanleTaixiu_comment_a").val(),
                        b: $("#chanleTaixiu_comment_b").val(),
                        c: $("#chanleTaixiu_comment_c").val(),
                        d: $("#chanleTaixiu_comment_d").val()
                    },
                    ratio: {
                        a: $("#chanleTaixiu_ratio_a").val(),
                        b: $("#chanleTaixiu_ratio_b").val(),
                        c: $("#chanleTaixiu_ratio_c").val(),
                        d: $("#chanleTaixiu_ratio_d").val(),
                    }
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
                })
            }
        }
        const chanleTaixiuV2 = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.chanleTaixiuV2') }}', {
                    comment: {
                        a: $("#chanleTaixiuV2_comment_a").val(),
                        b: $("#chanleTaixiuV2_comment_b").val(),
                        c: $("#chanleTaixiuV2_comment_c").val(),
                        d: $("#chanleTaixiuV2_comment_d").val()
                    },
                    ratio: {
                        a: $("#chanleTaixiuV2_ratio_a").val(),
                        b: $("#chanleTaixiuV2_ratio_b").val(),
                        c: $("#chanleTaixiuV2_ratio_c").val(),
                        d: $("#chanleTaixiuV2_ratio_d").val(),
                    }
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
                })
            }
        }
        const tongbaso = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.tongbaso') }}', {
                    comment: {
                        a: $("#tongbaso_comment_a").val(),
                        b: $("#tongbaso_comment_b").val(),
                        c: $("#tongbaso_comment_c").val(),
                    },
                    ratio: {
                        a: $("#tongbaso_ratio_a").val(),
                        b: $("#tongbaso_ratio_b").val(),
                        c: $("#tongbaso_ratio_c").val(),
                    }
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
                })
            }
        }
        const motphanba = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.motphanba') }}', {
                    comment: {
                        a: $("#motphanba_comment_a").val(),
                        b: $("#motphanba_comment_b").val(),
                        c: $("#motphanba_comment_c").val(),
                        d: $("#motphanba_comment_d").val()
                    },
                    ratio: {
                        a: $("#motphanba_ratio_a").val(),
                        b: $("#motphanba_ratio_b").val(),
                        c: $("#motphanba_ratio_c").val(),
                        d: $("#motphanba_ratio_d").val(),
                    }
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
                })
            }
        }
        const gapba = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.gapba') }}', {
                    comment: {
                        a: $("#gapba_comment_a").val(),
                        b: $("#gapba_comment_b").val(),
                        c: $("#gapba_comment_c").val(),
                    },
                    ratio: {
                        a: $("#gapba_ratio_a").val(),
                        b: $("#gapba_ratio_b").val(),
                        c: $("#gapba_ratio_c").val(),
                    }
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
                })
            }
        }
        const lo = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.lo') }}', {
                    comment: {
                        a: $("#lo_comment_a").val(),
                    },
                    ratio: {
                        a: $("#lo_ratio_a").val(),
                    }
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
                })
            }
        }
        const hba = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.hba') }}', {
                    comment: {
                        a: $("#hba_comment_a").val(),
                        b: $("#hba_comment_b").val(),
                        c: $("#hba_comment_c").val(),
                    },
                    ratio: {
                        a: $("#hba_ratio_a").val(),
                        b: $("#hba_ratio_b").val(),
                        c: $("#hba_ratio_c").val(),
                    }
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
                })
            }
        }
        const xien = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.xien') }}', {
                    comment: {
                        a: $("#xien_comment_a").val(),
                        b: $("#xien_comment_b").val(),
                        c: $("#xien_comment_c").val(),
                        d: $("#xien_comment_d").val()
                    },
                    ratio: {
                        a: $("#xien_ratio_a").val(),
                        b: $("#xien_ratio_b").val(),
                        c: $("#xien_ratio_c").val(),
                        d: $("#xien_ratio_d").val(),
                    }
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
                })
            }
        }
        const vanmay = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.vanmay') }}', {
                    comment: {
                        a: $("#vanmay_comment_a").val(),
                        b: $("#vanmay_comment_b").val(),
                        c: $("#vanmay_comment_c").val(),
                    },
                    ratio: {
                        a: $("#vanmay_ratio_a").val(),
                        b: $("#vanmay_ratio_b").val(),
                        c: $("#vanmay_ratio_c").val(),
                    }
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
                })
            }
        }
        const doanso = function (){
            if(confirm(confirm_update)){
                axios.post('{{ route('admin.axios.ratio.doanso') }}', {
                    comment: {
                        a: $("#doanso_comment_a").val(),
                        b: $("#doanso_comment_b").val(),
                        c: $("#doanso_comment_c").val(),
                        d: $("#doanso_comment_d").val(),
                        e: $("#doanso_comment_e").val(),
                        f: $("#doanso_comment_f").val(),
                        g: $("#doanso_comment_g").val(),
                        h: $("#doanso_comment_h").val(),
                        i: $("#doanso_comment_i").val(),
                        k: $("#doanso_comment_k").val(),
                    },
                    ratio: {
                        a: $("#doanso_ratio_a").val(),
                        b: $("#doanso_ratio_b").val(),
                        c: $("#doanso_ratio_c").val(),
                        d: $("#doanso_ratio_d").val(),
                        e: $("#doanso_ratio_e").val(),
                        f: $("#doanso_ratio_f").val(),
                        g: $("#doanso_ratio_g").val(),
                        h: $("#doanso_ratio_h").val(),
                        i: $("#doanso_ratio_i").val(),
                        k: $("#doanso_ratio_k").val(),
                    }
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
                })
            }
        }

        const statusGameMode = function (mode, status){
            axios.post('{{ route('admin.axios.ratio.statusGameMode') }}', {
                mode, status
            }).then(res => {
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
            })
        }
    </script>
@endsection
