@extends('owner.app', ['title' => __(' Space Zone View ')],['activePage' => 'space_zone'])
@section('content')
  @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Space Zone View",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Space Zone View'
])))
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('space_zone.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter une zone spatiale') }}</a>
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
                                    <th scope="col">{{ __('Espace') }}</th>
                                    <th scope="col">{{ __('Nom de la zone') }}</th>
                                     <th scope="col">{{ __('Statut') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spacezones as $zone)
                                    <tr>
                                <td>{{ $loop->iteration}}</td>
                                 <td>{{ $zone->ParkingSpace->title }}</td>  
                                 <td>{{ $zone->name }}</td>  
                                 <td>   
                                    <span class="badge badge-pill badge-{{$zone->status == 0 ? 'warning' : 'success'}}">
                                    {{$zone->status == 1 ? 'Activé':'DésActivé'}}
                                    </span>
                                </td>
                                 <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                            <form action="{{ route('spaces.destroy', $zone->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="dropdown-item"
                                                    onclick="confirm('{{ __("Êtes-vous sûr(e) de vouloir supprimer cet espace ?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('supprimer') }}
                                                </button>
                                            </form>
                                            <a class="dropdown-item rtl_edit"  href="{{ route('space_zone.edit',$zone->id) }}">{{ __('Editer') }}</a>
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