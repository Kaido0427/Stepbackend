@extends('layouts.app', ['title' => __('Contenu du site web')],['activePage' => 'website_content'])
@section('content')
@include('layouts.headers.header',
array(
'class'=>'primary',
'title'=>"Contenu du site web",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Contenu du site web'
])))

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">

            <form method="post" autocomplete="off" action="{{ route('webcontent.update',$webcontent) }}">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Mettre à jour') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">

                                <label class="form-control-label" for="name">{{ __('À Propos')}}</label>
                                <textarea name="about_us" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" placeholder="Ecrire le contenu du site web ...">{{$webcontent->about_us}}</textarea>

                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection