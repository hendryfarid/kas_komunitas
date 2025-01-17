<?php

class admin extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model'); //kemodel simpanan
        $this->load->library('form_validation'); //membuat sebuah validation
        // $this->load->helper(array('form', 'url'));
        $this->load->model('Kategori_model');
        is_logged_in();
    }
    public function index()
    {
        // $data['judul'] = 'Halaman Home';

        // $this->load->view('template/header', $data);
        // $this->load->view('home/index', $data);
        // $this->load->view('template/footer');

        //sbadmin

        $data['title'] = 'Dashboard';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        ///total keseluruhan berita
        $data['totber'] = $this->db->count_all('berita');
        ///total keseluruhan anggota
        $data['jumlah_ang'] = $this->db->count_all('anggota');
        //anggota yang aktif
        $this->db->like('status', '1');
        $this->db->from('anggota');
        $data['jumang_ak'] = $this->db->count_all_results();
        //anggota yang tidak aktif
        $this->db->like('status', '0');
        $this->db->from('anggota');
        $data['jumang_ta'] = $this->db->count_all_results();
        //total pemasukan
        // $data['jum_pem'] = $this->home_model->getJumPem();
        // //total pengeluaran
        // $data['jum_peng'] = $this->home_model->getJumPeng();
        // // var_dump($dataq);
        // // die;
        //jumlah simpanan
        $data['jum_sim'] = $this->home_model->getJumSim();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('template/footer');
    }
}
