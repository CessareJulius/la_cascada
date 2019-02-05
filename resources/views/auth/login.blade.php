<!doctype html>
<html class="no-js" lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>La Cascada</title>
        <meta name="description" content="aurora project">
        <meta name="author" content="CessareJulius">
        <meta name="keywords" content="">
        
        <link rel="icon" href="../favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('themekit/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ionicons/dist/css/ionicons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themekit/node_modules/perfect-scrollbar/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('themekit/dist/css/theme.min.css') }}">
        <script src="{{ asset('themekit/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>

        <style>
            .custom-login{
                height: 100vh;
                display: flex;
                position: fixed;
                left: 0px;
                background-color: rgba(230,230,230,.5);
                align-items: center;
            }
            @media (min-height: 446px) and (max-height: 640px){
                .custom-login{
                    overflow: auto;
                }
                .authentication-form{
                    margin-top: 35%;
                }
            }
        </style>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('{{ asset('themekit/img/fondo1.jpg') }}')">
                            <div class="lavalite-overlay" style="background: linear-gradient(135deg,rgba(46,52,81,.4) 0%,rgba(52,40,104,0.5) 100%) !important;"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="#">
                                    <img src="{{ asset('themekit/img/al.png') }}" alt="" style="width: 160%;height: auto;">
                                </a>
                            </div>
                            <h2 style="margin-bottom:1.5rem">Entrar a La Cascada</h2>
                            @if ($errors->any())
                                <div style="background-color: #f34249d9;color: white;border-radius: 3px; text-align:left;padding-top: 1%;padding-bottom: 1%;margin-bottom: 4%;">
                                    <ul style="margin-bottom:0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email"
                                            type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required autofocus>
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input id="password"
                                            type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password"
                                            required>
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="row">
                                    <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="remember" id="item_checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="custom-control-label" style="padding-top: 5px">&nbsp;Recordarme</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="sign-btn text-center">
                                    <button class="btn btn-theme">Acceder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('themekit/src/js/vendor/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('themekit/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('themekit/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('themekit/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('themekit/node_modules/screenfull/dist/screenfull.js') }}"></script>
        <script src="{{ asset('themekit/dist/js/theme.js') }}"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>



{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}