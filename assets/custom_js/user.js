jQuery(document).ready(function () {
    
    //datatable code
    var users_listing = $('#users_listing');
    // begin first table
    users_listing.dataTable({
        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No user available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ users",
            "infoEmpty": "No user found",
            "infoFiltered": "(filtered1 from _MAX_ total users)",
            "lengthMenu": "Show _MENU_",
            "search": "Search:",
            "zeroRecords": "No matching user found",
            "paginate": {
                "previous": "Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "bProcessing": false,
        "serverSide": true,
        "sAjaxSource": BASEURL + "WEB/adminusers/getuserslist",
        "sServerMethod": "POST",
        "aoColumns": [
            {"data": "uniqid", "bSearchable": false, "bSortable": false, "bVisible": true},
            {"data": "user_image", "bSortable": false, "bSearchable": false, "mRender": function (data, type, full) {
                    return '<a href="' + BASEURL + 'userdetail/' + btoa(full.user_id) + '" class="" title="View detail"> <img  src="' + data + '" alt="user_image" style="max-width:100px;max-height:38px" class="lazy"/> </a>';
                }},
            {"data": "full_name", "bSearchable": true, "bSortable": true},            
            {"data": "user_name", "bSearchable": true, "bSortable": true},
            {"data": "email", "bSearchable": true, "bSortable": true},
            {"data": "phone", "bSearchable": true, "bSortable": true},
            {"data": "promocode", "bSearchable": true, "bSortable": false},
            {"data": "block_status", "bSearchable": false, "bSortable": false, "mRender": function (data, type, full) {
                    if (full.block_status == 'Unblocked')
                    {
                       var bloku = '<span class="btn btn-danger change_status" data-attr-id="' + full.user_id + '" data-bind="'+data+'" data-status-msg="block">Block</span>';
                    }
                    else
                    {
                       var bloku = '<span class="btn btn-success change_status" data-attr-id="' + full.user_id + '" data-bind="'+data+'" data-status-msg="unblock">Unblock</span>';
                    }
                    var viewdetail = '<a href="' + BASEURL + 'userdetail/' + btoa(full.user_id) + '" class="btn btn-success" title="View detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    actionrow = bloku+viewdetail;
                    return actionrow;
                }}
        ],
        "aoColumnDefs": [{"bSortable": false, "aTargets": [1, 2]},
            {"bSearchable": false, "aTargets": [1]}],
        "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],
        "lengthMenu": [
            [5, 15, 20, 0],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pagelength": 5,
        "pagingType": "bootstrap_full_number",
        "order": [
			 //[0, "desc"]
		 ] // set first column as a default sort by asc
    });
    
    $('.dataTables_filter input').removeClass('input-small').addClass('input-medium');
    $('.dataTables_filter label').css('margin-bottom', '0px');
    //datatable code End
    
    
    $(document).on("click", ".change_status", function () {
        var Obj = $(this);
        var user_id = $(this).attr("data-attr-id");
        var status = $(this).attr("data-bind");
        var status_msg = $(this).attr("data-status-msg");

        bootbox.confirm("Are you sure want to "+status_msg+" this user ?", function (result) {
            //if user confirm ok then process delete blog
            if (result) {
                var dataString = {
                    user_id: user_id,
                    status:status
                };
                //define ajax path
                var path = BASEURL + 'WEB/adminusers/blockuser/';
                $.post(path, {
                    data: dataString
                },
                function (res) {
                    if ($.trim(res) == '') {
                        toastr.error('Something went wrong', 'Error');
                        return false;
                    } else {
                        toastr.success('Staus updated successfully', 'Success');
                        users_listing.fnDraw();
                    }
                }, 'json');
            }
        });
    });
    
    //datatable code
    var invites_listing = $('#invites_listing');
    // begin first table
    invites_listing.dataTable({
        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No record available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ records",
            "infoEmpty": "No record found",
            "infoFiltered": "(filtered1 from _MAX_ total records)",
            "lengthMenu": "Show _MENU_",
            "search": "Search:",
            "zeroRecords": "No matching record found",
            "paginate": {
                "previous": "Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "bProcessing": false,
        "serverSide": true,
        "sAjaxSource": BASEURL + "WEB/adminusers/getinvitelist",
        "sServerMethod": "POST",
        "aoColumns": [
            {"data": "invite_id", "bSearchable": false, "bSortable": false, "bVisible": true},
            {"data": "friend_email", "bSearchable": true, "bSortable": false},
            {"data": "promocode", "bSearchable": true, "bSortable": false},
            {"data": "status", "bSearchable": false, "bSortable": false, "mRender": function (data, type, full) {
                if (full.status == 'Yes')
                {
                    return '<span class="btn btn-success" style="cursor: default">' + data + '</span>';
                }
                else
                {
                    return '<span class="btn btn-danger" style="cursor: default">' + data + '</span>';
                }
            }}
        ],
        "aoColumnDefs": [{"bSortable": false, "aTargets": [1, 2]},
            {"bSearchable": false, "aTargets": [1]}],
        "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],
        "lengthMenu": [
            [5, 15, 20, 0],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pagelength": 5,
        "pagingType": "bootstrap_full_number",
        "order": [
			 //[0, "desc"]
		 ] // set first column as a default sort by asc
    });
    
    $('.dataTables_filter input').removeClass('input-small').addClass('input-medium');
    $('.dataTables_filter label').css('margin-bottom', '0px');
    //datatable code End
    
});