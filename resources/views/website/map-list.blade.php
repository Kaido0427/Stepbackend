@extends('website.layout.app', ['activePage' => 'map-list'])
@section('content')
<div class="mt-10 mb-10 xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
    <div class="flex lg:flex-row s:flex-col gap-5">
        <div class="map-responsive">
            <!-- <iframe src="https://maps.google.com/maps?q=california&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=&amp;output=embed" style="border:0" loading="lazy" class="rounded-[8px] xxxxl:w-[650px] xxxxl:h-[770px] s:w-full s:h-96 lg:w-[500px] lg:h-[700px] xl:w-[650px] xxl:w-[700px]"></iframe> -->

            <div id="mymap" style="width: 800px; height: 800px;"></div>
        </div>
        <div>
            
            @foreach($parkingspace as $key => $item)
            
            <div class="bg-white xxxxl:w-[630px] rounded-[8px] shadow p-4 xl:w-[580px] xxl:w-[620px] mb-5">
                <div class="flex justify-between xxxxl:flex-row s:flex-col xl:flex-row">
                    <div class="xxxxl:w-[350px] xxxxl:mb-0 s:mb-10 xl:w-[340px] xxl:w-[340px]">
                        <h5 class="font-poppins font-medium text-[#404F65] text-xl mb-4">{{$item->title}}</h5>
                        @if(isset($item->rating))
                        <h6 class="flex gap-2 font-poppins font-normal text-[#8896AB] text-base mb-4"><img src="{{asset('website/icon/star.svg')}}" alt="">{{$item->rating}}</h6>
                        @else
                        <h6 class="flex gap-2 font-poppins font-normal text-[#8896AB] text-base mb-4">{{__('Aucun avis')}}</h6>
                        @endif

                        <div class="flex gap-2">
                            <img src="{{asset('website/icon/location.svg')}}" alt="" class="w-5 h-5 mt-1">
                            <p class="font-poppins font-normal text-gray text-lg">{{$item->address}}</p>
                        </div>
                    </div>
                    <div class="xl:self-end">
                        <h4 class="font-poppins font-medium text-gray text-2xl mb-4">{{$adminsetting->currency_symbol}} {{$item->price_par_hour}} <span class="font-poppins font-normal text-[#8896AB] text-base">{{__('/hr')}}</span></h4>
                        @if(Auth::guard('appuser')->check())
                        <a href="{{url('/parking_space/'.$item->id)}}"><button class="border border-primary w-36 h-12 font-poppins font-medium text-base text-primary rounded-[6px]">{{__('Reservé')}}</button></a>
                        @else
                        <button class="border border-primary w-36 h-12 font-poppins font-medium text-base text-primary rounded-[6px]" type="button" data-modal-target="SignIn" data-modal-toggle="SignIn">{{__('Reservé')}}</button>
                        @endif
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
</div>
<script>
    // function initMap() {
    //     var locations = {
    //         !!json_encode($parkingspace) !!
    //     };
    //     var map = new google.maps.Map(document.getElementById('mymap'), {
    //         center: {
    //             lat: locations[0].lat,
    //             lng: locations[0].lng
    //         },
    //         zoom: 13
    //     });
    //     for (var i = 0; i < locations.length; i++) {
    //         var marker = new google.maps.Marker({
    //             position: {
    //                 lat: locations[i].lat,
    //                 lng: locations[i].lng
    //             },
    //             map: map
    //         });
    //     }
    // }

    var markers = [];

    @foreach($parkingspace as $item)
    var markerData = {
        "title": '{{ $item->title }}',
        "lat": '{{ $item->lat }}',
        "lng": '{{ $item->lng }}',
        "description": '{{ $item->description }}'
    };
    markers.push(markerData);
    @endforeach

    window.onload = function() {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var geocoder = geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById("mymap"), mapOptions);
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
            (function(marker, data) {
                google.maps.event.addListener(marker, "click", function(e) {
                    infoWindow.setContent(data.title);
                    infoWindow.open(map, marker);
                });
                google.maps.event.addListener(marker, "dragend", function(e) {
                    var lat, lng, address;
                    geocoder.geocode({
                        'latLng': marker.getPosition()
                    }, function(results, status) {
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
    };
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$adminsetting->map_key}}&callback=initMap"></script>

@endsection