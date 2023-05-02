<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <style>
        .send-otp{
            cursor: pointer;
        }
        .send-otp:hover .input-group-text{
            background: #bbc9d3;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('app') }}" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{ route('postLogin') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="email" name="email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
{{--                <div class="input-group mb-3">--}}
{{--                    <input type="text" class="form-control" placeholder="otp" name="otp" value="{{ old('otp') }}">--}}
{{--                    <div class="input-group-append send-otp" onclick="sendOTP()">--}}
{{--                        <div class="input-group-text">--}}
{{--                            <span class="fas fa-paper-plane"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @if (count($errors) >0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger"> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (session('status'))
                    <ul>
                        <li class="text-danger"> {{ session('status') }}</li>
                    </ul>
                @endif
                <div class="social-auth-links text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </form>


            <!-- /.social-auth-links -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<script src="{{ asset('assets/js/loading-overlay.min.js') }}"></script>
<script src="{{ asset('assets/js/axios.min.js') }}"></script>
<script>
    axios.interceptors.request.use((config) => {
        $.LoadingOverlay('show');
        return config;
    }, (error) => {
        return Promise.reject(error);
    });
    axios.interceptors.response.use((response) => {
        $.LoadingOverlay('hide');
        return response.data;
    }, (error) => {
        $.LoadingOverlay('hide');
        return Promise.reject(error);
    });
</script>
<script>
    const sendOTP = () => {
        axios.post('{{ route('sendOTP') }}', {
            email: $("input[name=email]").val()
        }).then(res => {
            alert(res.message)
        })
        console.log('ssss')
    }
</script>
</body>
</html>
