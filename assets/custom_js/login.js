var Login = function () {

    var handleLogin = function () {
        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    //email: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },
            messages: {
                email: {
                    required: "Username is required."
                },
                password: {
                    required: "Password is required."
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },
            submitHandler: function (form) {
                // submit data using ajax
                var formData = new FormData($(".login-form")[0]);
                    $.ajax({
                        url: BASEURL + 'WEB/adminlogin/login_check',
                        type: 'POST',
                        data: formData,
                        async: false,
                        success: function (data) {
                            var result_data = jQuery.parseJSON(data);
                            if (result_data.success)
                            {	
                                window.location = BASEURL+'dashboard';
                            }
                            else
                            {
                                toastr.error('Invalid username or password. Please try again', 'Error');
                                return false;
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                // submit data using ajax end
            }
        });

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    // submit data using ajax 
                    var formData = new FormData($(".login-form")[0]);
                    $.ajax({
                        url: BASEURL + 'WEB/adminlogin/login_check',
                        type: 'POST',
                        data: formData,
                        async: false,
                        success: function (data) {
                            var result_data = jQuery.parseJSON(data);
                            if (result_data.success)
                            {	
                                window.location = BASEURL + 'dashboard';
                            }
                            else
                            {
                                toastr.error('Invalid email or password. Please try again', 'Error');
                                return false;
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                    // submit data using ajax end
                }
                return false;
            }
        });
    }

    var handleForgetPassword = function () {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Email is required.",
                    email: "Enter valid email"
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   

            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },
            submitHandler: function (form) {
                // submit data using ajax 
                 $('#forget_submit').addClass(' disabled');
                 $('#forget_submit').attr('disabled', 'disabled');
                var formData = new FormData($(".forget-form")[0]);
                    $.ajax({
                        url: BASEURL + 'WEB/adminlogin/forget_password',
                        type: 'POST',
                        data: formData,
                        async: true,
                        success: function (data) {
                            var result_data = jQuery.parseJSON(data);
                            if (result_data.success)
                            {	
                                $('.forget-form')[0].reset();
                                toastr.success('Please check your email for password information', 'Success');
                            }
                            else
                            {
                                $('#forget_submit').removeClass(' disabled');
                                $('#forget_submit').prop("disabled", false);
                                toastr.error('This email is not registered with us.', 'Error');
                                return false;
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                // submit data using ajax end
            }
        });

        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                // submit data using ajax
                $('#forget_submit').addClass(' disabled');
                $('#forget_submit').attr('disabled', 'disabled');
                var formData = new FormData($(".forget-form")[0]);
                    $.ajax({
                        url: BASEURL + 'WEB/adminlogin/forget_password',
                        type: 'POST',
                        data: formData,
                        async: true,
                        success: function (data) {
                            var result_data = jQuery.parseJSON(data);
                            if (result_data.success)
                            {	
                                $('.forget-form')[0].reset();
                                toastr.success('Please check your email for password information', 'Success');
                            }
                            else
                            {
                                $('#forget_submit').removeClass(' disabled');
                                $('#forget_submit').prop("disabled", false);
                                toastr.error('This email is not registered with us.', 'Error');
                                return false;
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                    // submit data using ajax end
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function () {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function () {

        function format(state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<span><img src="../assets/global/img/flags/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
                );

            return $state;
        }

        if (jQuery().select2 && $('#country_list').size() > 0) {
            $("#country_list").select2({
                placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
                templateResult: format,
                templateSelection: format,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });


            $('#country_list').change(function () {
                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }


        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                fullname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                country: {
                    required: true
                },
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                rpassword: {
                    equalTo: "#register_password"
                },
                tnc: {
                    required: true
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                tnc: {
                    required: "Please accept TNC first."
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   

            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $('.register-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                }
                return false;
            }
        });

        jQuery('#register-btn').click(function () {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleLogin();
            handleForgetPassword();
            handleRegister();
        }
    };

}();

jQuery(document).ready(function () {
    Login.init();
    $('input:first').focus();
});