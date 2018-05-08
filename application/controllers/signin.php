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
        $user = $this->input->post('user');
        $mail = $this->input->post('mail');
        $pswd = $this->input->post('pswd');
        $pswdv = $this->input->post('pswdv');
        $input = array (
            'user' => $user,
            'mail' => $mail
        );
        $this->session->input = $input;
        if ($pswd != $pswdv) {
            $data ['input'] = $this->session->input; 
            $this->load->view('signin_view', $data);
        }else{
            $data = array (
                'Username'  => strtoupper($user),
                'Email'     => $mail,
                'Password'  => $pswd  
            );
            $this->M_Signin->Add_user($data);
            $this->load->view('login_view');
        }
    }
}