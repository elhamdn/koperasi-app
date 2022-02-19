@extends('layouts.template')

@section('content')
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="mb-4 text-center">
                    <img src="https://kopmafeuii.com/wp-content/uploads/2017/06/LAMBANG-KOPERASI.png" alt="Logo" srcset="" style="object-fit: contain; width: 100px;height:100px">
                </div>
                <h2 class="text-center text-secondary">Koperasi App</h2>
                <h3 class="text-center text-dark mb-5">Log in</h3>
                <form method="post" action="{{ route('login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                        @endif
                        <div class="form-control-icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                        @endif
                        <div class="form-control-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end" style="margin-left: 5px">
                        <input type="checkbox" class="form-check-input me-2" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-gray-600" for="remember">
                            Remember Me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
                @if (Session::has('success'))
                <div class="alert alert-success mt-3">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger mt-3">
                    {{ Session::get('error') }}
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right"></div>
        </div>
    </div>
</div>
@endsection