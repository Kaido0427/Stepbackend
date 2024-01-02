@extends('layouts.app', ['title' => __('Termes and Condition')],['activePage' => 'tc'])
@section('content')
@include('layouts.headers.header',
array(
'class'=>'primary',
'title'=>"Termes et conditions",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Terms and Condition'
])))

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <form method="post" autocomplete="off" action="{{ route('tc.update',$tc) }}">
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
                                <textarea id="textEditor" name="terms_condition" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" placeholder="Write a Terms and Condition ...">{{$tc->terms_condition}}</textarea>
                                @if ($errors->has('terms_condition'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('terms_condition') }}</strong>
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