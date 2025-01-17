<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // } ttidak dipakai karena kita pakai function is_loggin
        $this->load->model('Simpananuser_model'); // berguna untuk mengarahkan ke model
        $this->load->library('form_validation'); //membuat sebuah validation
        is_logged_in();
    }
    public function index()
    {

        $data['title'] = 'My Profile';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id_user = $this->session->userdata('id');

        $data['anggota_'] =  $this->db->get_where('anggota', ['id_user' =>
        $id_user])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'My Profile';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password1', 'Password Lama', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'password tidak sama!',
            'min_lenght' => 'password terlalu singkat!'
        ]);
        $this->form_validation->set_rules('password2', 'password2', 'required|trim|min_length[6]|matches[password1]', [
            'matches' => 'password tidak sama!',
            'min_lenght' => 'password terlalu singkat!'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/footer');
        } else {

            $data = [
                "name" => $this->input->post('nama', true),
                "password" => password_hash($this->input->post('password1', true), PASSWORD_DEFAULT)
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user', $data);


            $datatanggota = [
                'nama' => $this->input->post('nama', true),
            ];
            $this->db->where('id_user', $this->input->post('id'));
            $this->db->update('anggota', $datatanggota);


            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="success">
                password berhasil diperbarui!!
              </div>');
            redirect('user');
        }
    }
}
