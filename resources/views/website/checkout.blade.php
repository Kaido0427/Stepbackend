@extends('website.layout.app', ['activePage' => 'checkout'])
@section('content')
<div class="pt-10 pb-20 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2 ">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <a href="{{url('/parking_slots')}}"><img src="{{asset('website/icon/left-arrow.svg')}}" alt="" class="mb-10"></a>
        <div class="flex gap-8 lg:flex-row s:flex-col">
            <div class="lg:w-[855px] s:w-full h-fit bg-white rounded-2xl p-5 shadow-sm">
                <h5 class="font-poppins font-semibold text-black text-2xl tracking-wide mb-7">{{__('Méthodes de payement')}}</h5>
                <div class="flex gap-8 mb-5 sm:flex-row s:flex-col paymentCard hide">
                    <div>
                        @if ($adminsetting['paypal_status'])
                        <div class="flex justify-between items-center rounded-lg w-[230px] h-[56px] px-3 bg-light-blue mb-3">
                            <div class="flex items-center gap-2">
                                <div>
                                    <img src="{{asset('website/image/PayPal.png')}}">
                                </div>
                            </div>
                            <input id="customRadio1" type="radio" value="paypal" name="paymentRadio" class="custom-control-input w-[20px] h-[20px] rounded-full text-blue-600 border-[#BAC7D5]">
                        </div>
                        @endif
                        @if ($adminsetting['razorpay_status'])
                        <div class="flex justify-between items-center rounded-lg w-[230px] h-[56px] px-3 bg-light-blue mb-3">
                            <div class="flex items-center gap-2">
                                <div>
                                    <img src="{{asset('website/image/razorpay.png')}}">
                                </div>
                            </div>
                            <input id="customRadio2" type="radio" value="razorpay" name="paymentRadio" class="custom-control-input w-[20px] h-[20px] rounded-full text-blue-600 border-[#BAC7D5]">
                        </div>
                        @endif
                        @if ($adminsetting['stripe_status'])
                        <div class="flex justify-between items-center rounded-lg w-[230px] h-[56px] px-3 bg-light-blue mb-3">
                            <div class="flex items-center gap-2">
                                <div>
                                    <img src="{{asset('website/image/Stripe.png')}}">
                                </div>
                            </div>
                            <input id="customRadio3" type="radio" value="stripe" name="paymentRadio" class="custom-control-input w-[20px] h-[20px] rounded-full text-blue-600 border-[#BAC7D5]">
                        </div>
                        @endif
                        @if ($adminsetting['flutterwave_status'])
                        <div class="flex justify-between items-center rounded-lg w-[230px] h-[56px] px-3 bg-light-blue mb-3">
                            <div class="flex items-center gap-2">
                                <div>
                                    <img src="{{asset('website/image/flutterwave.png')}}">
                                </div>
                            </div>
                            <input id="customRadio4" type="radio" value="flutterwave" name="paymentRadio" class="custom-control-input w-[20px] h-[20px] rounded-full text-blue-600 border-[#BAC7D5]">
                        </div>
                        @endif
                    </div>
                    <form action="{{url('/billing')}}" method="post">
                        @csrf
                        @php $total = session()->get('parkingslot')['price_par_hour']; @endphp
                        <?php
                        $parkingspace = session()->get('parkingspace');
                        $parkingslot = session()->get('parkingslot');
                        ?>
                        <input type="hidden" name="owner_id" value="{{session()->has('parkingspace') == true ? $parkingspace['owner_id'] : '' }}">
                        <input type="hidden" name="space_id" value="{{session()->has('parkingspace') == true ? $parkingspace['space_id'] : '' }}">
                        <input type="hidden" name="user_id" value="{{Auth::guard('appuser')->user()->id}}">
                        <input type="hidden" name="arriving_time" value="{{session()->has('parkingspace') == true ? $parkingspace['arriving_time'] : '' }}">
                        <input type="hidden" name="leaving_time" value="{{session()->has('parkingspace') == true ? $parkingspace['leaving_time'] : '' }}">
                        <input type="hidden" name="vehicle_id" value="{{session()->has('parkingspace') == true ? $parkingspace['vehicle_id'] : '' }}">
                        <input type="hidden" name="slot_id" value="{{session()->has('parkingslot') == true ? $parkingslot['slot_id'] : '' }}">

                        <div class="w-full">
                            <div class="mt-2 stripeCard hidden" id="stripeform">
                                <div class="card-body">
                                    <div class="alert alert-warning stripe_alert hidden" role="alert">
                                    </div>
                                    <input type="hidden" name="total_amount" value="{{$total}}">
                                    <input type="hidden" name="stripe_publish_key" value="{{$adminsetting['stripe_public']}}">
                                    <form role="form" method="post" class="require-validation customform xxxl:w-[680px] s:w-[225px] m:w-[300px] l:w-[400px] sm:w-[320px] md:w-[450px] lg:w-[300px] xl:w-[540px] xxl:w-[550px]" data-cc-on-file="false" id="stripe-payment-form">
                                        @csrf
                                        <div class="border border-light-gray rounded p-5">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="email" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Email')}}</label>
                                                    <input type="email" name="email" title="Enter Your Email" class="email form-control required border border-[#D5DAE1] rounded-lg p-3 w-full mt-3" required />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <label for="card-number" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Informations de carte')}}</label>
                                                    <!-- <input type="text" class="card-number required form-control border border-[#D5DAE1] rounded-lg p-3 w-full mt-3" title="please input only number." pattern="[0-9]{16}" name="card-number" placeholder="1234 1234 1234 1234" title="Card Number" required /> -->
                                                    <div class="form-group">
                                                        <div id="card-number"></div>
                                                    </div>


                                                    <div>
                                                        <div>
                                                            <!-- <input type="text" class="expiry-date required form-control border border-[#D5DAE1] rounded-lg p-3 w-full" name="expiry-date" title="Expiration date" title="please Enter data in MM/YY format." pattern="(0[1-9]|10|11|12)/[0-9]{2}$" placeholder="MM/YY" required /> -->
                                                            <div class="form-group">
                                                                <div id="card-expiry"></div>
                                                            </div>
                                                            <input type="hidden" class="card-expiry-month required form-control" name="card-expiry-month" />
                                                            <input type="hidden" class="card-expiry-year required form-control" name="card-expiry-year" />
                                                        </div>


                                                    </div>
                                                    <div>
                                                        <!-- <input type="text" class="card-cvc required form-control border border-[#D5DAE1] rounded-lg p-3 w-full" title="please input only number." pattern="[0-9]{3}" name="card-cvc" placeholder="CVC" title="CVC" required /> -->
                                                        <div class="form-group">
                                                            <div id="card-cvc"></div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div>
                                                    <div class="form-group">
                                                        <label class="font-poppins font-medium text-black text-base tracking-wide">{{__('Nom sur la carte')}}</label>
                                                        <input type="text" class="required form-control border border-[#D5DAE1] rounded-lg p-3 w-full mt-3" name="name" title="Name on Card" required />
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group text-center">
                                                        <input type="submit" class="bg-primary l:w-[250px] h-[47px] s:w-full rounded-md font-poppins font-medium text-white text-lg mt-4 btn-submit" value="{{ __('Payer avec stripe') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-2 razorCard hidden">
                                <input type="hidden" name="razorpay_key" value="{{ $adminsetting['razorpay_key'] }}">

                                <div class="card-body text-center">
                                    <button type="submit" class="bg-primary l:w-[250px] h-[47px] s:w-full rounded-md font-poppins font-medium text-white text-lg mt-4" name="RazorBtn" id="paybtn" data-total="{{ $total }}" onclick="RazorPayPayment()">{{ __('Payer avec Razorpay') }}</button>
                                </div>
                            </div>

                            <div class="mt-2 flutterwaveCard hidden">
                                <input type="hidden" name="flutterwave_key" value="{{ $adminsetting['flutterwave_key'] }}">
                                <input type="hidden" name="currency" value="{{ $adminsetting['currency'] }}">
                                <input type="hidden" name="name" value="{{ Auth::guard('appuser')->user()->name }}">
                                <input type="hidden" name="email" value="{{ Auth::guard('appuser')->user()->email }}">
                                <input type="hidden" name="phone_no" value="{{ Auth::guard('appuser')->user()->phone_no }}">
                                <div class="card-body text-center">
                                    <button type="submit" class="bg-primary l:w-[250px] h-[47px] s:w-full rounded-md font-poppins font-medium text-white text-lg mt-4" onclick="makePayment()">{{ __('Payer avec Flutterwave') }}</button>
                                </div>
                            </div>
                            <div class="mt-2 paypalCard hidden">
                                <div class="paypal_row_body"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:w-[422px] bg-white rounded-2xl p-5 shadow-sm">
                <h5 class="font-poppins font-semibold text-black text-2xl tracking-wide mb-7">{{__('Détails de parking')}}</h5>
                <div class="flex justify-between l:items-center mb-4 l:flex-row s:flex-col">
                    <h5 class="font-poppins font-medium text-[#404F65] text-xl">{{session()->has('parkingspace') == true ? $parkingspace['title'] : '' }}</h5>
                    <div class="flex items-center justify-center gap-1 w-[61px] h-[37px] bg-light-orange rounded-lg s:mt-4 xxxxl:mt-0">
                        <img src="{{asset('website/icon/star.svg')}}" alt="" class="w-5">
                        <h6 class="font-poppins font-normal text-[#8896AB] text-sm">{{session()->has('parkingspace') == true ? $parkingspace['rating'] : 'Aucun avis' }}</h6>
                    </div>
                </div>
                <div class="flex gap-2">
                    <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                    <p class="font-poppins font-normal text-[#556987] text-base w-48">{{session()->has('parkingspace') == true ? $parkingspace['address'] : '' }}</p>
                </div>
                <ul class="border border-[#EEF0F3] mt-5 mb-5"></ul>
                <form action="">
                    <div class="mb-5">
                        <label for="intime" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('Heure d'entrée')}}</label>
                        <div class="mt-3">
                            <div>
                                <input type="datetime-local" name="arriving_time" class="w-full border border-light-gray rounded-lg font-poppins font-normal text-black text-base mt-2" value="{{session()->has('parkingspace') == true ? $parkingspace['arriving_time'] : '' }}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="intime" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('Heure de sortie')}}</label>
                        <div class="mt-3">
                            <div>
                                <input type="datetime-local" name="leaving_time" class="w-full border border-light-gray rounded-lg font-poppins font-normal text-black text-base mt-2" value="{{session()->has('parkingspace') == true ? $parkingspace
                                    ['leaving_time'] : ''}}" readonly="readonly">
                            </div>
                        </div>
                    </div>

                    <div class="flex mb-5 gap-8 l:flex-row s:flex-col">
                        <div>
                            <label for="slot" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('Crénau no')}}</label>
                            <h5 class="font-poppins font-normal text-base text-primary bg-light-blue w-[200px] h-[46px] border-dashed border-primary border-2 text-center rounded mt-2 pt-2" value="{{session()->has('parkingslot') == true ? $parkingslot
                                    ['name'] : ''}}" readonly="readonly">{{session()->has('parkingslot') == true ? $parkingslot
                                    ['name'] : ''}}</h5>
                        </div>
                        <div>
                            <label for="slot" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('Durée')}}</label>
                            <div class="flex mt-5 gap-2">
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
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="vehicle" class="font-poppins font-normal text-[#8896AB] text-base tracking-wide">{{__('Selectionner un vélo')}}</label>
                    </div>
                    <div class="bg-[#F7F8F9] rounded-[4px] p-2 w-fit mb-5">
                        <p class="font-poppins font-normal text-sm text-[#556987] tracking-wide">{{__('Notre système fonctionne à l'heure')}} <span class="font-medium text-[#4D5F7A] text-base">{{__('$12/hr')}}</span></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->

{{-- <div id="booking" tabindex="-1" aria-hidden="true" class="fixed top-5 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto  h-modal md:h-full">
    <div class="relative xxxxl:w-[499px] s:w-full h-full max-w-2xl md:h-auto">        
        <div class="relative bg-white rounded-2xl shadow dark:bg-gray-700 p-8">         
            <img src="{{asset('website/icon/book.svg')}}" alt="" class="mx-auto mb-8">
<h5 class="font-poppins font-bold text-3xl text-[#404F65] text-center mb-16">{{__('Votre Crénau a été reservé')}}</h5>
<button class="w-full border border-[#EEF0F3] rounded-[6px] h-14 font-poppins font-medium text-lg text-[#8896AB] tracking-wide mb-5">{{__('Retour à la page d'acceuil')}}</button>
<button class="w-full bg-primary rounded-[6px] h-14 font-poppins font-medium text-lg text-white tracking-wide mb-10">{{__('Voir la commande')}}</button>
</div>
</div>
</div> --}}


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ $adminsetting->paypal_sandbox }}&currency={{ $adminsetting->currency }}" data-namespace="paypal_sdk"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
    $('input[name="paymentRadio"]').change(function() {
        if (this.value == 'stripe') {
            $('.stripeCard').show(500);
            $('.razorCard').hide(500);
            $('.paypalCard').hide(500);
            $('.flutterwaveCard').hide(500);
            StripePayment();
        }
        if (this.value == 'razorpay') {
            $('.razorCard').show(500);
            $('.stripeCard').hide(500);
            $('.paypalCard').hide(500);
            $('.flutterwaveCard').hide(500);
        }
        if (this.value == 'paypal') {
            $('.paypalCard').show(500);
            $('.razorCard').hide(500);
            $('.stripeCard').hide(500);
            $('.flutterwaveCard').hide(500);
            paypalPayment();
        }
        if (this.value == 'flutterwave') {
            $('.flutterwaveCard').show(500);
            $('.paypalCard').hide(500);
            $('.razorCard').hide(500);
            $('.stripeCard').hide(500);
        }
    });
</script>
<script>
    var order_no = "{!! isset($parkingBooking) ? $parkingBooking->order_no : '' !!}";

    // Call the demoSuccessHandler function with the session data as parameters
    demoSuccessHandler(order_no);
</script>

@endsection