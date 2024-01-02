$form = $(".require-validation");
var base_url = $('meta[name=base_url]').attr('content');
var duration,amount,subscription_id,currency;
var formData = new FormData();
$(document).ready(function () 
{
    currency = $('input[name=currency]').val();
    $('.purchase').click(function () {
        $('.paymentCard').toggle(500);
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
    
    $('input[name="paymentRadio"]').change(function () 
    {
        var rdBtn = $('input[name="radioBtn"]:checked').val();
        rdBtn = rdBtn.split("/");
        duration = rdBtn[0];
        amount = rdBtn[1];
        subscription_id = rdBtn[2];
        
        formData.append('duration',duration);
        formData.append('amount',amount);
        formData.append('subscription_id',subscription_id);
        if(this.value == 'stripe')
        {
            $('.stripeCard').show(500);
            $('.flutterwaveCard').hide(500);
            $('.razorCard').hide(500);
            $('.paypalCard').hide(500);
            StripePayment();
        }
        if(this.value == 'razorpay')
        {
            $('.razorCard').show(500);
            $('.stripeCard').hide(500);
            $('.flutterwaveCard').hide(500);
            $('.paypalCard').hide(500);
        }
        if(this.value == 'paypal')
        {
            $('.paypalCard').show(500);
            $('.razorCard').hide(500);
            $('.stripeCard').hide(500);
            $('.flutterwaveCard').hide(500);
            paypalPayment();
        }
        if(this.value == 'flutterwave')
        {
            $('.flutterwaveCard').show(500);
            $('.paypalCard').hide(500);
            $('.razorCard').hide(500);
            $('.stripeCard').hide(500);
        }
    });

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

function StripePayment() {
    $('.btn-submit').bind('click', function (e)
    {
        var rdBtn = $('input[name="radioBtn"]:checked').val();
        rdBtn = rdBtn.split("/");
        duration = rdBtn[0];
        amount = rdBtn[1];
        subscription_id = rdBtn[2];
        inputSelector = ['input[type=email]', 'input[type=password]','input[type=text]', 'input[type=file]','textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function (i, el) {
            var $input = $(el);
            if ($input.val() === '')
            {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        var month = $('.expiry-date').val().split('/')[0];
        var year = $('.expiry-date').val().split('/')[1];
        $('.card-expiry-month').val(month);
        $('.card-expiry-year').val(year);
    
        if (!$form.data('cc-on-file'))
        {
            e.preventDefault();
            Stripe.setPublishableKey($('input[name=stripe_publish_key]').val());
    
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });
}

function stripeResponseHandler(status, response)
{
    if (response.error) {
        $('.stripe_alert').show();
        $('.stripe_alert').text(response.error.message);
    }
    else
    {
        var token = response['id'];
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        formData.append('payment_token',token);
        formData.append('payment_type','STRIPE');
        subscription();
    }
}

function RazorPayPayment()
{
    var options =
    {
        key: $('input[name="razor_key"]').val(),
        amount: amount * 100,
        description: '',
        currency: currency,
        handler: demoSuccessHandler
    }
    window.r = new Razorpay(options);
    document.getElementById('paybtn').onclick = function ()
    {
        r.open();
    }
}

function padStart(str) {
    return ('0' + str).slice(-2)
}

function demoSuccessHandler(transaction)
{
    $("#paymentDetail").removeAttr('style');
    $('#paymentID').text(transaction.razorpay_payment_id);
    var paymentDate = new Date();
    $('#paymentDate').text(
        padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
    );
    formData.append('payment_token',transaction.razorpay_payment_id);
    formData.append('payment_type','RAZORPAY');
    subscription();
}

function subscription() 
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: base_url + '/owner/purchaseSubscription',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result)
        {
            if (result.success == true)
            {
                location.href=base_url+'/owner/dashboard';
            }
            else
            {
                alert('Oops,Something went wrong');
            }
        },
        error: function (err)
        {
            alert('Oops,Something went wrong');
        }
    });
}

function paypalPayment()
{
    if(currency != 'INR')
    {
        $('.paypal_row_body').html('');
        paypal_sdk.Buttons({
            createOrder: function (data, actions)
            {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount
                        }
                    }]
                });
            },
            onApprove: function (data, actions)
            {
                return actions.order.capture().then(function (details)
                {
                    formData.append('payment_token',details.id);
                    formData.append('payment_type','PAYPAL');
                    subscription();
                });
            }
        }).render('.paypal_row_body');
    }
    else
    {
        $('.paypal_row_body').html('INR currency not supported in Paypal');
    }
}

function makePayment()
{
    FlutterwaveCheckout({
      public_key: $('input[name=flutterwave_key]').val(),
      tx_ref: Math.floor(Math.random() * (1000 - 9999 + 1) ) + 9999,
      amount: amount,
      currency: currency,
      payment_options: " ",
      customer: {
        email: $('input[name=email]').val(),
        phone_number: $('input[name=phone]').val(),
        name: $('input[name=name]').val(),
      },
      callback: function (data)
      {
        if (data.status == 'successful')
        {
            console.log("data",data);
            formData.append('payment_token',data.transaction_id);
            formData.append('payment_type','FLUTTERWAVE');
            subscription();
        }
      },
      customizations: {
        title: $('input[name=name]').val(),
        description: "Subscription Payment",
      },
    });
}

function modelOpen()
{
   Swal.fire({
        title: 'Limit Reached!',
        text: "You've reached the maximum parking space limit.\nPlease upgrade your subscription plan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) =>
    {
        if (result.isConfirmed) {
            window.location.href = base_url + '/owner/subscription';
        }
    });
    
}