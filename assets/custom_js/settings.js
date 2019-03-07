jQuery(document).ready(function () {
    // image crope code
    var original = $(".img-responsive").attr('src');

    $('#done').click(function () {
        $('#myModal').modal('hide');

    });
    
    /*
     * Purpose  : setting
     */
    var edit_settings = $("#update_settings"),
            r = $(".alert-danger", edit_settings),
            i = $(".alert-success", edit_settings);

    edit_settings.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            opencart_websiteurl: {
                required: "Opencart web url required"
            },
            opencart_database: {
                required: "Opencart database required",                
            },
            opencart_dbpassword: {
                required: "Opencart database password required"
            },
			opencart_dbhost: {
                required: "Opencart database host required"
            },
			magento_websiteurl: {
                required: "Magento web url required"
            },
			magento_database: {
                required: "Magento database required"
            },
			magento_dbpassword: {
                required: "Magento database password required"
            },
			magento_dbhost: {
                required: "Magento database host required"
            },
        },
        rules: {
            opencart_websiteurl: {                
                required: !0,
            },
            opencart_database: {
                required: !0,
            },
			opencart_dbpassword: {
				required: !0,
			},
            opencart_dbhost: {
                required: !0,
            },
			magento_websiteurl: {
                required: !0,
            },
			magento_database: {
                required: !0,
            },
			magento_dbpassword: {
                required: !0,
            },
			magento_dbhost: {
                required: !0,
            },
        },
        errorPlacement: function (edit_settings, r) {
            r.parent(".input-group").size() > 0 ? edit_settings.insertAfter(r.parent(".input-group")) : r.attr("data-error-container") ? edit_settings.appendTo(r.attr("data-error-container")) : r.parents(".radio-list").size() > 0 ? edit_settings.appendTo(r.parents(".radio-list").attr("data-error-container")) : r.parents(".radio-inline").size() > 0 ? edit_settings.appendTo(r.parents(".radio-inline").attr("data-error-container")) : r.parents(".checkbox-list").size() > 0 ? edit_settings.appendTo(r.parents(".checkbox-list").attr("data-error-container")) : r.parents(".checkbox-inline").size() > 0 ? edit_settings.appendTo(r.parents(".checkbox-inline").attr("data-error-container")) : edit_settings.insertAfter(r)
        },
        invalidHandler: function (edit_settings, t) {
            i.hide(), r.show(), App.scrollTo(r, -200)
        },
        highlight: function (edit_settings) {
            $(edit_settings).closest(".form-group").addClass("has-error")
        },
        unhighlight: function (edit_settings) {
            $(edit_settings).closest(".form-group").removeClass("has-error")
        },
        success: function (edit_settings) {
            edit_settings.closest(".form-group").removeClass("has-error")
        },
        submitHandler: function (edit_settings) {
            i.show(), r.hide()
            //submit data with ajax 
            var formData = new FormData($("#edit_admin_profile")[0]);
            $.ajax({
                url: BASEURL + 'WEB/settings/update_settings',
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                    var result_data = jQuery.parseJSON(data);
                    if (result_data.success)
                    {
                        toastr.success('Settings Added/Updated successfully', 'Success');
                        setTimeout(function () {
                            window.location = BASEURL + 'settings';
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

});