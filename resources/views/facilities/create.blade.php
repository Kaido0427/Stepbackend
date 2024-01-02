@extends('layouts.app', ['title' => __('Installations de Parking')],['activePage' => 'facilities'])

@section('content')
     @include('layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Installations de Parking",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Installations de Parking'
],['text'=>'Add New'])))
  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('facilities.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('facilities.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
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
                            <div class="form-group mt-2{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="title">{{ __('Titre') }}</label>
                                <input type="text" name="title" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}"  autofocus required>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                               
                            {{-- <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-status">{{ __('Image') }}</label>

                                <input type="file" name="image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}" required>
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Enregistrer') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection