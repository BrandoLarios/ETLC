<?php

class M_Signin extends CI_Model{
	
	function Add_user($datos){
		$this->db->insert('usuarios',$datos);
	}
}