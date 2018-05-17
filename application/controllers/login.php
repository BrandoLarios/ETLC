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

	
	public function login () {
		//Recibimos por POST el nombre de ususario y su clave
		$user = $this->input->post('user');
		$pswd = $this->input->post('pswd');
		//Invocamos el metodo getUsuario del modelo M_Agenda
		$only = $this ->M_Login->get_User(strtoupper($user));
		$full =  $this ->M_Login->get_Fulluser(strtoupper($user),$pswd);
		//Validacion para determinar si se encuentra el usuario registrado
		if(empty($only)){
			$input = array (
				'mensaje' => 'Usuario no registrado.'
			);
			$this->session->input = $input;
            $data ['input'] = $this->session->input; 
			$this->load->view('login_view',$data);
		}else{
			//Validacion para determinar si la contraseña coincide con el usuario registrado
			if(empty($full)){
				$input = array (
					'mensaje' => 'Error con la contraseña.',
					'user' => $user
				);
				$this->session->input = $input;
				$data ['input'] = $this->session->input; 
				$this->load->view('login_view',$data);
			}else{
				//Registrar al usuario en una variable de sesion
				$this->session->set_userdata('usuario',$user);
				//Cargar la vista del ETL
				$this->load->view('etl_view');
			}
		}
	}

	public function sign_in () {
		$this->load->view('signin_view');
	}
}