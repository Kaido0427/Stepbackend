//login
const signintogglePassword = document.querySelector('#signintogglePassword');
const loginpasswords = document.querySelector('#loginpasswords');
signintogglePassword.addEventListener('click', function (e) {
    const type = loginpasswords.getAttribute('type') === 'password' ? 'text' : 'password';
    loginpasswords.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

//Signup
const togglePassword = document.querySelector('#signUptogglePassword');
const password = document.querySelector('#passwords');
togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

const signuptoggleCPassword = document.querySelector('#signuptoggleCPassword');
const confirmpassword = document.querySelector('#confirmpassword');
signuptoggleCPassword.addEventListener('click', function (e) {
    const type = confirmpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmpassword.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

//Changepassword
const oldtogglePasswords = document.querySelector('#oldtogglePasswords');
const oldpassword = document.querySelector('#oldpassword');
oldtogglePasswords.addEventListener('click', function (e) {
    const type = oldpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    oldpassword.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

const newpassword = document.querySelector('#newpassword');
const npassword = document.querySelector('#npassword');
newpassword.addEventListener('click', function (e) {
    const type = npassword.getAttribute('type') === 'password' ? 'text' : 'password';
    npassword.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

const confirmPassword = document.querySelector('#confirmPassword');
const cpassword = document.querySelector('#cpassword');
confirmPassword.addEventListener('click', function (e) {
    const type = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    cpassword.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

//sign In 
"use strict";
var emailData;
function signIn() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user_login',
        data: {
            email: $('input[name="loginEmail"]').val(),
            password: $('input[name="loginPassword"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        dataType: 'json',
        success: function (data) {
            if (data.success == true) {
                window.location = data.redirect_location;
                $("#success_msg").html(data.message);
                document.getElementById('loader').style.display = 'none';
            } else if (data.success == false) {
                if (data.message) {
                    $("#errors-list").html(data.message);
                    document.getElementById('loader').style.display = 'none';
                }
                if (data.email) {
                    emailData = data.email;
                    $('#EmailVerification').show();
                    $('#SignIn').toggle();
                    $('.email').text(data.email);
                    document.getElementById('loader').style.display = 'none';
                }
            }
        },
        error: function (data) {
            document.getElementById('loader').style.display = 'none';
            $('.email').text(data.responseJSON.email);
            $('.password').text(data.responseJSON.password);
        }
    });
};


//verify login
"use strict";
function verifyLogin() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    base_url = '/user_verify';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url,
        data: {
            otp: $('input[name="otp"]').val(),
            email: emailData,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        success: function (data) {
            if (data.success == true) {
                window.location = data.redirect_location;
                document.getElementById('loader').style.display = 'none';
            }
            if (data.success == false) {
                $("#verify-list").html(data.message);
                document.getElementById('loader').style.display = 'none';

            }
        },
        error: function (data) {
            $('.otp').text(data.responseJSON.otp);
            document.getElementById('loader').style.display = 'none';
        }
    });
}

//OTP mail resend
function resendMail() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/resend_mail',
        data: {
            email: emailData,
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        type: "POST",
        dataType: 'json',
        success: function (data) {
            if (data.success == true) {
                $("#verify-list").html(data.message);
                document.getElementById('loader').style.display = 'none';
                // window.location = data.redirect_location;
            } else if (data.success == false) {
                $("#verify-list").html(data.message);
                document.getElementById('loader').style.display = 'none';
            }
        },
    });
}

//sign up form
"use strict";
function signUp() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $base_url = '/user_register';

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $base_url,
        data: {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val(),
            confirmpassword: $('input[name="confirmpassword"]').val()
        },
        type: "POST",
        success: function (data) {
            $("#success_msg").html(data.message);
            $('#SignUp').toggle();
            $('[data-modal-hide]').click();
            document.getElementById('loader').style.display = 'none';

        },
        error: function (data) {
            document.getElementById('loader').style.display = 'none';
            $('.name').text(data.responseJSON.name);
            $('.email').text(data.responseJSON.email);
            $('.password').text(data.responseJSON.password);
            $('.confirmpassword').text(data.responseJSON.confirmpassword);

        }
    });
};

//Forgot Password
"use strict";
function sendMail() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $base_url = '/forgotpassword';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $base_url,
        data: {
            email: $('input[name="fpemail"]').val(),
        },
        type: "POST",
        success: function (data) {
            if (data.success) {
                window.location = data.redirect_location;
                document.getElementById('loader').style.display = 'none';

            }
            if (data.success == false) {
                $("#fp-list").html(data.message);

            }
        },
        error: function (data) {
            $('.fpemail').text(data.responseJSON.email);
            document.getElementById('loader').style.display = 'none';

        }
    });
};


//change password

"use strict";
function changePassword() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $base_url = '/user_change_password';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $base_url,
        data: {
            currentpassword: $('input[name="old_password"]').val(),
            password: $('input[name="npassword"]').val(),
            confirmpassword: $('input[name="confirm_password"]').val()
        },
        type: "POST",
        dataType: 'json',
        success: function (data) {
            if (data.success == true) {
                $("#success_msg").html(data.message);
                $('#change-password').toggle();
                $('[data-modal-hide]').click();
                document.getElementById('loader').style.display = 'none';
            }
            if (data.success == false) {
                $("#notmatch-error").html(data.message);
                document.getElementById('loader').style.display = 'none';
            }
        },
        error: function (data) {
            $('.currentpassword').text(data.responseJSON.currentpassword);
            $('.password').text(data.responseJSON.password);
            $('.confirmpassword').text(data.responseJSON.confirmpassword);
            document.getElementById('loader').style.display = 'none';
        }
    });
};

//Profile Update
"use strict";
function profileUpdate() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    base_url = '/update_user_profile';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        enctype: 'multipart/form-data',
        url: base_url,
        type: "POST",
        data: {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            phone: $('input[name="number"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $("#success_msg").html(data.message);
            $('#EditProfile').toggle();
            $('[data-modal-hide]').click();
            setTimeout(function () {
                location.reload();
            }, 2000);
            document.getElementById('loader').style.display = 'none';
        },
        error: function (data) {
            $('.phone').text(data.responseJSON.phone);
            document.getElementById('loader').style.display = 'none';
        }
    });

};

//preview Image
function readURL(input) {
    $base_url = '/update_user_profileimage';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#upload')
                .attr('src', e.target.result);
        };
        demofunction();
        reader.readAsDataURL(input.files[0]);

    }
}

//Profile image Update
"use strict";
function demofunction(params) {
    $base_url = '/update_user_profileimage';
    var file = $('#imgUpload')[0].files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        var imageData = reader.result.split(',')[1];
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $base_url,
            data: {
                image: imageData
            },
            success: function (response) {
                console.log(response);
            }
        });
    }

}

//Add Vehicle
"use strict";
function addVehicle() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $base_url = '/user_vehicle_store';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $base_url,
        data: {
            user_id: $('input[name="user_id"]').val(),
            brand: $('input[name="brand"]').val(),
            model: $('input[name="model"]').val(),
            vehicle_no: $('input[name="vehicle_no"]').val(),
            vehicle_type_id: $('input[name="vehicle_type_id"]:checked').val()
        },
        type: "POST",
        success: function (data) {
            $("#success_msg").html(data.message);
            $('#AddVehicle').toggle();
            $('[data-modal-hide]').click();
            setTimeout(function () {
                location.reload();
            }, 2000);
            document.getElementById('loader').style.display = 'none';

        },
        error: function (data) {
            $('.brand').text(data.responseJSON.brand);
            $('.model').text(data.responseJSON.model);
            $('.vehicle_no').text(data.responseJSON.vehicle_no);
            $('.vehicle_type_id').text(data.responseJSON.vehicle_type_id);
            document.getElementById('loader').style.display = 'none';
        }
    });
}


// Edit Vehicle
"use strict";
function edit(id) {
    $('#editModal-' + id).toggle();
}

// Update Vehicle
"use strict";
function vehicleUpdate(id) {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $base_url = '/user_vehicle_update/' + id;
    var brand = $('#brand_' + id).val();
    var model = $('#model_' + id).val();
    var vehicle_no = $('#vehicle_no_' + id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $base_url,
        data: {
            id: id,
            brand: brand,
            model: model,
            vehicle_no: vehicle_no,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        success: function (data) {
            if (data.success) {
                document.getElementById('loader').style.display = 'none';
                $("#success_msg").html(data.message);
                $('#editModal-' + id).toggle();
                $('[data-modal-hide]').click();
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
            if (data.success == false) {
                $("#errors-list").html(data.message);
                document.getElementById('loader').style.display = 'none';
            } else {
                $.each(data.errors, function (key, val) {
                    $("#errors-list").append("<div class='alert alert-danger'>" + errstr + "</div>");
                });
            }
        }
    });
}

// Delete Vehicle
"use strict";
function deleteVehicle(id) {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    $base_url = '/user_vehicle_destroy/' + id,
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $base_url,
            type: 'POST',
            data: {
                id: id,
            },
            success: function (data) {
                if (data.success) {
                    $("#success_msg").html(data.message);
                    $('#DeleteVehicle').toggle();
                    $('[data-modal-hide]').click();
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                    document.getElementById('loader').style.display = 'none';
                }
                if (data.success == false) {
                    $("#errors-list").html(data.message);
                    document.getElementById('loader').style.display = 'none';

                } else {
                    document.getElementById('loader').style.display = 'none';
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + errstr + "</div>");
                    });
                }
            }
        });

}


//Delete Account
"use strict";
function deleteAccount() {
    $base_url = '/delete_account/',
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $base_url,
            type: 'POST',
            data: {
                accountPassword: $('input[name="accountPassword"]').val(),
            },
            success: function (data) {
                if (data.success == true) {
                    window.location = data.redirect_location;
                } else if (data.success == false) {
                    if (data.message) {
                        $("#delete-list").html(data.message);
                    }
                    if (data.data) {
                        console.log('here');
                        $('#NotDeleteAccount').show();
                        $('#DeleteAccount').hide();
                    }

                } else {
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + errstr + "</div>");
                    });
                }
            }

        });
}

$form = $(".require-validation");
var base_url = $('meta[name=base_url]').attr('content');
var duration, amount, currency;
var formData = new FormData();

function parkingbooking(formData) {
    var base_url = '/billing';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.success == true) {
                window.location = data.redirect_location;
                $("#booking_msg").html(data.message);
            }
        },
        error: function (xhr, status, error) {

        }
    });
}


function RazorPayPayment() {
    var $payBtn = $('#paybtn');
    var total = $payBtn.data('total');
    var options = {
        key: $('input[name="razorpay_key"]').val(),
        amount: total * 100,
        description: '',
        currency: currency,
        handler: demoSuccessHandler
    }
    window.r = new Razorpay(options);
    r.open();
}

function padStart(str) {
    return ('0' + str).slice(-2)
}

function demoSuccessHandler(transaction) {

    var total = parseFloat(transaction.amount) / 100;
    var $payBtn = $('#paybtn');
    var requestData = {
        payment_token: transaction.razorpay_payment_id,
        payment_type: 'RAZORPAY',
        payment_status: 1,
        total_amount: $payBtn.data('total'),
        arriving_time: $('input[name="arriving_time"]').val(),
        leaving_time: $('input[name="leaving_time"]').val(),
        owner_id: $('input[name="owner_id"]').val(),
        space_id: $('input[name="space_id"]').val(),
        user_id: $('input[name="user_id"]').val(),
        vehicle_id: $('input[name="vehicle_id"]').val(),
        slot_id: $('input[name="slot_id"]').val()
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/billing',
        type: 'POST',
        data: requestData,
        success: function (data) {
            if (data.success == true) {
                window.location = data.redirect_location;
                $("#booking_msg").html(data.message);
                document.getElementById('loader').style.display = 'none';
            }
        },
        error: function (xhr, status, error) {

        }
    });
}

function paypalPayment() {
    var $payBtn = $('#paybtn');
    var total = $payBtn.data('total');

    if (currency != 'INR') {
        $('.paypal_row_body').html('');
        paypal_sdk.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: total
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    var requestData = {
                        total_amount: total,
                        arriving_time: $('input[name="arriving_time"]').val(),
                        leaving_time: $('input[name="leaving_time"]').val(),
                        owner_id: $('input[name="owner_id"]').val(),
                        space_id: $('input[name="space_id"]').val(),
                        user_id: $('input[name="user_id"]').val(),
                        vehicle_id: $('input[name="vehicle_id"]').val(),
                        slot_id: $('input[name="slot_id"]').val(),
                        payment_token: details.id,
                        payment_type: 'PAYPAL',
                        payment_status: 1
                    };

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/billing',
                        type: 'POST',
                        data: requestData,
                        success: function (data) {
                            if (data.success == true) {
                                window.location = data.redirect_location;
                                $("#booking_msg").html(data.message);
                                document.getElementById('loader').style.display = 'none';
                            }
                        },
                        error: function (xhr, status, error) {

                        }
                    });
                });
            }
        }).render('.paypal_row_body');
    } else {
        $('.paypal_row_body').html('INR currency not supported in Paypal');
    }
}


function StripePayment() {
    var stripe = Stripe($('input[name=stripe_publish_key]').val());
    var elements = stripe.elements();
    var cardNumber = elements.create('cardNumber', {
        classes: {
            base: 'card-number required form-control border border-[#D5DAE1] rounded-lg p-3 w-full mt-3'
        }
    });
    var cardExpiry = elements.create('cardExpiry', {
        classes: {
            base: 'card-expiry required form-control border border-[#D5DAE1] rounded-lg p-3 w-full mt-3'
        }
    });
    var cardCvc = elements.create('cardCvc', {
        classes: {
            base: 'card-cvc required form-control border border-[#D5DAE1] rounded-lg p-3 w-full mt-3'
        }
    });

    console.log(cardCvc);
    cardNumber.mount('#card-number');
    cardExpiry.mount('#card-expiry');
    cardCvc.mount('#card-cvc');

    $('.btn-submit').bind('click', function (e) {
        e.preventDefault();
        var amount = parseFloat($('input[name=total_amount]').val());
        stripe.createToken(cardNumber).then(function (result) {
            stripeResponseHandler(result, $form, amount);
        });
    });
}

function stripeResponseHandler(result, $form, amount) {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    var token = result.token;
    if (result.error) {
        $('.stripe_alert').show();
        $('.stripe_alert').text(result.error.message);

    } else {
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token.id + "'/>");

        var requestData = {
            total_amount: amount,
            payment_token: token.id,
            payment_type: 'STRIPE',
            payment_status: 1,
            arriving_time: $('input[name="arriving_time"]').val(),
            leaving_time: $('input[name="leaving_time"]').val(),
            owner_id: $('input[name="owner_id"]').val(),
            space_id: $('input[name="space_id"]').val(),
            user_id: $('input[name="user_id"]').val(),
            vehicle_id: $('input[name="vehicle_id"]').val(),
            slot_id: $('input[name="slot_id"]').val()
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/billing',
            type: 'POST',
            data: requestData,
            success: function (data) {
                if (data.success == true) {
                    window.location = data.redirect_location;
                    $("#booking_msg").html(data.message);
                    document.getElementById('loader').style.display = 'none';
                }
            },
            error: function (xhr, status, error) {
                // Error handling code...
            }
        });
    }
}


function makePayment() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader').style.display = 'flex';
    var $payBtn = $('#paybtn');
    var total = $payBtn.data('total');
    var currency = $('input[name=currency]').val();
    FlutterwaveCheckout({
        public_key: $('input[name=flutterwave_key]').val(),
        tx_ref: Math.floor(Math.random() * (1000 - 9999 + 1)) + 9999,
        amount: total,
        currency: currency,
        payment_options: " ",
        customer: {
            email: $('input[name=email]').val(),
            phone_number: $('input[name=phone_no]').val(),
            name: $('input[name=name]').val(),
        },

        callback: function (data) {
            if (data.status == 'successful') {
                var requestData = {
                    total_amount: total,
                    arriving_time: $('input[name="arriving_time"]').val(),
                    leaving_time: $('input[name="leaving_time"]').val(),
                    owner_id: $('input[name="owner_id"]').val(),
                    space_id: $('input[name="space_id"]').val(),
                    user_id: $('input[name="user_id"]').val(),
                    vehicle_id: $('input[name="vehicle_id"]').val(),
                    slot_id: $('input[name="slot_id"]').val(),
                    payment_token: data.transaction_id,
                    payment_type: 'FLUTTERWAVE',
                    payment_status: 1
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/billing',
                    type: 'POST',
                    data: requestData,
                    success: function (data) {
                        document.getElementById('loader').style.display = 'none';
                        $("#success_msg").html(data.message);
                    },
                    error: function (xhr, status, error) {

                    }
                });
            }
        },
        customizations: {
            title: $('input[name=name]').val(),
            description: "step Payment",
        },
    });
}


function activeClass(id) {
    $("#active_tab").val(id);
    $(".dynamic").html("");
}

function setRating(star) {
    document.getElementById('star').value = star;

    for (let i = 1; i <= 5; i++) {
        const starElement = document.getElementById('star-' + i);

        if (i <= star) {
            starElement.classList.add('text-[#F59E0B]');
            starElement.classList.remove('text-[#D5DAE1]');
        } else {
            starElement.classList.remove('text-[#F59E0B]');
            starElement.classList.add('text-[#D5DAE1]');
        }
    }
}

function toggleModals() {
    var signInModal = document.getElementById('SignIn');
    var signUpModal = document.getElementById('SignUp');

    signInModal.classList.remove('hidden'); // Show SignIn modal
    signUpModal.classList.add('hidden'); // Hide SignUp modal
}