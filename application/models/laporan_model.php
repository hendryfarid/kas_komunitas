<?php


class laporan_model extends CI_model
{
    public function getAlllaporan($tgl1, $tgl2)
    {

        // $query = "SELECT transaksi.*, history_trans.pemasukan as spemasukan,history_trans.pengeluaran as spengeluaran FROM transaksi,history_trans WHERE transaksi.id_trans = history_trans.id_trans and tanggal between $tgl1 and $tgl2;
        // return $this->db->query($query)->result_array();

        $sql = "SELECT transaksi.*, history_trans.pemasukan as spemasukan,history_trans.pengeluaran as spengeluaran 
        FROM transaksi,history_trans WHERE transaksi.id_trans = history_trans.id_trans 
        and tanggal between '$tgl1' and '$tgl2'";
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    public function getTotSimpanan()
    {


        $sql = "SELECT sum(jumlah) as totaljumlah FROM simpanan";
        $result = $this->db->query($sql);
        return $result->row()->totaljumlah;
    }
    // //awalsimpanan combobox
    // public function getSimpAwal($th1, $th2)
    // {


    //     $sql = "SELECT sum(history_trans.pemasukan) - sum(history_trans.pengeluaran) as saldoawal from history_trans, transaksi where history_trans.id_trans=transaksi.id_trans and tanggal between '$th1' and '$th2'";
    //     $result = $this->db->query($sql);

    //     return $result->row()->saldoawal;
    // }


    public function getTahun()
    {
        $this->db->select('year(tanggal) as th');
        $this->db->from('transaksi');
        $this->db->group_by('year(tanggal)');
        return $this->db->get()->result_array();
    }
    public function getBln()
    {
        $this->db->select('month(tanggal) as bln');
        $this->db->from('transaksi');
        $this->db->group_by('month(tanggal)');
        return $this->db->get()->result_array();
    }


    public function getBlnThn()
    {
        $this->db->select('month(tanggal) as bln');
        $this->db->select('year(tanggal) as th');
        $this->db->from('transaksi');
        $this->db->group_by('month(tanggal)');
        return $this->db->get()->result_array();
    }
}
