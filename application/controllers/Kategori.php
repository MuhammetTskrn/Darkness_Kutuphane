<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_category','category');
        // Session kontrolü
        if (!$this->session->userdata('logged_in')) {
            redirect('yonetici');
        }
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

    public function add_category()
    {
        $this->form_validation->set_rules('kategori_adi', 'Kategori Adı', 'required|min_length[3]|max_length[50]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('kategori/ekle');
        } else {
            $data = array(
                'kategori_adi' => $this->input->post('kategori_adi'),
                'kategori_kodu' => pascalize($this->input->post('kategori_adi'))
            );
            
            $this->M_kategori->add_category($data);
            redirect('kategori');
        }
    }

    public function ekle()
    {
        $this->form_validation->set_rules('kategori_adi', 'Kategori Adı', 'required|min_length[3]|max_length[50]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('sablon');
            $this->load->view('kategori/ekle');
        } else {
            $data = array(
                'kategori_adi' => $this->input->post('kategori_adi'),
                'kategori_kodu' => pascalize($this->input->post('kategori_adi')) // Kategori adını pascalize ediyoruz
            );
            
            $this->M_kategori->ekle($data);
            redirect('kategori');
        }
    }
}

function pascalize($str) {
    $str = strtolower($str);
    $str = str_replace(' ', '_', $str);
    $str = str_replace('-', '_', $str);
    $str = str_replace('_', ' ', $str);
    $str = ucwords($str);
    $str = str_replace(' ', '', $str);
    return $str;
}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */