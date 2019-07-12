@extends('login.login')
@section('form')
<form method="POST" action="{{route('admin.login.submit')}}">
    @csrf
    <div class="form-group">
        @if ($errors->has('email'))
        <div class="callout callout-danger">
            <p>{{ $errors->first('email') }}</p>
        </div>
        @endif
        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>  {{ __('Tetap Masuk') }}
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <button type="submit" class="btn btn-warning btn-block btn-flat">Masuk Admin</button>
        </div>
        <!-- /.col -->
    </div>
</form>
@endsection
