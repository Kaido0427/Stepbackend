@extends('owner.app', ['title' => __('Parking Images')],['activePage' => 'parkingimages'])

@section('content')
     @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"Parking Images",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Parking Images'
],['text'=>'Add New'])))
  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{url('owner/parkingimages')}}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('parkingimages.store')}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="col-md-4">
                                    <label for="Image" class="col-form-label"> {{__('Image')}}</label>
                                    <div class="avatar-upload avatar-box avatar-box-left">
                                        <div class="avatar-edit">
                                            <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                            <label for="image"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview">
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="custom_error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                 @endif
                                
                                <div class="form-group">
                                    <label class="form-control-label" for="space">{{ __('Espace') }}</label>
                                    <select class="form-control form-control-alternative" name="space">
                                        @foreach ($spaces as $space)
                                        <option  class="form-control form-control-alternative" value="{{$space['id']}}" >{{$space['title']}}</option>
                                        @endforeach
                                    </select>   
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary rtl_btn mt-4">{{ __('Sauvegarder') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function preview_image() {
        var total_file = document.getElementById("upload_file").files.length;
        // if (total_file <= 3) {
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) +
                    "' height='100px' width='100px'>");
            }
        // } else {
        //     $('#image_preview').append("<p class='text-danger'>Please select Max 3 image<p>");
        //     location.reload();
        // }
    }
</script>