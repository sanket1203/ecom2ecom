<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->
        <!-- END THEME PANEL -->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?= WEB_URL . 'web' ?>">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?= WEB_URL . 'users' ?>">Users List</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    User Detail
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-red-haze bold uppercase"><h1 class="page-title"> User Detail</h1></span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="row">
                                
                                <div class="col-md-10">
                                    <div class="row">
                                        <?php if ($user_data['signup_with_promocode']) { ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label bold custom_label_width">Signup with promocode :</label>
                                                    
                                                        <div class="custom_width col-md-6"><p class="form-control-static"> <?= $user_data['signup_with_promocode'] ?> </p></div>

                                                </div>
                                            </div>
                                           <!--  <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label_align control-label col-md-4"></label>
                                                <div class="col-md-6">                                                    
                                                </div>
                                            </div> -->
                                        
                                        <?php } ?>
                                        <div class="col-md-6">
                                            <div class="form-group custom_margin">
                                                <label class="label_align control-label col-md-4">Full Name:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static"> <?= $user_data['full_name'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group custom_margin">
                                                <label class="label_align control-label col-md-4">User Name:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static"> <?= $user_data['user_name'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                       <?php /* <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Last Name:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> <?= $user_data['last_name'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                        */ ?>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group custom_margin">
                                                <label class="label_align control-label col-md-4">Email:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static"> <?= $user_data['email'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group custom_margin">
                                                <label class="label_align control-label col-md-4">Phone:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static"> <?= $user_data['phone'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6 custom_margin">
                                            <div class="form-group">
                                                <label class="label_align control-label col-md-4">User's promocode:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static"> <?= $user_data['promocode'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                  
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <img src="<?= $user_data['profile_pic'] ?>" style="max-height: 139px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                    <hr>
                    <h3>Invites</h3>
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover table-bordered" id="invites_listing">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Email </th>
                                                <th> Promocode </th>
                                                <th> Accept Status </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
    </div>
    <!-- END CONTENT BODY -->
</div>