<?php
class My_API extends CI_Controller
{
  public function __construct() 
  {
    parent::__construct();
    date_default_timezone_set('UTC');
//    if(!isset($_SERVER['PHP_AUTH_USER']) ) 
//    {
//      header('WWW-Authenticate: Basic realm="viiny is a tiny service"');
//      header('HTTP/1.0 401 Unauthorized');
//      _error(401,"Unauthorized");  
//    }
//    if($_SERVER['PHP_AUTH_USER'] == 'abc' AND $_SERVER['PHP_AUTH_PW'] == 123123)
//    {
//      return true;
//    }
//    else
//    {
//      header('WWW-Authenticate: Basic realm="viiny is a tiny service"');
//      header('HTTP/1.0 401 Unauthorized');
//      _error(401,"Incaorrect username and password access denied");
//    }
  }
}