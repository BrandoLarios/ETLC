<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

	public function __construct () {
		parent :: __construct ();
		$this->load->model('M_Signin');
    }

    public function volver () {
        $this->load->view('login_view');
    }

    public function sign_in () {
        //Guardado de los campos
        $user = $this->input->post('user');
        $mail = $this->input->post('mail');
        $pswd = $this->input->post('pswd');
        $pswdv = $this->input->post('pswdv');


        //Obtener si hay usuarios con ese nombre
        $ruser = $this->M_Signin->get_User($user);
        //Obtener si hay correos ya registrados
        $rmail = $this->M_Signin->get_Mail($mail); //echo $rmail;
        //Validar que no exista el nombre de usuario
        if(!empty($ruser)){
            $input = array (
                'mensaje' => 'Nombre de usuario ya registrado, intente de nuevo.', 
                'mail' => $mail  
            ); 
            $this->session->input = $input;
            $data ['input'] = $this->session->input; 
            $this->load->view('signin_view', $data);
        }else{
            //Validar que no exista el correo
            if(!empty($rmail)){
                $input = array (
                    'mensaje' => 'Correo electronico ya registrado, intente de nuevo.', 
                    'user' => $user 
                ); 
                $this->session->input = $input;
                $data ['input'] = $this->session->input; 
                $this->load->view('signin_view', $data);
            }else{
                //Validar que las contraseñas sean iguales
                if ($pswd != $pswdv) {
                    $input = array (
                        'mensaje' => 'La contraseña no coincide, intente de nuevo.',
                        'user' => $user, 
                        'mail' => $mail  
                    ); 
                    $this->session->input = $input;
                    $data ['input'] = $this->session->input; 
                    $this->load->view('signin_view', $data);
                }else{
                    //Accesos de registro
                    $data = array (
                        'Username'  => strtoupper($user),
                        'Email'     => $mail,
                        'Password'  => $pswd  
                    );
                    $this->M_Signin->add_User($data);
                    $this->load->view('login_view');
                }
            }
        }
        
    }
}