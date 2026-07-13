@extends('layouts.common')

@section('content')
<style>
    .login-form {
        background: #f5f5f5;
        width: 400px;
        border-radius: 6px;
        margin: 0 auto;
        display: table;
        padding: 30px;
        box-sizing: border-box;
    }

    .login-form h1 {
        font-size: 36px;
        text-align: center;
        color: #1017e3;
        margin-bottom: 30px;
        font-weight: normal;
    }

    .login-form .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    .login-form .form-group {
        width: 100%;
        margin: 0 0 15px;
        position: relative;
    }

    .login-form input {
        width: 100%;
        padding: 10px;
        height: 40px;
        border-radius: 20px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        font-size: 15px;
        padding-left: 40px;
    }

    .login-form .form-group .input-icon {
        font-size: 15px;
        position: absolute;
        bottom: 0;
        height: 100%;
        padding-left: 15px;
        color: #666;
        display: flex;
        align-items: center;
    }

    .login-form .login-btn {
        background: #1017e3;
        padding: 10px 30px;
        border-color: #1017e3;
        color: #fff;
        text-align: center;
        margin: 0 auto;
        font-size: 18px;
        border: 1px solid #1017e3;
        border-radius: 22px;
        width: 100%;
        cursor: pointer;
    }

    .login-form .login-btn:hover {
        opacity: 0.9;
    }

    .login-form .reset-psw {
        text-decoration: none;
        color: #1017e3;
        font-size: 14px;
        text-align: center;
        margin-top: 10px;
        display: block;
    }

    .login-form .seperator {
        width: 100%;
        border-top: 1px solid #ccc;
        text-align: center;
        margin: 30px 0;
    }

    .login-form .seperator b {
        width: 40px;
        height: 40px;
        font-size: 16px;
        text-align: center;
        line-height: 40px;
        background: #fff;
        display: inline-block;
        border: 1px solid #e0e0e0;
        border-radius: 50%;
        position: relative;
        top: -22px;
        z-index: 1;
    }

    .login-form p {
        width: 100%;
        text-align: center;
        font-size: 16px;
        margin: 10px 0;
    }

    .login-form .social-icon {
        text-align: center;
    }

    .login-form .social-icon button {
        font-size: 20px;
        color: white;
        width: 50px;
        height: 50px;
        background: #1017e3;
        border-radius: 50%;
        margin: 0 10px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .login-form .social-icon button:hover {
        background-color: #090da6;
    }

    @media screen and (max-width: 767px) {
        .login-form {
            width: 90%;
            padding: 15px;
        }
    }
</style>
<div class="container">
    <div class="row justify-content-center">

        <div class="login-form mb-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>{{ __('Login') }}</h1>
                @if(request()->has('redirect'))
                <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                @endif
                <div class="form-group">
                    <input type="email" name="email" placeholder="E-mail Address" @error('email') is-invalid @enderror value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span class="input-icon"><i class="fa fa-envelope"></i></span>
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                </div>


                <button class="login-btn">Login</button>
                @if (Route::has('password.request'))
                <a class="btn btn-link reset-psw" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
                <div class="seperator"><b>or</b></div>
                <p>Sign in with your social media account</p>
                <!-- Social login buttons -->
                <div class="social-icon">
                    <button type="button" class="fa fa-facebook"></button>
                    <button type="button" class="fa fa-google"></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection