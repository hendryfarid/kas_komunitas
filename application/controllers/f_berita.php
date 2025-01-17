<?php

class f_berita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Berita_model'); // berguna untuk mengarahkan ke model
        $this->load->library('form_validation'); //membuat sebuah validation

    }

    public function berita($namket)
    {
        $data['kategori_ber'] =  $this->db->get_where('kategori_berita')->result_array();
        // var_dump($data1);
        // die;

        // $data['detailberita'] =  $this->db->get_where('berita', ['kategori' =>
        // $namket])->result_array();

        // var_dump($data1);
        // die;

        //pagination load libraruy
        $this->load->library('pagination');


        //ambil data keyword
        if ($this->input->post('submit_')) {

            $data['keyword_berita'] = $this->input->post('keyword_berita');
            $this->session->set_userdata('keyword_berita', $data['keyword_berita']);
        } else {
            $data['keyword_berita'] = $this->session->userdata('keyword_berita');
        }


        //configuration
        $this->db->like('judul', $data['keyword_berita']);
        $this->db->or_like('isi', $data['keyword_berita']);
        $this->db->from('berita');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 6;
        // $config['base_url'] = 'http://localhost/koperasi/f_berita/berita/' . $namket;
        $config['base_url'] =   base_url().'f_berita/berita/' . $namket;

        $config['num_links'] = 3;
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = ' </ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        //initialize 
        $this->pagination->initialize($config);



        $data['start'] = $this->uri->segment(4);
        $data['infokat'] = $namket;
        $data['detailberita'] = $this->Berita_model->getfBerita($namket, $config['per_page'],  $data['start'], $data['keyword_berita']); //untuk pagination 12=menmpilan 12 baris, 30=dimulai dari datar 31.





        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/berita/index', $data);
        $this->load->view('frontend/template/footer');
        // $this->load->view('template/sidebar');
    }
    public function detail($id)
    {
        $data['kategori_ber'] =  $this->db->get_where('kategori_berita')->result_array();
        $data['title'] = 'Kelola Berita';
        $data['berita'] = $this->Berita_model->getBeritaById($id);
        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/berita/detail', $data);
        $this->load->view('frontend/template/footer');
    }
}
