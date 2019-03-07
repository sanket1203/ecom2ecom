<?php
    if(!function_exists('flash_message'))
    {  
        function flash_message($message = '', $selector = '')
        {
//            print_r('test');exit;
            switch($selector) {
                case 'error':
                    return '<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>'.$message.'</div>';					
                break;

                case 'warning':
                    return '<div class="alert alert-warning"><a class="close" data-dismiss="alert">&times;</a>'.$message.'</div>';
                break;

                case 'info':
                    return '<div class="alert alert-info"><a class="close" data-dismiss="alert">&times;</a>'.$message.'</div>';
                break;

                case 'success':
                default:
                    return '<div class="alert alert-success"><a class="close" data-dismiss="alert">&times;</a>'.$message.'</div>';
                break;
            }
        }
    }
?>