<?php

class M_Login extends CI_Model{
	
	function getUsuario($user,$pswd){
		$this->db->where('Username',$user);
		$this->db->where('Password',$pswd);
		$query = $this->db->get('Usuarios');
		return $query -> result_Array();
    }
}