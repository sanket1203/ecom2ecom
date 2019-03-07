<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class General_lib 
{
    var $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('general','gm');
    }
    public function send_mail($data,$info)
    {
        switch ($data['option']) 
        {    
            case 'forgot':
                $this->load_page('MAIL/forgot',$info,'Forgot password request');
                break;
            case 'registration':
                $update=array(
                        'forgot_token'=>''
                    );
                $where=array('email'=>$_POST['email']);
                $info=$this->generate_token_('tbl_user',$update,$where);
                $info['email']=$_POST['email'];
                $info['link']=base_url('activate').'/'.$info['forgot_token'];
                $this->load_page('web/mail/registration',$info,'Registration confirm');
                break;
            default:
                break;
        }   
    }
    public function load_page($view,$info,$subject)
    {
        $data=$this->CI->load->view($view,$info,true);
        $config = Array(
            'protocol' =>'smtp',
            'smtp_host' =>'mail.abc.com',
            'smtp_port' => 26,
            'smtp_user' => 'noreply@abc.com' , // change it to yours
            'smtp_pass' => 'aaaa', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = $data;
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from('admin@coan.com'); // change it to yours
        $this->CI->email->to($info['email']);// change it to yours
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        if($this->CI->email->send())
        {
            return true;
        }
        else
        {
            show_error($this->CI->email->print_debugger()); exit();
        }
    }
    /*
    |================================================================
    |Note:- set unique key to your required column which store generate_token_() and then after use this query during |add or edit
    |================================================================
    */
    public function generate_token_($table,$data,$where) 
    {
        try 
        {
            $data['forgot_password_token'] = $this->generateRandomString(100);
            $this->CI->gm->edit($table,$data,$where);
            return $data;
        }
        catch(Exception $e)
        {
            $error_info = $e->errorInfo;
            if($error_info[1] == 1062) 
            {
                generate_token_();
            }
            else
            {
                print_r($error_info);
            } 
        }
    }
    
    public function generate_signup_token_($table,$data,$where) 
    {
        try 
        {
            $data['signup_token'] = $this->generateRandomString(100);
            $this->CI->gm->edit($table,$data,$where);
            return $data;
        }
        catch(Exception $e)
        {
            $error_info = $e->errorInfo;
            if($error_info[1] == 1062) 
            {
                generate_signup_token_();
            }
            else
            {
                print_r($error_info);
            } 
        }
    }
    
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function initPagination($limit,$base_url,$total_rows)
    {
        $config['per_page']          = $limit;
        $config['uri_segment']       = 2;
        $config['base_url']          = base_url().$base_url;
        $config['total_rows']        = $total_rows;
        $config['use_page_numbers']  = TRUE;
        
        $config['full_tag_open'] = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        /*$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '';
        $config['cur_tag_open'] = "";
        $config['cur_tag_close'] = "";*/
        
        $this->CI->pagination->initialize($config);
        return $config;    
    }
    function do_it_background($url, $params)
    {
        /*+++++++++++++++++++++++            
            $param=array('option'=>'registration','email' => $_POST["email"] );
        +++++++++++++++++++++++*/
        $post_string = http_build_query($params);
        $parts = parse_url($url);
            $errno = 0;
        $errstr = "";
        
        //Use SSL & port 443 for secure servers
        //Use otherwise for localhost and non-secure servers
        //For secure server
        //$fp = fsockopen('ssl://' . $parts['host'], isset($parts['port']) ? $parts['port'] : 443, $errno, $errstr, 30);
        //For localhost and un-secure server
        $fp = fsockopen($parts['host'], isset($parts['port']) ? $parts['port'] : 80, $errno, $errstr, 30);
        
        if(!$fp)
        {
            echo "Some thing Problem";    
        }
        $out = "POST ".$parts['path']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out.= "Content-Length: ".strlen($post_string)."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        if (isset($post_string)) $out.= $post_string;
        fwrite($fp, $out);
        fclose($fp);
    }
}
?>