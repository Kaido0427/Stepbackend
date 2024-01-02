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
    <link rel="shortcut icon" href="{{ asset('argon') }}/img/brand/favicon2.png">

    <title>{{ $adminSetting->name }} {{$title ?? ''}}</title>
    {{-- <title>{{ config('app.name', 'step') }} {{$title ?? ''}} </title> --}}

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">

    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/css/dataTables.min.css" rel="stylesheet" />

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
    @auth('owner')
        @include('owner.layouts.navbars.sidebar')
    @endauth
   
    @if (Auth::guard('owner')->check())
        <div class="main-content">
            @include('owner.layouts.navbars.navbar')
            @if (Auth::guard('owner')->user()->subscription_status)
                @yield('content')
                @yield('subscription')
            @else
                <script>
                    var url =  window.location.origin+window.location.pathname;
                    var to = url.lastIndexOf('/');
                    to = to == -1 ? url.length : to;
                    url2 = url.substring(0, to);
                    var a = document.querySelector("meta[name='base_url']").getAttribute("content")+'/owner/subscription';
                    if (window.location.origin + window.location.pathname != document.querySelector("meta[name='base_url']").getAttribute("content") + '/owner/subscription')
                    {
                        window.alert('Your subscription has expired.');
                        window.location.href=a;
                    }
                </script>
                @yield('subscription')
            @endif
        </div>
    @else
        <div class="main-content">
            @yield('content')
        </div>
    @endif
        
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script src="{{ asset('argon') }}/js/datatables.min.js"></script>
    <script src="{{asset('Owner/js/owner.js')}}"></script>
    <script src="{{asset('Owner/js/sweetalert2@10.js')}}"></script>


</body>

</html>
