<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $adminSetting = \App\AdminSetting::first();
    @endphp
    <link rel="shortcut icon" href="{{  url('upload/'.$adminSetting->favicon)  }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="base_url" content="{{ url('/') }}" />

    <title>{{ $adminSetting->name }}  {{$title ?? ''}}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <link href="{{ asset('argon') }}/css/dataTables.min.css" rel="stylesheet" />
    <style>
        :root{
            --primary_color : <?php echo $adminSetting->color ?>;
            --primary_color_hover : <?php echo $adminSetting->color.'cc' ?>;
        }
        </style>
    @if (session('direction') == 'rtl')
        <link href="{{ asset('argon') }}/css/rtl_direction.css" rel="stylesheet">
    @endif
</head>

<body>
    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('layouts.navbars.sidebar')
    @endauth


    <div class="main-content rlt_maincontent">
        @include('layouts.navbars.navbar')
        @if (auth()->check())
        @yield('content')
        @if (App\AdminSetting::first()->license_status)
            @yield('license')
        @else
            <script>
                var a = $('meta[name=base_url]').attr('content');
                if(window.location.origin + window.location.pathname != a + '/licenseactive')
                // if(window.location.pathname != '/licenseactive')
                {
                    window.alert('License is deactivates please active your license.');
                    window.location.href=(a+'/licenseactive');
                }
            </script>
            @yield('license')
        @endif
    @else
        @yield('content')
    @endif
    </div>

    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    @stack('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script src="{{ asset('argon') }}/js/own.js"></script>
    <script src="{{ asset('argon') }}/js/datatables.min.js"></script>
</body>

</html>
