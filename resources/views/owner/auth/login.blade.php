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

    <title>{{ $adminSetting->name }} {{ ' Connexion Concierge' }}</title>

    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">

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
                                @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <form role="form" method="POST" action="{{ url('owner/login_confirm') }}">
                                    @csrf
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
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
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('mot de passe') }}" type="password" required>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-muted font-bold d-flex justify-content-between">
                                        <small>{{ __(' Créer un nouveau compte ?') }}  <span class="text-success font-weight-700"><a href="{{url('owner/register')}}">{{ __('inscription') }}</a></span></small>
                                       
                                    </div>
                                        
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">{{ __('Se connecter') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>