<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/11
 * Time: 9:18
 */
class Model_meet_select extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    /*通过名字获取选中的会议室*/
    public  function get_selected( $username ){
        $this->db->select("selected");
        $this->db->from("meet");
        $this->db->where('username', $username);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $str = $row->selected;
        }
        if(isset($str)){
            return $str;
        }
    }
    /*增加预约数据*/
    public function insert($roomnumber , $day , $selected){
        $username = $_SESSION['username'];
        $handlerTime = date("y-m-d",time());
        $this->db->select("id");
        $this->db->from("meet");
        $this->db->where('roomnumber', $roomnumber);
        $this->db->where('day', $day);
        $this->db->where('username', $username);
        $result = $this->db->get();
        foreach ($result->result() as $row) {
            $id = $row->id;
        }
        if($id != NULL){
            if( $selected == "" ){
                $this->db->where('id', $id)
                    ->delete("meet");
            }else{
                $updata = array('selected' => $selected);
                $this->db->where('username', $username);
                $this->db->where('day', $day);
                $this->db->where('roomnumber', $roomnumber);
                $this->db->update('meet', $updata);
            }
        }else{
            $addData = array(
                'username' => $username,
                'roomnumber' => $roomnumber,
                'selected' => $selected,
                'handlerTime' => $handlerTime,
                'day' => $day
            );
            $this->db->insert('meet', $addData);
        }
    }
    /*获取已被预约的参数*/
    public function selected( $meetSelected , $daySelected){
        $data = "";
        $username = $_SESSION['username'];
        $this->db->select('selected, username');
        $this->db->from('meet');
        $this->db->where('roomnumber', $meetSelected);
        $this->db->where('day', $daySelected);
        $query = $this->db->get();
        if(isset($query)){
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i]["username"] = $row->username;
                $data[$i]["selected"] = $row->selected;
                $i++;
            }
            return $data;
        }
    }
    /*获取我的预约信息*/
    public function my_order(){
        $username = $_SESSION['username'];
        $this->db->select('id,day,selected,roomnumber');
        $this->db->from('meet');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $verify = $query->row();
        if( isset($verify) ){
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i]["id"] = $row->id;
                $data[$i]["day"] = $row->day;
                $data[$i]["roomnumber"] = $row->roomnumber;
                $data[$i]["selected"] = $row->selected;
                $i++;
            }
            return $data;
        }else{
            return NULL;
        }
    }
    /*取消预约*/
    public function cancel( $id ){
        $this->db->where('id', $id)
            ->delete("meet");
    }

}