@extends('layouts.app', ['title' => __('Privacy And Policy')],['activePage' => 'Paramètres'])
@section('content')
@include('layouts.headers.header',
array(
'class'=>'success',
'title'=>"Paramètres",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Paramètres'
])))

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Detail de la configuration') }}</h3>
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
              
                <div class="p-4">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                    href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                    aria-selected="true">
                                    <i class="ni ni-email-83 mr-2"></i>{{__('Paramètres géneraux')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                    href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                    aria-selected="false">
                                    <i class="ni ni-email-83 mr-2"></i>{{__('Email')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                                    href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3"
                                    aria-selected="false">
                                    <i class="ni ni-credit-card mr-2"></i>{{__('passerelles de paiement')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab"
                                    href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4"
                                    aria-selected="false">
                                    <i class="ni ni-bell-55 mr-2"></i>{{__('Notification')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab"
                                    href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5"
                                    aria-selected="false">
                                    <i class="ni ni-send mr-2"></i>{{__('TWILIO')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-1-tab">
                                    <form method="post" action="{{ route('setting.generalsetting') }}"
                                        autocomplete="off" enctype="multipart/form-data" id="myform" class="myform">
                                        @csrf
                                        @method('put')
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="Image" class="col-form-label"> {{__('Logo')}}</label>
                                                    <div class="avatar-upload avatar-box avatar-box-left">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="image" name="logo"
                                                                accept=".png, .jpg, .jpeg" />
                                                            <label for="image"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview"
                                                                style="background-image: url({{ url('upload/'.$data->logo) }});">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('logo')
                                                    <div class="custom_error">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="Image" class="col-form-label"> {{__('Logo
                                                        Blanc')}}</label>
                                                    <div class="avatar-upload avatar-box avatar-box-left">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="image1" name="white_logo"
                                                                accept=".png, .jpg, .jpeg" />
                                                            <label for="image1"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview1"
                                                                style="background-image: url({{ url('upload/'.$data->white_logo) }});">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('white_logo')
                                                    <div class="custom_error">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="Image" class="col-form-label"> {{__('Favicon')}}</label>
                                                    <div class="avatar-upload avatar-box avatar-box-left">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="image2" name="favicon"
                                                                accept=".png, .jpg, .jpeg" />
                                                            <label for="image2"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview2"
                                                                style="background-image: url({{ url('upload/'.$data->favicon) }});">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('favicon')
                                                    <div class="custom_error">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="Image" class="col-form-label"> {{__('Arrière-plan Image')}}</label>
                                                    <div class="avatar-upload avatar-box avatar-box-left">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="image3" name="bg_img"
                                                                accept=".png, .jpg, .jpeg" />
                                                            <label for="image3"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview3"
                                                                style="background-image: url({{ url('upload/'.$data->bg_img) }});">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('bg_img')
                                                    <div class="custom_error">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <div
                                                        class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="name">{{ __('Nom')
                                                            }}</label>
                                                        <input type="text" name="name" id="input-name"
                                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('name',$data['name']) }}" autofocus required>

                                                        @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <div
                                                        class="form-group{{ $errors->has('color') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="color">{{ __('Couleur')
                                                            }}</label>
                                                        <input type="color" name="color" id="input-name"
                                                            class="form-control form-control-alternative{{ $errors->has('color') ? ' is-invalid' : '' }}"
                                                            value="{{ old('color',$data['color']) }}" autofocus
                                                            required>

                                                        @if ($errors->has('color'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="name">{{ __('Devise')
                                                            }}</label>
                                                        <select name="currency_code"
                                                            class="form-control form-control-alternative select2">
                                                            @foreach ($currencies as $currency)
                                                            <option value="{{$currency->id}}" {{ $currency->id ==
                                                                $data->currency_id ? 'selected' :
                                                                ''}}>{{$currency->country}}&nbsp;&nbsp;({{$currency->currency}})&nbsp;&nbsp;({{$currency->code}})
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('currency'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('currency') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group{{ $errors->has('timezone') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="name">{{ __('Fuseau horaire')
                                                            }}</label>
                                                        <select name="timezone"
                                                            class="form-control form-control-alternative select2">
                                                            @foreach ($timezones as $timezone)
                                                            <option value="{{$timezone->TimeZone}}" {{ $timezone->
                                                                TimeZone == $data->timezone ? 'selected' :
                                                                ''}}>{{$timezone->TimeZone}}&nbsp;&nbsp;({{$timezone->UTC_offset}})&nbsp;&nbsp;({{$timezone->UTC_DST_offset}})
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('timezone'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('timezone') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-between">
                                                    <div
                                                        class="form-group{{ $errors->has('trial_days') ? ' has-danger' : '' }} col-10">
                                                        <label class="form-control-label" for="name">{{ __('Durée de l\'abonnement Concierge')
                                                            }}</label>
                                                        <input type="number" name="trial_days" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('trial_days') ? ' is-invalid' : '' }}"
                                                            value="{{ old('trial_days',$data['trial_days']) }}" autofocus min="0"
                                                            required>
                                                        @if ($errors->has('trial_days'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('trial_days') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-between">
                                                    <div
                                                        class="form-group{{ $errors->has('map_key') ? ' has-danger' : '' }} col-10">
                                                        <label class="form-control-label" for="name">{{ __('Clé de carte')
                                                            }}</label>
                                                        <input type="text" name="map_key" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('map_key') ? ' is-invalid' : '' }}"
                                                            value="{{ old('map_key',$data['map_key']) }}" autofocus
                                                            required>
                                                        @if ($errors->has('map_key'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('map_key') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>

                                                    <div class="text-center">
                                                        <a type="submit"
                                                            href="https://developers.google.com/maps/documentation"
                                                            target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                            __('Help') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Sauvegarder')
                                                }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-1-tab">
                                    <form method="post" action="{{ route('setting.email') }}" autocomplete="off" id="myform" class="myform"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <div class="pl-lg-4">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_username') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL USERNAME">{{
                                                            __('MAIL
                                                            USERNAME') }}</label>
                                                        <input type="text" name="mail_username" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('mail_username') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_username',$data['mail_username']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_username'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_username') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_password') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL PASSWORD">{{
                                                            __('MAIL
                                                            MOT DE PASSE') }}</label>
                                                        <input type="text" name="mail_password" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('mail_password') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_password',$data['mail_password']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_driver') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL DRIVER">{{ __('MAIL
                                                            DRIVER') }}</label>
                                                        <input type="text" name="mail_driver" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('mail_driver') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_driver',$data['mail_driver']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_driver'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_driver') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_host') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL HOST">{{ __('MAIL
                                                            HOST')
                                                            }}</label>
                                                        <input type="text" name="mail_host" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('mail_host') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_host',$data['mail_host']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_host'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_host') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_port') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL PORT">{{ __('MAIL
                                                            PORT')
                                                            }}</label>
                                                        <input type="text" name="mail_port" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_port',$data['mail_port']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_port'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_port') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_encryption') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL ENCRYPTION">{{
                                                            __('MAIL
                                                            ENCRYPTION') }}</label>
                                                        <input type="text" name="mail_encryption" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('mail_encryption') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_encryption',$data['mail_encryption']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_encryption'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_encryption') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_from_address') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL FROM ADDRESS">{{ __('MAIL
                                                            FROM ADDRESS')
                                                            }}</label>
                                                        <input type="text" name="mail_from_address" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_from_address',$data['mail_from_address']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_from_address'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_from_address') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('mail_from_name') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="MAIL FROM NAME">{{
                                                            __('MAIL
                                                            FROM NAME') }}</label>
                                                        <input type="text" name="mail_from_name" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('mail_from_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mail_from_name',$data['mail_from_name']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('mail_from_name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mail_from_name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row" style="margin-top:35px">
                                                        <div class="col-6"> <label class="form-control-label">{{ __('Email OTP
                                                                Verification') }}?</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="custom-toggle">
                                                                <input type="checkbox" name="email_verification"
                                                                    id="email_verification" {{ $data->email_verification == 1 ? 'checked' : '' }}>
                                                                <span class="custom-toggle-slider rounded-circle"
                                                                    data-label-off="No" data-label-on="Yes"></span>
                                                            </label>                                                     
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                      

                                            <div class="d-flex justify-content-between pb-5">
                                                <div class="text-center d-flex">
                                                    <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{__('Sauvegarder') }}</button>
                                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class=" btn btn-primary mt-4 rtl_btn ">{{__('Test Mail')}}</button>
                                                </div>
                                                <div class="text-center">
                                                    <a type="submit"
                                                        href="https://sendgrid.com/blog/what-is-an-smtp-server/"
                                                        target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Help')
                                                        }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" 
                                    aria-labelledby="tabs-icons-text-2-tab">
                                    <form method="post" action="{{ route('setting.payments') }}" autocomplete="off" id="myform" class="myform"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        </h6>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="hide_value custom-control-input" value="1"
                                                                name="stripe_status" {{ $data['stripe_status']==1
                                                                ? 'checked' : '' }} id="customCheck1" type="checkbox">
                                                            <label class="custom-control-label" for="customCheck1">{{
                                                                __('Stripe') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div
                                                        class="form-group{{ $errors->has('STRIPE_SECRET') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="STRIPE SECRET">{{
                                                            __('Stripe
                                                            secret') }}</label>
                                                        <input type="text" name="stripe_secret" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('stripe_secret') ? ' is-invalid' : '' }}"
                                                            value="{{ old('stripe_secret',$data['stripe_secret']) }}">

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
                                                        <label class="form-control-label" for="STRIPE KEY">{{ __('Stripe
                                                            Public key') }}</label>
                                                        <input type="text" name="stripe_public" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('stripe_public') ? ' is-invalid' : '' }}"
                                                            value="{{ old('stripe_public',$data['stripe_public']) }}">

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
                                                            <a type="submit"
                                                                href="https://stripe.com/docs/keys#obtain-api-keys"
                                                                target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                                __('Help') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                         

                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="hide_value custom-control-input" value="1"
                                                                name="paypal_status" {{ $data['paypal_status']==1
                                                                ? 'checked' : '' }} id="paypal" type="checkbox">
                                                            <label class="custom-control-label" for="paypal">{{
                                                                __('Paypal')
                                                                }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div
                                                        class="form-group{{ $errors->has('paypal_sandbox') ? ' has-danger' : '' }}">
                                                        <label class="hide_value form-control-label"
                                                            for="Paypal Client Id">{{ __('Paypal Sandbox key')
                                                            }}</label>
                                                        <input type="text" name="paypal_sandbox" id="input-name"
                                                            class="form-control form-control-alternative{{ $errors->has('paypal_sandbox') ? ' is-invalid' : '' }}"
                                                            value="{{ old('paypal_sandbox',$data['paypal_sandbox']) }}">

                                                        @if ($errors->has('paypal_sandbox'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('paypal_sandbox') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div
                                                        class="form-group{{ $errors->has('paypal_production') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="Paypal secret key">{{
                                                            __('Paypal Production key') }}</label>
                                                        <input type="text" name="paypal_production" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('paypal_production') ? ' is-invalid' : '' }}"
                                                            value="{{ old('paypal_production',$data['paypal_production']) }}">

                                                        @if ($errors->has('paypal_production'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('paypal_production') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="offset-2 col-4">
                                                    <div
                                                        class="form-group{{ $errors->has('paypal_client_id') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="Paypal Client Id">{{
                                                            __('Paypal Client Id') }}</label>
                                                        <input type="text" name="paypal_client_id" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('paypal_client_id') ? ' is-invalid' : '' }}"
                                                            value="{{ old('paypal_client_id',$data['paypal_client_id']) }}">

                                                        @if ($errors->has('paypal_client_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('paypal_client_id') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div
                                                        class="form-group{{ $errors->has('paypal_secret_key') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="Paypal secret key">{{
                                                            __('Paypal Secret key') }}</label>
                                                        <input type="text" name="paypal_secret_key" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('paypal_secret_key') ? ' is-invalid' : '' }}"
                                                            value="{{ old('paypal_secret_key',$data['paypal_secret_key']) }}">

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
                                                            <a type="submit"
                                                                href="https://www.appinvoice.com/en/s/documentation/how-to-get-paypal-client-id-and-secret-key-22"
                                                                target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                                __('Help') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Sauvegarder')
                                                    }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" 
                                    aria-labelledby="tabs-icons-text-3-tab">
                                    <form method="post" action="{{ route('setting.notification') }}" autocomplete="off" id="myform" class="myform"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="pl-lg-4">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('APP_ID') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="APP ID">{{ __('APP ID')
                                                            }}</label>
                                                        <input type="text" name="APP_ID" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('APP_ID') ? ' is-invalid' : '' }}"
                                                            value="{{ old('APP_ID',$data['app_id']) }}" autofocus
                                                            required>

                                                        @if ($errors->has('APP_ID'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('APP_ID') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                    <div
                                                        class="form-group{{ $errors->has('REST_API_KEY') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="REST API KEY">{{ __('REST
                                                            API
                                                            KEY') }}</label>
                                                        <input type="text" name="REST_API_KEY" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('REST_API_KEY') ? ' is-invalid' : '' }}"
                                                            value="{{ old('REST_API_KEY',$data['rest_api_key']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('REST_API_KEY'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('REST_API_KEY') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('USER_AUTH_KEY') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="USER AUTH KEY">{{
                                                            __('USER
                                                            AUTH KEY') }}</label>
                                                        <input type="text" name="USER_AUTH_KEY" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('USER_AUTH_KEY') ? ' is-invalid' : '' }}"
                                                            value="{{ old('USER_AUTH_KEY',$data['user_auth_key']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('USER_AUTH_KEY'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('APP_ID') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('PROJECT_NUMBER') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="PROJECT NUMBER">{{
                                                            __('PROJECT NUMBER') }}</label>
                                                        <input type="text" name="PROJECT_NUMBER" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('PROJECT_NUMBER') ? ' is-invalid' : '' }}"
                                                            value="{{ old('PROJECT_NUMBER',$data['project_number']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('PROJECT_NUMBER'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('PROJECT_NUMBER') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2"> <label class="form-control-label">{{ __('Push
                                                        Notification') }}?</label>
                                                </div>
                                                <div class="col-10">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" value="1" name="push" id="push" checked>
                                                        <span class="custom-toggle-slider rounded-circle"
                                                            data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between pb-5">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Sauvegarder')
                                                        }}</button>
                                                </div>
                                                <div class="text-center">
                                                    <a type="submit"
                                                        href="https://documentation.onesignal.com/docs/accounts-and-keys"
                                                        target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Help')
                                                        }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form method="post" action="{{ route('setting.ownerNotification') }}" id="myform" class="myform"
                                        autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <div class="pl-lg-4">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('OWNER_APP_ID') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="OWNER APP ID">{{
                                                            __('OWNER
                                                            APP ID') }}</label>
                                                        <input type="text" name="OWNER_APP_ID" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('OWNER_APP_ID') ? ' is-invalid' : '' }}"
                                                            value="{{ old('OWNER_APP_ID',$data['owner_app_id']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('OWNER_APP_ID'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('OWNER_APP_ID') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                    <div
                                                        class="form-group{{ $errors->has('OWNER_REST_API_KEY') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="OWNER REST API KEY">{{
                                                            __('OWNER REST API KEY') }}</label>
                                                        <input type="text" name="OWNER_REST_API_KEY" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('OWNER_REST_API_KEY') ? ' is-invalid' : '' }}"
                                                            value="{{ old('OWNER_REST_API_KEY',$data['owner_rest_api_key']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('OWNER_REST_API_KEY'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('OWNER_REST_API_KEY') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('OWNER_AUTH_KEY') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="OWNER AUTH KEY">{{
                                                            __('OWNER
                                                            AUTH KEY') }}</label>
                                                        <input type="text" name="OWNER_AUTH_KEY" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('OWNER_AUTH_KEY') ? ' is-invalid' : '' }}"
                                                            value="{{ old('OWNER_AUTH_KEY',$data['owner_auth_key']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('OWNER_AUTH_KEY'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('OWNER_AUTH_KEY') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <label class="form-control-label">{{ __('Push Notification')
                                                        }}?</label>
                                                </div>
                                                <div class="col-10">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" value="1" name="push" id="push" checked>
                                                        <span class="custom-toggle-slider rounded-circle"
                                                            data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between pb-5">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Sauvegarder')
                                                        }}</button>
                                                </div>
                                                <div class="text-center">
                                                    <a type="submit"
                                                        href="https://documentation.onesignal.com/docs/accounts-and-keys"
                                                        target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Help')
                                                        }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form method="post" action="{{ route('setting.guardNotification') }}" id="myform" class="myform"
                                        autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="pl-lg-4">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('GUARD_APP_ID') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="GUARD APP ID">{{
                                                            __('GUARD
                                                            APP ID') }}</label>
                                                        <input type="text" name="GUARD_APP_ID" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('GUARD_APP_ID') ? ' is-invalid' : '' }}"
                                                            value="{{ old('GUARD_APP_ID',$data['guard_app_id']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('GUARD_APP_ID'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('GUARD_APP_ID') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                    <div
                                                        class="form-group{{ $errors->has('GUARD_REST_API_KEY') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="GUARD REST API KEY">{{
                                                            __('GUARD REST API KEY') }}</label>
                                                        <input type="text" name="GUARD_REST_API_KEY" id="input-name"
                                                            class="hide_value form-control form-control-alternative{{ $errors->has('GUARD_REST_API_KEY') ? ' is-invalid' : '' }}"
                                                            value="{{ old('GUARD_REST_API_KEY',$data['guard_rest_api_key']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('GUARD_REST_API_KEY'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('GUARD_REST_API_KEY') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('GUARD_AUTH_KEY') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="GUARD AUTH KEY">{{
                                                            __('GUARD
                                                            AUTH KEY') }}</label>
                                                        <input type="text" name="GUARD_AUTH_KEY" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('GUARD_AUTH_KEY') ? ' is-invalid' : '' }}"
                                                            value="{{ old('GUARD_AUTH_KEY',$data['guard_auth_key']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('GUARD_AUTH_KEY'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('GUARD_AUTH_KEY') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2"> <label class="form-control-label">{{ __('Push
                                                        Notification') }}?</label>
                                                </div>
                                                <div class="col-10">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" value="1" name="push" id="push" checked>
                                                        <span class="custom-toggle-slider rounded-circle"
                                                            data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between pb-5">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Sauvegarder')
                                                        }}</button>
                                                </div>
                                                <div class="text-center">
                                                    <a type="submit"
                                                        href="https://documentation.onesignal.com/docs/accounts-and-keys"
                                                        target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Help')
                                                        }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" 
                                    aria-labelledby="tabs-icons-text-4-tab">
                                    <form method="post" action="{{ route('setting.twilio') }}" autocomplete="off" id="myform" class="myform"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="pl-lg-4">


                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('twilio_id') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="TWILIO SID">{{ __('TWILIO
                                                            SID') }}</label>
                                                        <input type="text" name="twilio_id" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('twilio_id') ? ' is-invalid' : '' }}"
                                                            value="{{ old('twilio_id',$data['twilio_id']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('twilio_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('twilio_id') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('twilio_auth_token') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="TWILIO AUTH TOKEN">{{
                                                            __('TWILIO AUTH TOKEN') }}</label>
                                                        <input type="text" name="twilio_auth_token" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('twilio_auth_token') ? ' is-invalid' : '' }}"
                                                            value="{{ old('twilio_auth_token',$data['twilio_auth_token']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('twilio_auth_token'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('twilio_auth_token') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-6">
                                                    <div
                                                        class="form-group{{ $errors->has('twilio_number') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="TWILIO NUMBER">{{
                                                            __('TWILIO
                                                            NUMBER') }}</label>
                                                        <input type="text" name="twilio_number" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('twilio_number') ? ' is-invalid' : '' }}"
                                                            value="{{ old('twilio_number',$data['twilio_number']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('twilio_number'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('twilio_number') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                    <div
                                                        class="form-group{{ $errors->has('country_code') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="COUNTRY CODE">{{
                                                            __('COUNTRY
                                                            CODE') }}</label>
                                                        <input type="text" name="country_code" id="input-name"
                                                            class="hide_value form-control
                                                            form-control-alternative{{ $errors->has('country_code') ? ' is-invalid' : '' }}"
                                                            value="{{ old('country_code',$data['country_code']) }}"
                                                            autofocus required>

                                                        @if ($errors->has('country_code'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('country_code') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row" style="margin-top:35px">
                                                        <div class="col-6"> <label class="form-control-label">{{ __('SMS
                                                                OTP
                                                                Verification') }}?</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="custom-toggle">
                                                                <input type="checkbox" value="1" name="verification"
                                                                    id="verification" {{$data['verification']=='1'
                                                                    ? 'checked' : '' }}>
                                                                <span class="custom-toggle-slider rounded-circle"
                                                                    data-label-off="No" data-label-on="Yes"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between pb-5">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Sauvegarder')
                                                        }}</button>
                                                </div>
                                                <div class="text-center">
                                                    <a type="submit"
                                                        href="https://www.twilio.com/docs/glossary/what-is-an-api-key"
                                                        target="_blank" class="btn btn-primary mt-4 rtl_btn">{{
                                                        __('Help')
                                                        }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('Test Mail')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="col-form-label">{{__('Recipient Email for SMTP Testing')}}</label>
                <input type="text" name="mail_to" id="to" value="{{auth()->user()->email}}" required
                    class="form-control @error('mail_to') is-invalid @enderror">
                <span class="text-danger" id="validate"></span>
                @error('mail_to')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-primary" id="TestMail" onclick="demo()">{{__('Send')}}</button>
            </div>
            <div class="emailstatus text-right mr-3"></div>
        </div>
    </div>
</div>
@endsection
<script>
//test mail

function demo()
{
    var button = document.getElementById('TestMail');
    var mail_to = $('[name="mail_to"]').val(); 
    console.log('mail',mail_to);
    if(mail_to == "")
    {
        $('#validate').text('Email Field Is Required.');
        return;
    }

    button.addEventListener('click', function (event) {
        event.preventDefault();
        $('.emailstatus').html('<div class=" mt-3"><h6>Sending...</h6></div>');
        $.ajax({
            type: "GET",
            data:  { to: mail_to },
            url: base_url + '/test_mail',
            success: function (result) {
                if (result.success == true) {
                    console.log(result);
                    $('.emailstatus').html('');
                    $('.emailstatus').html(' <div class="text-success mt-3"><h6>' + result.message + '</h6></div>');
                } else if (result.success == false) {
                    $('.emailstatus').html('');
                    $('.emailstatus').html(' <div class="text-danger mt-3"><h6>' + result.message + '</h6></div>');
                    $('.emailerror').html(' <div class="text-danger mt-2"><p>' + result.data + '</p></div>');
                }
            }
        });

    });
}
</script>