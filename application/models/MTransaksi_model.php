<?php


class MTransaksi_model extends CI_model
{
    public function getAllKasMsk()
    {
        //cara1
        // $query = $this->db->get('berita');
        // return $query->result_array();

        //cara 2
        return $this->db->get('kas_masuk')->result_array();
        // $query = $this->db->get('kategori_berita');
    }
    public function getAllKasKlr()
    {
        return $this->db->get('kas_keluar')->result_array();
    }

    public function getAllTrans()
    {
        return $this->db->get('transaksi')->result_array();
    }
}
