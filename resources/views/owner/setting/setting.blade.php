@extends('owner.app', ['title' => __('Settings')],['activePage' => 'setting'])
@section('content')
@include('owner.layouts.headers.header',
array(
'class'=>'success',
'title'=>"Settings",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Setting'
])))

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Détails de configuration') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('owner/setting/payments')}}" autocomplete="off"  enctype="multipart/form-data">
                        @csrf
                            @if($ownerSetting)
                                <input type="hidden" name="ownerid" value="{{$ownerSetting->owner_id}}">
                            @endif
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" value="1" name="cod" {{ $ownerSetting['cod'] == 1 ? 'checked' : '' }} id="cod" type="checkbox">
                                            <label class="custom-control-label" for="cod">{{ __('Paiement en espèces au gardien lors de l'enregistrement.') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" value="1" name="stripe_status" {{ $ownerSetting['stripe_status'] == 1 ? 'checked' : '' }} id="stripe" type="checkbox">
                                            <label class="custom-control-label" for="stripe">{{ __('Stripe') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div
                                        class="form-group{{ $errors->has('STRIPE_SECRET') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="STRIPE SECRET">{{ __('Stripe secret') }}</label>
                                        <input type="text" name="stripe_secret" id="input-name" class="form-control form-control-alternative{{ $errors->has('stripe_secret') ? ' is-invalid' : '' }}" value="{{ old('stripe_secret',$ownerSetting['stripe_secret']) }}">

                                        @if ($errors->has('stripe_secret'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stripe_secret') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div
                                        class="form-group{{ $errors->has('stripe_public') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="STRIPE KEY">{{ __('Clé public space') }}</label>
                                        <input type="text" name="stripe_public" id="input-name" class="form-control form-control-alternative{{ $errors->has('stripe_public') ? ' is-invalid' : '' }}" value="{{ old('stripe_public',$ownerSetting['stripe_public']) }}">

                                        @if ($errors->has('stripe_public'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stripe_public') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <a type="submit" href="https://stripe.com/docs/keys#obtain-api-keys" target="_blank" class="btn btn-primary mt-4 rtl_btn">{{ __('Help') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" value="1" name="razorpay_status" {{ $ownerSetting['razorpay_status'] == 1 ? 'checked' : '' }} id="razorpay" type="checkbox">
                                            <label class="custom-control-label" for="razorpay">{{ __('Razorpay') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group{{ $errors->has('razorpay_key') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="Razorpay key">{{ __('Razorpay key') }}</label>
                                        <input type="text" name="razorpay_key" id="input-name" class="form-control form-control-alternative{{ $errors->has('razorpay_key') ? ' is-invalid' : '' }}" value="{{ old('razorpay_key',$ownerSetting['razorpay_key']) }}">

                                        @if ($errors->has('razorpay_key'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('razorpay_key') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <a type="submit" href="https://razorpay.com/docs/payments/dashboard/settings/api-keys/" target="_blank" class="btn btn-primary mt-4 rtl_btn">{{ __('Help') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" value="1" name="paypal_status" {{ $ownerSetting['paypal_status'] == 1 ? 'checked' : '' }} id="paypal" type="checkbox">
                                            <label class="custom-control-label" for="paypal">{{ __('Paypal') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div
                                        class="form-group{{ $errors->has('paypal_client_key') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="Paypal Client Id">{{ __('Paypal Client ID') }}</label>
                                        <input type="text" name="paypal_client_key" id="input-name" class="form-control form-control-alternative{{ $errors->has('paypal_client_key') ? ' is-invalid' : '' }}" value="{{ old('paypal_client_key',$ownerSetting['paypal_client_key']) }}">

                                        @if ($errors->has('paypal_client_key'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paypal_client_key') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('paypal_secret_key') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="Paypal secret key">{{ __('Paypal Secret key') }}</label>
                                        <input type="text" name="paypal_secret_key" id="input-name" class="form-control form-control-alternative{{ $errors->has('paypal_secret_key') ? ' is-invalid' : '' }}" value="{{ old('paypal_secret_key',$ownerSetting['paypal_secret_key']) }}">

                                        @if ($errors->has('paypal_secret_key'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paypal_secret_key') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <a type="submit" href="https://www.appinvoice.com/en/s/documentation/how-to-get-paypal-client-id-and-secret-key-22" target="_blank" class="btn btn-primary mt-4 rtl_btn">{{ __('Help') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" value="1" id="flutterwavekey" {{ $ownerSetting['flutterwave_status'] == 1 ? 'checked' : '' }} name="flutterwave_status" type="checkbox">
                                            <label class="custom-control-label" for="flutterwavekey">{{ __('Flutterwave') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('flutterwave_key') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="Flutterwave">{{ __('Flutterwave') }}</label>
                                        <input type="text" name="flutterwave_key" id="input-name" class="form-control form-control-alternative{{ $errors->has('flutterwave_key') ? ' is-invalid' : '' }}" value="{{ old('flutterwave_key',$ownerSetting['flutterwave_key']) }}">

                                        @if ($errors->has('flutterwave_key'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('flutterwave_key') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('flutterwave_key') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="Flutterwave">{{ __('Live Mode?') }}</label>
                                        <select name="isLiveMode" class="form-control">
                                            <option value="0" {{ $ownerSetting['isLiveMode'] == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                                            <option value="1" {{ $ownerSetting['isLiveMode'] == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                        </select>

                                        @if ($errors->has('flutterwave_key'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('flutterwave_key') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <a type="submit" href="https://developer.flutterwave.com/docs/quickstart/" target="_blank" class="btn btn-primary mt-4 rtl_btn">{{ __('Help') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Sauvegarder') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection