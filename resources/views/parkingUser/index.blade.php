@extends('layouts.app', ['title' => __('Client De Parking')],['activePage' => 'parkingUser'])

@section('content')
     @include('layouts.headers.header',
      array(
          'class'=>'success',
          'title'=>"Clients",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Liste des Clients'
])))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                {{-- <a href="{{ route('vehicleType.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter un Client de parking') }}</a> --}}
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
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Phone No') }}</th>
                                    <th scope="col">{{ __('Statut') }}</th>
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Date de création') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkingUser as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone_no }}</td>
                                        <td>
                                            <span class="badge badge-pill badge-{{$item->status == 0 ? 'warning' : 'success'}}">
                                                {{$item->status == 1 ? 'Activé':'DésActivé'}}
                                            </span>
                                        </td>
                                        <td><img src="{{ asset('upload')}}/{{$item->image }}" class="rounded-circle" height="50" width="50"> </td>
                                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-right"></td>
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