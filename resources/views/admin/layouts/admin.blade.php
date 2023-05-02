<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $titlePage ?? "Admin | Trang Quản Trị" }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.jpeg') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/custom.css?v=1') }}">
    @yield('push_css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('admin.layouts.navbar')
    <!-- Main Sidebar Container -->
    @include('admin.layouts.menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="h__title_page">
                    <h2 class="m-0">{{ $titlePage ?? "" }}</h2>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    @include('admin.layouts.footer')
</div>
</body>
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/js/loading-overlay.min.js') }}"></script>
<script src="{{ asset('assets/js/message.js') }}"></script>
<script src="{{ asset('assets/js/vue.min.js') }}"></script>
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
@yield('push_js')
</html>
