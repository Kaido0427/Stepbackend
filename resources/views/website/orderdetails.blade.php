@extends('website.layout.app', ['activePage' => 'orderdetails'])
@section('content')
<div class="pt-10 pb-20 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2 ">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <a href="{{url('/display_parking_booking')}}"><img src="{{asset('website/icon/left-arrow.svg')}}" alt="" class="mb-10"></a>
        <div class="flex gap-8 xl:flex-row s:flex-col">
            <div>
                {{-- Booking Details --}}
                <div class="bg-white rounded-2xl xxxxl:p-6 xxxxl:w-[872px] shadow-sm mb-6 s:p-4 s:w-full">
                    <h5 class="font-poppins font-semibold text-[#404F65] text-2xl tracking-wide mb-7">{{__('Détails de la réservation')}}</h5>
                    <div class="flex justify-between l:items-center mb-8 l:flex-row s:flex-col">
                        <div class="xxxxl:mb-0 s:mb-5">
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-1">{{__('id de la reservation')}}</h6>
                            <h5 class="font-poppins font-medium text-[#404F65] text-base">#{{$orderdetails->id}}</h5>
                        </div>
                        <button class="bg-light-blue font-poppins font-medium text-base text-primary px-5 rounded h-10 tracking-wide w-[100px]">{{__('Réservé')}}</button>
                    </div>
                    <div class="flex l:gap-12 s:gap-5 mb-8 l:flex-row s:flex-col">
                        <div>
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-1">{{__('Crénau')}}</h6>
                            <h5 class="font-poppins font-medium text-[#404F65] text-base">{{$orderdetails->SpaceSlot->name}}</h5>
                        </div>
                        <div>
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-1">{{__('Vélo')}}</h6>
                            <h5 class="font-poppins font-medium text-[#404F65] text-base">{{$orderdetails->Vehicle->brand}}</h5>
                        </div>
                        <div>
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-1">{{__('Nuléro de Vélo')}}</h6>
                            <h5 class="font-poppins font-medium text-[#404F65] text-base">{{$orderdetails->Vehicle->vehicle_no}}</h5>
                        </div>
                    </div>
                    <div class="flex justify-between xxxxl:items-center md:flex-row s:flex-col">
                        <div class="xxxxl:mb-0 s:mb-5">
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-1">{{__('Heure d'entrée')}}</h6>
                            <h5 class="font-poppins font-medium text-[#404F65] text-base">{{ \Carbon\Carbon::parse($orderdetails->arriving_time)->format('d-m-Y, h:i A') }}</h5>
                        </div>
                        <div class="flex items-center xxxxl:mb-0 s:mb-5">
                            <span class="border h-px w-full bg-light-gray md:w-[60px] s:w-[60px] md:mr-5 s:mr-2"></span>
                            <div class="flex gap-2">
                                <img src="{{asset('website/icon/clock.svg')}}" alt="">
                                <h6 class="font-poppins font-medium text-[#404F65] text-base">
                                    @if ($dayDifference > 0)
                                    {{ $dayDifference }} {{ __('Day') }}
                                    @if ($dayDifference > 1)
                                    {{ __('s') }}
                                    @endif

                                    @endif
                                    @if ($hourDifference > 0)
                                    {{ $hourDifference }} {{ __('Hour') }}
                                    @if ($hourDifference > 1)
                                    {{ __('s') }}
                                    @endif

                                    @endif
                                    @if ($minuteDifference > 0)
                                    {{ $minuteDifference }} {{ __('Minute') }}
                                    @if ($minuteDifference > 1)
                                    {{ __('s') }}
                                    @endif

                                    @endif
                                    @if ($secondDifference > 0)
                                    {{ $secondDifference }} {{ __('Second') }}
                                    @if ($secondDifference > 1)
                                    {{ __('s') }}
                                    @endif
                                    @endif
                                </h6>
                            </div>
                            <span class="border h-px w-full bg-light-gray md:w-[60px] s:w-[60px] md:ml-5 s:ml-2"></span>
                        </div>
                        <div>
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-1">{{__('Heure de sortie')}}</h6>
                            <h5 class="font-poppins font-medium text-[#404F65] text-base">{{ \Carbon\Carbon::parse($orderdetails->leaving_time)->format('d-m-Y, h:i A')}}</h5>
                        </div>
                    </div>
                </div>

                {{-- Payment Details --}}
                <div class="bg-white rounded-2xl xxxxl:p-6 xxxxl:w-[872px] shadow-sm mb-6 s:p-4 s:w-full ">
                    <h5 class="font-poppins font-semibold text-[#404F65] text-2xl tracking-wide mb-7">{{__('Détails de payement')}}</h5>
                    <div class="grid md:grid-cols-4 md:divide-x s:grid-cols-1 xxxxl:gap-0 s:gap-5">
                        <div>
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base tracking-wide mb-1">{{__('Montant')}}</h6>
                            <h6 class="font-poppins font-normal text-[#4D5F7A] text-base tracking-wide">{{$setting->currency}} {{$orderdetails->total_amount}}</h6>
                        </div>
                        <div class="md:pl-5 s:pl-0">
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base tracking-wide mb-1">{{__('Statut de payement')}}</h6>
                            @if($orderdetails->payment_status == 0)
                            <h6 class="font-poppins font-normal text-[#F59E0B] text-base tracking-wide">{{__('Restant')}}</h6>
                            @elseif($orderdetails->payment_status == 1)
                            <h6 class="font-poppins font-normal text-[#16A34A] text-base tracking-wide">{{__('Terminé')}}</h6>
                            @elseif($orderdetails->payment_status == 2)
                            <h6 class="font-poppins font-normal text-dark-orange text-base tracking-wide">{{__('annuler')}}</h6>
                            @endif
                        </div>
                        <div class="md:pl-5 s:pl-0">
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base tracking-wide mb-1">{{__('Mode de payment')}}</h6>
                            <h6 class="font-poppins font-normal text-[#4D5F7A] text-base tracking-wide">{{$orderdetails->payment_type}}</h6>
                        </div>
                        <div class="md:pl-5 s:pl-0">
                            <h6 class="font-poppins font-normal text-[#8896AB] text-base tracking-wide mb-1">{{__('Date de réservation')}}</h6>
                            <h6 class="font-poppins font-normal text-[#4D5F7A] text-base tracking-wide">{{ \Carbon\Carbon::parse($orderdetails->created_at)->format('d-m-Y, h:i A')}}</h6>
                        </div>
                    </div>
                </div>

                {{-- Rate --}}

                @if(Session::has('success'))
                <div class="success">
                    <div class="alert-success text-center">{{ session::get('success')}}</div>
                </div>
                @endif
                @if($review->isNotEmpty())
                <div class="bg-white rounded-2xl xxxxl:p-6 xxxxl:w-[872px] shadow-sm s:w-full s:p-4">
                    <h5 class="font-poppins font-semibold text-[#404F65] text-2xl tracking-wide mb-5">{{__('Evaluer votre expérience')}}</h5>
                    <form action="{{url('/edit_review')}}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::guard('appuser')->user()->id}}">
                        <input type="hidden" name="space_id" value="{{$orderdetails->Space->id}}">
                        <input type="hidden" name="star" id="star">
                        <div class="flex gap-2 mb-4">
                            @php
                            $rating = $review->first()->star;
                            @endphp
                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$rating) <span class="fa fa-star checked text-[#F59E0B]" onclick="setRating({{ $i }})" id="star-{{ $i }}"></span>
                                @else
                                <span class="fa fa-star text-[#D5DAE1]" onclick="setRating({{ $i }})" id="star-{{ $i }}"></span>
                                @endif
                                @endfor
                        </div>
                        <textarea name="description" rows="3" class="w-full border border-[#EEF0F3] rounded-[8px] font-poppins font-normal text-gray text-sm mb-5" placeholder="Write review">{{$review->first()->description}}</textarea>

                        <button type="submit" class="border border-primary px-10 py-4 font-poppins font-medium text-primary text-base rounded">{{__('Editer')}}</button>
                    </form>
                </div>
                @else
                <div class="bg-white rounded-2xl xxxxl:p-6 xxxxl:w-[872px] shadow-sm s:w-full s:p-4">
                    <h5 class="font-poppins font-semibold text-[#404F65] text-2xl tracking-wide mb-5">{{__('Evaluer votre expérience)}}</h5>
                    <form action="{{url('/review')}}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::guard('appuser')->user()->id}}">
                        <input type="hidden" name="space_id" value="{{$orderdetails->Space->id}}">
                        <input type="hidden" name="star" id="star" value="0">
                        <div class="flex gap-2 mb-4">
                            <span class="fa fa-star checked text-[#D5DAE1]" onclick="setRating(1)" id="star-1"></span>
                            <span class="fa fa-star checked text-[#D5DAE1]" onclick="setRating(2)" id="star-2"></span>
                            <span class="fa fa-star checked text-[#D5DAE1]" onclick="setRating(3)" id="star-3"></span>
                            <span class="fa fa-star checked text-[#D5DAE1]" onclick="setRating(4)" id="star-4"></span>
                            <span class="fa fa-star checked text-[#D5DAE1]" onclick="setRating(5)" id="star-5"></span>
                        </div>
                        @error('star')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        
                        <textarea name="description" rows="3" class="w-full border border-[#EEF0F3] rounded-[8px] font-poppins font-normal text-gray text-sm" placeholder="Write review"></textarea>
                        @error('description')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="border border-primary px-10 py-4 font-poppins font-medium text-primary text-base rounded mt-5">{{__('Submit')}}</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="bg-white xxxxl:p-6 shadow-sm rounded-2xl xxxxl:w-[424px] lg:w-[500px] !h-fit s:w-full s:p-4">
                <h5 class="font-poppins font-semibold text-[#404F65] text-2xl tracking-wide mb-7">{{__('"Détails du parking"')}}</h5>
                <div>
                    <p class="font-poppins font-normal text-sm text-[#556987] mb-10 text-center">{{__('Scannez le code QR ci-dessous à l'entrée du parking.')}}</p>

                    <img src="data:image/png;base64,{{ base64_encode($result) }}" alt="QR Code" class="mx-auto object-cover w-48 h-48 mb-14">

                    <div class="flex justify-between mb-5">
                        <div class="w-[200px]">
                            <h5 class="font-poppins font-medium text-[#404F65] text-base tracking-wide mb-2">{{$orderdetails->Space->title}}</h5>
                            <p class="font-poppins font-normal text-[#556987] text-sm">{{$orderdetails->Space->address}}</p>
                        </div>
                        <div>
                            <div class="flex gap-1 mb-3">
                                <img src="{{asset('website/icon/star.svg')}}" alt="">
                                <h6 class="font-poppins font-normal text-[#8896AB] text-sm ">{{__('4.0')}}</h6>
                            </div>
                            <div class="bg-light-perot w-9 h-9 rounded ml-1">
                                <img src="{{asset('website/icon/directions.svg')}}" alt="" class="mx-auto p-2">
                            </div>
                        </div>
                    </div>
                    <button class="w-full border border-[#FBD6D0] rounded-[6px] py-3 font-poppins font-normal text-dark-orange text-lg tracking-wide" data-modal-target="DeleteSlot" data-modal-toggle="DeleteSlot">{{__('Cancel slot')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div id="DeleteSlot" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative sm:w-[450px] s:w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-5">
            <!-- Modal body -->
            <p class="font-poppins font-medium text-[#404F65] text-2xl text-center mb-10">{{__('Êtes-vous sûr de vouloir annuler l'emplacement ??')}}</p>
            <div class="flex gap-3 mt-4 justify-end mr-2 l:flex-row s:flex-col">

                <button class="border border-gray rounded font-poppins font-normal text-base text-[#8896AB] px-6 py-2 tracking-wide" type="button" data-modal-hide="DeleteSlot">{{__('Non')}}</button>
                <form action="{{url('/booking_cancel/'.$orderdetails->id)}}" method="post">
                    @csrf
                    @method('post')
                    <button class="bg-dark-orange rounded font-poppins font-normal text-base text-white px-6 py-2 tracking-wide" type="submit">{{__('Oui')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection