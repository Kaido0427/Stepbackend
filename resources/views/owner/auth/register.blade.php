<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $adminSetting = \App\AdminSetting::first();
    @endphp
    <link rel="shortcut icon" href="{{  url('upload/'.$adminSetting->favicon)  }}">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <meta name="base_url" content="{{ url('/') }}" />

    <title>{{ $adminSetting->name }} {{ ' inscription du Concierge' }}</title>

    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    
    <style>
        :root{
            --primary_color : <?php echo $adminSetting->color ?>;
            --primary_color_hover : <?php echo $adminSetting->color.'cc' ?>;
        }
    </style>

    @stack('css')
    @if (session('direction') == 'rtl')
        <link href="{{ asset('argon') }}/css/rtl_direction.css" rel="stylesheet">
    @endif
</head>

<body class="{{ $class ?? '' }}" >
    <div class="main-content">
        <div class="container-fuild py-7 py-lg-8 bg-primary">
            <div class="container py-7 py-lg-8">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-header bg-transparent pb-5" style="text-align: center;padding: 0;padding: 22px 0px !important;">
                                <img src="{{ url('upload/'.$adminSetting->logo) }}" style="height: 50px"/>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <form role="form" method="POST" action="{{ url('owner/register_confirm') }}">
                                    @csrf
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nom') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Mot de passe') }}" type="password" name="password" required>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="{{ __('Confirmer le mot de passe') }}" type="password" name="password_confirmation" required>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="text-muted font-bold">
                                        <small>{{ __('Déja inscrit?') }}  <span class="text-success font-weight-700"><a href="{{url('owner/login')}}">{{ __('Se connecter') }}</a></span></small>
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mt-4">{{ __('Créer un compte') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('owner.layouts.headers.guest') --}}
    <div class="container mt--8 pb-5">
    </div>
</body>
</html>
