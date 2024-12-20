<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gecmis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_transaction', 'transaction');
	}

	public function index()
	{
		$data['get_history']=$this->transaction->get_transaction();
		$data['content']="g_gecmis";
		$this->load->view('sablon', $data);		
	}

}

/* End of file Gecmis.php */
/* Location: ./application/controllers/Gecmis.php */