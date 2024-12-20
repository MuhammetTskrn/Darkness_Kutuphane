<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_category extends CI_Model {

    public function get_category()
    {
        return $this->db->get('book_category')->result();
    }

    public function save_category()
    {
        $object = array(
            'category_code' => $this->input->post('category_code'),
            'category_name' => $this->input->post('category_name')
        );
        return $this->db->insert('book_category', $object);
    }

    public function get_category_id($id)
    {
        return $this->db->where('category_code', $id)
                        ->get('book_category')
                        ->row();
    }

    public function category_update()
    {
        $object = array(
            'category_code' => $this->input->post('category_code'),
            'category_name' => $this->input->post('category_name')
        );
        return $this->db->where('category_code', $this->input->post('category_code_lama'))
                        ->update('book_category', $object);
    }

    public function delete_category($id)
    {
        return $this->db->where('category_code', $id)
                        ->delete('book_category');
    }
}

/* End of file M_category.php */
/* Location: ./application/models/M_category.php */