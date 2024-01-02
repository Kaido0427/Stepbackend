$form = $(".require-validation");
var base_url = document.querySelector("meta[name='base_url']").getAttribute("content");
var duration,amount,subscription_id;
$(document).ready(function () 
{
    $('.select2').select2();

    $('#textEditor').summernote({
        height: 500,
    });

     // image upload
     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var type = $('#imagePreview').attr('data-id');
                var fileName = document.getElementById("image").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png")
                {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                else
                {
                    $('input[type=file]').val('');
                    alert("Only jpg/jpeg and png files are allowed!");
                    if(type == 'add')
                    {
                        $('#imagePreview').css('background-image', 'url()');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        readURL(this);
    });

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var type = $('#imagePreview1').attr('data-id');
                var fileName = document.getElementById("image1").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png")
                {
                    $('#imagePreview1').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview1').hide();
                    $('#imagePreview1').fadeIn(650);
                }
                else
                {
                    $('input[type=file]').val('');
                    alert("Only jpg/jpeg and png files are allowed!");
                    if(type == 'add')
                    {
                        $('#imagePreview1').css('background-image', 'url()');
                        $('#imagePreview1').hide();
                        $('#imagePreview1').fadeIn(650);
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image1").change(function () {
        readURL1(this);
    });

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var type = $('#imagePreview2').attr('data-id');
                var fileName = document.getElementById("image2").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png")
                {
                    $('#imagePreview2').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview2').hide();
                    $('#imagePreview2').fadeIn(650);
                }
                else
                {
                    $('input[type=file]').val('');
                    alert("Only jpg/jpeg and png files are allowed!");
                    if(type == 'add')
                    {
                        $('#imagePreview2').css('background-image', 'url()');
                        $('#imagePreview2').hide();
                        $('#imagePreview2').fadeIn(650);
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image2").change(function () {
        readURL2(this);
    });

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var type = $('#imagePreview3').attr('data-id');
                var fileName = document.getElementById("image3").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png")
                {
                    $('#imagePreview3').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview3').hide();
                    $('#imagePreview3').fadeIn(650);
                }
                else
                {
                    $('input[type=file]').val('');
                    alert("Only jpg/jpeg and png files are allowed!");
                    if(type == 'add')
                    {
                        $('#imagePreview3').css('background-image', 'url()');
                        $('#imagePreview3').hide();
                        $('#imagePreview3').fadeIn(650);
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image3").change(function () {
        readURL3(this);
    });
    // Image over

    // datatable start
    var datatable = $('.datatable').DataTable({
        "buttons": [
            'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ],
        language: {
            paginate:
            {
                previous: "<i class='fa fa-angle-left'>",
                next: "<i class='fa fa-angle-right'>",
                first: "<i class='fa fa-angle-double-left'>",
                last: "<i class='fa fa-angle-double-right'>",
            }
        },
        pagingType: "full_numbers",
    });
    $('#export_print').on('click', function(e) {
        e.preventDefault();
        datatable.button(0).trigger();
    });

    $('#export_copy').on('click', function(e) {
        e.preventDefault();
        datatable.button(1).trigger();
    });

    $('#export_excel').on('click', function(e) {
        e.preventDefault();
        datatable.button(2).trigger();
    });

    $('#export_csv').on('click', function(e) {
        e.preventDefault();
        datatable.button(3).trigger();
    });

    $('#export_pdf').on('click', function(e) {
        e.preventDefault();
        datatable.button(4).trigger();
    });
    // datatable over
});

// Notification template
function edit_template(id)
{
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/edit_notification'+'/'+id,
        success: function (result)
        {
            if(result.success == true)
            {
                $('#subject').val(result.data.subject);
                $('#title').val(result.data.title);
                $('h5').text(result.data.title);
                $('#msg_content').val(result.data.msg_content);
                $('#mail_content').summernote('code', result.data.mail_content);
                $('.update_template').attr("action",base_url+"/update_template/"+result.data.id);
            }
        },
        error: function (err) {

        }
    });
}



