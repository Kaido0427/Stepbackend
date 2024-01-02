@extends('owner.app', ['title' => __('Security Guard')],['activePage' => 'security'])

@section('content')
     @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Security Guard",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Security Guard'
],['text'=>'Add New'])))
  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('security.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('security.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="col-md-4">
                                    <label for="Image" class="col-form-label"> {{__('Image')}}</label>
                                    <div class="avatar-upload avatar-box avatar-box-left">
                                        <div class="avatar-edit">
                                            <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                            <label for="image"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview">
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="custom_error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name">{{ __('Nom') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}"  autofocus required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-name" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}"  autofocus required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="phone">{{ __('Phone') }}</label>
                                    <input type="text" name="phone" id="input-name" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}"  autofocus required>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="password">{{ __('Mot de passe') }}</label>
                                    <input type="password" name="password" id="input-name" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password') }}"  autofocus required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            <div class="form-group">
                                <label class="form-control-label" for="space">{{ __('Espace') }}</label>
                                <select class="form-control form-control-alternative" name="space">
                                    @foreach ($parkingSpace as $space )       
                                     <option  class="form-control form-control-alternative" value="{{$space['id']}}">{{$space['title']}}</option>
                                    @endforeach
                                </select>   
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="status">{{ __('Statut') }}</label>
                                <select class="form-control form-control-alternative" name="status">
                                    <option  class="form-control form-control-alternative" value="1">{{__('Activé')}}</option>
                                    <option  class="form-control form-control-alternative" value="0">{{__('DésActivé')}}</option>
                                </select>   
                            </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary rtl_btn mt-4">{{ __('Sauvegarder') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection