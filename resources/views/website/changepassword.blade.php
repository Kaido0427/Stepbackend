@extends('website.layout.app', ['activePage' => 'editprofile'])
@section('content')
<div class="pt-10 pb-60 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <div class="flex gap-5 mb-10">
            <img src="{{asset('website/icon/left-arrow.svg')}}" alt="">
            <h5 class="font-poppins font-semibold text-[#404F65] text-2xl">{{__('Modifier le mot de passe')}}</h5>
        </div>
        <div class="bg-white rounded-[16px] shadow-sm p-7 md:w-[450px]">
            <form action="">
                <div class="form-group mb-5">
                    <label for="cpassword" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Mot de passe actuel')}}</label>
                    <div class="flex relative">
                        <input type="password" name="cpassword" class="border border-[#D5DAE1] rounded-lg w-full mt-3 font-poppins font-normal text-[#667085] text-base">
                        <i class="fa fa-eye absolute right-5 top-6"></i>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="npassword" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Nouveau mot de passe')}}</label>
                    <div class="flex relative">
                        <input type="password" name="npassword" class="border border-[#D5DAE1] rounded-lg w-full mt-3 font-poppins font-normal text-[#667085] text-base">
                        <i class="fa fa-eye absolute right-5 top-6"></i>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="confirmpassword" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Confirmer le mot de passe')}}</label>
                    <div class="flex relative">
                        <input type="password" name="confirmpassword" class="border border-[#D5DAE1] rounded-lg w-full mt-3 font-poppins font-normal text-[#667085] text-base">
                        <i class="fa fa-eye absolute right-5 top-6"></i>
                    </div>
                </div>
                <button class="w-full bg-primary rounded-md font-poppins font-medium text-white text-base py-3 tracking-wide mt-7">{{__('Mettre à jour')}}</button>
            </form>
        </div>
    </div>
</div>


<!-- <div class="mb-96 xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
    <div class="container mx-auto">
        <div class="splide">
            <div class="splide__track">
                <div class="splide__list gap-1 min-w-[50%]">
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
                    <div class="splide__slide">
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
                    <div class="splide__slide">
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
                    <div class="splide__slide">
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

                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.2/dist/js/splide.min.js"></script>
<script>
    var splide = new Splide('.splide', {
        type: 'loop',
        perPage: 3,
        rewind: true,
    });

    splide.mount();
</script> -->


@endsection