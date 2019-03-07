jQuery(document).ready(function () {
    // image crope code
    var original = $(".img-responsive").attr('src');
    $('#avatar').on('change', function () {

        $('#div1').css('display', 'none');
        $('#done').css('display', 'none');
        $('#theImg').attr('src', '');
        $(".img-preview > img").attr('src', original);
        $(".img-preview > img").css('height', '200px');
        $(".img-preview > img").css('width', '200px');
        $(".img-preview > img").css('margin-left', '0px');
        $(".img-preview > img").css('margin-top', '0px');
        $(".img-preview > img").css('background-color', 'white');
        var input = $(this)[0];
        var file = input.files[0];
        var reader = new FileReader();
        reader.onload = function (e)
        {
            $('#myModal').modal('show');
            $("#theImg").remove();
            $(".cropper-container").remove();
            $('#div1').append('<img id="theImg" src="' + e.target.result + '" class="cropper" />');
            var img = document.getElementById('theImg');
            var width = img.clientWidth;
            var height = img.clientHeight;
            $('.img-preview').css('display', 'block');
            $('#div1').css('display', 'block');
            $('#done').css('display', 'inline');
            $(".cropper").cropper({
                aspectRatio: 1 / 1,
                zoomable: false,
                strict: true,
                guides: false,
                highlight: false,
                dragCrop: false,
                resizable: false,
                minCropBoxWidth: 200,
                minCropBoxHeight: 200,
                dragMode: false,
                preview: ".img-preview",
                crop: function (data) {
                    $("#x1").val(data.x);
                    $("#x2").val(data.x);
                    $("#y1").val(data.y);
                    $("#y2").val(data.y);
                    $("#h").val(data.height);
                    $("#w").val(data.width);
                    $("#theImg").on("dragend.cropper", function ()
                    {
                        height_temp = $("#h").val();
                        if (height_temp < 200)
                        {
                            $("#theImg").cropper("setData", {width: 200, height: 200})
                        }
                    });
                },
                built: function () {
                    $('.cropper').cropper('setCropBoxData', {
                        width: 200,
                        height: 200
                    });
                }
            });
        }
        reader.readAsDataURL(file);
    });
    $('#done').click(function () {
        $('#myModal').modal('hide');

    });
    

    /*
     * Purpose  : admin profile update form validation and ajax upload     
     */
    var edit_admin = $("#edit_admin_profile"),
            r = $(".alert-danger", edit_admin),
            i = $(".alert-success", edit_admin);

    edit_admin.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            first_name: {
                required: "First name required"
            },
            email: {
                required: "Email required",
                email: "Please enter valid email"
            },
            last_name: {
                required: "Last name required"
            },
            image: {
                accept: "Only jpg,jpeg,png allowed"
            }
        },
        rules: {
            first_name: {
                minlength: 5,
                maxlength: 30,
                required: !0,
                alphanumeric: true
            },
            email: {
                required: !0,
                email: true
            },
            last_name: {
                minlength: 5,
                maxlength: 30,
                required: !0,
                alphanumeric: true
            },
            image: {
                accept: "image/jpg,image/jpeg,image/png",
            }
        },
        errorPlacement: function (edit_admin, r) {
            r.parent(".input-group").size() > 0 ? edit_admin.insertAfter(r.parent(".input-group")) : r.attr("data-error-container") ? edit_admin.appendTo(r.attr("data-error-container")) : r.parents(".radio-list").size() > 0 ? edit_admin.appendTo(r.parents(".radio-list").attr("data-error-container")) : r.parents(".radio-inline").size() > 0 ? edit_admin.appendTo(r.parents(".radio-inline").attr("data-error-container")) : r.parents(".checkbox-list").size() > 0 ? edit_admin.appendTo(r.parents(".checkbox-list").attr("data-error-container")) : r.parents(".checkbox-inline").size() > 0 ? edit_admin.appendTo(r.parents(".checkbox-inline").attr("data-error-container")) : edit_admin.insertAfter(r)
        },
        invalidHandler: function (edit_admin, t) {
            i.hide(), r.show(), App.scrollTo(r, -200)
        },
        highlight: function (edit_admin) {
            $(edit_admin).closest(".form-group").addClass("has-error")
        },
        unhighlight: function (edit_admin) {
            $(edit_admin).closest(".form-group").removeClass("has-error")
        },
        success: function (edit_admin) {
            edit_admin.closest(".form-group").removeClass("has-error")
        },
        submitHandler: function (edit_admin) {
            i.show(), r.hide()
            //submit data with ajax 
            var formData = new FormData($("#edit_admin_profile")[0]);
            $.ajax({
                url: BASEURL + 'WEB/adminlogin/update_profile',
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                    var result_data = jQuery.parseJSON(data);
                    if (result_data.success)
                    {
                        toastr.success('Profile Updated successfully', 'Success');
                        setTimeout(function () {
                            window.location = BASEURL + 'dashboard';
                        }, 3000);
                    } else
                    {
                        toastr.error('Something went wrong', 'Error');
                        return false;
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
            //submit data with ajax end
        }
    });
    // Add blog form validation and ajax upload End

    /*
     * Purpose  : Change form validation and ajax upload
     */
    var change_pass = $("#change_password"),
            r = $(".alert-danger", change_pass),
            i = $(".alert-success", change_pass);
    jQuery.validator.addMethod("notEqual", function (value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "New password must be different from current password");
    change_pass.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            current_password: {
                required: "Current password required",
                minlength: "Minimum five charcter required"
            },
            new_password: {
                required: "New password required",
                minlength: "Minimum five charcter required"
            },
            confirm_password: {
                required: "Confirm password required",
                minlength: "Minimum five charcter required",
                equalTo: "New password and confirm password must be same"
            }
        },
        rules: {
            current_password: {
                minlength: 5,
                required: !0
            },
            new_password: {
                required: !0,
                minlength: 5,
                notEqual: '#current_password'
            },
            confirm_password: {
                minlength: 5,
                required: !0,
                equalTo: '#new_password'
            }
        },
        errorPlacement: function (change_pass, r) {
            r.parent(".input-group").size() > 0 ? change_pass.insertAfter(r.parent(".input-group")) : r.attr("data-error-container") ? change_pass.appendTo(r.attr("data-error-container")) : r.parents(".radio-list").size() > 0 ? change_pass.appendTo(r.parents(".radio-list").attr("data-error-container")) : r.parents(".radio-inline").size() > 0 ? change_pass.appendTo(r.parents(".radio-inline").attr("data-error-container")) : r.parents(".checkbox-list").size() > 0 ? change_pass.appendTo(r.parents(".checkbox-list").attr("data-error-container")) : r.parents(".checkbox-inline").size() > 0 ? change_pass.appendTo(r.parents(".checkbox-inline").attr("data-error-container")) : change_pass.insertAfter(r)
        },
        invalidHandler: function (change_pass, t) {
            i.hide(), r.show(), App.scrollTo(r, -200)
        },
        highlight: function (change_pass) {
            $(change_pass).closest(".form-group").addClass("has-error")
        },
        unhighlight: function (change_pass) {
            $(change_pass).closest(".form-group").removeClass("has-error")
        },
        success: function (change_pass) {
            change_pass.closest(".form-group").removeClass("has-error")
        },
        submitHandler: function (change_pass) {
            i.show(), r.hide()
            //submit data with ajax 
            var formData = new FormData($("#change_password")[0]);
            $.ajax({
                url: BASEURL + 'WEB/adminlogin/change_password',
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                    if ($.trim(data) == "")
                    {
                        toastr.success('Password Changed successfully', 'Success');
                        setTimeout(function () {
                            window.location = BASEURL + 'dashboard';
                        }, 3000);
                    } 
                    else if ($.trim(data) == "error")
                    {
                        toastr.error('Wrong Current password entered', 'Error');
                        return false;
                    } else
                    {
                        toastr.error('Something went wrong', 'Error');
                        return false;
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
            //submit data with ajax end
        }
    });
    //Change password form validation and ajax upload End
});