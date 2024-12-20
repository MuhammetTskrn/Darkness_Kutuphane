<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_book extends CI_Model {

    public function get_book()
    {
        return $this->db->join('book_category','book_category.category_code=book.category_code')
                        ->get('book')
                        ->result();
    }

    public function data_category()
    {
        return $this->db->get('book_category')->result();
    }

    public function save_book($nama_file)
    {
        $object = array(
            'book_title' => $this->input->post('book_title'),
            'year' => $this->input->post('year'),
            'price' => $this->input->post('price'),
            'category_code' => $this->input->post('category'),
            'publisher' => $this->input->post('publisher'),
            'writer' => $this->input->post('writer'),
            'stock' => $this->input->post('stock')
        );

        if ($nama_file != "") {
            $object['book_img'] = $nama_file;
        }

        return $this->db->insert('book', $object);
    }

    public function get_book_id($id)
    {
        return $this->db->join('book_category', 'book_category.category_code=book.category_code')
                        ->where('book_code', $id)
                        ->get('book')
                        ->row();
    }

    public function detail($id)
    {
        return $this->db->join('book_category', 'book_category.category_code=book.category_code')
                        ->where('book_code', $id)
                        ->get('book')
                        ->row();
    }

    public function book_update()
    {
        $object = array(
            'book_title' => $this->input->post('book_title'),
            'year' => $this->input->post('year'),
            'price' => $this->input->post('price'),
            'category_code' => $this->input->post('category'),
            'publisher' => $this->input->post('publisher'),
            'writer' => $this->input->post('writer'),
            'stock' => $this->input->post('stock')
        );

        if ($_FILES['gambar']['name'] != "") {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('gambar')) {
                $object['book_img'] = $this->upload->data('file_name');
            }
        }

        return $this->db->where('book_code', $this->input->post('book_code'))
                        ->update('book', $object);
    }

    public function delete_book($book_code)
    {
        return $this->db->where('book_code', $book_code)
                        ->delete('book');
    }
}

/* End of file M_book.php */
/* Location: ./application/models/M_book.php */