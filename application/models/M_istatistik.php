<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_istatistik extends CI_Model {
    
    // Manuel model örneği - İstatistikleri getir
    public function get_stats()
    {
        // Toplam kitap sayısı
        $total_books = $this->db->count_all('book');
        
        // Toplam kategori sayısı
        $total_categories = $this->db->count_all('book_category');
        
        // En çok okunan kitaplar (manuel SQL sorgusu)
        $most_read = $this->db->query("
            SELECT b.book_title, COUNT(t.transaction_id) as read_count 
            FROM book b 
            LEFT JOIN transaction t ON b.book_id = t.book_id 
            GROUP BY b.book_id 
            ORDER BY read_count DESC 
            LIMIT 5
        ")->result();
        
        return array(
            'total_books' => $total_books,
            'total_categories' => $total_categories,
            'most_read' => $most_read
        );
    }
}

/* End of file M_istatistik.php */
/* Location: ./application/models/M_istatistik.php */
