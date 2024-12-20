<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yonetici extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		ob_start();
		$this->load->library('session');
		$this->load->model('M_admin');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == FALSE) {
			$this->load->view('giris');
		} else {
			redirect('kontrol');
		}
		
	}
	public function proses_login()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'username', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				if ($this->M_admin->get_login() == TRUE) {
					redirect('kontrol');
				} else {
					$this->session->set_flashdata('message', 'Wrong Username and Password');
					redirect('yonetici/index');
				}
			} else {
				$this->session->set_flashdata('message', 'Username or Password must be filled!!');
				redirect('yonetici/index');
			} 
		}
	}

	public function register()
	{
		if ($this->session->userdata('logged_in') == FALSE) {
			$this->load->view('kayit');
		} else {
			redirect('kontrol');
		}
	}

	public function proses_register()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'username', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			$this->form_validation->set_rules('fullname', 'fullname', 'trim|required');
			$this->form_validation->set_rules('level', 'level', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				if ($this->M_admin->get_register() == TRUE) {
					redirect('yonetici/index');
				} else {
					$this->session->set_flashdata('message', 'Wrong Username and Password');
					redirect('yonetici/register');
				}
			} else {
				$this->session->set_flashdata('message', 'Username or Password must be filled!!');
				redirect('yonetici/register');
			} 
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('yonetici/index','refresh');
	}

}

/* End of file Yonetici.php */
/* Location: ./application/controllers/Yonetici.php */