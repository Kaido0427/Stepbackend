@extends('owner.app', ['title' => __('Security Guard ')],['activePage' => 'security'])

@section('content')
  @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Security Guard",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Security Guard'
])))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('security.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter un agent de sécurité') }}</a>
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
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Phone') }}</th>
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Espace') }}</th>
                                    <th scope="col">{{ __('Date de création') }}</th>
                                     <th scope="col">{{ __('Statut') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sguards as $sgurad)
                                    <tr>
                                <td>{{ $loop->iteration}}</td>
                                 <td>{{ $sgurad->name }}</td>
                                 <td>{{ $sgurad->email }}</td>
                                 <td>{{ $sgurad->phone_no }}</td>
                                 <td><img src="{{ asset('upload')}}/{{$sgurad->image }}" class="rounded-circle" height="50" width="50"> </td>
                                
                                 <td> {{$sgurad->space== null?'':$sgurad->space['title']}}  </td>
                                 
                                 <td>{{ $sgurad->created_at->format('d/m/Y H:i') }}</td>
                                  
                                    <td>   
                                        <span class="badge badge-pill badge-{{$sgurad->status == 0 ? 'warning' : 'success'}}">
                                        {{$sgurad->status == 1 ? 'Activé':'DésActivé'}}
                                        </span>
                                    </td>
                                 <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                            <form action="{{ route('security.destroy', $sgurad->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="dropdown-item"
                                                    onclick="confirm('{{ __("Êtes-vous sûr(e) de vouloir supprimer ce gardien?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                            <a class="dropdown-item rtl_edit" href="{{ route('security.edit',$sgurad) }}">{{ __('Editer') }}</a>
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