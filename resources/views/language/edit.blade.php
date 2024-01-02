@extends('layouts.app', ['title' => __('Language')],['activePage' => 'language'])

@section('content')
     @include('layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Language ",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Language '
],['text'=>''])))
  
  <div class="container-fluid mt--7">
      <div class="row">
          <div class="col-xl-12 order-xl-1">
             
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{url('languages')}}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('languages.update',$languages) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{$languages->id}}">
                            <div class="pl-lg-4">
                                @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="Image" class="col-form-label"> {{__('Image')}}</label>
                                    <div class="avatar-upload avatar-box avatar-box-left">
                                        <div class="avatar-edit">
                                            <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                            <label for="image"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{ asset('upload')}}/{{$languages->image }});">
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="custom_error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name">{{ __('Nom') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',$languages->name) }}"  autofocus required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('json_file') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="json file">{{ __('Fichier json') }}</label>
                                    <input type="file" name="json_file" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('json_file') }}" value="{{ old('json_file') }}"  accept=".json" autofocus >
                                    @if ($errors->has('json_file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('json_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="direction">{{ __('Direction') }}</label>
                                    <select class="form-control form-control-alternative" name="direction">
                                        <option  class="form-control form-control-alternative" >Selectionner une direction </option>

                                        <option  class="form-control form-control-alternative" value="ltr"{{$languages->direction=='ltr'?'selected':''}}>{{ __('ltr')}} </option>
                                        <option  class="form-control form-control-alternative" value="rtl"{{$languages->direction=='rtl'?'selected':''}}>{{ __('rtl')}}</option>
                                    </select>   
                                </div>
                                 {{-- <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="image">{{ __('Image') }}</label>

                                <input type="file" name="image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                accept=".png, .jpg, .jpeg, .svg" >
                                <img src="{{ asset('upload')}}/{{$languages->image }}" class="rounded-circle mt-2" height="50" width="50">
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div> --}}
                            <div class="form-group">
                                <label class="form-control-label" for="">{{ __('Statut') }}</label>
                                <select class="form-control form-control-alternative" name="status">
                                    <option  class="form-control form-control-alternative" value="1" {{$languages->status==1?'selected':''}}>{{ __('Activé')}}</option>
                                    <option  class="form-control form-control-alternative" value="0"{{$languages->status==0?'selected':''}}>{{ __('DésActivé')}}</option>
                                </select>   
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