@extends('layouts.app', ['title' => __('Plan')],['activePage' => 'plan'])

@section('content')
       @include('layouts.headers.header',
      array(
          'class'=>'warning',
          'title'=>"Clients",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Plan'
])))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-4 text-right">
                                <a href="{{ route('plan.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter un  Plan') }}</a>
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
                                    <th scope="col">{{ __('Nom') }}</th>
                                    
                                    <th scope="col">{{ __('Montant') }}</th>
                                    <th scope="col">{{ __('intervalle') }}</th>
                    
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plan as $item)
                                    <tr>
                                <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item['product']['name'] }}</td>
                                        <td>{{ $item['currency'] .' '. ($item['amount'] / 100)}}</td>
                                        <td>{{ $item['interval_count'] .' '. $item['interval'] }}</td>
                            
                                             <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                            <form action="{{ url('plan/'. $item['id']) }}" method="post">
                                                @csrf
                                                @method('delete')


                                                <button type="button" class="dropdown-item"
                                                    onclick="confirm('{{ __("Êtes-vous sûr de vouloir supprimer cet Client") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Supprimer') }}
                                                </button>
                                            </form>

                                          

                                        </div>
                                    </div>
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

