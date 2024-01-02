@extends('website.layout.app', ['activePage' => 'contactus'])
@section('content')
<div class="pt-10 pb-20 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <div class="col-12">
            @if(session()->has('alert-success'))
            <div class="w-full text-[#4fd69c] font-semibold font-normal text-center text-lg tracking-wide mb-2">
                {{ session()->get('alert-success') }}
            </div>
            @endif
            @if(Session::has('success'))
            <div class="success">
                <div class="alert-success text-center w-full bg-[#4fd69c] text-white font-semibold font-normal text-center text-lg tracking-wide mb-2">{{ session::get('success')}}</div>
            </div>
            @endif
        </div>
        <h5 class="font-poppins font-semibold text-[#404F65] text-2xl mb-10">{{__('Contactez nous')}}</h5>
        <div class="flex gap-7 mb-8 lg:flex-row s:flex-col">
            <div class="bg-white rounded-[16px] xxxxl:w-[760px] h-[480px] s:w-full p-5">
                <iframe src="https://maps.google.com/maps?q=california&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=&amp;output=embed" loading="lazy" class="w-full h-full rounded-lg"></iframe>
            </div>
            <div class="bg-white rounded-[16px] xxxxl:w-[537px] h-[480px] s:w-full md:p-7 s:p-5">
                <form action="{{url('/contactus_mail')}}" method="post">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="email" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Email')}}</label>
                        <input type="text" name="email" class="border border-[#D5DAE1] rounded-lg p-3 w-full mt-3">
                        @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="email" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Message')}}</label>
                        <textarea name="message" id="message" rows="7" class="w-full border border-[#D5DAE1] rounded-lg mt-3"></textarea>
                        @error('message')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="w-full bg-primary font-poppins font-medium text-lg text-white h-14 rounded-md tracking-wide">{{__('Envoyer')}}</button>
                </form>
            </div>
        </div>
        <div class="grid xxl:grid-cols-4 gap-5 s:grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white drop-shadow-sm p-7 rounded-2xl">
                <div class="w-12 h-12 rounded-full bg-primary mb-5">
                    <img src="{{asset('website/icon/location-white.svg')}}" alt="" class="mx-auto pt-3.5">
                </div>
                <h5 class="font-poppins font-semibold text-[#2A3342] text-2xl tracking-wide mb-5">{{__('Office')}}</h5>
                <p class="font-poppins font-medium text-xl text-gray">{{$contactus->address}}</p>
            </div>
            <div class="bg-white drop-shadow-sm p-7 rounded-2xl">
                <div class="w-12 h-12 rounded-full bg-primary mb-5">
                    <img src="{{asset('website/icon/mail.svg')}}" alt="" class="mx-auto pt-3.5">
                </div>
                <h5 class="font-poppins font-semibold text-[#2A3342] text-2xl tracking-wide mb-5">{{__('Email')}}</h5>
                <p class="font-poppins font-medium text-xl text-gray">{{$contactus->email}}</p>
            </div>
            <div class="bg-white drop-shadow-sm p-7 rounded-2xl">
                <div class="w-12 h-12 rounded-full bg-primary mb-5">
                    <img src="{{asset('website/icon/call.svg')}}" alt="" class="mx-auto pt-3.5">
                </div>
                <h5 class="font-poppins font-semibold text-[#2A3342] text-2xl tracking-wide mb-5">{{__('Appel')}}</h5>
                <p class="font-poppins font-medium text-xl text-gray">{{$contactus->phone}}</p>
            </div>
            <div class="bg-white drop-shadow-sm p-7 rounded-2xl">
                <div class="w-12 h-12 rounded-full bg-primary mb-5">
                    <img src="{{asset('website/icon/social.svg')}}" alt="" class="mx-auto pt-3.5">
                </div>
                <h5 class="font-poppins font-semibold text-[#2A3342] text-2xl tracking-wide mb-5">{{__('Socials')}}</h5>
                <div class="flex gap-5">
                    <a href="{{$contactus->facebook_url}}" target="_blank"><img src="{{asset('website/icon/Facebook.svg')}}"></a>
                    <a href="{{$contactus->twitter_url}}" target="_blank"><img src="{{asset('website/icon/Twitter.svg')}}"></a>
                    <a href="{{$contactus->instagram_url}}" target="_blank"><img src="{{asset('website/icon/Instagram.svg')}}"></a>
                    <a href="{{$contactus->linkdin_url}}" target="_blank"><img src="{{asset('website/icon/LinkedIn.svg')}}"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection