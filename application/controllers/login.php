<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/22
 * Time: 11:40
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Model_login_on');
        $this->load->model('Model_meet_select');
        $this->load->helper ( array (
            'form',
            'url'
        ) );
    }

    /*默认执行*/
    public function index($errors=''){
    	$error["message"] = $errors;
        $this->load->view('login',$error);
    }

    /*登录按钮*/
    public function submit()
    {
    	$username = $_POST["username"];
    	$password = $_POST["password"];
		$data = array(
			'username' => $username,
			'password' => $password
		);
        $newdata = array(
            'username'  => $username,
            'loginTime' => time()
        );
		$password = $this->Model_login_on->get_password($username);
		if ($password == $data['password']) {
            $this->session->set_userdata($newdata);
            $data ['day'] = date("d");
            $data ['day1'] = date("d",strtotime("+1 day"));
            $data ['day2'] = date("d",strtotime("+2 day"));
            $str = $this->Model_meet_select->get_selected($username);
            $data['selected'] = explode(",",$str);
			$this->load->view('meeting',$data);
		}else{
			$error["message"] = "请检查您的用户名和密码！";
            $this->session->sess_destroy();
            redirect('/Login/index/'.$error["message"] );
		}
    }
}