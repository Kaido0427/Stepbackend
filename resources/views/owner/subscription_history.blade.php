@extends('owner.app', ['title' => __('Subscription History')],['activePage' => 'subscription_history'])

@section('content')
  @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Subscription History",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Subscription History'
])))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                        </div>
                    </div>

                    <div class="table-responsive" style="padding: 20px;">
                        <table class="table datatable align-items-center table-flush p-3">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('#') }}</th>
                                    <th scope="col">{{ __('Nom de la souscription') }}</th>
                                    <th scope="col">{{ __('Durée') }}</th>
                                    <th scope="col">{{ __('Date de début') }}</th>
                                    <th scope="col">{{ __('Date de fin') }}</th>
                                    <th scope="col">{{ __('jeton de payement') }}</th>
                                    <th scope="col">{{ __('Statut') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subscription['subscription']->subscription_name }}</td>
                                    <td>{{ $subscription->duration }}</td>
                                    <td>{{ $subscription->start_at }}</td>
                                    <td>{{ $subscription->end_at }}</td>
                                    <td>{{ $subscription->payment_token }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{$subscription->status == 0 ? 'warning' : 'success'}}">
                                            {{$subscription->status == 1 ? 'Actif':'Expiré'}}
                                        </span>
                                    </td>
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