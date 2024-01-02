<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
@extends('owner.app', ['title' => __('Card')],['activePage' => 'subscription'])

@section('content')
     @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Card",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Card'
],['text'=>'Add New'])))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ url('owner/subscription') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="col-md-6 col-md-offset-3">
                            
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                    <div class="alert alert-primary text-center">
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                    @endif
                                    <form role="form" action="{{ url('owner/addcarddetail') }}" method="post" class="stripe-payment"
                                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"  id="stripe-payment">
                                        @csrf
                                        <div class="form-group">
                                            <div class='form-group required'>
                                                <label class="form-control-label">{{__('Nomm sur la carte')}}</label> 
                                                <input class='form-control form-control-alternative' size='4' type='text' >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class='form-group  required'>
                                                <label class="form-control-label">{{__('Numéro de carte')}}</label> 
                                                <input class='form-control  form-control-alternative card-num' autocomplete='off'   type='text' >
                                            </div>
                                           
                                        </div>
            
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='form-control-label'>{{__('CVC')}}</label>
                                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 595'
                                                    size='4' type='text' >
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='form-control-label'>{{__('Mois d'expiration')}}</label> <input
                                                    class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='form-control-label'>{{__('Année d'expiration')}}</label> <input
                                                    class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' >
                                            </div>
                                        </div>
                                       
                                        <div class='col-md-12 error form-group hide'>
                                            <div class='alert text-danger '>

                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <button class="btn btn-primary btn-lg btn-block rtl_btn" type="submit">{{__('Ajouter une carte')}}</button>
                                        </div>
                                    </form>    
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            @if (session('statusdelete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('statusdelete') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                           <div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-name">{{__('Sauvegarder la Carte') }}</label>
                                @if(isset($cards))
                                    @foreach ( $cards['data'] as $card )
                                        <div class="d-flex" >
                                            <div class="abc"> 
                                            <span><input type="radio" name="payment-source" ></span>
                                            </div>
                                            <div id="Sauvegarderd-card">* ******* ****{{$card['last4']}} </div>
                                            <form action="{{url('owner/deletecard',$card['id'])}}" method="post">
                                                @csrf
                                                <button type="button" class="btn btn-danger rtl_danger" style="margin-left: 30px;"
                                                    onclick="confirm('{{ __("Êtes-vous sûr de vouloir supprimer ces détails de carte ?") }}') ? this.parentElement.submit() : ''">
                                                    <i class="ni ni-fat-remove"></i>
                                                </button>
                                            </form>   
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() =='') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });
        function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>












