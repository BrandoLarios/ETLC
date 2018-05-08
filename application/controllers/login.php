<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct () {
		parent :: __construct ();
		$this->load->model('M_Login');
	}

	public function index () {
		$this->load->view('login_view');
	}

	
	public function validar () {
		//Recibimos por POST el nombre de ususario y su clave
		$user = strtoupper($this->input->post('user'));
		$pswd = $this->input->post('pswd');
		//Invocamos el metodo getUsuario del modelo M_Agenda
		$res = $this ->M_Login->getUsuario($user,$pswd); 
		if(empty($res)){
			$this->load->view('login_view');
		}else{
			//Registrar al usuario en una variable de sesion
			$this->session->set_userdata('usuario',$user);
			//Cargar la vista del ETL
			$this->load->view('etl_view');
		}
	}

	public function sign_in () {
		$this->load->view('signin_view');
	}
}