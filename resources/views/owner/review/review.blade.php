@extends('owner.app', ['title' => __(' Review ')],['activePage' => 'review'])

@section('content')
  @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Review",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Review'
])))
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
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
                                    <th scope="col">{{ __('Nom de l\'Espace') }}</th>
                                    <th scope="col">{{ __('Nom') }}</th>
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Evaluation') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $review->space->title}}</td>
                                        <td>{{ $review->user->name }}</td>
                                        <td><img src="{{ asset('upload')}}/{{$review->user->image }}" class="rounded-circle" height="50" width="50"> </td>
                                        <td>     
                                            @for ($i = 1; $i <= $review->star; $i++)
                                                <span class="fa fa-star checked " style="color:rgb(255, 197, 8)"></span>
                                            @endfor
                                            @for ($j = $review->star + 1; $j <= 5; $j++)
                                                <span class="fa fa-star "></span>
                                            @endfor
                                        </td>
                                        <td>{{ $review->description }}</td>
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