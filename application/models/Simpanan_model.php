<?php


class Simpanan_model extends CI_model
{
    public function getAllSimpanan()
    {
        //cara1
        // $query = $this->db->get('berita');
        // return $query->result_array();

        //cara 2
        return $this->db->get('simpanan')->result_array();
        $query = $this->db->get('simpanan');
    }

    public function getKomAng()
    {
        $sql = "SELECT anggota.*, sum(simpanan.jumlah) as totaljumlah FROM anggota,simpanan where anggota.id_anggota=
        simpanan.id_anggota group by anggota.id_anggota";
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function getRinAng() //rincian anggota
    {
        $sql = "SELECT anggota.nama, simpanan.angsuran  FROM anggota,simpanan where anggota.id_anggota=
        simpanan.id_anggota";
        $result = $this->db->query($sql);
        return $result->result_array();
    }



    public function getAnggSim()
    {

        return $this->db->get('anggota')->result_array();
    }
    public function getAnggMax($id)
    {

        $sql = "SELECT max(angsuran) as angsuran FROM simpanan where id_anggota= '$id'";
        $result = $this->db->query($sql);
        return $result->row()->angsuran;
    }
}
