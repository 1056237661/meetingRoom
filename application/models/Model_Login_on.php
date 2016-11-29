<?php
class Model_login_on extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /*通过名字获取密码*/
    public function get_password( $username ){
        $password = "";     
        $this->db->select("password");
        $this->db->from("user");
		$this->db->where('username', $username);
		$query = $this->db->get();      
       	foreach ($query->result() as $row) {
            $password = $row->password;
        }
        return $password;
    }
}