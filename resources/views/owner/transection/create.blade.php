
@extends('owner.app', ['title' => __('Transaction')],['activePage' => 'transection'])
@section('content')

@include('owner.layouts.headers.header',
array(
'class'=>'Transaction',
'title'=>"Transaction",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Transaction'
])))

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('Transaction') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('owner/transection/custom') }}" autocomplete="off" enctype="multipart/form-data" id="myform" class="myform">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="d-flex">
                                <div class="form-group{{ $errors->has('startdate') ? ' has-danger' : '' }}  col-6">
                                    <label class="form-control-label" for="start date">{{ __('Date de début') }}</label>
                                    <input type="date" name="startdate" id="input-name" class="form-control form-control-alternative{{ $errors->has('startdate') ? ' is-invalid' : '' }}" placeholder="{{ __('startdate') }}" value="{{ old('startdate') }}"  autofocus required>
                                    @if ($errors->has('startdate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('statdate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('enddate') ? ' has-danger' : '' }} col-6">
                                    <label class="form-control-label" for="end date">{{ __('Date de fin') }}</label>
                                    <input type="date" name="enddate" id="input-name" class="form-control form-control-alternative{{ $errors->has('startdate') ? ' is-invalid' : '' }}" placeholder="{{ __('enddate') }}" value="{{ old('enddate') }}"  autofocus required>

                                    @if ($errors->has('enddate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('enddate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary rtl_btn mt-4">{{ __('Trouver') }}</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4" />
                    <form method="post" action="{{ url('owner/transectionall') }}" autocomplete="off" id="myform" class="myform">
                        @csrf
                        <div class="pl-lg-4 " >
                            <div class="aa" style="display:flex; justify-content:center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="today" required>
                                    <label class="form-check-label" for="inlineRadio1">{{__('Aujourd\'hui')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="week" required>
                                    <label class="form-check-label" for="inlineRadio2">{{__('Semaine')}}</label>
                                </div>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="month" required>
                                    <label class="form-check-label" for="inlineRadio2">{{__('Mois')}}</label>
                                </div>
                            </div>    
                                <div class="text-center mb-2">
                                    <button type="submit" class="btn btn-primary rtl_btn mt-4">{{ __('Trouver') }}</button>
                                </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection