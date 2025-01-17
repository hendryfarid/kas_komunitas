<?php

class c_laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // $this->load->helper(array('form', 'url'));
        $this->load->model('Laporan_model');
    }
    public function cetak_laptrans($thn, $bln)
    {
        $this->load->library('mypdf');

        $data['blnnya'] = $bln;
        $data['thn'] = $thn;

        $thnpilihan1 = $thn . '-' . '0' . $bln . '-' . '01';
        $thnpilihan2 = $thn . '-' . '0' . $bln . '-' . '31';

        $data['transaksi'] = $this->Laporan_model->getAlllaporan($thnpilihan1, $thnpilihan2);
        $this->mypdf->generate('laporan/cetak.php', $data);
    }

    public function cetak_lapSimAng($id)
    {
        $this->load->library('mypdf');

        ///meenghubungkan data tabel user dan anggota
        $data['anggota_'] =  $this->db->get_where('anggota', ['id_anggota' =>
        $id])->row_array();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['simpanan_'] =  $this->db->get_where('simpanan', ['id_anggota' =>
        $id])->result_array();
        $this->mypdf->generate('laporan/cetak_sim_ang.php', $data);


        // $data['simpanan_'] =  $this->db->get_where('simpanan', ['id_anggota' =>
        // $id_anggota])->result_array();


    }

    public function cetak_Rekap()
    {
        $this->load->library('mypdf');
        $data['list_th'] = $this->Laporan_model->getTahun();
        $data['list_bln'] = $this->Laporan_model->getBln();
        $data['totsim'] = $this->Laporan_model->getTotSimpanan();
        $this->mypdf->generate('laporan/cetak_rekap.php', $data);
    }
}
