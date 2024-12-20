<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_category','category');
    }

    public function index()
    {
        $data['get_category']=$this->category->get_category();
        $data['content']="g_kategori";
        $this->load->view('sablon', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if ($this->category->save_category()) {
                $this->session->set_flashdata('message', 'Kategori başarıyla eklendi');
            } else {
                $this->session->set_flashdata('message', 'Kategori eklenirken bir hata oluştu');
            }
            redirect('kategori','refresh');
        } else {
            $this->session->set_flashdata('message', validation_errors());
            redirect('kategori','refresh');
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if ($this->category->category_update()) {
                $this->session->set_flashdata('message', 'Kategori başarıyla güncellendi');
                redirect('kategori');
            } else {
                $this->session->set_flashdata('message', 'Güncelleme başarısız oldu');
                redirect('kategori');
            }
        }
    }

    public function delete_category($category_code)
    {
        if ($this->category->delete_category($category_code)) {
            $this->session->set_flashdata('message', 'Kategori başarıyla silindi');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('message', 'Silme işlemi başarısız oldu');
            redirect('kategori');
        }
    }

    public function edit_category($id)
    {
        $data = $this->category->get_category_id($id);
        echo json_encode($data);
    }
}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */