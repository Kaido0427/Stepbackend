@extends('layouts.app', ['title' => __('Subscription')],['activePage' => 'subscription'])
@section('content')
     @include('layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Subscription",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Subscription'
],['text'=>'Edit details'])))
  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('subscription.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('subscription.update', $subscription) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="row pl-lg-4">
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('subscription_name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Nom de la souscription') }}</label>
                                            <input type="text" name="subscription_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('subscription_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Subscription') }}" value="{{ old('subscription_name',$subscription->subscription_name) }}"  autofocus required>
    
                                            @if ($errors->has('subscription_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('subscription_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('max_space_limit') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Durée de validité et prix du plan d'abonnement') }}</label>
                                            <input type="text" name="max_space_limit" id="input-name" class="form-control form-control-alternative{{ $errors->has('max_space_limit') ? ' is-invalid' : '' }}" placeholder="{{ __('Max Space Limit') }}" value="{{ old('max_space_limit',$subscription->max_space_limit) }}"  autofocus required>
    
                                            @if ($errors->has('max_space_limit'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('max_space_limit') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Statut') }}</label>
                                        <select name="status" class="form-control form-control-alternative">
                                            <option value="1" {{ $subscription->status == 1 ? 'selected' : '' }}>{{ __('Actif') }}</option>
                                            <option value="0" {{ $subscription->status == 0 ? 'selected' : '' }}>{{ __('Inactif') }}</option>
                                        </select>

                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('Durée de validité et prix du plan d'abonnement')}}</label>
                                        @foreach ($subscription->plan as $plan)
                                            <div class="registrations-info mt-3">
                                                <div class="row form-row reg-cont">
                                                    <div class="col-12 col-md-5 form-group">
                                                        <label class="col-form-group">{{__('Mois')}}</label>
                                                        <input type="number" min="1" name="month[]" value="{{ $plan->month }}" required class="form-control">
                                                    </div>
                                                    <div class="col-12 col-md-5 form-group">
                                                        <label>{{__('price')}}</label>
                                                        <input type="number" min="1" name="price[]" value="{{ $plan->price }}" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="add-more">
                                            <a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i>{{__(' Ajouter plus')}}</a>
                                        </div>
                                    </div>
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

@push('js')

<script>
    $(".registrations-info").on('click','.trash', function () {
        $(this).closest('.reg-cont').remove();
        return false;
    });

    $(".add-reg").on('click', function () {
        var regcontent = '<div class="row form-row reg-cont">' +
            '<div class="col-12 col-md-5">' +
                '<div class="form-group">' +
                    '<label>Month</label>' +
                    '<input type="number" name="month[]" required class="form-control">' +
                '</div>' +
            '</div>' +
            '<div class="col-12 col-md-5">' +
                '<div class="form-group">' +
                    '<label>Price</label>' +
                    '<input type="number" name="price[]" required class="form-control">' +
                '</div>' +
            '</div>' +
            '<div class="col-12 col-md-2">' +
                '<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
                '<a href="javascript:void(0)" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
            '</div>' +
        '</div>';
    
        $(".registrations-info").append(regcontent);
        return false;
    });
</script>
@endpush