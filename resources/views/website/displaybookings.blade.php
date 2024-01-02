@extends('website.layout.app', ['activePage' => 'booking'])
@section('content')
<div class="pt-10 pb-20 w-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2">
    <div id="booking_msg" class="w-full text-[#4fd69c] font-semibold font-normal text-center text-lg tracking-wide mb-2"></div>
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        @if(Session::has('fail'))
        <div class="fail">
            <div class="alert-danger text-center">{{ session::get('fail')}}</div>
        </div>
        @endif
        <h5 class="font-poppins font-semibold text-[#404F65] text-2xl mb-10">{{__('Mes Réservations')}}</h5>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex l:flex-row s:flex-col flex-wrap -mb-px font-poppins font-medium text-lg text-[#556987]" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="upcoming-booking-tab" data-tabs-target="#upcoming-booking" type="button" role="tab" aria-controls="upcoming-booking" aria-selected="false">{{__('Réservation à venir')}}</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="past-booking-tab" data-tabs-target="#past-booking" type="button" role="tab" aria-controls="past-booking" aria-selected="false">{{__('Réservation passées')}}</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div class="hidden" id="upcoming-booking" role="tabpanel" aria-labelledby="upcoming-booking-tab">
                @forelse($dataCurrant as $datac)
                <div class="bg-white rounded-lg shadow w-full xxxxl:p-8 s:p-5 mb-5">
                    <div class="flex justify-between md:flex-row s:flex-col">
                        <a href="{{url('/order_details/'.$datac->id)}}" class="s:mb-5 md:mb-0">
                            <div class="flex gap-4 xxxxl:mb-3 s:mb-5 l:flex-row s:flex-col">
                                <h6 class="text-gray font-poppins font-medium text-base text-center bg-[#F7F8F9] px-3 h-8 p-1 tracking-wide rounded"># {{$datac->id}}</h6>
                                @if ($datac->status == 0)
                                <h6 class="text-[#F59E0B] font-poppins font-medium text-base text-center bg-light-orange px-3 h-8 p-1 tracking-wide rounded">{{__('En attente')}}</h6>
                                @elseif ($datac->status == 1)
                                <h6 class="text-perot font-poppins font-medium text-base text-center bg-light-perot px-3 h-8 p-1 tracking-wide rounded">{{__('approuvé')}}</h6>
                                @endif
                            </div>
                            <h5 class="font-poppins font-medium text-[#404F65] text-xl tracking-wide mb-3">{{$datac->space->title}}</h5>
                            <div class="flex md:gap-12 s:gap-5 md:flex-row s:flex-col">
                                <div>
                                    <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-2">{{__('Heure d\'entrée')}}</h6>
                                    <h4 class="font-poppins font-medium text-[#404F65] text-base">{{ Carbon\Carbon::parse($datac->arriving_time)->format('Y-m-d h:i A')}}</h4>
                                </div>
                                <div>
                                    <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-2">{{__('Heure de sortie')}}</h6>
                                    <h4 class="font-poppins font-medium text-[#404F65] text-base">{{Carbon\Carbon::parse($datac->leaving_time)->format('Y-m-d h:i A')}}</h4>
                                </div>
                            </div>
                        </a>
                        <div class="md:self-end md:text-center">
                            <h6 class="font-popping font-medium text-[#4D5F7A] text-2xl mb-2">{{$settings->currency}} {{$datac->total_amount}}</h6>

                            <button class="border border-grey rounded py-2 px-5 font-popping font-medium text-base text-[#8896AB] tracking-wide" data-modal-target="DeleteSlot" data-modal-toggle="DeleteSlot">{{__('Cancel slot')}}</button>

                        </div>
                    </div>
                </div>
                @empty
                <p class="font-poppins font-medium text-lg text-[#556987] text-center mt-10">{{ __('Aucune Réservation') }}</p>
                @endforelse
            </div>
            <div class="hidden" id="past-booking" role="tabpanel" aria-labelledby="past-booking-tab">
                @forelse($dataOld as $item)
                <div class="bg-white rounded-lg shadow w-full xxxxl:p-8 s:p-5 mb-5">
                    <div class="flex justify-between md:flex-row s:flex-col">
                        <div class="s:mb-5 md:mb-0">
                            <div class="flex gap-4 xxxxl:mb-3 s:mb-5 l:flex-row s:flex-col">
                                <h6 class="text-gray font-poppins font-medium text-base text-center bg-[#F7F8F9] px-3 h-8 p-1 tracking-wide rounded"># {{$item->id}}</h6>
                                @if($item->status == 2)
                                <h6 class="text-perot font-poppins font-medium text-base text-center bg-light-perot px-3 h-8 p-1 tracking-wide rounded">{{__('Completé')}}</h6>
                                @elseif ($item->status == 3)
                                <h6 class="text-dark-orange font-poppins font-medium text-base text-center bg-light-red px-3 h-8 p-1 tracking-wide rounded">{{__('Annulé')}}</h6>
                                @endif
                            </div>
                            <h5 class="font-poppins font-medium text-[#404F65] text-xl tracking-wide mb-3">{{__('Parking de Mountain view')}}</h5>
                            <div class="flex md:gap-12 s:gap-5 md:flex-row s:flex-col">
                                <div>
                                    <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-2">{{__('Heure d\'entrée')}}</h6>
                                    <h4 class="font-poppins font-medium text-[#404F65] text-base">{{Carbon\Carbon::parse($item->arriving_time)->format('Y-m-d h:i A')}}</h4>
                                </div>
                                <div>
                                    <h6 class="font-poppins font-normal text-[#8896AB] text-base mb-2">{{__('Heure de sortie')}}</h6>
                                    <h4 class="font-poppins font-medium text-[#404F65] text-base">{{Carbon\Carbon::parse($item->leaving_time)->format('Y-m-d h:i A')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-popping font-medium text-[#4D5F7A] text-2xl mb-2">{{$settings->currency}} {{$item->total_amount}}</h6>
                        </div>
                    </div>
                </div>
                @empty
                <p class="font-poppins font-medium text-lg text-[#556987] text-center mt-10">{{ __('Aucune Réservation') }}</p>
                @endforelse
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
            <p class="font-poppins font-medium text-[#404F65] text-2xl text-center mb-10">{{__('Êtes-vous sûr(e) de vouloir annuler la plage horaire?')}}</p>
            <div class="flex gap-3 mt-4 justify-end mr-2 l:flex-row s:flex-col">

                <button class="border border-gray rounded font-poppins font-normal text-base text-[#8896AB] px-6 py-2 tracking-wide" type="button" data-modal-hide="DeleteSlot">{{__('Non')}}</button>
                @if($dataCurrant->isNotEmpty())
                <form action="{{url('/booking_cancel/'.$datac->id)}}" method="post">
                    @csrf
                    @method('post')
                    <button class="bg-dark-orange rounded font-poppins font-normal text-base text-white px-6 py-2 tracking-wide" type="submit">{{__('Oui')}}</button>
                </form>
                @else
                <p class="font-poppins font-medium text-lg text-[#556987] text-center mt-10">{{ __('Aucune Réservation') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection