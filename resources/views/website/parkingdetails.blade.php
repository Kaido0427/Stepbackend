@extends('website.layout.app', ['activePage' => 'parkingspace'])
@section('content')
<div class="pt-10 pb-20 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2 ">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <a href="{{url('/parking_map_list')}}"><img src="{{asset('website/icon/left-arrow.svg')}}" alt="" class="mb-10"></a>
        @foreach($parkingdetails as $key => $item)
        <div class="flex gap-7 lg:flex-row s:flex-col">
            <div class="s:w-full lg:w-[60%] xxxl:w-[70%] xxxxl:w-[70%]">
                <div class="xxxxl:w-[870px] s:w-full h-fit bg-white rounded-2xl p-5 shadow-sm mb-5">
                    <div id="indicators-carousel" class="relative mb-5" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96 z-0">
                            <!-- Item 1 -->
                            @if (isset($parkingimage) && count($parkingimage) > 0)
                            @foreach($parkingimage as $image)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                <img src="{{asset('upload/'.$image->image)}}" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-lg object-cover w-full" alt="...">
                            </div>
                            @endforeach
                            @else
                            <div>
                                <img src="{{asset('/images/no-image-space.png')}}" class="z-0 rounded-lg object-cover w-full" alt="...">
                            </div>
                            @endif
                        </div>

                        <!-- Slider controls -->
                        <button type="button" class="absolute xxxxl:top-[310px] s:top-[168px] m:top-[184px] md:top-[344px] s:right-10 xxxxl:right-14  z-30 flex items-center justify-center h-10 cursor-pointer" data-carousel-prev>
                            <span class="inline-flex items-center justify-center xxxxl:w-14 xxxxl:h-14 s:w-10 s:h-10 sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class="absolute xxxxl:top-[310px] s:top-[168px] m:top-[184px] md:top-[344px] right-[1px] z-30 flex items-center justify-center h-10 cursor-pointer" data-carousel-next>
                            <span class="inline-flex items-center justify-center xxxxl:w-14 xxxxl:h-14 s:w-10 s:h-10 sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                    <div class="flex justify-between xxxxl:items-center mb-5 l:flex-row s:flex-col">
                        <h5 class="font-poppins font-semibold text-black text-2xl tracking-wide xxxxl:mb-0 s:mb-3">{{$item->title}}</h5>
                        @if(isset($reviews) && count($reviews) > 0)
                        <div class="flex justify-center bg-light-orange w-[71px] h-[43px] rounded-lg items-center gap-1">
                            <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                            <h6 class="font-poppins font-normal text-[#8896AB] text-lg">{{$rating}}</h6>
                        </div>
                        @else
                        <div class="flex justify-center bg-light-orange w-auto h-[43px] p-2 rounded-lg items-center gap-1">
                            <h1 class="font-poppins font-normal text-[#556987] text-base">{{__('Aucun avis')}}</h1>
                        </div>
                        @endif
                    </div>
                    <div class="flex gap-3">
                        <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-6 h-6 mt-1">
                        <p class="font-poppins font-normal text-[#556987] text-lg">{{$item->address}}</p>
                    </div>
                </div>
                <div class="xxxxl:w-[870px] s:w-full h-fit bg-white rounded-2xl p-5 shadow-sm mb-5">
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex l:flex-row s:flex-col flex-wrap -mb-px font-poppins font-medium text-lg text-[#556987]" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false">{{__('À Propos')}}</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">{{__('Services')}}</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="reviews-tab" data-tabs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">{{__('Avis')}}</button>
                            </li>
                        </ul>
                    </div>
                    <div id="myTabContent">
                        <div class="hidden p-4" id="about" role="tabpanel" aria-labelledby="about-tab">
                            <p class="font-poppins font-normal text-base text-[#404F65]">{{$item->description}}</p>
                        </div>


                        <div class="hidden p-4" id="services" role="tabpanel" aria-labelledby="services-tab">
                            <div class="grid xl:grid-cols-4 gap-7 mb-7 s:grid-cols-1 l:grid-cols-2 md:grid-cols-3">
                                @if($facilities)
                                @foreach($facilities as $facilitie)
                                <div class="bg-white p-5 rounded-lg border border-light-gray">
                                    <div class="mb-5">
                                        <img src="{{asset('upload/'.$facilitie->image)}}" alt="" class="mx-auto w-[54px] h-[54px] object-contain">
                                    </div>

                                    <h3 class="font-poppins font-normal text-dark-gray text-base text-center">{{$facilitie->title}}</h3>
                                </div>
                                @endforeach
                                @else
                                <p>Pas d'installations disponible</p>
                                @endif
                            </div>
                        </div>

                        <div class="hidden p-4" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            @if(isset($reviews) && count($reviews) > 0)
                            @foreach($reviews as $review)
                            <div class="mb-5">
                                <div class="flex justify-between l:items-center mb-5 l:flex-row s:flex-col">
                                    <div class="flex gap-3 items-center">
                                        <img src="{{asset('upload/'.$review->user->image)}}" alt="" class="w-14 h-14 object-cover rounded-full">
                                        <div>
                                            <h6 class="font-poppins font-medium text-black text-lg mb-1">{{$review->user->name}}</h6>
                                            <div class="flex gap-2">
                                                @if(isset($review->star) && $review->star != 0)
                                                @for($i = 1; $i <= 5; $i++) <span class="{{ $i <= $review->star ? 'fa fa-star checked text-[#F59E0B]' : 'fa fa-star text-[#D5DAE1]' }}"></span>
                                                    @endfor
                                                    @else
                                                    <span class="fa fa-star checked text-[#D5DAE1]"></span>
                                                    <span class="fa fa-star checked text-[#D5DAE1]"></span>
                                                    <span class="fa fa-star checked text-[#D5DAE1]"></span>
                                                    <span class="fa fa-star checked text-[#D5DAE1]"></span>
                                                    <span class="fa fa-star checked text-[#D5DAE1]"></span>

                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="l:mt-0 l:mr-0 s:mt-5 s:mr-28 font-poppins font-medium text-[#8896AB] text-sm">
                                        @if ($review->created_at->isToday())
                                        Today
                                        @elseif($review->created_at->isYesterday())
                                        Yesterday
                                        @else
                                        {{ $review->created_at->diffForHumans() }}
                                        @endif

                                    </div>
                                </div>
                                <p class="font-poppins font-normal text-base text-[#404F65]">{{$review->description}}</p>
                            </div>
                            <ul class="border border-light-gray mb-5"></ul>
                            @endforeach
                            @else
                            <div class="text-center">
                                <h5 class="font-poppins font-medium text-lg text-[#556987] tracking-wide xxxxl:mb-0 s:mb-3">{{ __('Aucun avis') }}</h5>
                            </div>
                            @endif

                        </div>

                    </div>

                </div>
            </div>
            <div class="s:w-full lg:w-[40%] xxxl:w-[30%] xxxxl:w-[30%]">
                <div class="bg-white h-fit rounded-2xl p-5 shadow-sm mb-3">
                    <h5 class="font-poppins font-semibold text-2xl text-[#404F65] mb-5">{{__('Parking')}}</h5>
                    <form action="{{url('/parkingspace_booking')}}" method="post">
                        @csrf
                        <?php
                        $parkingspace = session()->get('parkingspace');

                        ?>
                        <input type="hidden" name="owner_id" value="{{$item->owner_id}}">
                        <input type="hidden" name="space_id" value="{{$item->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::guard('appuser')->user()->id}}">
                        <input type="hidden" name="price_par_hour" value="{{$item->price_par_hour}}">
                        <input type="hidden" name="title" value="{{$item->title}}">
                        <input type="hidden" name="address" value="{{$item->address}}">
                        <input type="hidden" name="rating" value="{{$rating}}">
                        <div class="mb-5">
                            <label for="intime" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('À temps')}}</label>
                            <div class="mt-2">
                                <div>
                                    <input type="datetime-local" name="arriving_time" id="arrivingdatetime" class="form-control w-full border border-light-gray rounded-lg font-poppins font-normal text-black text-base mt-2 " value="{{session()->has('parkingspace') == true ? $parkingspace['arriving_time'] : '' }}">
                                    <span class="text-danger">
                                        @error('arriving_time')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="intime" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('Heure de sortie')}}</label>
                            <div class="mt-2">
                                <div>
                                    <input type="datetime-local" name="leaving_time" id="leavingdatetime" class="form-control w-full border border-light-gray rounded-lg font-poppins font-normal text-black text-base mt-2" value="{{session()->has('parkingspace') == true ? $parkingspace['leaving_time'] : ''}}">
                                    <span class="text-danger">
                                        @error('leaving_time')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="vehicle" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('Vélo')}}</label>
                            @if(isset($vehicles) && count($vehicles) > 0)
                            <select id="vehicle_id" class="border border-light-gray w-full mt-2 rounded-lg font-poppins font-medium text-black text-base tracking-wide" name="vehicle_id">
                                @foreach($vehicles as $vehicle)
                                <option value="{{$vehicle->id}}" @if(session()->has('parkingspace')){{$vehicle->id == $parkingspace['vehicle_id'] ? 'selected' :''}}@endif>{{$vehicle->brand}}</option>
                                @endforeach
                            </select>
                            @else
                            <div class="relative">
                                <select class="border border-light-gray w-full mt-2 rounded-lg font-poppins font-medium text-black text-base tracking-wide cursor-not-allowed">
                                    <option value="" selected Desactived>{{__('Veuillez ajouter un vélo d\'abord.')}}</option>
                                </select>
                            </div>
                            @endif
                        </div>
                        <div class="bg-[#F7F8F9] rounded-[4px] p-2 w-fit mb-5">
                            <p class="font-poppins font-normal text-xs text-[#556987] tracking-wide">{{__('Notre système fonctionne à l\'heure.')}}</p>
                        </div>
                        <div class="flex justify-between items-center l:flex-row s:flex-col">
                            <h5 class="font-poppins font-medium text-[#4D5F7A] text-2xl">{{$settings->currency_symbol}} {{$item->price_par_hour}} <span class="text-base text-[#8896AB]">{{__('/ hr')}}</span></h5>
                            @if(isset($_POST['Sauvegarder']))
                            <a href="{{url('/parking_slots')}}"><button type="submit" class="l:w-[260px] s:w-full h-[56px] bg-primary rounded-[6px] font-poppins font-medium text-white text-lg s:mt-4 xxxxl:mt-0">{{__('Réserver')}}</button></a>
                            @else
                            <a href="{{url('/parking_space/{id}')}}"><button type="submit" class="l:w-[260px] s:w-[200px] h-[56px] bg-primary rounded-[6px] font-poppins font-medium text-white text-lg s:mt-4 xxxxl:mt-0">{{__('Réserver')}}</button></a>
                            @endif
                        </div>
                    </form>
                </div>
                 <div class="bg-white h-fit rounded-2xl p-5 shadow-sm mb-3">
                    <h5 class="font-poppins font-semibold text-2xl text-[#404F65] mb-5">{{__('Avis des clients')}}</h5>

                    <div class="flex l:items-center gap-3 mb-3 l:flex-row s:flex-col">
                        <div class="bg-[#DCFCE7] w-14 h-9 rounded-lg flex items-center justify-center gap-1">
                            <img src="{{asset('website/icon/green-star.svg')}}" alt="" class="w-5">
                            <h6 class="font-poppins font-medium text-base text-perot">{{__('5')}}</h6>
                        </div>
                        <div class="l:w-64 bg-gray-200 rounded-full h-3 bg-gray">
                            <div class="bg-blue-600 h-3 rounded-full bg-perot" style="width: {{ $all_reviews->per_5_star }}%"></div>
                        </div>
                        <h5 class="font-poppins font-semibold text-sm text-[#4D5F7A]">{{ $all_reviews->per_5_star }}%</h5>
                    </div>
                    <div class="flex l:items-center mb-3 l:flex-row s:flex-col gap-3">
                        <div class="bg-[#DCFCE7] w-14 h-9 rounded-lg flex items-center justify-center gap-1">
                            <img src="{{asset('website/icon/green-star.svg')}}" alt="" class="w-5">
                            <h6 class="font-poppins font-medium text-base text-perot">{{__('4')}}</h6>
                        </div>
                        <div class="l:w-64 bg-gray-200 rounded-full h-3 bg-gray">
                            <div class="bg-blue-600 h-3 rounded-full bg-perot" style="width: {{ $all_reviews->per_4_star }}%"></div>
                        </div>
                        <h5 class="font-poppins font-semibold text-sm text-[#4D5F7A]">{{$all_reviews->per_4_star}}%</h5>
                    </div>
                    <div class="flex l:items-center mb-3 l:flex-row s:flex-col gap-3">
                        <div class="bg-[#FEF5E7] w-14 h-9 rounded-lg flex items-center justify-center gap-1">
                            <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                            <h6 class="font-poppins font-medium text-base text-[#F59E0B]">{{__('3')}}</h6>
                        </div>
                        <div class="l:w-64 bg-gray-200 rounded-full h-3 bg-gray">
                            <div class="h-3 rounded-full bg-[#F59E0B]" style="width: {{ $all_reviews->per_3_star }}%"></div>
                        </div>
                        <h5 class="font-poppins font-semibold text-sm text-[#4D5F7A]">{{$all_reviews->per_3_star}}%</h5>
                    </div>
                    <div class="flex l:items-center mb-3 l:flex-row s:flex-col gap-3">
                        <div class="bg-[#FEF5E7] w-14 h-9 rounded-lg flex items-center justify-center gap-1">
                            <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                            <h6 class="font-poppins font-medium text-base text-[#F59E0B]">{{__('2')}}</h6>
                        </div>
                        <div class="l:w-64 bg-gray-200 rounded-full h-3 bg-gray">
                            <div class="h-3 rounded-full bg-[#F59E0B]" style="width: {{ $all_reviews->per_2_star }}%"></div>
                        </div>
                        <h5 class="font-poppins font-semibold text-sm text-[#4D5F7A]">{{$all_reviews->per_2_star}}%</h5>
                    </div>
                    <div class="flex l:items-center mb-3 l:flex-row s:flex-col gap-3">
                        <div class="bg-[#FDEEEC] w-14 h-9 rounded-lg flex items-center justify-center gap-1">
                            <img src="{{asset('website/icon/red-star.svg')}}" alt="" class="w-5">
                            <h6 class="font-poppins font-medium text-base text-dark-orange">{{__('1')}}</h6>
                        </div>
                        <div class="l:w-64 bg-gray-200 rounded-full h-3 bg-gray">
                            <div class="h-3 rounded-full bg-dark-orange" style="width: {{ $all_reviews->per_1_star }}%"></div>
                        </div>
                        <h5 class="font-poppins font-semibold text-sm text-[#4D5F7A]">{{$all_reviews->per_1_star}}%</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var hour = now.getHours().toString().padStart(2, '0');
    var minute = now.getMinutes().toString().padStart(2, '0');
    var minDateTime = year + '-' + month + '-' + day + 'T' + hour + ':' + minute;
    document.getElementById('arrivingdatetime').setAttribute('min', minDateTime);
</script>

<script>
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var hour = now.getHours().toString().padStart(2, '0');
    var minute = now.getMinutes().toString().padStart(2, '0');
    var minDateTime = year + '-' + month + '-' + day + 'T' + hour + ':' + minute;
    document.getElementById('leavingdatetime').setAttribute('min', minDateTime);
</script>
@endsection