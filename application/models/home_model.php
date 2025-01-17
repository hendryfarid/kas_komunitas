<?php


class home_model extends CI_model
{
    // public function getJumPem()
    // {
    //     $sql = "SELECT sum(pemasukan) as pemasukan FROM history_trans";
    //     $result = $this->db->query($sql);
    //     return $result->row()->pemasukan;
    // }

    // public function getJumPeng()
    // {
    //     $sql = "SELECT sum(pengeluaran) as pengeluaran FROM history_trans";
    //     $result = $this->db->query($sql);
    //     return $result->row()->pengeluaran;
    // }

    public function getJumSim()
    {
        $sql = "SELECT sum(jumlah) as jsimpanan FROM simpanan";
        $result = $this->db->query($sql);
        return $result->row()->jsimpanan;
    }
}
