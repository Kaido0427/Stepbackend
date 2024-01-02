@extends('layouts.app', ['title' => __('Plan')],['activePage' => 'buyerList'])

@section('content')
   @include('layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Plan Buyer List",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Plan'
],[ 'text'=>'Buyer List'])))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h3 class="mb-0">{{ __('Plan') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="https://dashboard.stripe.com/login" target="_blank" class="btn btn-sm btn-primary">{{ __('Aller sur Stripe') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('#') }}</th>
                                    <th scope="col">{{ __('Nom du Concierge') }}</th>
                                    <th scope="col">{{ __('Montant') }}</th>
                                    <th scope="col">{{ __('Periode') }}</th>
                                    <th scope="col">{{ __('Temp restant') }}</th>
                                    <th scope="col">{{ __('ID d'achat') }}</th>
                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plan as $item)
                                    <tr>
                                <td>{{ $loop->iteration}}</td>

                                        <td>{{ $item->owner->name }}</td>
                                        <td>${{  $item->price }}</td>
                                        <td>{{ $item->start_at->toFormattedDateString() .' to '. $item->end_at->toFormattedDateString() }}</td>
                                        <td>{{$item->end_at->diffForHumans()}}</td>
                                        <td>{{ $item->sub_id }}</td>
                            
                                            
                               
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection