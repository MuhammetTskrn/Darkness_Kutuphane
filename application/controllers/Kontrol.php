<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrol extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Dashboard', 'dashboard');
        $this->load->helper(['text', 'inflector', 'url', 'security']); // Gerekli helper'ları yüklüyoruz
        $this->load->library('form_validation');
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

    // Kitap detay sayfası - url_title kullanımı
    public function kitap_detay($id)
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('yonetici');
        }

        // Kitap detaylarını getir
        $kitap = $this->dashboard->get_book_detail($id);
        
        if (!$kitap) {
            show_404();
        }
        
        // SEO dostu URL oluştur
        $kitap->seo_url = url_title($kitap->book_title, 'dash', TRUE);
        // Açıklamayı kısalt
        $kitap->description = word_limiter($kitap->description, 20);
        
        $data['content'] = "kitap/detay";
        $data['kitap'] = $kitap;
        $this->load->view('sablon', $data);
    }

    // Kitap ekleme - CSRF ve form validation örneği
    public function kitap_ekle()
    {
        // CSRF kontrolü
        if($this->input->is_ajax_request()) {
            if(!$this->security->get_csrf_hash()) {
                exit('No direct script access allowed');
            }
        }

        // Form validation kuralları
        $this->form_validation->set_rules('book_title', 'Kitap Başlığı', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('writer', 'Yazar', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('year', 'Yıl', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('stock', 'Stok', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('price', 'Fiyat', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['content'] = "kitap_ekle";
            $data['error'] = validation_errors();
            $this->load->view('sablon', $data);
        } else {
            if($this->dashboard->save_book()) {
                redirect('kitaplar');
            } else {
                $data['content'] = "kitap_ekle";
                $data['error'] = 'Kitap eklenirken bir hata oluştu.';
                $this->load->view('sablon', $data);
            }
        }
    }
}

/* End of file Kontrol.php */
/* Location: ./application/controllers/Kontrol.php */
?>