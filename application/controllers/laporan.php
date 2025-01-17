<?php

class laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); //membuat sebuah validation
        // $this->load->helper(array('form', 'url'));
        $this->load->model('Laporan_model');
        is_logged_in();
    }

    public function index()
    {
        $thn = $this->input->post('th');
        $bln = $this->input->post('bln');
        $data['title'] = 'Rekap Bulanan';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        if (empty($thn) || empty($bln)) {
            $data['list_th'] = $this->Laporan_model->getTahun();
            $data['list_bln'] = $this->Laporan_model->getBln();

            $data['blnnya'] = $bln;
            $data['thn'] = $thn;

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('template/footer');
        } else {

            $data['title'] = 'Laporan Keuangan';
            $data['user'] =  $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['blnnya'] = $bln;
            $data['thn'] = $thn;

            $thnpilihan1 = $thn . '-' . '0' . $bln . '-' . '01';
            $thnpilihan2 = $thn . '-' . '0' . $bln . '-' . '31';


            $data['transaksi'] = $this->Laporan_model->getAlllaporan($thnpilihan1, $thnpilihan2);

            ///
            $data['list_th'] = $this->Laporan_model->getTahun();
            $data['list_bln'] = $this->Laporan_model->getBln();




            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('template/footer');
        }
    }


    public function rekap()
    {


        $data['title'] = 'Rekap Tahunan';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['list_th'] = $this->Laporan_model->getTahun();
        $data['list_bln'] = $this->Laporan_model->getBln();
        $data['totsim'] = $this->Laporan_model->getTotSimpanan();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/rekapitulasi', $data);
        $this->load->view('template/footer');
    }
}
