<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

    public function get_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->db->get_where('user', array('username' => $username))->row();
        
        if ($user && password_verify($password, $user->password)) {
            // Giriş başarılı
            $data = array(
                'user_id' => $user->user_id,
                'username' => $user->username,
                'fullname' => $user->fullname,
                'level' => $user->level,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($data);
            return TRUE;
        }
        return FALSE;
    }

    public function get_register()
    {
        $regis = array(
            'username'  => $this->input->post('username'),
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'fullname'  => $this->input->post('fullname'),
            'level'     => $this->input->post('level') == 'cashier' ? 'müşteri' : $this->input->post('level'),
        );
        
        $this->db->insert('user', $regis);
        return ($this->db->affected_rows() != 0) ? TRUE : FALSE;
    }
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */