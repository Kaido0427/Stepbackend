@extends('layouts.app', ['title' => __('Type de Vélo')],['activePage' => 'vehicleType'])

@section('content')
@include('layouts.headers.header', ['title' => __('Editer un type vélo')])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12 text-right">
                            <a href="{{ route('vehicle_type.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('vehicle_type.update', $vehicleType) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="pl-lg-4">

                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="title">{{ __('Titre') }}</label>
                                <input type="text" name="title" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Titre') }}" value="{{ old('title',$vehicleType->title) }}" autofocus required>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="status">{{ __('Statut') }}</label>

                                <select name="status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                    <option value=1 {{old('status',$vehicleType->status)==1 ? 'selected' : ''}}>{{ __('Activé')}}</option>
                                    <option value=0 {{old('status',$vehicleType->status)==0 ? 'selected' : ''}}>{{ __('DésActivé')}}</option>
                                </select>



                                @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="image">{{ __('Image') }}</label>

                                <input type="file" name="image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}">




                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Sauvegarder') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection