<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrol extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Dashboard', 'dashboard');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('yonetici');
        }
        $data['content'] = "Anasayfa";  // Dosya adıyla aynı olmalı, .php uzantısı olmadan
        $data['jml_book'] = $this->dashboard->get_jml_book();
        $data['book_cat'] = $this->dashboard->get_book_cat();
        $data['sys_user'] = $this->dashboard->get_sys_user();
        $data['jml_transaction'] = $this->dashboard->get_jml_transaction();
        $data['jml_pengguna'] = $this->dashboard->get_jml_pengguna();
        $data['book_stock'] = $this->dashboard->get_book_stock();
        $data['sales_p'] = $this->dashboard->get_sales_p();
        $this->load->view('sablon', $data);
    }
}

/* End of file Kontrol.php */
/* Location: ./application/controllers/Kontrol.php */
?>