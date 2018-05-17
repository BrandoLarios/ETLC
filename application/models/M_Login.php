<?php

class M_Login extends CI_Model{
	
	function get_User ($user) {
		$this->db->where('Username',$user);
		$query = $this->db->get('usuarios');
		return $query -> result_Array();
	}

	function get_Fulluser($user,$pswd){
		$this->db->where('Username',$user);
		$this->db->where('Password',$pswd);
		$query = $this->db->get('usuarios');
		return $query -> result_Array();
    }
}