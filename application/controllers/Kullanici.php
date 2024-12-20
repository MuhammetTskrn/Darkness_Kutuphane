<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') != 'yönetici' && $this->session->userdata('level') != 'admin') {
            redirect('dashboard');
        }
        $this->load->model('m_user','user');
    }

    public function index()
    {
        $data['get_user'] = $this->user->get_user();
        $data['content'] = "g_kullanici";
        $this->load->view('sablon', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('fullname', 'fullname', 'trim|required');
        $this->form_validation->set_rules('level', 'level', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if ($this->user->save_user()) {
                $this->session->set_flashdata('message', 'Kullanıcı başarıyla eklendi');
            } else {
                $this->session->set_flashdata('message', 'Kullanıcı eklenirken bir hata oluştu');
            }
            redirect('kullanici');
        } else {
            $this->session->set_flashdata('message', validation_errors());
            redirect('kullanici');
        }
    }

    public function update()
    {
        if ($this->user->user_update()) {
            $this->session->set_flashdata('message', 'Kullanıcı başarıyla güncellendi');
            redirect('kullanici');
        } else {
            $this->session->set_flashdata('message', 'Güncelleme başarısız oldu');
            redirect('kullanici');
        }
    }

    public function delete($user_id)
    {
        if ($this->user->delete_user($user_id)) {
            $this->session->set_flashdata('message', 'Kullanıcı başarıyla silindi');
            redirect('kullanici');
        } else {
            $this->session->set_flashdata('message', 'Silme işlemi başarısız oldu');
            redirect('kullanici');
        }
    }

    public function edit_user($id)
    {
        $data = $this->user->get_user_id($id);
        echo json_encode($data);
    }
}

/* End of file Kullanici.php */
/* Location: ./application/controllers/Kullanici.php */