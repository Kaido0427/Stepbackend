@extends('owner.app', ['title' => __('Plan')],['activePage' => 'subscription'])

@push('css')
<style>
    .pricing-table {
        display: flex;
        flex-wrap: wrap;
        width: min(1600px, 100%);
        margin: auto;
    }

    .pricing-card {
        flex: 1;
        text-align: center;
        cursor: pointer;
        overflow: hidden;
        color: #2d2d2d;
        transition: .3s linear;
        background: aliceblue;
        border-radius: 28px;
        height: 100%;
    }

    .pricing-card-header {
        background-color: #0fbcf9;
        display: inline-block;
        color: #fff;
        padding: 12px 30px;
        border-radius: 0 0 20px 20px;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 600;
        transition: .4s linear;
    }

    .price {
        font-size: 30px;
        color: #0fbcf9;
        margin: 20px 0;
        transition: .2s linear;
    }

    .price sup,
    .price span {
        font-size: 22px;
        font-weight: 700;
    }

    .pricing-card li {
        font-size: 16px;
        padding: 10px 0;
        text-transform: uppercase;
    }

    .pricing-table .col-md-3 .pricing-card ul {
        list-style: none;
    }

    .hide {
        display: none;
    }
</style>
@endpush

@section('subscription')
@include('owner.layouts.headers.header', [
'class' => 'warning',
'title' => 'Subscription',
'description' => '',
'icon' => 'fas fa-home',
'breadcrumb' => [
[
'text' => 'Subscription',
],
],
])
<input type="hidden" name="currency" value="{{ $adminSettings['currency'] }}">
<input type="hidden" name="email" value="{{ Auth::guard('owner')->user()->email }}">
<input type="hidden" name="name" value="{{ Auth::guard('owner')->user()->name }}">
<input type="hidden" name="phone" value="{{ Auth::guard('owner')->user()->phone_no }}">
<input type="hidden" name="name" value="{{ $adminSettings['name'] }}">
<div class="container-fluid mt--7">
    <div class="card">
        <div class="card-header w-100 text-right">
            <button class="btn-sm btn-primary purchase" id='btn'>{{__('Acheter une sosucription')}}</button>
        </div>
        <div>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="pricing-table">
                    @foreach($subscriptions as $subscription)
                    <div class="col-md-3 mt-5">
                        <div class="pricing-card">
                            <h3 class="pricing-card-header">{{ $subscription->subscription_name }}</h3>
                            <div class="d-flex justify-content-center">
                                <p class="text-black fs-6">{{__('Maximum Parking Space(s) :')}}</p>
                                <p class="pl-2 text-black fs-6">{{ $subscription->max_space_limit == 0 ? "Unlimited" : $subscription->max_space_limit}} </p>
                            </div>
                            @if ($subscription->id == $purchase->subscription_id)
                            <div>
                                <span class="text-muted m-3">{{__('Actif')}}</span>
                            </div>
                            @endif
                            @if ($subscription->subscription_name != 'Free')
                            <div class="mt-2">
                                @foreach (json_decode($subscription->plan) as $plan)
                                <div class="custom-control custom-radio mb-3">
                                    <input name="radioBtn" class="custom-control-input radioBtn" value="{{ $plan->month }}/{{ $plan->price }}/{{ $subscription->id }}" id="customRadio{{ $subscription->id }}{{ $loop->iteration }}" type="radio">
                                    <label class="custom-control-label" for="customRadio{{ $subscription->id }}{{ $loop->iteration }}"><strong>{{ $adminSettings['currency_symbol'] }}{{ $plan->price }}/</strong>{{ $plan->month }}{{__(' month')}}</label>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="custom-control custom-radio mb-3">
                                <strong>{{$adminSettings->trial_days}}{{__(' validité en jours gratuits')}}</strong><br>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-2 paymentCard hide">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if ($adminSettings['stripe_status'])
                    <div class="custom-control custom-radio mb-3">
                        <input name="paymentRadio" class="custom-control-input" value="stripe" id="customRadio1" type="radio">
                        <label class="custom-control-label" for="customRadio1">{{ __('Stripe') }}</label>
                    </div>
                    @endif
                    @if ($adminSettings['razorpay_status'])
                    <div class="custom-control custom-radio mb-3">
                        <input name="paymentRadio" class="custom-control-input" value="razorpay" id="customRadio2" type="radio">
                        <label class="custom-control-label" for="customRadio2">{{ __('Razorpay') }}</label>
                    </div>
                    @endif
                    @if ($adminSettings['paypal_status'])
                    <div class="custom-control custom-radio mb-3">
                        <input name="paymentRadio" class="custom-control-input" value="paypal" id="customRadio3" type="radio">
                        <label class="custom-control-label" for="customRadio3">{{ __('Paypal') }}</label>
                    </div>
                    @endif
                    @if ($adminSettings['flutterwave_status'])
                    <div class="custom-control custom-radio mb-3">
                        <input name="paymentRadio" class="custom-control-input" value="flutterwave" id="customRadio4" type="radio">
                        <label class="custom-control-label" for="customRadio4">{{ __('Flutterwave') }}</label>
                    </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card mt-2 stripeCard hide">
                        <div class="card-body">
                            <div class="alert alert-warning stripe_alert hide" role="alert">
                            </div>
                            <input type="hidden" name="stripe_publish_key" value="{{$adminSettings['stripe_public']}}">
                            <form role="form" method="post" class="require-validation customform" data-cc-on-file="false" id="stripe-payment-form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{__('Email')}}</label>
                                            <input type="email" class="email form-control required" title="Enter Your Email" name="email" required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{__('Information de carte')}}</label>
                                            <input type="text" class="card-number required form-control" title="please input only number." pattern="[0-9]{16}" name="card-number" placeholder="1234 1234 1234 1234" title="Card Number" required />
                                            <div class="row mt-2">
                                                <div class="col-lg-6">
                                                    <input type="text" class="expiry-date required form-control" name="expiry-date" title="Expiration date" title="please Enter data in MM/YY format." pattern="(0[1-9]|10|11|12)/[0-9]{2}$" placeholder="MM/YY" required />
                                                    <input type="hidden" class="card-expiry-month required form-control" name="card-expiry-month" />
                                                    <input type="hidden" class="card-expiry-year required form-control" name="card-expiry-year" />
                                                </div>

                                                <div class="col-lg-6 pl-0">
                                                    <input type="text" class="card-cvc required form-control" title="please input only number." pattern="[0-9]{3}" name="card-cvc" placeholder="CVC" title="CVC" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{__('Name on card')}}</label>
                                            <input type="text" class="required form-control" name="name" title="Name on Card" required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <input type="button" class="btn btn-primary mt-4 btn-submit" value="{{ __('Payer avec stripe') }}" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-2 razorCard hide">
                        <input type="hidden" name="razor_key" value="{{ $adminSettings['razorpay_key'] }}">
                        <div class="card-body text-center">
                            <button class="btn-sm btn-primary" name="RazorBtn" id="paybtn" onclick="RazorPayPayment()">{{ __('Payer avec Razorpay') }}</button>
                        </div>
                    </div>

                    <div class="card mt-2 flutterwaveCard hide">
                        <input type="hidden" name="flutterwave_key" value="{{ $adminSettings['flutterwave_key'] }}">
                        <div class="card-body text-center">
                            <button class="btn-sm btn-primary" onclick="makePayment()">{{ __('Payer avec Flutterwave') }}</button>
                        </div>
                    </div>

                    <div class="card mt-2 paypalCard hide">
                        <div class="paypal_row_body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#btn').hide();
        $('.radioBtn').change(function() {
            if ($("input[name='radioBtn']").is(":checked")) {
                $('#btn').show();
            } else {
                $('#btn').hide();
            }
        });
    });
</script>
<script src="https://js.stripe.com/v1/"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ $adminSettings->paypal_sandbox }}&currency={{ $adminSettings->currency }}" data-namespace="paypal_sdk"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
@endpush