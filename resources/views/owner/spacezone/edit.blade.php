@extends('owner.app', ['title' => __('Space Zone')],['activePage' => 'space_zone'])
@section('content')
   @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Space Zone",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Space Zone'
],['text'=>'Edit Detail'])))
  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('space_zone.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('space_zone.update', $spacezone) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{$spacezone->id}}">

                            <div class="pl-lg-4">
                               
                                <div class="form-group">
                                    <label class="form-control-label" for="input-status">{{ __('Espace') }}</label>
                                    <select class="form-control form-control-alternative" name="space_id">
                                        @foreach ($spaces as $space)
                                        <option value="{{ $space->id }}" {{ $spacezone->space_id == $space->id ? 'selected' : '' }}>{{ $space->title }}</option>
                                    @endforeach                                 
                                    </select>   
                                </div>
                                
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __(' Nom de zone') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('spacezone') ? ' is-invalid' : '' }}" value="{{ old('spacezone',$spacezone->name) }}"  autofocus required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 
                                <div class="form-group">
                                    <label class="form-control-label" for="input-status">{{ __('Statut') }}</label>
                                    <select class="form-control form-control-alternative" name="status">
                                        <option  class="form-control form-control-alternative" value="1" {{$spacezone->status==1?'selected':''}}>{{ __('Activé')}}</option>
                                        <option  class="form-control form-control-alternative" value="0" {{$spacezone->status==0?'selected':''}}>{{ __('DésActivé')}}</option>
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
