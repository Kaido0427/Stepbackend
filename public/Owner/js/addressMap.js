// Javascript Document

var lat,lng;
lat = parseFloat($('input[name="lat"]').val());
lng = parseFloat($('input[name="lang"]').val());

$(document).ready(function(){
    $('.address_btn').on('click', function()
    {
        var from = $(this).attr('data-from');
        if (from == 'new') {
            $('input[name=from]').val('add_new');
            lat = parseFloat($('#lat').val());
            lng = parseFloat($('#lng').val());
        } 
        else 
        {   
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: base_url + '/edit_user_address/'+$(this).attr('data-id'),
                success: function (result)
                {
                    $('input[name=from]').val('update');
                    $('input[name=address_id]').val(result.data.id);
                    $('input[name="lat"]').val(result.data.lat);
                    $('input[name="lang"]').val(result.data.lang);
                    $('select[name="type"]').val(result.data.type);
                    $('textarea[name=address]').val(result.data.address);
                    lat = parseFloat($('input[name="lat"]').val());
                    lng = parseFloat($('input[name="lang"]').val());
                    initAutocomplete();
                },
                error: function (err) {
                }
            });
        }
    });

});

function updateAddress(lat, lng, address){
    $('#loader').show();
    var type = $("#type").val();
    $.ajax({
        url:'/addmaplocation',
        type:'POST',
        data:{lat:lat,lng:lng,address:address,type:type},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success :function(data)
        {
            $("#staticBackdrop").modal('hide');
            location.reload();
            $('#loader').hide();
        }
    });
}

function userupdateAddress(lat, lng, address)
{
    var id = $("#addressId").val();
    var type = $("#type").val();

    $.ajax({
        url: $("#basepath").val()+'/updateaddress',
        type:'POST',
        data:{id:id,lat:lat,lng:lng,address:address,type:type},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success :function(data)
        {
            $("#staticBackdrop").modal('hide');
            location.reload();
            $('#loader').hide();
        }
    })
}

function openModelMapAddress(){
    $("#staticBackdrop").modal('show');
}


function deleteAddress(id)
{
    $('#loader').show();
    $.ajax({
        url: $("#basepath").val()+'/deleteaddress',
        type:'POST',
        data:{id:id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data)
        {
            location.reload();
            $('#loader').hide();
        }
    });
}
function initAutocomplete()
{
    if (lat != '' && lng != '' && lat != NaN && lng != NaN) 
    {
        if (document.getElementById("addMap")) {
            const map = new google.maps.Map(document.getElementById("addMap"), {
            center: { lat: lat, lng: lng },
                zoom: 13,
                mapTypeId: "roadmap",
            });
            
            const a = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: lng
                },
                map,
                draggable: true,
            });
            
            google.maps.event.addListener(a, 'dragend', function() {
                geocodePosition(a.getPosition());
                $('input[name="lat"]').val(a.getPosition().lat().toFixed(5));
                $('input[name="lang"]').val(a.getPosition().lng().toFixed(5));
            });
        }
    }
}

function geocodePosition(pos) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
    latLng: pos
    }, function(responses) {
    if (responses && responses.length > 0) {
        $('textarea[name=address]').val(responses[0].formatted_address);
    } else {
        $('textarea[name=address]').val('Cannot determine address at this location.');
    }
    });
}