<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kitap extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_book', 'book');
    }

    public function index()
    {
        $data['get_book'] = $this->book->get_book();
        $data['category'] = $this->book->data_category();
        $data['content'] = "g_kitap";
        $this->load->view('sablon', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('book_title', 'book_title', 'trim|required');
        $this->form_validation->set_rules('year', 'year', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('publisher', 'publisher', 'trim|required');
        $this->form_validation->set_rules('stock', 'stock', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            
            if ($_FILES['gambar']['name'] != "") {
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    redirect('kitap');
                } else {
                    if ($this->book->save_book($this->upload->data('file_name'))) {
                        $this->session->set_flashdata('message', 'Kitap başarıyla eklendi');
                    } else {
                        $this->session->set_flashdata('message', 'Kitap eklenirken bir hata oluştu');
                    }
                    redirect('kitap');
                }
            } else {
                if ($this->book->save_book("")) {
                    $this->session->set_flashdata('message', 'Kitap başarıyla eklendi');
                } else {
                    $this->session->set_flashdata('message', 'Kitap eklenirken bir hata oluştu');
                }
                redirect('kitap');
            }
        } else {
            $this->session->set_flashdata('message', validation_errors());
            redirect('kitap');
        }
    }

    public function update()
    {
        if ($this->book->book_update()) {
            $this->session->set_flashdata('message', 'Kitap başarıyla güncellendi');
            redirect('kitap');
        } else {
            $this->session->set_flashdata('message', 'Güncelleme başarısız oldu');
            redirect('kitap');
        }
    }

    public function delete($book_code)
    {
        if ($this->book->delete_book($book_code)) {
            $this->session->set_flashdata('message', 'Kitap başarıyla silindi');
            redirect('kitap');
        } else {
            $this->session->set_flashdata('message', 'Silme işlemi başarısız oldu');
            redirect('kitap');
        }
    }

    public function edit_book($id)
    {
        $data = $this->book->get_book_id($id);
        echo json_encode($data);
    }
}