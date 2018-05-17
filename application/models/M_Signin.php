<?php

class M_Signin extends CI_Model{
	
	function add_User ($datos) {
		$this->db->insert('usuarios',$datos);
	}

	function get_User ($user) {
		$this->db-> where('Username',$user);
		$query = $this->db->get('usuarios');
		return $query -> result_Array();
	}

	function get_Mail ($mail) {
		$this->db-> where('Email',$mail);
		$query = $this->db->get('usuarios');
		return $query -> result_Array();
	}
}