@extends('website.layout.app', ['activePage' => 'home'])
@section('content')

<div class="pb-20 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2">
    @if(session('direction') == 'rtl')
    <div class="w-full mb-10 bg-cover bg-no-repeat" style="background-image: url({{asset('website/image/hero_rtl.png')}});height: 548px;">
        @else
        <div class="w-full mb-10 bg-cover bg-no-repeat" style="background-image: url({{asset('website/image/Hero.png')}});height: 548px;">
            @endif
            <div id="success_msg" class="w-full bg-[#4fd69c] text-white font-semibold font-normal text-center text-lg tracking-wide"></div>

            <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] xxxxl:pt-[116px] s:pl-[10px] s:pr-[10px] s:pt-[50px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">

                
                <div class="xxxxl:w-[658px] lg:w-[700px]">
                    <h1 class="font-poppins font-bold text-dark-gray xxxxl:text-6xl leading-[72px] mb-7 s:text-4xl sm:text-6xl">{{__('Sécurisez votre vélo avec notre service de Parking dédié.')}} </h1>
                    <p class="font-poppins font-medium text-[#8896AB] text-base leading-8 mb-10">{{__('Simplification de la mobilité urbaine. Nous sommes une entreprise de mobilité urbaine axée sur l\'avenir, dédiée à fournir des solutions intégrées. Grâce à nos services innovants, nous visons à transformer la manière dont les gens se déplacent et vivent les villes.')}}</p>
                    @if(Auth::guard('appuser')->check())
                    <a href="{{asset('/parking_map_list')}}"><button class="w-48 h-14 bg-primary text-white font-poppins font-semibold text-lg rounded-[6px]">{{__('Reserver un Parking')}}</button></a>
                    @else
                    <button class="w-48 h-14 bg-primary text-white font-poppins font-semibold text-lg rounded-[6px]" data-modal-target="SignIn" data-modal-toggle="SignIn" type="button">{{__('Réserver un Parking.')}}</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">

            {{-- How it works? --}}
            <div class="bg-white rounded-[32px] md:p-10 mb-10 s:p-4">
                <h5 class="font-poppins font-bold text-dark-gray text-4xl mb-3">{{__('Comment ça fonctionne ?')}}</h5>
                <img src="{{asset('website/image/how_it_works.png')}}" alt="" class="object-cover">
            </div>

            {{-- Services --}}

            <div class="bg-light-blue md:rounded-[64px] xxxxl:pt-10 md:p-10 mb-10 s:p-4 s:pt-10 s:rounded-[30px]">
                <h5 class="font-poppins font-bold text-dark-gray text-4xl mb-5">{{__('Services')}}</h5>
                <div class="grid xl:grid-cols-4 gap-7 mb-7 s:grid-cols-1 l:grid-cols-2 md:grid-cols-3">
                    @forelse($services as $service)
                    <div class="bg-white p-4 rounded-[32px] border border-light-gray">
                        <div class="mb-3">
                            <img src="{{asset('upload/'.$service->image)}}" alt="" class="mx-auto">
                        </div>
                        <ul class="border border-light-gray lg:w-32 mx-auto mb-3"></ul>
                        <h3 class="font-poppins font-semibold text-dark-gray text-base text-center">{{$service->title}}</h3>
                    </div>
                    @empty
                    <p class="font-poppins font-medium text-lg text-[#556987] text-center mt-10">{{ __('Aucun service n\'est disponible.') }}</p>
                    @endforelse
                </div>
            </div>

            {{-- Feature Parking --}}

            <div class="bg-white xxxxl:rounded-[64px] md:p-10 s:p-4 mb-10 s:rounded-[30px]">
                <h5 class="font-poppins font-bold text-dark-gray text-4xl mb-5">{{__('Parkings en vedette.')}}</h5>
                <div class="grid lg:grid-cols-3 s:grid-cols-1 md:grid-cols-2 xxxxl:gap-10 s:gap-5">
                    @forelse($spaceslots as $item)
                    <div class="border border-light-gray rounded-[32px] p-5">
                        @if(isset($item->image))
                        <img src="{{asset('upload/'.$item->image)}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                        @else
                        <img src="{{asset('/images/no-image-space.png')}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                        @endif
                        <div class="flex justify-between mb-5">
                            <h4 class="font-poppins font-semibold text-dark-gray text-xl">{{$item->name}}</h4>
                            @if(isset($item->rate))                            
                            <div class="flex gap-1 pl-2 pr-2 items-center w-[71px] h-[43px] bg-light-orange rounded-[8px]">
                                <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                                <h6 class="font-poppins font-normal text-gray text-lg">{{$item->rate->star}}</h6>
                            </div>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                            <p class="font-poppins font-normal text-gray text-lg">{{$item->address}}</p>
                        </div>
                    </div>
                    @empty
                    <p class="font-poppins font-medium text-lg text-[#556987] text-center mt-10">{{ __('Aucun Parking n\'est mis en avant pour le moment.') }}</p>
                    @endforelse

                </div>

                <!-- <div class="content-area w-full overflow-hidden">
                    <div class="platform h-full flex gap-5">

                        <div class="flex each-frame border-box">
                            <div class="w-[390px] h-[502px] border border-light-gray rounded-[32px] p-5">
                                <img src="{{asset('website/image/mountain.png')}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                                <div class="flex justify-between mb-5">
                                    <h4 class="font-poppins font-semibold text-dark-gray text-xl">{{__('Mountain View Parking')}}</h4>
                                    <div class="flex gap-1 pl-2 pr-2 items-center w-[71px] h-[43px] bg-light-orange rounded-[8px]">
                                        <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                                        <h6 class="font-poppins font-normal text-gray text-lg">{{__('4.5')}}</h6>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                                    <p class="font-poppins font-normal text-gray text-lg">{{__('711-2880 Nulla St.Mankato Mississippi 96522 (257) 563-7401')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex each-frame border-box">
                            <div class="w-[390px] h-[502px] border border-light-gray rounded-[32px] p-5">
                                <img src="{{asset('website/image/mile.png')}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                                <div class="flex justify-between mb-5">
                                    <h4 class="font-poppins font-semibold text-dark-gray text-xl">{{__('Mountain View Parking')}}</h4>
                                    <div class="flex gap-1 pl-2 pr-2 items-center w-[71px] h-[43px] bg-light-orange rounded-[8px]">
                                        <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                                        <h6 class="font-poppins font-normal text-gray text-lg">{{__('4.5')}}</h6>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                                    <p class="font-poppins font-normal text-gray text-lg">{{__('711-2880 Nulla St.Mankato Mississippi 96522 (257) 563-7401')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex each-frame border-box">
                            <div class="w-[390px] h-[502px] border border-light-gray rounded-[32px] p-5">
                                <img src="{{asset('website/image/land.png')}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                                <div class="flex justify-between mb-5">
                                    <h4 class="font-poppins font-semibold text-dark-gray text-xl">{{__('Mountain View Parking')}}</h4>
                                    <div class="flex gap-1 pl-2 pr-2 items-center w-[71px] h-[43px] bg-light-orange rounded-[8px]">
                                        <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                                        <h6 class="font-poppins font-normal text-gray text-lg">{{__('4.5')}}</h6>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                                    <p class="font-poppins font-normal text-gray text-lg">{{__('711-2880 Nulla St.Mankato Mississippi 96522 (257) 563-7401')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex each-frame border-box">
                            <div class="w-[390px] h-[502px] border border-light-gray rounded-[32px] p-5">
                                <img src="{{asset('website/image/mountain.png')}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                                <div class="flex justify-between mb-5">
                                    <h4 class="font-poppins font-semibold text-dark-gray text-xl">{{__('Mountain View Parking')}}</h4>
                                    <div class="flex gap-1 pl-2 pr-2 items-center w-[71px] h-[43px] bg-light-orange rounded-[8px]">
                                        <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                                        <h6 class="font-poppins font-normal text-gray text-lg">{{__('4.5')}}</h6>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                                    <p class="font-poppins font-normal text-gray text-lg">{{__('711-2880 Nulla St.Mankato Mississippi 96522 (257) 563-7401')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex each-frame border-box">
                            <div class="w-[390px] h-[502px] border border-light-gray rounded-[32px] p-5">
                                <img src="{{asset('website/image/land.png')}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                                <div class="flex justify-between mb-5">
                                    <h4 class="font-poppins font-semibold text-dark-gray text-xl">{{__('Mountain View Parking')}}</h4>
                                    <div class="flex gap-1 pl-2 pr-2 items-center w-[71px] h-[43px] bg-light-orange rounded-[8px]">
                                        <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                                        <h6 class="font-poppins font-normal text-gray text-lg">{{__('4.5')}}</h6>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                                    <p class="font-poppins font-normal text-gray text-lg">{{__('711-2880 Nulla St.Mankato Mississippi 96522 (257) 563-7401')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex each-frame border-box">
                            <div class="w-[390px] h-[502px] border border-light-gray rounded-[32px] p-5">
                                <img src="{{asset('website/image/mile.png')}}" alt="" class="w-[376px] h-[330px] rounded-[8px] mb-5 object-cover">
                                <div class="flex justify-between mb-5">
                                    <h4 class="font-poppins font-semibold text-dark-gray text-xl">{{__('Mountain View Parking')}}</h4>
                                    <div class="flex gap-1 pl-2 pr-2 items-center w-[71px] h-[43px] bg-light-orange rounded-[8px]">
                                        <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                                        <h6 class="font-poppins font-normal text-gray text-lg">{{__('4.5')}}</h6>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                                    <p class="font-poppins font-normal text-gray text-lg">{{__('711-2880 Nulla St.Mankato Mississippi 96522 (257) 563-7401')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>

            {{-- We're available --}}

            <div class="bg-[#EBF5FF] md:rounded-[64px] md:p-10 s:rounded-[30px] s:p-4">
                <h5 class="font-poppins font-bold text-dark-gray text-4xl mb-5">{{__('Nous somme disponible')}}</h5>
                <img src="{{asset('website/image/map.png')}}" alt="">
            </div>


        </div>

    </div>




    @endsection