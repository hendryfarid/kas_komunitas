<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();


        // jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id'],

                    ];
                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
                Wrong password!
              </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
                this email has not beet activated!
              </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
            Email is not Register
          </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'this email has already registered!'
        ]);
        $this->form_validation->set_rules('id', 'id', 'required|trim|is_unique[user.id]', [
            'is_unique' => 'this id_member has already registered!'
        ]);
        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'required|trim|is_unique[anggota.id_anggota]', [
            'is_unique' => 'this id_member has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_lenght' => 'password to short!'

        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/auth_header');
            $this->load->view('auth/registration');
            $this->load->view('template/auth_footer');
        } else {

            $data = [
                'id' => $this->input->post('id', true),
                'name' => $this->input->post('name', true),
                'email' =>  $this->input->post('email', true),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => '2',
                'is_active' => '0',
                'date_created' => time()
            ];
            $this->db->insert('user', $data);

            $datatanggota = [
                'id_user' => $this->input->post('id', true),
                'id_anggota' => $this->input->post('id_anggota', true),
                'nama' => $this->input->post('name', true),
                'email' =>  $this->input->post('email', true),
                'status' => 0
            ];
            $this->db->insert('anggota', $datatanggota);

            // krim email
            $this->_sendEmail();


            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
            Congratalations! Your account has been created.
          </div>');
            redirect('auth');
        }
    }

    private function _sendEmail()
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'satriarahmatputra@gmail.com',
            'smtp_pass' => '27071997',

            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",

        ];
        // $config = [
        //     'protocol'  => 'smtp',
        //     'smtp_host' => 'smtp.gmail.com',
        //     'smtp_user' => 'satriarahmatputra@gmail.com',  // Email gmail
        //     'smtp_pass'   => '27071997',  // Password gmail
        //     'smtp_port'   => 465,
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        //     'newline' => "\r\n",
        //     'smtp_crypto' => 'ssl',
        //     'crlf'    => "\r\n",

        // ];
        $email = $this->input->post('email');

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('satriarahmatputra@gmail.com', 'Admin Koperasi MDM');
        $this->email->to($email);
        $this->email->subject('Pendaftaran Anggota');
        $this->email->message('Silahkan anda isi data pribadi anda sesuai URL dibawah!<br>
        https://tinyurl.com/DaftarAnggotaKMDM<br><br>
        akun anda akan aktif apabila admin Koperasi telah mengkonfirmasi pendaftaran anda!!');

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        } else {
            echo 'Success to send email';
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('id_anggota');
        $this->session->unset_userdata('id');
        $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
        You have been logout
      </div>');
        redirect('auth');
    }


    public function blocked()
    {
        echo 'akses anda ditolak!!';
    }
}
