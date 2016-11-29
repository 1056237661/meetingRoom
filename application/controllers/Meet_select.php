<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/11
 * Time: 9:31
 */
class Meet_select extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_meet_select');
        $this->load->helper ( array (
            'form',
            'url'
        ) );
    }

    /*通过日期、会议室—罗列时间段的选择状态*/
    public function select(){
        $daySelected = $_POST['daySelected'];
        $meetSelected = $_POST['meetSelected'];
        $data = $this->Model_meet_select->selected($meetSelected , $daySelected);
        print_r(json_encode($data));
    }

    /*增加预约信息*/
    public function verify(){
        $daySelected = isset($_POST['daySelected'])?$_POST['daySelected']:false;
        $meetSelected = isset($_POST['meetSelected'])?$_POST['meetSelected']:false;
        $selected = isset($_POST['selected'])?$_POST['selected']:false;
        $this->Model_meet_select->insert($meetSelected , $daySelected, $selected);
    }

    /*点击我的预定*/
    public function my_order(){
        $data = $this->Model_meet_select->my_order();
        if($data == NULL ){
            echo -1;
        }else{
            print_r(json_encode($data));
        }
    }
    /*取消预约*/
    public function cancel(){
        $id = $_POST["id"];
        $data = $this->Model_meet_select->cancel($id);
    }
}