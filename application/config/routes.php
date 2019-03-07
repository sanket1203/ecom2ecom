<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Sample default SITE Routes
|--------------------------------------------------------------------------
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['user_guide/web']="welcome/web";
$route['user_guide/api']="welcome/rest";



/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['gettubeid'] = "API/Home/gettubeid";
$route['web'] = "WEB/Adminlogin/index";
$route['dashboard'] = "WEB/Admindashboard/index";
$route['userprofile/(:any)'] = "WEB/adminlogin/adminprofile/$1";
$route['settings'] = "WEB/settings/index";
$route['users'] = "WEB/Adminusers/index";