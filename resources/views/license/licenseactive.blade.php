@extends('layouts.app', ['title' => __('Activation de licence')],['activePage' => 'setting'])

@section('license')
     @include('layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"License Active",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Activation de licence'
],['text'=>''])))
  
  <div class="container-fluid mt--7">
      <div class="row">
          <div class="col-xl-12 order-xl-1">
             
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('update_license')}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                @if (session('error_msg'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error_msg') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                          @endif

                                <div class="form-group{{ $errors->has('client_name  ') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Client Name') }}</label>
                                    <input type="text" name="client_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('client_name ') ? ' is-invalid' : '' }}" placeholder="{{ __('Client Name') }}" value="{{ old('client_name ') }}" {{$license->license_status==1?'DésActivé':''}} autofocus required>

                                    @if ($errors->has('client_name '))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_name ') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('license_code ') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('License Code') }}</label>
                                    <input type="text" name="license_code" id="input-name" class="form-control form-control-alternative{{ $errors->has('license_code') ? ' is-invalid' : '' }}" placeholder="{{ __('License code') }}" value="{{ old('license_code',) }}"{{$license->license_status==1?'DésActivé':''}}  autofocus required>

                                    @if ($errors->has('license_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_code') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4" {{$license->license_status==1?'DésActivé':''}}>{{ __('Sauvegarder') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection