<script src="https://maps.googleapis.com/maps/api/js?key={{$adminsetting->map_key}}&libraries=places" type="text/javascript"></script>
@extends('owner.app', ['title' => __('Space')],['activePage' => 'spaces'])
@section('content')
   @include('owner.layouts.headers.header',
      array(
          'class'=>'info',
          'title'=>"SpaceZone",'description'=>'',
          'icon'=>'fas fa-home',
          'breadcrumb'=>array([
            'text'=>'Space'
],['text'=>'Edit Detail'])))
  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <a href="{{ route('spaces.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('spaces.update', $parkingSpace) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{$parkingSpace->id}}">

                            <div class="pl-lg-4">                               
                                <div class="form-group{{ $errors->has('spacename') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __(' Nom de l'espace') }}</label>
                                    <input type="text" name="spacename" id="input-name" class="form-control form-control-alternative{{ $errors->has('spacename') ? ' is-invalid' : '' }}" placeholder="{{ __('Space Name') }}" value="{{ old('spacename',$parkingSpace->title) }}"  autofocus required>

                                    @if ($errors->has('spacename'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('spacename') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Description') }}</label>
                                    <input type="text" name="description" id="input-name" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description',$parkingSpace->description) }}"  autofocus required>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Phone Number') }}</label>
                                    <input type="text" name="phone" id="input-name" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone Number') }}" value="{{ old('phone',$parkingSpace->phone_number) }}"  autofocus required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Prix (Par Heure)') }}</label>
                                    <input type="text" name="price" id="input-name" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price Per Hour') }}" value="{{ old('price',$parkingSpace->price_par_hour) }}"  autofocus required>

                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>

                              
                                <div class="form-group">
                                    <label class="form-control-label" for="input-status">{{ __('Installations') }}</label>
                                    <select multiple class="form-control form-control-alternative" id="exampleFormControlSelect2" name="facilites[]">
                                        @foreach ( $facilites  as $facility)
                                            @if(is_null($parkingSpace->facilities))
                                                <option value="{{$facility->id}}" >{{$facility->title}}</option>  
                                            @else
                                                <option value="{{$facility->id}}"  {{in_array($facility->id,$parkingSpace->facilities) ? 'selected' : '' }} >{{$facility->title}}</option>  
                                            @endif
                                        @endforeach
                                    </select>
                                  </div>

                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Addresse') }}</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Addresse') }}" value="{{ old('address',$parkingSpace->address) }}"  readonly autofocus required>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                    <div id="dvMap" style="height:350px; width: 100%;"  class="mt-2"></div>
                                </div>
                               
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Lat') }}</label>
                                        <input type="text" class="form-control form-control-alternative" name="lat" id="lat" value="{{ old('lat',$parkingSpace->lat) }}">
                                    </div>
                        
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Long') }}</label>
                                        <input type="text" class="form-control form-control-alternative" name="lng" id="lng" value="{{ old('lng',$parkingSpace->lng) }}">
                                    </div>


                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"  name="available" value = "1" {{$parkingSpace->available_all_day == 1 ? 'checked':'' }} role="switch" id="ss"  />
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ __('disponible 24 Heure')}}</label>
                                        <div class="d-flex" id="time">
                                            <div  class="col-4">
                                                <div class="form-group">
                                                    <label for="example-time-input" class="form-control-label">{{__('Heure d'ouverture')}}</label>
                                                    <input class="form-control" type="time"  id="example-time-input" name="open_time" value="{{$parkingSpace->open_time}}" >
                                                </div>
                                                 
                                            </div>
                                            <div></div>
                                            <div  class="col-4">
                                                <div class="form-group">
                                                    <label for="example-time-input" class="form-control-label">{{__('Heure de fermeture')}}</label>
                                                    <input class="form-control" type="time"  id="example-time-input" name="close_time"  value="{{$parkingSpace->close_time}}">
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-status">{{ __('Payement Hors ligne') }}</label>
                                    <select class="form-control form-control-alternative" name="offlinepayment">
                                        <option  class="form-control form-control-alternative" value="1"{{$parkingSpace->offline_payment==1?'selected':''}} >{{__('Oui')}}</option>
                                        <option  class="form-control form-control-alternative" value="0" {{$parkingSpace->offline_payment==0?'selected':''}}>{{__('Non')}}</option>
                                    </select>   
                                </div>   
                                <div class="form-group">
                                    <label class="form-control-label" for="input-status">{{ __('Statut') }}</label>
                                    <select class="form-control form-control-alternative" name="status">
                                        <option  class="form-control form-control-alternative" value="1" {{$parkingSpace->status==1?'selected':''}}>{{ __('Activé')}}</option>
                                        <option  class="form-control form-control-alternative" value="0" {{$parkingSpace->status==0?'selected':''}}>{{ __('DésActivé')}}</option>
                                    </select>   
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Sauvegarder') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var markers = [
        {
            "title": '{{$parkingSpace->title}}',
            "lat": '{{$parkingSpace->lat}}',
            "lng": '{{$parkingSpace->lng}}',
            "description": '{{$parkingSpace->description}}'
        }
    ];
    
    window.onload = function () {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var geocoder = geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title,
                draggable: false,
                animation: google.maps.Animation.DROP
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.description);
                    infoWindow.open(map, marker);
                });
                google.maps.event.addListener(marker, "dragend", function (e) {
                    var lat, lng, address;
                    geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                          var lat = marker.getPosition().lat().toFixed(4);
                          var lng = marker.getPosition().lng().toFixed(4);
                            address = results[0].formatted_address;
                            $('#lat').val(lat);
                            $('#lng').val(lng);
                            $("#address").val(address);
                            // alert("Latitude: " + lat + "\nLongitude: " + lng + "\nAddress: " + address);
                        }
                    });
                });
            })(marker, data);
            latlngbounds.extend(marker.position);
        }
        var bounds = new google.maps.LatLngBounds();
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
    }
    </script>  
@endsection
<script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>    
<script type="text/javascript">
    $(document).ready(function(){
            $(document).on('change','#ss',function(){
                if($(this).is(':checked')) 
                {     
                    $('#time').addClass('d-none');
                    $('#time').removeClass('d-flex');    
                }    
                else
                {
                    $('#time').removeClass('d-none');
                    $('#time').addClass('d-flex'); 
                }  
            });
    });
</script>  