@extends('admin.layouts.admin')
@section('content')
    <form class="col-sm-3" action="{{ route('postChangePassword') }}" method="POST">
        @csrf
        @if (count($errors) >0)
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-danger"> {{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (session('error'))
            <ul>
                <li class="text-danger"> {{ session('error') }}</li>
            </ul>
        @endif
        @if (session('success'))
            <ul>
                <li class="text-primary"> {{ session('success') }}</li>
            </ul>
        @endif
        <div class="form-group">
            <label for="old_password">Nhập mật khẩu cũ</label>
            <input type="password" class="form-control" id="old_password" placeholder="Mật khẩu cũ" name="old_password" value="{{ old('old_password') }}">
        </div>
        <div class="form-group">
            <label for="new_password">Nhập mật khẩu mới</label>
            <input type="password" class="form-control" id="new_password" placeholder="Mật khẩu mới" name="new_password" value="{{ old('new_password') }}">
        </div>
        <div class="form-group">
            <label for="renew_password">Nhập lại mật khẩu mới</label>
            <input type="password" class="form-control" id="renew_password" placeholder="Xác nhận mật khẩu mới" name="renew_password" value="{{ old('renew_password') }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
