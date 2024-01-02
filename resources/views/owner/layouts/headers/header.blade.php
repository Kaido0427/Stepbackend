@php
$adminSetting = \App\AdminSetting::first();
@endphp
<div class="header pb-7 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url({{url('upload/'.$adminSetting->bg_img)}}); background-size: cover; background-position: center center;" style="padding-top: 5%">
    <span class="mask bg-dark-success opacity-3"></span>

    <div class="container-fluid">
        <div class="header-body">
           <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
        <h6 class="h2 text-white d-inline-block mb-0">{{ $title }}</h6>
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="{{url('owner/logout')}}"><i class="{{$icon ?? ''}}"></i></a></li>
            @if (isset($breadcrumb))      
            @foreach ($breadcrumb as $item)
            <li class="breadcrumb-item {{$loop->last ? 'active' : ''}}"><a href="#">{{$item['text']}}</a></li>
            {{-- <li class="breadcrumb-item active" aria-current="page">List</li> --}}
            @endforeach
            @endif
      
            </ol>
        </nav>
    </div>
            <div class="col-lg-6 col-5 text-right">
            {{-- <a href="#" class="btn btn-sm btn-neutral">Nouveau</a>
            <a href="#" class="btn btn-sm btn-neutral">Filtres</a> --}}
        </div>
    </div> 
        </div>
    </div>
</div>