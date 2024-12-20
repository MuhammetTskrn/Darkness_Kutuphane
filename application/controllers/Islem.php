<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Islem extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaction', 'transaction');
        $this->load->model('M_book', 'book');
        $this->load->library('cart');
    }

    public function index()
    {
        $data['get_transaction'] = $this->transaction->get_transaction();
        $data['get_book'] = $this->book->get_book();
        $data['transaction'] = $this->transaction->tm_transaction();
        $data['content'] = "g_islem";
        $this->load->view('sablon', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('book_code', 'book_code', 'trim|required');
        $this->form_validation->set_rules('member_id', 'member_id', 'trim|required');
        $this->form_validation->set_rules('borrow_date', 'borrow_date', 'trim|required');
        $this->form_validation->set_rules('return_date', 'return_date', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if ($this->transaction->save_transaction()) {
                $this->session->set_flashdata('message', 'İşlem başarıyla eklendi');
            } else {
                $this->session->set_flashdata('message', 'İşlem eklenemedi');
            }
            redirect('islem', 'refresh');
        } else {
            $this->session->set_flashdata('message', validation_errors());
            redirect('islem', 'refresh');
        }
    }

    public function update()
    {
        if ($this->transaction->transaction_update()) {
            $this->session->set_flashdata('message', 'İşlem detayları başarıyla güncellendi.');
            redirect('islem');
        } else {
            $this->session->set_flashdata('message', 'Güncelleme başarısız');
            redirect('islem');
        }
    }

    public function delete($transaction_id)
    {
        if ($this->transaction->hapus_transaction($transaction_id)) {
            $this->session->set_flashdata('message', 'İşlem başarıyla silindi.');
            redirect('islem', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Silme başarısız');
            redirect('islem', 'refresh');
        }
    }

    public function addcart($id)
    {
        $book = $this->book->detail($id);
        $data = array(
            'id'      => $book->book_code,
            'qty'     => 1,
            'price'   => $book->price,
            'name'    => $book->book_title
        );
        $this->cart->insert($data);
        redirect('islem');
    }

    public function delete_cart($rowid)
    {
        $this->cart->remove($rowid);
        redirect('islem');
    }

    public function clearcart()
    {
        $this->cart->destroy();
        redirect('islem');
    }

    public function save()
    {
        if ($this->input->post('update')) {
            for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
                $data = array(
                    'rowid' => $this->input->post('rowid')[$i],
                    'qty'   => $this->input->post('qty')[$i]
                );
                $this->cart->update($data);
            }
            redirect('islem');
        } elseif ($this->input->post('pay')) {
            if (empty($this->input->post('user_code')) || empty($this->input->post('buyer_name'))) {
                $this->session->set_flashdata('error', 'Kasiyer ve Müşteri Adı alanları doldurulmalıdır!');
                redirect('islem');
            }

            $transaction_code = $this->transaction->save_cart_db();
            if ($transaction_code) {
                $this->cart->destroy();
                redirect('islem/nota/' . $transaction_code);
            }
        }
    }

    public function nota($id)
    {
        $data['nota'] = $this->transaction->detail_note($id);
        $data['detail_transaction'] = $this->transaction->detail_transaction($id);
        $this->load->view('nota', $data);
    }
}

/* End of file Islem.php */
/* Location: ./application/controllers/Islem.php */