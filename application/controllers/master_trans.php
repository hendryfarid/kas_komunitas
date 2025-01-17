<?php

class Master_trans extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); //membuat sebuah validation
        // $this->load->helper(array('form', 'url'));
        $this->load->model('MTransaksi_model');
        is_logged_in();
    }


    ////untuk kas_masuk
    public function index_kas_masuk()
    {


        $data['title'] = 'Kas Masuk';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kas_msk'] = $this->MTransaksi_model->getAllKasMsk();



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('master_transaksi/kas_masuk/index', $data);
        $this->load->view('template/footer');
    }
    public function tambah_kas_msk()
    {
        $data['title'] = 'Kas Masuk';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id_kas', 'id_kas', 'required', [
            'required' => 'id_kas belum diisi!'
        ]);

        $this->form_validation->set_rules('nama_kas', 'nama_kas', 'required', [
            'required' => 'nama kas belum diisi!'
        ]);

        $id_kas = $this->input->post('id_kas', true);
        $nama_kas = $this->input->post('nama_kas', true);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master_transaksi/kas_masuk/tambah', $data);
            $this->load->view('template/footer');
        } else {

            $data = array(
                'id_kas' => $id_kas,
                'nama_kas' => $nama_kas,
            );

            $this->db->insert('kas_masuk', $data);
            $this->session->set_flashdata('flash', ' Berhasil Ditambahkan');
            redirect('master_trans/index_kas_masuk');
        }
    }
    public function edit_kas_masuk($id)
    {
        $data['title'] = 'Kas Masuk';
        $data['ksm'] = $this->db->get_where('kas_masuk', ['id_kas' => $id])->row_array();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('nama_kas', 'nama_kas', 'required', [
            'required' => 'nama kas belum diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master_transaksi/kas_masuk/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                "id_kas" => $this->input->post('id_kas', true),
                "nama_kas" => $this->input->post('nama_kas', true),
            ];

            $this->db->where('id_kas', $this->input->post('id_kas'));
            $this->db->update('kas_masuk', $data);


            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('flash', 'Berhasil diedit');
            redirect('master_trans/index_kas_masuk');
        }
    }

    public function hapus_kas_masuk($id)
    {

        $this->db->where('id_kas', $id);
        $this->db->delete('kas_masuk');
        $this->session->set_flashdata('flash', ' Berhasil Dihapus');
        redirect('master_trans/index_kas_masuk');
    }


    ////untuk kas_keluar
    public function index_kas_keluar()
    {


        $data['title'] = 'Kas Keluar';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kas_klr'] = $this->MTransaksi_model->getAllKasKlr();



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('master_transaksi/kas_keluar/index', $data);
        $this->load->view('template/footer');
    }
    public function tambah_kas_keluar()
    {
        $data['title'] = 'Kas Keluar';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id_kas', 'id_kas', 'required', [
            'required' => 'id_kas belum diisi!'
        ]);

        $this->form_validation->set_rules('nama_kas', 'nama_kas', 'required', [
            'required' => 'nama kas belum diisi!'
        ]);

        $id_kas = $this->input->post('id_kas', true);
        $nama_kas = $this->input->post('nama_kas', true);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master_transaksi/kas_keluar/tambah', $data);
            $this->load->view('template/footer');
        } else {

            $data = array(
                'id_kas' => $id_kas,
                'nama_kas' => $nama_kas,
            );

            $this->db->insert('kas_keluar', $data);
            $this->session->set_flashdata('flash', ' Berhasil Ditambahkan');
            redirect('master_trans/index_kas_keluar');
        }
    }
    public function edit_kas_keluar($id)
    {
        $data['title'] = 'Kas Keluar';
        $data['ksm'] = $this->db->get_where('kas_keluar', ['id_kas' => $id])->row_array();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('nama_kas', 'nama_kas', 'required', [
            'required' => 'nama kas belum diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master_transaksi/kas_keluar/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                "id_kas" => $this->input->post('id_kas', true),
                "nama_kas" => $this->input->post('nama_kas', true),
            ];

            $this->db->where('id_kas', $this->input->post('id_kas'));
            $this->db->update('kas_keluar', $data);


            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('flash', 'Berhasil diedit');
            redirect('master_trans/index_kas_keluar');
        }
    }

    public function hapus_kas_keluar($id)
    {

        $this->db->where('id_kas', $id);
        $this->db->delete('kas_keluar');
        $this->session->set_flashdata('flash', ' Berhasil Dihapus');
        redirect('master_trans/index_kas_keluar');
    }




    ////untuk Transaksi
    public function index_trans()
    {


        $data['title'] = 'Transaksi';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kmsk'] =  $this->db->get_where('kas_masuk')->result_array();
        $data['kklr'] =  $this->db->get_where('kas_keluar')->result_array();
        $data['transaksi'] = $this->MTransaksi_model->getAllTrans();



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('master_transaksi/transaksi/index', $data);
        $this->load->view('template/footer');
    }
    public function tambah_trans()
    {
        $data['title'] = 'Transaksi';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['kmsk'] =  $this->db->get_where('kas_masuk')->result_array();
        $data['kklr'] =  $this->db->get_where('kas_keluar')->result_array();

        $this->form_validation->set_rules('id_trans', 'id_trans', 'required', [
            'required' => 'id_trans belum diisi!'
        ]);

        $this->form_validation->set_rules('tanggal', 'tanggal', 'required', [
            'required' => 'tanggal belum diisi!'
        ]);


        $jenis_kas1 = $this->input->post('jenis_kas', true);
        if ($jenis_kas1 == 'Kas Masuk') {
            $kas_msk = $this->input->post('kas_masuk', true);
            $kas_klr = '-';
            $this->form_validation->set_rules('kas_masuk', 'kas_masuk', 'required', [
                'required' => 'kas masuk belum diisi!'
            ]);
        } else if ($jenis_kas1 == 'Kas Keluar') {
            $kas_klr = $this->input->post('kas_keluar', true);
            $kas_msk = '-';
            $this->form_validation->set_rules('kas_keluar', 'kas_keluar', 'required', [
                'required' => 'kas keluar belum diisi!'
            ]);
        } else if ($jenis_kas1 == null) {
            $this->form_validation->set_rules('jenis_kas', 'jenis_kas', 'required', [
                'required' => 'Jenis Kas belum terpilih!'
            ]);
        }

        $id_trans = $this->input->post('id_trans', true);
        $tanggal = $this->input->post('tanggal', true);
        $jenis_kas = $this->input->post('jenis_kas', true);

        $keterangan = $this->input->post('keterangan', true);
        $jumlah = $this->input->post('jumlah', true);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master_transaksi/transaksi/tambah', $data);
            $this->load->view('template/footer');
        } else {

            $data = array(
                'id_trans' => $id_trans,
                'tanggal' => $tanggal,
                'jenis_kas' => $jenis_kas,
                'kas_masuk' => $kas_msk,
                'kas_keluar' => $kas_klr,
                'keterangan' => $keterangan,
                'jumlah' => $jumlah,
            );

            $this->db->insert('transaksi', $data);


            if ($jenis_kas1 == 'Kas Masuk') {
                $kas_msk = $this->input->post('jumlah', true);
                $kas_klr = 0;
                $this->form_validation->set_rules('kas_masuk', 'kas_masuk', 'required', [
                    'required' => 'kas masuk belum diisi!'
                ]);
            } else if ($jenis_kas1 == 'Kas Keluar') {
                $kas_klr = $this->input->post('jumlah', true);
                $kas_msk = 0;
                $this->form_validation->set_rules('kas_keluar', 'kas_keluar', 'required', [
                    'required' => 'kas keluar belum diisi!'
                ]);
            }

            $data1 = array(
                'id_trans' => $id_trans,
                'pemasukan' => $kas_msk,
                'pengeluaran' => $kas_klr,
            );
            $this->db->insert('history_trans', $data1);
            $this->session->set_flashdata('flash', ' Berhasil Ditambahkan');
            redirect('master_trans/index_trans');
        }
    }
    public function edit_trans($id)
    {
        $data['title'] = 'Transaksi';
        $data['stat_jekas'] = ['Kas Masuk', 'Kas Keluar'];
        $data['transaksi'] = $this->db->get_where('transaksi', ['id_trans' => $id])->row_array();
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kmsk'] =  $this->db->get_where('kas_masuk')->result_array();
        $data['kklr'] =  $this->db->get_where('kas_keluar')->result_array();


        $this->form_validation->set_rules('id_trans', 'id_trans', 'required', [
            'required' => 'id_trans belum diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master_transaksi/transaksi/edit', $data);
            $this->load->view('template/footer');
        } else {
            $jenis_kas1 = $this->input->post('jenis_kas', true);
            if ($jenis_kas1 == 'Kas Masuk') {
                $kas_msk = $this->input->post('kas_masuk', true);
                $kas_klr = '-';
            } else {
                $kas_klr = $this->input->post('kas_keluar', true);
                $kas_msk = '-';
            }


            $data = [

                "tanggal" => $this->input->post('tanggal', true),
                "jenis_kas" => $this->input->post('jenis_kas', true),
                "kas_masuk" => $kas_msk,
                "kas_keluar" => $kas_klr,
                "keterangan" => $this->input->post('keterangan', true),
                "jumlah" => $this->input->post('jumlah', true),
            ];

            $this->db->where('id_trans', $this->input->post('id_trans'));
            $this->db->update('transaksi', $data);


            // $this->Berita_model->editDataBerita();
            if ($jenis_kas1 == 'Kas Masuk') {
                $kas_msk = $this->input->post('jumlah', true);
                $kas_klr = 0;
                $this->form_validation->set_rules('kas_masuk', 'kas_masuk', 'required', [
                    'required' => 'kas masuk belum diisi!'
                ]);
            } else if ($jenis_kas1 == 'Kas Keluar') {
                $kas_klr = $this->input->post('jumlah', true);
                $kas_msk = 0;
                $this->form_validation->set_rules('kas_keluar', 'kas_keluar', 'required', [
                    'required' => 'kas keluar belum diisi!'
                ]);
            }

            $data1 = array(
                'pemasukan' => $kas_msk,
                'pengeluaran' => $kas_klr,
            );
            $this->db->where('id_trans', $this->input->post('id_trans'));
            $this->db->update('history_trans', $data1);

            $this->session->set_flashdata('flash', 'Berhasil diedit');
            redirect('master_trans/index_trans');
        }
    }

    public function hapus_trans($id)
    {

        $this->db->where('id_trans', $id);
        $this->db->delete('transaksi');

        $this->session->set_flashdata('flash', ' Berhasil Dihapus');
        redirect('master_trans/index_trans');
    }
}
