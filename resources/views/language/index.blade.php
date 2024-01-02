@extends('layouts.app', ['title' => __('Langues ')],['activePage' => 'language'])

@section('content')
  @include('layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>" Langues",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Langues '
])))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('languages.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter Languages') }}</a>
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
                                    <th scope="col">{{ __('Nom') }}</th>
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Direction') }}</th>
                                    <th scope="col">{{ __('Statut') }}</th>
                                    {{-- <th scope="col">{{ __('Date de création') }}</th> --}}
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($languages as $item)
                                    <tr>
                                <td>{{ $loop->iteration}}</td>

                                        <td>{{ $item->name }}</td>
                                       
                                <td><img src="{{ asset('upload')}}/{{$item->image }}" class="rounded-circle" height="50" width="50"> </td>
                                        <td>{{$item->direction}}</td>
                                        <td>   
                                            <span class="badge badge-pill badge-{{$item->status == 0 ? 'warning' : 'success'}}">
                                            {{$item->status == 1 ? 'Activé':'Désactivé'}}
                                            </span>
                                        </td>
                                       <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                            <form action="{{ route('languages.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('delete')


                                                <button type="button" class="dropdown-item"
                                                    onclick="confirm('{{ __("Êtes-vous sûr de vouloir supprimer cet Client ?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Supprimer') }}
                                                </button>
                                            </form>

                                            <a class="dropdown-item rtl_edit"
                                                href="{{ route('languages.edit',$item) }}">{{ __('Editer') }}</a>

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