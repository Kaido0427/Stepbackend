@extends('owner.app', ['title' => __('Parking Image')],['activePage' => 'parkingimages'])

@section('content')
   @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"ParkingImage",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'ParkingImage'
],['text'=>'Edit Detail'])))
  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('parkingimages.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('parkingimages.update', $parkingimage) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{$parkingimage->id}}">
                            <div class="pl-lg-4">
                                <div class="col-md-4">
                                    <label for="Image" class="col-form-label"> {{__('Image')}}</label>
                                    <div class="avatar-upload avatar-box avatar-box-left">
                                        <div class="avatar-edit">
                                            <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                            <label for="image"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{ asset('upload')}}/{{$parkingimage->image }})">
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="custom_error">
                                            {{ $message }}
                                        </div>
                                    @enderror
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