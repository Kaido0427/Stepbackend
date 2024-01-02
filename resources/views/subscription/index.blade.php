@extends('layouts.app', ['title' => __('Subscription')],['activePage' => 'subscription'])
@section('content')
@include('layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Abonnement",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Abonnement'
])))
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('subscription.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter un abonnement') }}</a>
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

                    <div class="table-responsive" style="padding: 20px">
                        <table class="table datatable align-items-center table-flush p-3">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('#') }}</th>
                                    <th scope="col">{{ __('Subscription name') }}</th>
                                    <th scope="col">{{ __('Max Space Limit') }}</th>
                                    <th scope="col">{{ __('Statut') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>

                                        <td>{{ $item->subscription_name }}</td>
                                        <td>{{ $item->max_space_limit }}</td>
                                        <td>
                                            <span
                                                class="badge badge-pill badge-{{$item->status == 0 ? 'warning' : 'success'}}">
                                                {{$item->status == 1 ? 'Activé':'DésActivé'}}
                                            </span>
        
                                        </td>
                                        <td class="text-right">
                                            @if ($item->id == 1)
                                                {{ "This can't be edit or delete." }}    
                                            @else
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                        <form action="{{ route('subscription.destroy', $item) }}" method="post">
                                                            @csrf
                                                            @method('delete')


                                                            <button type="button" class="dropdown-item"
                                                                onclick="confirm('{{ __("Are you sure you want to delete this subscription?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>

                                                        <a class="dropdown-item rtl_edit" href="{{ route('subscription.edit',$item) }}">{{ __('Edit') }}</a>
                                                    </div>
                                                </div>
                                            @endif
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
