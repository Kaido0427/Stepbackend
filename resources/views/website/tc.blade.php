@extends('website.layout.app', ['activePage' => 'tc'])
@section('content')
<div class="pt-10 pb-20 w-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2 h-screen">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <h5 class="font-poppins font-semibold text-[#404F65] text-2xl mb-10">{{__('Termes et Conditions')}}</h5>
        <p class="font-poppins font-normal text-[#404F65] text-base leading-7 tracking-wide mb-5">{!! $settings->terms_condition !!}</p>        
    </div>
</div>
@endsection