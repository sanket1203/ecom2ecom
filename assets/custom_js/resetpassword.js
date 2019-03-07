jQuery(document).ready(function () {
    
    var slider_form = $("#reset_password"),
            r = $(".alert-danger", slider_form),
            i = $(".alert-success", slider_form);
    slider_form.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            new_password: {
                required: "New password required",
                minlength: "Minimum five charcter required"
            },
            confirm_password: {
                required: "Confirm password required",
                minlength: "Minimum five charcter required"
            }
        },
        rules: {
            new_password: {
                required: !0,
                minlength: 5
            },
            confirm_password: {
                minlength: 5,
                required: !0,
                equalTo : '#new_password'
            }
        },
        invalidHandler: function (slider_form, t) {
            i.hide(), r.show(), App.scrollTo(r, -200)
        },
        highlight: function (slider_form) {
            $(slider_form).closest(".form-group").addClass("has-error")
        },
        unhighlight: function (slider_form) {
            $(slider_form).closest(".form-group").removeClass("has-error")
        },
        success: function (slider_form) {
            slider_form.closest(".form-group").removeClass("has-error")
        },
        submitHandler: function () {
            i.show(), r.hide()
            // submit data using ajax
            var formData = new FormData($("#reset_password")[0]);
                $('#reset_submit').addClass(' disabled');
                $('#reset_submit').attr('disabled', 'disabled');
                $.ajax({
                    url: BASEURL + 'WEB/adminlogin/resetpassword_process',
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {
                        var result_data = jQuery.parseJSON(data);
                        if (result_data.success)
                        {	
                            toastr.success('Your password created successfully', 'Success');
                        }
                        else
                        {
                            toastr.error('Something went wrong please try again later.', 'Error');
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
});