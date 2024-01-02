@extends('layouts.app', ['title' => __('Installations de Parking ')],['activePage' => 'facilities'])

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Installations de Parking",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Installations de Parking'
])))

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 text-right">
                            <a href="{{ route('facilities.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter des installations de Parking') }}</a>
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
                                <th scope="col">{{ __('installations') }}</th>

                                <th scope="col">{{ __('Image') }}</th>
                                <th scope="col">{{ __('Date de Création') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $item)
                            <tr>
                                <td>{{ $loop->iteration}}</td>

                                <td>{{ $item->titre }}</td>

                                <td><img src="{{ asset('upload')}}/{{$item->image }}" class="rounded-circle" height="50" width="50" style="object-fit: cover"> </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                            <form action="{{ route('facilities.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('delete')


                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Êtes-vous sûr de vouloir supprimer cet Client ?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('supprimer') }}
                                                </button>
                                            </form>

                                            <a class="dropdown-item rtl_edit" href="{{ route('facilities.edit',$item) }}">{{ __('Editer') }}</a>
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