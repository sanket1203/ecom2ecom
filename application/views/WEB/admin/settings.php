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
                    <span>Settings</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Settings Opencart to Magento Migrations</h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red bold uppercase">Settings</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal" role="form" id="update_settings" method="post">
                            <div class="form-group">
                                <label for="" class="col-md-3 control-label">Opencart Web URL</label>
                                <div class="col-md-4">                                    
                                    <input type="text" name="opencart_websiteurl" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-3 control-label">Opencart Databse name</label>
                                <div class="col-md-4">
                                    <input type="text" name="opencart_database" class="form-control">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="" class="col-md-3 control-label">Opencart Databse password</label>
                                <div class="col-md-4">
                                    <input type="text" name="opencart_dbpassword" class="form-control">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="" class="col-md-3 control-label">Opencart Database Host</label>
                                <div class="col-md-4">
                                    <input type="text" name="opencart_dbhost" class="form-control">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="" class="col-md-3 control-label">Magento Web URL</label>
                                <div class="col-md-4">
                                    <input type="text" name="magento_websiteurl" class="form-control">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="" class="col-md-3 control-label">Magento Database Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="magento_database" class="form-control">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="" class="col-md-3 control-label">Magento Database Password</label>
                                <div class="col-md-4">
                                    <input type="text" name="magento_dbpassword" class="form-control">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="" class="col-md-3 control-label">Magento Database Host</label>
                                <div class="col-md-4">
                                    <input type="text" name="magento_dbhost" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->

    </div>
    <!-- END CONTENT BODY -->
</div>