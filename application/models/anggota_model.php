<?php

class anggota_model extends CI_Model
{
    public function getAllAnggota()
    {

        return $this->db->get('anggota')->result_array();
    }

    public function getAnggota($limit, $start, $keyword = null) ///tidak dipakai untuk pagnition role user
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('email', $keyword);
        }
        return $this->db->get('anggota', $limit, $start)->result_array();
    }


    public function getAnggMax($id)
    {

        // $this->db->select_max('angsuran');
        // $this->db->get_where('simpanan', ['id_anggota' => $id])->row_array();
        // $this->db->get('simpanan');
        $sql = "SELECT max(angsuran) as angsuran FROM simpanan where id_anggota= '$id'";
        $result = $this->db->query($sql);
        return $result->row()->angsuran;
    }

    //////karena kita sudah mencari berdasarkan pagination maka method ini tidak terpakai lagi sudah d folder config

    // public function getCountRowPeople()
    // {
    //     return $this->db->get('anggota')->num_rows();
    // }
}
