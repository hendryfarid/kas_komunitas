<?php

class Berita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Berita_model'); // berguna untuk mengarahkan ke model
        $this->load->library('form_validation'); //membuat sebuah validation
        // $this->load->helper(array('form', 'url'));
        $this->load->model('Kategori_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Kelola Berita';
        // $data['berita'] = $this->Berita_model->getAllBerita();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // $this->load->model('Berita_model'); //load model

        //pagination load libraruy
        $this->load->library('pagination');


        //ambil data keyword
        if ($this->input->post('submit_')) {
            // $data['berita'] = $this->Berita_model->getCariBerita();

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
        $config['per_page'] = 4;
        $config['base_url'] = base_url().'berita/index';
 

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



        $data['start'] = $this->uri->segment(3);
        $data['berita'] = $this->Berita_model->getBerita($config['per_page'], $data['start'], $data['keyword_berita']); //untuk pagination 12=menmpilan 12 baris, 30=dimulai dari datar 31.

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('berita/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Kelola Berita';
        // $data['berita'] = $this->Berita_model->getAllBerita();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['list_kategori'] = $this->db->get('kategori_berita')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('berita/tambah', $data);
        $this->load->view('template/footer');
    }

    public function tambah_data()
    {
        $data['title'] = 'Kelola Berita';
        // $data['berita'] = $this->Berita_model->getAllBerita();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['list_kategori'] = $this->db->get('kategori_berita')->result_array();
        $config['upload_path']          = './gambar/berita/';
        $config['allowed_types']        = 'gif|jpg|png|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;


        $this->load->library('upload', $config);
        $this->form_validation->set_rules('judul', 'judul', 'required', [
            'required' => 'judul belum diisi!'
        ]);
        $this->form_validation->set_rules('isi', 'isi', 'required', [
            'required' => 'judul belum diisi!'
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required', [
            'required' => 'judul belum diisi!'
        ]);
        $this->form_validation->set_rules('tanggal_publish', 'judul', 'required', [
            'required' => 'judul belum diisi!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('berita/tambah', $data);
            $this->load->view('template/footer');
        } else {
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('berita/tambah', $error);
            } else {
                $gambar = $this->upload->data();
                $gambar = $gambar['file_name'];
                $judul = $this->input->post('judul', true);
                $isi = $this->input->post('isi', true);
                $kategori = $this->input->post('kategori', true);
                $tanggal_publish = $this->input->post('tanggal_publish', true);

                $data = array(
                    'judul' => $judul,
                    'isi' => $isi,
                    'kategori' => $kategori,
                    'tanggal_publish' => $tanggal_publish,
                    'gambar' => $gambar,

                );
                $this->db->insert('berita', $data);
                $this->session->set_flashdata('flash', ' Berhasil Ditambahkan');
                redirect('berita');
            }
        }
    }

    public function hapus($id)
    {
        $this->Berita_model->hapusdataberita($id);
        $this->session->set_flashdata('flash', ' Berhasil Dihapus');
        redirect('berita ');
    }

    public function detail($id)
    {
        $data['title'] = 'Kelola Berita';
        $data['berita'] = $this->Berita_model->getBeritaById($id);
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('berita/detail', $data);
        $this->load->view('template/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Kelola Berita';
        $data['berita'] = $this->Berita_model->getBeritaById($id);
        $data['kategori'] = $this->db->get('kategori_berita')->result_array();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('berita/edit', $data);
            $this->load->view('template/footer');
        } else {
            //jika ada gambar diupload
            $upload_image = $_FILES['userfile']['name'];


            if ($upload_image) {
                $config['upload_path']          = './gambar/berita/';
                $config['allowed_types']        = 'gif|jpg|png|PNG';
                $config['max_size']             = 10000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userfile')) {
                    $new_image = $this->upload->data('file_name');
                    $data = $this->db->set('gambar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            //tanpa model
            $data = [
                "judul" => $this->input->post('judul', true),
                "isi" => $this->input->post('isi', true),
                "kategori" => $this->input->post('kategori', true),
                "tanggal_publish" => $this->input->post('tanggal_publish', true)
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('berita', $data);


            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('flash', 'Berhasil diedit');
            redirect('berita ');
        }
    }



    ////untuk kategori
    public function index_kategori()
    {


        $data['title'] = 'Kategori';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->Kategori_model->getAllKategori();



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('template/footer');
    }


    public function tambah_kategori()
    {
        $data['title'] = 'Kategori';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->Kategori_model->getAllKategori();

        $this->form_validation->set_rules('kategori_nama', 'Kategori_nama', 'required', [
            'required' => 'Kategori belum diisi!'
        ]);

        $this->form_validation->set_rules('id_kategori', 'Id_kategori', 'required', [
            'required' => 'Id Kategori belum diisi!'
        ]);

        $id_kategori = $this->input->post('id_kategori', true);
        $kategori_nama = $this->input->post('kategori_nama', true);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('kategori/tambah', $data);
            $this->load->view('template/footer');
        } else {

            $data = array(
                'id_kategori' => $id_kategori,
                'kategori' => $kategori_nama,
            );

            $this->db->insert('kategori_berita', $data);
            $this->session->set_flashdata('flash', ' Berhasil Ditambahkan');
            redirect('berita/index_kategori');
        }
    }

    public function hapus_kategori($id)
    {

        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori_berita');
        $this->session->set_flashdata('flash', ' Berhasil Dihapus');
        redirect('berita/index_kategori');
    }



    public function kategori_edit($id)
    {
        $data['title'] = 'Kategori';
        $data['kategori'] = $this->db->get_where('kategori_berita', ['id_kategori' => $id])->row_array();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
        $this->form_validation->set_rules('kategori_nama', 'kategori_nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('kategori/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                "id_kategori" => $this->input->post('id_kategori', true),
                "kategori" => $this->input->post('kategori_nama', true),
            ];

            $this->db->where('id_kategori', $this->input->post('id_kategori'));
            $this->db->update('kategori_berita', $data);


            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('flash', 'Berhasil diedit');
            redirect('berita/index_kategori');
        }
    }
}
