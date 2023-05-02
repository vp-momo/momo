<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ $setting->title ?? "" }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="title" content="Coder By Chjplore">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="{{ $setting->content ?? "" }}" name="title">
    <meta content="{{ $setting->description ?? "" }}" name="description">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta content="{{ $setting->keywords ?? "" }},minigamemomo,Clmm,Chan le momo,Tài Xỉu momo,chanlemomo,Chẵn lẻ online,Chẵn Lẻ,momo cl,Cách Chơi chẵn lẽ momo,chẵn lẽ momo tự động" name="keywords">
    <meta content="/" property="og:url" />
    <meta content="article" property="og:type" />
    <meta content="{{ $setting->title ?? "" }}" property="og:title" />
    <meta content="{{ $setting->description ?? "" }}" property="og:description" />
    <link href="" rel="apple-touch-icon" />
    <link href="{{ $setting->favicon ?? "" }}" rel="shortcut icon" type="image/x-icon" />
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.jpeg') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-social.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css?ver=1') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.1.css?ver=1') }}" rel="stylesheet" />
    <link href="{{ asset('css/wheel.css?ver=1') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.css" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-P73HWF09Y5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-P73HWF09Y5');
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Casino",
            "name": "CHẴN LẺ MOMO",
            "alternateName": "chanle88",
            "@id": "https://chanle88.io/",
            "url": "https://chanle88.io/",
            "logo": "https://i.imgur.com/Lc1y815.png",
            "image": "https://i.imgur.com/Lc1y815.png",
            "description": "Chơi chẵn lẻ momo uy tín, tiện lợi và an toàn. đánh chẵn lẻ ngay trên app momo auto trả thưởng siêu tốc chỉ 2s. Cùng nhiều phần thưởng ưu đãi, top tuần, may mắn và đầy hấp dẫn",
            "priceRange": "100000VND-500000000VND",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "48 Đường số 47, Thảo Điền, Thủ Đức, Thành phố Hồ Chí Minh 700000",
                "addressLocality": "Thủ Đức",
                "addressRegion": "Hồ Chí Minh",
                "postalCode": "700000",
                "addressCountry": "vn"
            },
            "sameAs": []
        }
    </script>
    <script type='text/javascript'>
        shortcut = {
            all_shortcuts: {},
            add: function(a, b, c) {
                var d = {
                    type: "keydown",
                    propagate: !1,
                    disable_in_input: !1,
                    target: document,
                    keycode: !1
                };
                if (c)
                    for (var e in d) "undefined" == typeof c[e] && (c[e] = d[e]);
                else c = d;
                d = c.target, "string" == typeof c.target && (d = document.getElementById(c.target)), a = a
                    .toLowerCase(), e = function(d) {
                    d = d || window.event;
                    if (c.disable_in_input) {
                        var e;
                        d.target ? e = d.target : d.srcElement && (e = d.srcElement), 3 == e.nodeType && (e = e
                            .parentNode);
                        if ("INPUT" == e.tagName || "TEXTAREA" == e.tagName) return
                    }
                    d.keyCode ? code = d.keyCode : d.which && (code = d.which), e = String.fromCharCode(code)
                        .toLowerCase(), 188 == code && (e = ","), 190 == code && (e = ".");
                    var f = a.split("+"),
                        g = 0,
                        h = {
                            "`": "~",
                            1: "!",
                            2: "@",
                            3: "#",
                            4: "$",
                            5: "%",
                            6: "^",
                            7: "&",
                            8: "*",
                            9: "(",
                            0: ")",
                            "-": "_",
                            "=": "+",
                            ";": ":",
                            "'": '"',
                            ",": "<",
                            ".": ">",
                            "/": "?",
                            "\\": "|"
                        },
                        i = {
                            esc: 27,
                            escape: 27,
                            tab: 9,
                            space: 32,
                            "return": 13,
                            enter: 13,
                            backspace: 8,
                            scrolllock: 145,
                            scroll_lock: 145,
                            scroll: 145,
                            capslock: 20,
                            caps_lock: 20,
                            caps: 20,
                            numlock: 144,
                            num_lock: 144,
                            num: 144,
                            pause: 19,
                            "break": 19,
                            insert: 45,
                            home: 36,
                            "delete": 46,
                            end: 35,
                            pageup: 33,
                            page_up: 33,
                            pu: 33,
                            pagedown: 34,
                            page_down: 34,
                            pd: 34,
                            left: 37,
                            up: 38,
                            right: 39,
                            down: 40,
                            f1: 112,
                            f2: 113,
                            f3: 114,
                            f4: 115,
                            f5: 116,
                            f6: 117,
                            f7: 118,
                            f8: 119,
                            f9: 120,
                            f10: 121,
                            f11: 122,
                            f12: 123
                        },
                        j = !1,
                        l = !1,
                        m = !1,
                        n = !1,
                        o = !1,
                        p = !1,
                        q = !1,
                        r = !1;
                    d.ctrlKey && (n = !0), d.shiftKey && (l = !0), d.altKey && (p = !0), d.metaKey && (r = !0);
                    for (var s = 0; k = f[s], s < f.length; s++) "ctrl" == k || "control" == k ? (g++, m = !0) :
                        "shift" == k ? (g++, j = !0) : "alt" == k ? (g++, o = !0) : "meta" == k ? (g++, q = !
                            0) : 1 < k.length ? i[k] == code && g++ : c.keycode ? c.keycode == code && g++ :
                            e ==
                            k ? g++ : h[e] && d.shiftKey && (e = h[e], e == k && g++);
                    if (g == f.length && n == m && l == j && p == o && r == q && (b(d), !c.propagate)) return d
                        .cancelBubble = !0, d.returnValue = !1, d.stopPropagation && (d.stopPropagation(), d
                        .preventDefault()), !1
                }, this.all_shortcuts[a] = {
                    callback: e,
                    target: d,
                    event: c.type
                }, d.addEventListener ? d.addEventListener(c.type, e, !1) : d.attachEvent ? d.attachEvent("on" +
                    c.type, e) : d["on" + c.type] = e
            },
            remove: function(a) {
                var a = a.toLowerCase(),
                    b = this.all_shortcuts[a];
                delete this.all_shortcuts[a];
                if (b) {
                    var a = b.event,
                        c = b.target,
                        b = b.callback;
                    c.detachEvent ? c.detachEvent("on" + a, b) : c.removeEventListener ? c.removeEventListener(a, b,
                        !1) : c["on" + a] = !1
                }
            }
        }, shortcut.add("Ctrl+U", function() {
            top.location.href = "{{ env('APP_URL') }}"
        }), shortcut.add("F12", function() {
            top.location.href = "{{ env('APP_URL') }}"
        }), shortcut.add("Ctrl+Shift+I", function() {
            top.location.href = "{{ env('APP_URL') }}"
        }), shortcut.add("Ctrl+Shift+J", function() {
            top.location.href = "{{ env('APP_URL') }}"
        }), shortcut.add("Ctrl+S", function() {
            top.location.href = "{{ env('APP_URL') }}"
        }), shortcut.add("Ctrl+Shift+C", function() {
            top.location.href = "{{ env('APP_URL') }}"
        });
    </script>
    <style>
        .panel-primary {
            border-color: {{ $setting->color ?? "" }} !important;
        }

        .panel-primary>.panel-heading {
            color: #fff;
            background-color: {{ $setting->color ?? "" }} !important;
            border-color: {{ $setting->color ?? "" }} !important;
        }

        .panel-primary>.panel-heading+.panel-collapse .panel-body {
            border-top-color: {{ $setting->color ?? "" }} !important;
        }

        .panel-primary>.panel-footer+.panel-collapse .panel-body {
            border-bottom-color: {{ $setting->color ?? "" }} !important;
        }
        .bg-primary {
            color: #fff;
            background-color: {{ $setting->color ?? "" }} !important;
        }

        .navbar {
            background-color: {{ $setting->color ?? "" }} !important;
        }
        .occho {
            margin-top: 0.5rem;
            color: #155724;
            background-color: #aed6b8;
            border-color: #c3e6cb;
            padding: 20px;
        }
        .mainbar {
            background-color: #aeb9bd;
            height: 80px;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .dot-text-1 {
            color: #FD0C0C
        }

        .dot-text-2 {
            color: #5bc0de
        }

        .dot-text-3 {
            color: #5cb85c
        }

        .dot-text-4 {
            color: #d9534f
        }

        .dot-text-6 {
            color: #5bc0de
        }

        .dot-text-7 {
            color: #5cb85c
        }

        .dot-text-8 {
            color: #d9534f
        }

        .dot-text-9 {
            color: #f0ad4e
        }

        .dot-text-11 {
            color: #5cb85c
        }

        .dot-text-12 {
            color: #d9534f
        }

        .dot-text-13 {
            color: #f0ad4e
        }

        .dot-text-14 {
            color: #5bc0de
        }

        .dot-text-16 {
            color: #d9534f
        }

        .dot-text-17 {
            color: #f0ad4e
        }

        .dot-text-18 {
            color: #5bc0de
        }

        .dot-text-19 {
            color: #5cb85c
        }

        .dot-text-99 {
            background-color: #FFF0F5;
            padding: 5px;
        }

        .btn-default {
            color: rgb(255, 254, 254);
            background-color: #ae5ced;
            border-color: rgb(215, 219, 154);
        }

        .navbar-brand>.title-1 {
            padding: 0 3px;
            border: 1px solid #28f321;
            background: #92c6f0;
            color: #fff;
        }

        .navbar-brand>.title-2 {
            padding: 0 3px;
            border: 1px solid #f00;
            background: #f00;
            color: #fff;
            margin-left: -6px;
        }

        .navbar-brand>.title-3 {
            font-size: x-small;
            margin-left: -3px;
        }

        .btn {
            display: inline-block;
            margin-bottom: 0;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            white-space: nowrap;
            padding: 6px 13px;
            font-size: 14px;
            line-height: 1.42857143;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .modal .h__event_list{
            display: flex;
            justify-content: space-around;
            font-size: 12px;
            font-weight: bold;
        }
        .modal .h__event_list button{
            font-size: 10px;
            font-weight: bold;
            padding: 2px 6px;
        }
        .modal .text-bold{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <marquee width="100%" behavior="scroll" style="display: block;
            position: fixed;
            z-index: 1000;
            cursor: pointer;
            width: 100%;">
        <font color="white" style="text-shadow: 0 0 0.2em #ff0000, 0 0 0.2em #ff0000,  0 0 0.2em #ff0000">
            <b>{!! $setting->text_run ?? ""!!}</b>
        </font>
    </marquee>
    <div class="navbar">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="">
                    <div class="">
                        <img src="{{ $setting->logo ?? asset('image/logo.png') }}" onerror="this.src=`{{ asset('image/logo.png') }}`" height="60" alt="Chẵn Lẻ Momo" />
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="mainbar hidden-xs">
        <div class="container"></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_thongbao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">
                        <center>TIN TỨC </center>
                    </h5>
                </div>
                <div class="modal-body" id="noidung_thongbao">
                    {!! $setting->note ?? "" !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng lại !</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_huongdan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">
                        <center>HƯỚNG DẪN </center>
                    </h5>
                </div>
                <div class="modal-body" id="noidung_huongdan">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng lại !</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_random" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title">KẾT QUẢ!</h5>
                </div>
                <div class="modal-body">
                    <div>Số điện thoại: <span id="h_r_phone" class="text-bold"></span></div>
                    <div>Tổng số tiền giao dịch trong ngày: <span id="h_r_total" class="text-bold"></span></div>
                    <div>* Phần thưởng được nhận khi đạt mốc chơi: <br />
                        <span class="text-bold">
                        @foreach($event_day as $key => $event)
                            @if($key > 0) {{ '-' }} @endif
                            {{ number_format($event->hook) }}
                        @endforeach
                        </span>
                    </div>
                    <div class="mt-2">
                        <div class="h__event_list">
                            @foreach($event_day as $event)
                            <div class="h__event_item_title">
                                <span>{{ number_format($event->reward) }}đ</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="h__event_list">
                            @foreach($event_day as $event)
                            <div>
                                <button class="btn btn-warning" type="button"
                                        onclick="receive('{{$event->id}}')"
                                        id="e_id_{{$event->id}}">nhận</button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center mt-5"><span id="loadingReceive"></span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng lại !</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="baotri">
        <div class="content">
            <div class="content-container">
                <div class="py-5" style="min-height:80px !important;">
                    <div class="output" id="output">
                        <h2 class="cursor"></h2>
                        <h4></h4>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <div class="text-center mt-5">
                        @foreach($gameMode as $game)
                            <button class="btn btn-default btn-primary mt-1" server-action=change data-game="{{ $game->mode }}">
                                {{ $game->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-5" role="group">
                    <button class="btn btn-default btn-primary" server-action=change data-game="nvn" style="position: relative;">
                        Nhiệm Vụ Ngày
                        <b class="text-danger" style="position: absolute;margin-left: auto;margin-right: auto;text-align: center;left: 0px;right: 0px;top: 22px;font-size: 9px;">
                            <font color="red">(HOT)</font>
                        </b>
                    </button>
                    <button class="btn btn-default btn-primary mt-1" server-action=change data-game="ref" style="position: relative;">
                        Gifcode
                        <b class="text-danger" style="position: absolute;margin-left: auto;margin-right: auto;text-align: center;left: 0px;right: 0px;top: 22px;font-size: 9px;">
                            <font color="red">(NEW)</font>
                        </b>
                    </button>
                </div>
                <div class="row justify-content-md-center box-cl">
                    <div class="col-md-6 mt-3 cl">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                CÁCH CHƠI
                            </div>
                            <div class="play-rules">
                                @foreach($gameMode as $game)
                                <div class="panel-body game" style="padding-top: 10px; padding-bottom: 20px;" game-tab="{{ $game->mode }}">
                                    {!! $game->description !!}
                                    <p>-Cách chơi vô cùng đơn giản :</p>
                                    <p>- Chuyển tiền vào một trong các tài khoản:</p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center mb-0">
                                            <thead>
                                            <tr>
                                                <th class="text-center text-white bg-primary">Số điện thoại</th>
                                                <th class="text-center text-white bg-primary">Tối thiểu</th>
                                                <th class="text-center text-white bg-primary">Tối đa</th>
                                            </tr>
                                            </thead>
                                            <tbody aria-live="polite" aria-relevant="all" class="result-table-10 momo" role="alert" game-tab="{{ $game->mode }}"></tbody>
                                        </table>
                                    </div>
                                    <div class="text-center font-weight-bold">
                                        <b>Làm mới sau <span class="text-danger coundown-time">15</span> s</b>
                                    </div>
                                    <p class="mt-3">
                                        - Nội dung chuyển: <span class="fa-stack"> </span>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr>
                                                <th class="text-center text-white bg-primary">Nội dung</th>
                                                <th class="text-center text-white bg-primary">Số</th>
                                                <th class="text-center text-white bg-primary">Tỉ Lệ</th>
                                            </tr>
                                            </thead>
                                            <tbody aria-live="polite" aria-relevant="all" class="" id="result-table" role="alert">
                                                @foreach($game->game as $oneGame)
                                                <tr>
                                                    <td>
                                                        <span class="fa-stack">
                                                            <span class="fa fa-circle fa-stack-2x dot-text-{{ rand(1, 19) }}"> </span>
                                                            <span class="fa-stack-1x text-white comment-chan">{{ $oneGame->comment }}</span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @foreach($oneGame->array_ket_qua as $keyKQ => $itemKetQua)
                                                            {{ $keyKQ > 0 ? "-" : "" }}
                                                            <code>{{ $itemKetQua }}</code>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <b>{{ $oneGame->ratio }}</b>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    - Tiền thắng sẽ = <b>Tiền cược*Tỉ Lệ</b><br> <b>- Lưu ý : Mức cược mỗi số khác nhau, nếu chuyển
                                        sai hạn mức hoặc sai nội dung vui lòng vào phần "kiểm tra mã giao dịch" để hoàn tiền.</b>
                                </div>
                                @endforeach
                            </div>
                            <div class="minigame-rules">
                                <div class="panel-body game" game-tab="nvn" style="padding-top: 0px;">
                                    <br>
                                    <div class="body">
                                        <div class="text-center">
                                            <div class="form-group" id="non_query" style="background-color: #7ee2ff; border-color: #ad4105; padding: 20px;">
                                                <h4 style="font-weight: bold">Tổng Tiền Đã Trao: <span style="color: red">{{ $eventCurrentDay }}đ</span></h4>
                                                <label for="partnerId" style="margin-top: 10px;">Số điện thoại:</label>
                                                <input type="text" class="form-control" name="phoneCode" id="phoneCode" placeholder="094xxxxxxx">
                                                <small id="partnerId" class="form-text text-muted" style="color: #ff0000">Nhập số điện thoại của
                                                    bạn để kiểm tra và
                                                    nhận
                                                    thưởng.</small> <br>
                                                <button class="btn btn-success check-day-mission" onclick="checkEventDay()">Kiểm Tra</button>
                                            </div>
                                            <div class="form-group occard" id="loadingEventDay"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr class="bg-primary">
                                                <th class="text-center text-white bg-primary">Mốc chơi</th>
                                                <th class="text-center text-white bg-primary">Thưởng</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($event_day as $key => $event)
                                            <tr>
                                                <td>{{ number_format($event->hook ?? 0) }}đ</td>
                                                <td>{{ number_format($event->reward ?? 0) }}đ</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel-body game" game-tab="ref" style="padding-top: 0px;">
                                    <br>
                                    <div class="body">
                                        <div class="text-center">
                                            <div class="form-group" id="non_query_1" style="background-color: #7ee2ff; border-color: #ad4105; padding: 20px;">
                                                <label for="partnerId" style="margin-top: 10px;">Số Điện Thoại Của Bạn: </label>
                                                <input type="text" class="form-control" name="phonecode" id="phonecode" placeholder="094xxxxxxx">
                                                <label for="partnerId" style="margin-top: 10px;">Mã Code: </label>
                                                <input type="text" class="form-control" name="code" id="code" placeholder="Nhập gitcode">
                                                <br>
                                                <button class="btn btn-success check-day-mission" onclick="gitcode()">Kiểm Tra</button>
                                            </div>
                                            <div class="form-group occard" id="gitcode" style="display: none;">Đang truy vấn... xin chờ nhé...</div>
                                            <div id="result-gitcode" style="margin-top: 5px;"></div>
                                            <br />
                                        </div>
                                        <div class="block" style="min-height: 50vh;">
                                            <div class="block"
                                                 style="background: rgb(242, 222, 222); border-radius: 5px; padding: 15px;">
                                                <div style="color: rgb(169, 68, 66);">
                                                    <p style="line-height: 0.8;"></p>
                                                    <p style="font-size:120%;text-align:center;"><b>CODE KHUYẾN MẠI</b></p>
                                                    1. Một số điện thoại chỉ được nhập 1 mã/ngày. <br>
                                                    2. Mã code khuyến mại sẽ tùy vào điều kiện để sử dụng, có thời hạn. <br>
                                                    3. Mã code khuyến mại sẽ được cấp theo các chương trình khuyến mại của hệ thống
                                                    Momo Lô Tô. <br>
                                                    4. Vui lòng liên hệ chát CSKH để biết thêm chi tết khi bạn nhận được CODE. <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 cl">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                TRẠNG THÁI
                            </div>
                            <div class="panel-body text-center">
                                Lưu ý: Khi đạt 180 GD hoặc 50 triệu sẽ tự đổi số.
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                        <tr role="row" class="bg-primary">
                                            <th class="text-center text-white">Số điện thoại</th>
                                            <th class="text-center text-white">Số Lần Chuyển Tiền</th>
                                            <th class="text-center text-white">Giới Hạn Ngày</th>
                                        </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all" id="phone-table2" class="">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center font-weight-bold">
                                    <b>Làm mới sau <span class="text-danger coundown-time">15</span> s</b>
                                </div>
                                <br>
                                <div class="alert alert-info text-left">
                                    Nếu quá 10 phút chưa nhận được tiền vui lòng dán mã vào đây để kiểm tra.
                                </div>
                                <div class="text-center">
                                    <div class="form-group">
                                        <label for="tran_id">Nhập mã giao dịch</label>
                                        <input type="number" class="form-control" id="tran_id" name="tran_id" placeholder="Mã giao dịch: Ví dụ 11223344556">
                                        <small id="checkHelp" class="form-text text-muted">Nhập mã giao dịch của
                                            bạn
                                            để
                                            kiểm tra.</small>
                                    </div>
                                    <button class="btn btn-primary mb-2 check-tran" onclick="check_tranid()">Kiểm
                                        tra</button>
                                </div>
                                <div>
                                    <br />

                                    <div id="result-check"></div>
                                    <div class="alert alert-info text-left">
                                        Nếu có lỗi, hãy liên hệ các kênh CSKH bên dưới hoặc nhấn vào nút liên hệ góc
                                        phải màn hình để báo lỗi ADMIN
                                    </div>
                                    <div id="contact" class="mt-5">
                                        @foreach($boxChat as $boxChatItem)
                                        <p>
                                            <a class="text-white" href="{{ $boxChatItem->url }}" target="_blank">
                                                <span style="background-color: #4CAF50;" class="btn btn-primary rounded-pill">
                                                    {{ $boxChatItem->name }}
                                                </span>
                                            </a>
                                        </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="text-center mb-3">
                    <h3 class="text-uppercase">LỊCH SỬ THẮNG</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                        <tr role="row" class="bg-primary">
                            <th class="text-center text-white">Thời gian</th>
                            <th class="text-center text-white">Số điện thoại</th>
                            <th class="text-center text-white">Tiền cược</th>
                            <th class="text-center text-white">Tiền nhận</th>
                            <th class="text-center text-white">Trò chơi</th>
                            <th class="text-center text-white">trạng thái</th>
                        </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all" class="" id="load_data_play">
                        </tbody>
                    </table>
                </div>
                <div class="text-center font-weight-bold">
                    <b>Làm mới sau <span class="text-danger coundown-time">15</span> s</b>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mt-5">
                        <div class="text-center mb-3">
                            <h3 class="text-uppercase">LƯU Ý</h3>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-body" id="noidung_thongbaoakditmemay">
                                <h3 style="text-align: justify;"><strong><span style="color: #ff00ff;">Chào mừng bạn đến với CLMM. Hệ thống mini game chẵn lẻ momo (clmm) uy tín số 1 Việt Nam.&nbsp;</span></strong></h3>
                                <p style="text-align: justify;"><strong>Trước khi chơi, bạn nên đọc kĩ những lưu ý sau, nếu <span style="color: #ff0000;">bỏ qua</span> những lưu ý này, thì khi&nbsp;<span style="color: #ff0000;">mất tiền</span>, web sẽ <span style="color: #ff0000;">không chịu trách nhiệm</span>.</strong></p>
                                <p style="text-align: justify;"><strong>&nbsp; &nbsp; 1. Chẵn lẻ tài xỉu số cuối mã giao dịch là 0, 9 thua, nếu muốn tính 0 và 9 vui lòng chơi chẵn lẻ 2.</strong></p>
                                <p style="text-align: justify;">&nbsp; &nbsp;<strong>2. Mỗi số trên web chỉ có thể giao dịch tối đa&nbsp;40 triệu&nbsp;hoặc&nbsp;120 lần&nbsp;một ngày. Vì vậy số trên hệ thống&nbsp;sẽ thay đổi liên tục nên&nbsp;trước khi chơi (Clmm) chẵn lẻ momo bạn hãy lên lấy số trước, Tránh trường hợp bị hoàn tiền.</strong></p>
                                <p style="text-align: justify;"><strong>&nbsp; &nbsp; 3. Mỗi số có một mức cược khác nhau, n</strong><strong>ếu chuyển sai hạn mức, sai nội dung,&nbsp;số ngừng hoạt động, hãy sử dụng chức năng&nbsp;KIỂM TRA MÃ GIAO DỊCH để được&nbsp;nhận lại tiền chơi .</strong></p>
                                <p style="text-align: justify;"><em><span style="color: #ff0000;"><strong>&nbsp; &nbsp; &nbsp; - Tất cả các mã giao dịch chỉ được hỗ trợ trong ngày nha ae!</strong></span></em></p>
                                <p style="text-align: justify;"><strong>&nbsp; &nbsp; 4.&nbsp;Nếu gặp các vấn đề khác nữa thì bạn hãy click vào icon chát ở&nbsp;góc phải màn hình để liên hệ hỗ trợ. (24/7).</strong></p>
                                <p style="text-align: center;"><span style="color: #800000;"><em><strong>Khi bạn tắt chú ý này đi, đồng nghĩa với việc bạn đã đọc và chấp nhận những điều đó!</strong></em></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mt-5">
                        <div class="text-center mb-3">
                            <h3 class="text-uppercase">TOP THẮNG TUẦN</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center">
                                <thead>
                                <tr role="row" class="bg-primary">
                                    <th class="text-center text-white">TOP</th>
                                    <th class="text-center text-white">Số điện thoại</th>
                                    <th class="text-center text-white">Số tiền</th>
                                    <th class="text-center text-white">Phần thưởng</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all" id="week_top" class="text-center">
                                </tbody>
                            </table>
                            <div class="text-center">
                                <b class="text-danger">Phần thưởng TOP sẽ được trao vào 11h ngày cuối tuần.</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="hu-left-display" style="position: fixed; bottom: 15px; left: 15px; z-index: 1000; cursor: pointer; width: 15%;" class="{{ $setting->hu == 0 ? 'hidden' : '' }}">
        <b onclick="hu_click()">
            <img class="animate__animated animate__heartBeat animate__infinite infinite" src="{{ asset('image/hu.png') }}" alt="Chẵn Lẻ Momo" width="100%" style="max-height: 130px;max-width: 150px;min-height: 50px; min-width:80px;">
            <div class="text-center">
                <p class="animate__animated animate__shakeX animate__infinite infinite animate__slow 2 hu-balance" style="border-top-right-radius: 30px; border-top-left-radius: 30px; border-radius: 30px; background: aquamarine;">
                    {{ number_format("99999") }}đ
                </p>
            </div>
        </b>
    </div>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <footer class="footer">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12 text-white ">
                    Dịch vụ sever Momo
                    <a href="https://t.me/vpsever" target="_bblank" style="color:red;">VPSever</a> All rights reserved
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/jquery-1.10.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#modal_thongbao').modal('show')
            socket()
            $('[data-toggle="tooltip"]').tooltip()
        });

        initAjax = (data_ajax) => {
            $.ajax(data_ajax);
        }

        function getmomo() {
            initAjax({
                url: `{{ route('app.getMomo') }}`,
                data: {
                    _token: `{{ csrf_token() }}`
                },
                method: "POST",
                success: function(data) {
                    $(".return-momo").html(data);
                }
            });
        }
        function trangthai() {
            initAjax({
                url: `{{ route('app.getMomo') }}`,
                data: {
                    id: "trangthai",
                    _token: `{{ csrf_token() }}`
                },
                method: "post",
                success: function(data) {
                    $("#phone-table2").html(data);
                }
            });
        }

        function hu_click() {
            $("#hu-info").modal("show");
        }

        function socket() {
            initAjax({
                url: `{{ route('app.getDataInfo') }}`,
                data: {
                    _token: `{{ csrf_token() }}`
                },
                method: "POST",
                success: function(data) {
                    $(".return-momo").html(data.getMomoV2);
                    $("#phone-table2").html(data.getMomoV1);
                    $("#load_data_play").html(data.getHistory);
                    $("#week_top").html(data.getRank)
                }
            })
            {{--getmomo();--}}
            {{--trangthai();--}}
            {{--initAjax({--}}
            {{--    url: `{{ route('app.getHistory') }}`,--}}
            {{--    data: {--}}
            {{--        _token: `{{ csrf_token() }}`--}}
            {{--    },--}}
            {{--    method: "POST",--}}
            {{--    success: function(data) {--}}
            {{--        $("#load_data_play").html(data);--}}
            {{--    }--}}
            {{--});--}}
            {{--initAjax({--}}
            {{--    url: `{{ route('app.getRank') }}`,--}}
            {{--    data: {--}}
            {{--        _token: `{{ csrf_token() }}`--}}
            {{--    },--}}
            {{--    method: "POST",--}}
            {{--    success: function(data) {--}}
            {{--        $("#week_top").html(data);--}}
            {{--    }--}}
            {{--});--}}
        }

        function check_tranid() {
            var tran_id = document.getElementById("tran_id").value;
            initAjax({
                url: `{{ route('app.checkTransaction') }}`,
                data: {
                    id: tran_id,
                    get: "his",
                    _token: `{{ csrf_token() }}`
                },
                method: "POST",
                success: function(data) {
                    $("#result-check").html(data);
                }
            })
        }
        function gitcode() {
            var phone = document.getElementById("phonecode").value;
            var code = document.getElementById("code").value;
            initAjax({
                url: `{{ route('app.giftCode') }}`,
                data: {
                    code: code,
                    phone: phone,
                    _token: `{{ csrf_token() }}`
                },
                method: "POST",
                beforeSend: function() {
                    $("#gitcode").show();
                    $("#non_query_1").hide();
                },
                success: function(data) {
                    $("#result-gitcode").html(data);
                    $("#gitcode").hide();
                    $("#non_query_1").show();
                }
            })
        };

        function refund(trans_id) {
            $("#btn_refund").remove()
            initAjax({
                url: "{{ route('app.refund') }}",
                data: {
                    tran_id: trans_id,
                    _token: `{{ csrf_token() }}`
                },
                method: "POST",
                success: function(data) {
                    alert(data.message);
                }
            })
        };
        async function checkEventDay(){
            $(`#loadingReceive`).html('');
            const phone = $("#phoneCode").val();
            initAjax({
                url: `{{ route('app.checkEventDay') }}`,
                data: {
                    phone: phone,
                    _token: `{{ csrf_token() }}`
                },
                method: "POST",
                beforeSend: function() {
                    $("#loadingEventDay").html(`<span class="text-danger">Đang kiểm tra..</span>`);
                },
                success: function(res) {
                    if(res.result){
                        let data = res.data;
                        $("#h_r_phone").html(data.phone);
                        $("#h_r_total").html(number_format(data.total)+'đ');
                        data.receiveData.forEach(item => {
                            if(!item.receive){
                                $(`#e_id_${item.position}`).prop("disabled", true)
                            }else{
                                $(`#e_id_${item.position}`).prop("disabled", false)
                            }
                        })
                        $("#modal_random").modal('show');
                        $("#loadingEventDay").html(`<span class="text-success">Thành công!</span>`);
                    }else{
                        alert(res.message);
                        $("#loadingEventDay").html(`<span class="text-danger">Không có dữ liệu!</span>`);
                    }
                }
            });
        }
        function receive(event_id){
            const phone = $("#phoneCode").val();
            initAjax({
                url: `{{ route('app.receive') }}`,
                data: {
                    phone: phone,
                    position: event_id,
                    _token: `{{ csrf_token() }}`
                },
                method: "POST",
                beforeSend: function() {
                    $(`#e_id_${event_id}`).attr('disabled', true);
                    $(`#loadingReceive`).html('Vui lòng chờ...');
                },
                success: function(res) {
                    if(res.result){
                        let data = res.data;

                    }else{
                        alert(res.message);
                    }
                    $(`#loadingReceive`).html(res.message);
                }
            });
        }

        function number_format(_0x90f8x4) {
            var _0x90f8x20 = String(_0x90f8x4);
            var _0x90f8x21 = _0x90f8x20['length'];
            var _0x90f8x22 = 0;
            var _0x90f8x23 = '';
            var _0x90f8xa;
            for (_0x90f8xa = _0x90f8x21 - 1; _0x90f8xa >= 0; _0x90f8xa--) {
                _0x90f8x22 += 1;
                aa = _0x90f8x20[_0x90f8xa];
                if (_0x90f8x22 % 3 == 0 && _0x90f8x22 != 0 && _0x90f8x22 != _0x90f8x21) {
                    _0x90f8x23 = '.' + aa + _0x90f8x23
                } else {
                    _0x90f8x23 = aa + _0x90f8x23
                }
            };
            return _0x90f8x23
        }

        $(document).ready(function() {
            function isJsonString(str) {
                try {
                    JSON.parse(str);
                } catch (e) {
                    return false;
                }
                return true;
            }

            $('button[server-action=change]').click(function() {
                let button = $(this);
                let id = button.attr('data-game');

                selection_server = id;
                selection_rate = button.attr('server-rate');
                $('.game').removeClass('active');
                $(`.game[game-tab=${id}]`).addClass('active');
                $('.momo').removeClass('return-momo');
                $(`.momo[game-tab=${id}]`).addClass('return-momo');
                $('button[server-action=change]').attr('class', 'btn btn-default');
                button.attr('class', 'btn btn-primary');
                socket();
            });
            $('button[data-game=CLTX]').click();
        });

        function copyStringToClipboard(str) {
            var el = document.createElement('textarea');
            var copydown = document.getElementById('copydown');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style = {
                position: 'absolute',
                left: '-9999px'
            };
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            var thongbao = 'Đã sao chép số điện thoại: ' + el.value +
                ' Vui lòng chú ý hạn mức còn lại trước khi chơi nhé .';
            alert(thongbao);
        }

        function play(str) {
            window.open(`https://nhantien.momo.vn/${str}`, '_blank')
        }

        function coppy(text, min, max) {
            var textArea = document.createElement("textarea");
            textArea.style.position = 'fixed';
            textArea.style.top = 0;
            textArea.style.left = 0;
            textArea.style.width = '2em';
            textArea.style.height = '2em';
            textArea.style.padding = 0;
            textArea.style.border = 'none';
            textArea.style.outline = 'none';
            textArea.style.boxShadow = 'none';
            textArea.style.background = 'transparent';
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                alert('Đã sao chép số điện thoại: 0' + text + '. Chỉ chơi từ: ' + min + ' VNĐ đến ' + max +
                    ' VNĐ chúc bạn may mắn ');
            } catch (err) {
                console.log('Oops, unable to copy');
            }
            document.body.removeChild(textArea);
        }

        var i = 0,
            a = 0,
            isBackspacing = false,
            isParagraph = false;
        var textArray = [
            "CHẴN LẺ MOMO (CLMM) • CLTX MOMO • {{ $setting->name ?? "" }} | Hệ Thống Chẵn Lẻ MoMo 24h | Uy Tín, Giao Dịch Tự Động 24/7 - Bank 30s !",
            "Chơi Chẵn Lẻ Trên Momo Auto 3s Trả Thưởng | Uy Tín - Nhanh Gọn - Tự Động 24/7 !"
        ];
        var speedForward = 0,
            speedWait = 15000,
            speedBetweenLines = 10,
            speedBackspace = 0;
        typeWriter("output", textArray);

        function typeWriter(id, ar) {
            var element = $("#" + id),
                aString = ar[a],
                eHeader = element.children("h2"),
                eParagraph = element.children("h4");
            if (!isBackspacing) {
                if (i < aString.length) {
                    if (aString.charAt(i) == "|") {
                        isParagraph = true;
                        eHeader.removeClass("cursor");
                        eParagraph.addClass("cursor");
                        i++;
                        setTimeout(function() {
                            typeWriter(id, ar);
                        }, speedBetweenLines);
                    } else {
                        if (!isParagraph) {
                            eHeader.text(eHeader.text() + aString.charAt(i));
                        } else {
                            eParagraph.text(eParagraph.text() + aString.charAt(i));
                        }
                        i++;
                        setTimeout(function() {
                            typeWriter(id, ar);
                        }, speedForward);
                    }
                } else if (i == aString.length) {
                    isBackspacing = true;
                    setTimeout(function() {
                        typeWriter(id, ar);
                    }, speedWait);
                }
            } else {
                if (eHeader.text().length > 0 || eParagraph.text().length > 0) {
                    if (eParagraph.text().length > 0) {
                        eParagraph.text(eParagraph.text().substring(0, eParagraph.text().length - 1));
                    } else if (eHeader.text().length > 0) {
                        eParagraph.removeClass("cursor");
                        eHeader.addClass("cursor");
                        eHeader.text(eHeader.text().substring(0, eHeader.text().length - 1));
                    }
                    setTimeout(function() {
                        typeWriter(id, ar);
                    }, speedBackspace);
                } else {
                    isBackspacing = false;
                    i = 0;
                    isParagraph = false;
                    a = (a + 1) % ar.length;
                    setTimeout(function() {
                        typeWriter(id, ar);
                    }, 50);
                }
            }
        }
        $(document).ready(function() {
            function Timer(fn, t) {
                var timerObj = setInterval(fn, t);
                this.stop = function() {
                    if (timerObj) {
                        clearInterval(timerObj);
                        timerObj = null;
                    }
                    return this;
                }
                this.start = function() {
                    if (!timerObj) {
                        this.stop();
                        timerObj = setInterval(fn, t);
                    }
                    return this;
                }
                this.reset = function(newT = t) {
                    t = newT;
                    return this.stop().start();
                }
            }
            var timeleft = 15;
            var downloadTimer = new Timer(function() {
                if (timeleft <= 0) {
                    socket();
                    downloadTimer.stop();
                    const elements = document.querySelectorAll('.coundown-time');
                    elements.forEach(el => {
                        el.innerHTML = 0;
                    });
                    $.when(function(xhr) {}, ).then(function() {
                        const elements2 = document.querySelectorAll('.coundown-time');
                        elements2.forEach(el => {
                            el.innerHTML = 15;
                        });
                        timeleft = 15;
                        downloadTimer.start();
                    });
                } else {
                    const elements3 = document.querySelectorAll('.coundown-time');
                    elements3.forEach(el => {
                        el.innerHTML = timeleft;
                    });
                }
                timeleft -= 1;
            }, 1000);
        });
    </script>
</body>
</html>
