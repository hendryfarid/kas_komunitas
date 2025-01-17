<?php


class Kategori_model extends CI_model
{
    public function getAllKategori()
    {
        //cara1
        // $query = $this->db->get('berita');
        // return $query->result_array();

        //cara 2
        return $this->db->get('kategori_berita')->result_array();
        // $query = $this->db->get('kategori_berita');
    }
}
