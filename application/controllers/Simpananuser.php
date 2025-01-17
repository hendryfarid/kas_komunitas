<?php

class Simpananuser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation'); //membuat sebuah validation
        $this->load->helper(array('form', 'url'));
        // $this->load->model('Kategori_model');
        $this->load->model('Simpananuser_model'); // berguna untuk mengarahkan ke model
        is_logged_in();
    }


    public function index()
    {

        $data['title'] = 'Simpanan';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        ///meenghubungkan data tabel user dan anggota
        $id = $this->session->userdata('id');
        $data['anggota_'] =  $this->db->get_where('anggota', ['id_user' =>
        $id])->row_array();

        $id_anggota_relasi = $this->db->get_where('anggota', ['id_user' =>
        $id])->row_array();
        $data['simpanan_'] =  $this->db->get_where('simpanan', ['id_anggota' =>
        $id_anggota_relasi['id_anggota']])->result_array();


        // $data['simpanan_'] =  $this->db->get_where('simpanan', ['id_anggota' =>
        // $id_anggota])->result_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('simpananuser/index', $data);
        $this->load->view('template/footer');
    }


    public function edit($id)
    {
        $data['title'] = 'Simpanan';
        $data['anggota'] = $this->Simpananuser_model->getSimpananById($id);
        $data['jekel'] = ['L', 'P'];
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('simpananuser/edit', $data);
            $this->load->view('template/footer');
        } else {
            //jika ada gambar diupload

            //upload foto
            $upload_image = $_FILES['userfilefoto']['name'];
            if ($upload_image) {
                $config['upload_path']          = './gambar/fotoanggota/';
                $config['allowed_types']        = 'gif|jpg|png|PNG';
                $config['max_size']             = 10000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userfilefoto')) {
                    $new_image = $this->upload->data('file_name');
                    $data = $this->db->set('Foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            //upload foto ktp
            $upload_image = $_FILES['userfilektp']['name'];
            if ($upload_image) {
                $config['upload_path']          = './gambar/fotoanggota/';
                $config['allowed_types']        = 'gif|jpg|png|PNG';
                $config['max_size']             = 10000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userfilektp')) {
                    $new_image = $this->upload->data('file_name');
                    $data = $this->db->set('foto_ktp', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }





            //tanpa model
            $data = [
                "nama" => $this->input->post('nama', true),
                "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
                "alamat" => $this->input->post('alamat', true),
                "pekerjaan" => $this->input->post('pekerjaan', true),
                "No_hp" => $this->input->post('nohp', true),
                "email" => $this->input->post('email', true),
            ];

            $this->db->where('id_anggota', $this->input->post('id_anggota'));
            $this->db->update('anggota', $data);


            $datauser = [
                'name' => $this->input->post('nama', true),
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user', $datauser);


            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('flash', 'Berhasil diedit');
            redirect('Simpananuser');
        }
    }
}
