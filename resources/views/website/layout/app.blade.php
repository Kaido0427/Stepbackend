<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
    $adminSetting = \App\AdminSetting::first();
    @endphp
    <link rel="shortcut icon" href="{{  url('upload/'.$adminSetting->favicon)  }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base_url" content="{{ url('/') }}" />
    <title>{{ $adminSetting->name }} {{$title ?? ''}}</title>

    <input type="hidden" name="base_url" value="{{ url('/') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.2/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }


        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid rgb(59 113 202);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    @if (session('direction') == 'rtl')
    <link href="{{ asset('argon') }}/css/rtl_direction.css" rel="stylesheet">
    @endif
</head>

<body class="{{ $class ?? '' }}">
<div id="loader" class="loader-container flex hidden">
                <div class="loader"></div>
            </div>
    <nav class="bg-white w-full h-16 xxxxl:pt-[0px] xxxxl:pl-[300px] xxxxl:pr-[300px] xxxxl:mt-4 s:pl-[10px] s:pr-[10px] s:pt-[10px] l:pr-[15px] l:pl-[15px] sm:pr-[20px] sm:pl-[20px] lg:pr-[30px] lg:pl-[30px] xxl:pr-[100px] xxl:pl-[100px] xxxl:pr-[150px] xxxl:pl-[150px] shadow-md shadow-[rgba(0, 0, 0, 0.1)]">
        @include('website.layout.header')
    </nav>
    @yield('content')
    <footer class="bottom-0">
        @include('website.layout.footer')
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('website/js/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.2/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</html>