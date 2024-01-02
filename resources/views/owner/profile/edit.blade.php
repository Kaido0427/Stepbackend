@extends('owner.app', ['title' => __('Owner Profile')],['activePage' => 'profile'])
@section('content')
@include('owner.layouts.headers.header',
array(
'class'=>'Profile',
'title'=>"Profile",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Profile'
])))

<div class="container-fluid mt--7">
    <div class="row">

        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('Editer le  Profil') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('owner/updateprofile') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for=" name">{{ __('Nom') }}</label>
                                <input type="text" name="name" id="input-name"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Name') }}" value="{{ old('name', Auth::guard('owner')->user()->name) }}"
                                    required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" readonly id="input-email"
                                    class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Email') }}" value="{{ old('email', Auth::guard('owner')->user()->email) }}"
                                    required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="phone">{{ __('Phone') }}</label>
                                <input type="text" name="phone" id="input-phone"
                                    class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('contact no') }}" value="{{ old('phone_no', Auth::guard('owner')->user()->phone_no) }}"
                                    required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                                <label for="Image" class="col-form-label"> {{__('Image')}}</label>
                                <div class="avatar-upload avatar-box avatar-box-left">
                                    <div class="avatar-edit">
                                        <input type='file' id="image" name="photo" accept=".png, .jpg, .jpeg" />
                                        <label for="image"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url({{ asset('upload')}}/{{Auth::guard('owner')->user()->image }})">
                                        </div>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="custom_error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            {{-- <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="image">{{ __('Image') }}</label>
                                <input type="file" name="photo" class="form-control form-control-alternative{{ $errors->has('photo') ? ' is-invalid' : '' }}" >
                                <img src="{{ asset('upload')}}/{{Auth::guard('owner')->user()->image }}" class="rounded-circle mt-2" height="50" width="50">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Sauvegarder') }}</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4" />
                    <form method="post" action="{{ url('owner/changepassword') }}" autocomplete="off">
                        @csrf
                        @if (session('password_status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('password_status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session('passworderror'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('passworderror') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="current-password">{{ __('Mot de passe actuel') }}</label>
                                <input type="password" name="old_password" id="input-current-password"
                                    class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Current Password') }}" value="" required>

                                @if ($errors->has('old_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="new password">{{ __('Nouveau mot de passe') }}</label>
                                <input type="password" name="password" id="input-password"
                                    class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('New Password') }}" value="" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label"  for="password-confirmation">{{ __('Confirmer le nouveau mot de passe') }}</label>
                                <input type="password" name="password_confirmation" id="input-password-confirmation"
                                    class="form-control form-control-alternative"
                                    placeholder="{{ __('Confirm New Password') }}" value="" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                   @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Changer le mot de passe') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection