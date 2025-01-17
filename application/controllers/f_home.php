<?php

class f_home extends CI_Controller
{

    public function index()
    {

        $data['kategori_ber'] =  $this->db->get_where('kategori_berita')->result_array();

        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/home/index');
        $this->load->view('frontend/template/footer');
        // $this->load->view('template/sidebar');
    }
    public function visimisi()
    {

        $data['kategori_ber'] =  $this->db->get_where('kategori_berita')->result_array();

        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/home/visimisi');
        $this->load->view('frontend/template/footer');
        // $this->load->view('template/sidebar'); 
    }
}
