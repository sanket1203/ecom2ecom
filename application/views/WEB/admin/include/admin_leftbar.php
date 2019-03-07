<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="nav-item <?=is_menu_active('dashboard');?>">
                <a href="<?=WEB_URL.'dashboard'?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?=$this->uri->segment(1) == 'users' ? is_menu_active('users') : is_menu_active('userdetail');?>">
                <a href="<?=WEB_URL.'users'?>" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Users</span>
                    <span class="selected"></span>
                </a>
            </li>
			<li class="nav-item <?=is_menu_active('settings');?>">
                <a href="<?=WEB_URL.'settings'?>" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Settings</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php /*<li class="nav-item <?=is_menu_active('restaurants');?>">
                <a href="<?=WEB_URL.'restaurants'?>" class="nav-link nav-toggle">
                    <i class="fa fa-cutlery"></i>
                    <span class="title">Restaurants</span>
                    <span class="selected"></span>
                </a>
            </li> */ ?>
            
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->