@extends('owner.app', ['title' => __(' Vue de l\'espace')],['activePage' => 'spaces'])
@section('content')
  @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Space View",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Space View'
])))
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                @if( $subscription->max_space_limit > 0 && $subscription->max_space_limit == $parkingSpace_count)
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="modelOpen()">{{__('Ajouter un espace') }}</a>
                                @else
                                    <a href="{{ route('spaces.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter un espace') }}</a>
                                @endif
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

                    <div class="table-responsive" style="padding: 20px;">
                        <table class="table datatable align-items-center table-flush p-3">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('#') }}</th>
                                    <th scope="col">{{ __('Nom') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    <th scope="col">{{ __('Addresse') }}</th>
                                    <th scope="col">{{ __('Prix_par_heure') }}</th>
                                    <th scope="col">{{ __('Temps') }}</th>
                                    <th scope="col">{{ __('Payement hors ligne') }}</th>
                                    <th scope="col">{{ __('Verifier') }}</th>

                                     <th scope="col">{{ __('Statut') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkingSpace as $pspace)
                                    <tr>
                                <td>{{ $loop->iteration}}</td>
                                 <td>{{ $pspace->title }}</td>
                                 <td>{{ $pspace->description }}</td>
                                 <td>{{ $pspace->address }}</td>
                                 <td>{{ $pspace->price_par_hour }}</td>
                                 <td>
                                    @if ($pspace->available_all_day ==1)
                                    24/7  
                                   @else
                                     {{ $pspace->open_time  }} To {{ $pspace->close_time  }}
                                   @endif
                               </td>      
                               <td>
                                <span class="badge badge-pill badge-{{$pspace->offline_payment ==0 ? 'warning' : 'success'}}">
                                    {{$pspace->offline_payment ==1 ? 'Oui':'Non'}}
                                </span>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-{{$pspace->verified ==0 ? 'warning' : 'success'}}">
                                        {{$pspace->verified ==1 ? 'Oui':'Non'}}
                                    </span>
                                </td>
                                 <td>   
                                    <span class="badge badge-pill badge-{{$pspace->status == 0 ? 'warning' : 'success'}}">
                                    {{$pspace->status == 1 ? 'Activé':'DésActivé'}}
                                    </span>
                                </td>
                                 <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                            <form action="{{ route('spaces.destroy', $pspace->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="dropdown-item"
                                                    onclick="confirm('{{ __("Êtes-vous sûr(e) de vouloir supprimer cet espace ?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Supprimer') }}
                                                </button>
                                            </form>
                                            <a class="dropdown-item rtl_edit"  href="{{ route('spaces.edit',$pspace) }}">{{ __('Editer') }}</a>
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
