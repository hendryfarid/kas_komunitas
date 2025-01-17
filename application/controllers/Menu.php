<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Menu_model', 'menu');
        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }
        is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil ditambahkan
          </div>');
            redirect('menu');
        }
    }
    //tidak jadi pake addmenu, bkin diindek aja
    public function edit_menu($id)
    {
        $id1 = $id;

        $data['title'] = 'Menu Management';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['menued'] = $this->db->get_where('user_menu', ['id' => $id1])->row_array();

        $this->form_validation->set_rules('menu1', 'menu1', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu1', true),
            ];
            $this->db->where('id', $id);
            $this->db->update('user_menu', $data);

            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil ditambahkan
          </div>');
            redirect('menu');
        }
    }
    public function hapus_menu($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user_menu');
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil dihapus!!
          </div>');
        redirect('menu');
    }


    public function submenu()
    {
        $data['title'] = 'SubMenu Management';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['submenu'] = $this->menu->getSubmenu();

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),

            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil ditambahkan
          </div>');
            redirect('menu/submenu');
        }
    }

    public function edit_submenu($id)
    {
        $id1 = $id;

        $data['title'] = 'SubMenu Management';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['submenued'] = $this->db->get_where('user_sub_menu', ['id' => $id1])->row_array();

        $this->form_validation->set_rules('title', 'title', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/edit_submenu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'title' => $this->input->post('title', true),
                'menu_id' => $this->input->post('menu_id', true),
                'url' => $this->input->post('url', true),
                'icon' => $this->input->post('icon', true),
                'is_active' => $this->input->post('is_active', true),
            ];
            $this->db->where('id', $id1);
            $this->db->update('user_sub_menu', $data);

            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil ditambahkan
          </div>');
            redirect('menu/submenu');
        }
    }


    public function hapus_submenu($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil dihapus!!
          </div>');
        redirect('menu/submenu');
    }



    ///user access menu
    public function index_user_acc()
    {
        $data['title'] = 'User Access';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['useracc'] = $this->menu->getuseracc();

        $this->form_validation->set_rules('menu', 'menu', 'required');
        $this->form_validation->set_rules('role', 'role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/index_user_acc', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'role_id' => $this->input->post('role'),
                'menu_id' => $this->input->post('menu'),
            ];
            $this->db->insert('user_access_menu', $data);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil ditambahkan
          </div>');
            redirect('menu/index_user_acc');
        }
    }

    public function edit_user_accmenu($id)
    {

        $data['title'] = 'User Access';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['useracc'] = $this->menu->getuseracc_row($id);


        $this->form_validation->set_rules('menu', 'menu', 'required');
        $this->form_validation->set_rules('role', 'role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/edit_accmenu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'role_id' => $this->input->post('role'),
                'menu_id' => $this->input->post('menu'),
            ];
            $this->db->where('id', $id);
            $this->db->update('user_access_menu', $data);

            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil ditambahkan
          </div>');
            redirect('menu/index_user_acc');
        }
    }


    public function hapus_accmenu($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user_access_menu');
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Data Berhsil dihapus!!
          </div>');
        redirect('menu/index_user_acc');
    }
}
