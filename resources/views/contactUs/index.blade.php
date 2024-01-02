@extends('layouts.app', ['title' => __('Nous Contacter')],['activePage' => 'contactus'])
@section('content')
@include('layouts.headers.header',
array(
'class'=>'success',
'title'=>"Nous Contacter",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Nous Contacter'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Détails de Contact') }}</h3>
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
                <div class="card shadow">

                    <div class="card-body">
                        <form method="post" action="{{ route('contactus.update') }}" autocomplete="off" id="myform" class="myform" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="email">{{__('Contact Email') }}</label>
                                            <input type="text" name="email" id="input-name" class="hide_value form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $data['email']) }}" autofocus required>

                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('facebook_url') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="facebook_url">{{__('Facebook URL') }}</label>
                                            <input type="url" name="facebook_url" id="input-name" class="hide_value form-control form-control-alternative{{ $errors->has('facebook_url') ? ' is-invalid' : '' }}" value="{{ old('facebook_url',$data['facebook_url']) }}" autofocus required>

                                            @if ($errors->has('facebook_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('facebook_url') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('queriemail') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="queriemail">{{__('Adresse e-mail pour recevoir les requêtes') }}</label>
                                            <input type="text" name="queriemail" id="input-name" class="hide_value form-control form-control-alternative{{ $errors->has('mail_receive_querie') ? ' is-invalid' : '' }}" value="{{ old('queriemail', $data['queriemail']) }}" autofocus required>

                                            @if ($errors->has('queriemail'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('queriemail') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('instagram_url') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="instagram_url">{{__('Instagram URL') }}</label>
                                            <input type="url" name="instagram_url" id="input-name" class="hide_value form-control form-control-alternative{{ $errors->has('instagram_url') ? ' is-invalid' : '' }}" value="{{ old('instagram_url', $data['instagram_url']) }}" autofocus required>

                                            @if ($errors->has('instagram_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('instagram_url') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="phone">{{__('Téléphone') }}</label>
                                            <input type="number" name="phone" id="input-name" class="hide_value form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone',$data['phone']) }}" autofocus required>

                                            @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('twitter_url') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="twitter_url">{{__('Twitter URL') }}</label>
                                            <input type="url" name="twitter_url" id="input-name" class="hide_value form-control form-control-alternative{{ $errors->has('twitter_url') ? ' is-invalid' : '' }}" value="{{ old('twitter_url', $data['twitter_url']) }}" autofocus required>

                                            @if ($errors->has('twitter_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('twitter_url') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="address">{{__('Addresse') }}</label>
                                            <textarea name="address" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3">{{$data['address']}}</textarea>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('linkdin_url') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="linkdin_url">{{__('LinkedIn URL') }}</label>
                                            <input type="url" name="linkdin_url" id="input-name" class="hide_value form-control form-control-alternative{{ $errors->has('linkdin_url') ? ' is-invalid' : '' }}" value="{{ old('linkdin_url', $data['linkdin_url']) }}" autofocus required>

                                            @if ($errors->has('linkdin_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('linkdin_url') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-5">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{__('Enregistrer') }}</button>
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

@endsection