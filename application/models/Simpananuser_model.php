<?php


class Simpananuser_model extends CI_model
{

    public function getSimpananById($id)
    {
        return $this->db->get_where('anggota', ['id_anggota' => $id])->row_array();
    }
}
