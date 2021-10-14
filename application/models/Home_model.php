<?php
class Home_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
	function checkuserlogin($value) {
		$userid = $value['user_id'];
		$pass = $value['password'];
        $this->db->select('*')
				 ->from('admin')	
				 ->where('email',$userid);
		$query = $this->db->get();
		//~ echo $this->db->last_query();die();		
		$result=$query->row();
		return $result ;
    }
    
    public function CheckLogin($value)
	{
		$userid = $value['user_id'];
		$pass = $value['password'];
        $this->db->select('*')
				 ->from('admin')	
				 ->where('email',$userid)
				 ->where('password',md5($pass));
		$query = $this->db->get();		
		$result=$query->row();
		return $result ;
	}
	
	public function updatequery($id,$room,$av_room)
	{
		$up_room = $av_room + $room;
		//~ echo "<pre>";print_r($room);die();
		return $this->db->where('id', $id)->update('mecca_hotels', array('availableroom' => $up_room));
	}
    

    function country_list() {
		$this->db->select('*')
				 ->from('countries');
		$query = $this->db->get();
		return $query->result();
    }

}
