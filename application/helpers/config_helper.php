<?php
/**
 * Get asset URL
 *
 * @access  public
 * @return  string
 */
if(!function_exists('site_name'))
{  
    function site_name()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();  
        //return the full asset path
        return $CI->config->item('site_name');
    }
}

if(!function_exists('addhttp'))
{ 
	function addhttp($url) {
		if(!empty($url)) {
			if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
				$url = "http://" . $url;
			}
		}
		else{
			$url = 'javascript:void(0);';
		}
		return $url;
	}
}
