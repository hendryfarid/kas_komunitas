<?php

class Anggota extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }
        $this->load->model('anggota_model'); //kemodel simpanan
        $this->load->library('form_validation'); //membuat sebuah validation
        is_logged_in();
    }

    // public function comboanggota($id) TIdak dipakai
    // {
    //     $data['title'] = 'Kelola Anggota';
    //     $data['user'] =  $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();
    //     $status = $this->input->post('status', true);

    //     if ($this->input->post('status')) {
    //         $data = array(
    //             'status' => $status
    //         );
    //         $this->db->where('id_anggota', $id);
    //         $this->db->update('anggota', $data);

    //         $this->session->set_flashdata('flash', ' Berhasil Ditambahkan');
    //         redirect('anggota');
    //     } else {
    //         $this->load->view('template/header', $data);
    //         $this->load->view('template/sidebar', $data);
    //         $this->load->view('template/topbar', $data);
    //         $this->load->view('anggota/index', $data);
    //         $this->load->view('template/footer');
    //     }
    // }

    public function index()
    {
        $data['title'] = 'Kelola Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['status'] = [0, 1];
        $this->load->model('anggota_model');
        // $data['anggota'] = $this->anggota_model->getAllAnggota(); tidak dipakai karna kita mau pakau getAnggota() model

        //pagination load libraruy
        $this->load->library('pagination');

        //ambil daya keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }


        //configuration
        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('email', $data['keyword']);
        $this->db->from('anggota');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 8;


        //initialize 
        $this->pagination->initialize($config);




        // var_dump($config['total_rows']);
        // die; cek apakah jmlahrow sudah bekerja atau tida

        $data['start'] = $this->uri->segment(3);
        $data['anggota'] = $this->anggota_model->getAnggota($config['per_page'], $data['start'], $data['keyword']); //untuk pagination 12=menmpilan 12 baris, 30=dimulai dari datar 31.
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('anggota/index', $data);
        $this->load->view('template/footer');
    }



    public function info_edit($id)
    {

        $data['title'] = 'Kelola Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        ///meenghubungkan data tabel user dan anggota
        $data['anggota_'] =  $this->db->get_where('anggota', ['id_anggota' =>
        $id])->row_array();


        $data['simpanan_'] =  $this->db->get_where('simpanan', ['id_anggota' =>
        $id])->result_array();



        // $data['simpanan_'] =  $this->db->get_where('simpanan', ['id_anggota' =>
        // $id_anggota])->result_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('anggota/detail', $data);
        $this->load->view('template/footer');
    }

    public function edit_anggota($id)
    {
        $data['title'] = 'Kelola Anggota';
        $data['status'] = [0, 1];
        $data['anggota'] = $this->db->get_where('anggota', ['id_anggota' =>
        $id])->row_array();

        $data['jekel'] = ['L', 'P'];
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'required');




        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('anggota/edit_anggota', $data);
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
                "status" => $this->input->post('status', true),
            ];

            $this->db->where('id_anggota', $this->input->post('id_anggota'));
            $this->db->update('anggota', $data);


            $datauser = [
                ///email tidak bosa kita tambahkan karena sessionnya pakai email
                'name' => $this->input->post('nama', true),
                'is_active' => $this->input->post('status', true),
                "email" => $this->input->post('email', true),
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user', $datauser);


            // $this->Berita_model->editDataBerita();

            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="success">
            Data Anggota Berhasil Diperbarui
          </div>');
            redirect('anggota');
        }
    }

    public function hapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="success">
        Data Anggota Berhasil Dihapus!!
      </div>');
        redirect('anggota');
    }




    ///simpanan anggota

    public function tambah_simpanan($id)
    {
        $data['title'] = 'Kelola Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['anggota'] =  $this->db->get_where('anggota', ['id_anggota' => $id])->row_array();

        $data['angmax1'] = $this->anggota_model->getAnggMax($id);



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('anggota/tambah_simpanan', $data);
        $this->load->view('template/footer');
    }
    //proses simpan
    public function prostam_simpanan()
    {
        $data['title'] = 'Kelola Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('jumlah', 'jumlah', 'required', [
            'required' => 'Id Kategori belum diisi!'
        ]);
        $this->form_validation->set_rules('tanggal_simpan', 'tanggal_simpan', 'required', [
            'required' => 'Tanggal simpan belum diisi!'
        ]);


        $id_anggota = $this->input->post('id_anggota', true);
        $angsuran = $this->input->post('angsuran', true);
        $jumlah = $this->input->post('jumlah', true);
        $tanggal_simpan = $this->input->post('tanggal_simpan', true);
        $keterangan = $this->input->post('keterangan', true);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('anggota/tambah_simpanan', $data);
            $this->load->view('template/footer');
        } else {

            $data = array(
                'id_anggota' => $id_anggota,
                'angsuran' =>  $angsuran,
                'jumlah' => $jumlah,
                'tanggal_simpan' => $tanggal_simpan,
                'keterangan' => $keterangan,
            );

            $this->db->insert('simpanan', $data);
            $this->_sEsimpAng($id_anggota);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="success">
            Data Simpanan Berhasil Ditambahkan
          </div>');
            redirect('anggota');
        }
    }
    private function _sEsimpAng($id)
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

        $anggota = $this->db->get_where('anggota', ['id_anggota' => $id])->row_array();
        $email = $anggota['email'];
        $nama = $anggota['nama'];

        //simpanan


        $message = '
        DATA SIMPANAN SUDAH TERUPDATE <br>
        <hr>
        Berikut detail simpanan anda: <br><br>
        <small>Nama : ' . $nama . '  </small><br>
        <small>Keterangan : </small><br>
        <hr>

       <h3 align="center">Detail simpanan</h3>

       <table width="100%" cellspacing="0">
       <thead>
           <tr>
               
               <th>Angsuran</th>
               <th>jumlah</th>               
               <th>tanggal</th>
               <th>keterangan</th>                              
           </tr>

       </thead>
       <tbody>
        
               <tr>                   
                   <td>' . $this->input->post('angsuran', true) . '</td>
                   <td>' . $this->input->post('jumlah', true) . '</td>
                   <td>' . $this->input->post('tanggal_simpan', true) . '</td>
                   <td>' . $this->input->post('keterangan', true) . '</td>
               </tr>                          
       </tbody>
   </table> <br><br>
   silahkan klik link ini untuk cetak laporan simpanan anda<br>
   http://localhost/koperasiMDM/c_laporan/cetak_lapSimAng/' . $id . '
     ';

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('satriarahmatputra@gmail.com', 'Admin Koperasi MDM');
        $this->email->to($email);
        // $this->email->to('satriarahmatputra27@gmail.com');
        $this->email->subject('Pendaftaran Anggota');
        $this->email->message($message);

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        } else {
            echo 'Success to send email';
        }
    }



    public function prosed_simpanan($id, $id1)
    {
        $data['title'] = 'Kelola Anggota';
        $data['anggota'] = $this->db->get_where('anggota', ['id_anggota' =>
        $id])->row_array();

        $data['simpanan'] = $this->db->get_where('simpanan', ['id' =>
        $id1])->row_array();

        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'required');




        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('anggota/edit_simpanan', $data);
            $this->load->view('template/footer');
        } else {
            //jika ada gambar diupload

            //upload foto
            // $upload_image = $_FILES['userfilefoto']['name'];
            // if ($upload_image) {
            //     $config['upload_path']          = './gambar/fotoanggota/';
            //     $config['allowed_types']        = 'gif|jpg|png|PNG';
            //     $config['max_size']             = 10000;
            //     $config['max_width']            = 10000;
            //     $config['max_height']           = 10000;
            //     $this->load->library('upload', $config);

            //     if ($this->upload->do_upload('userfilefoto')) {
            //         $new_image = $this->upload->data('file_name');
            //         $data = $this->db->set('Foto', $new_image);
            //     } else {
            //         echo $this->upload->display_errors();
            //     }
            // }




            //tanpa model
            $data = [
                "id_anggota" => $this->input->post('id_anggota', true),
                "angsuran" => $this->input->post('angsuran', true),
                "jumlah" => $this->input->post('jumlah', true),
                "tanggal_simpan" => $this->input->post('tanggal_simpan', true),
                "keterangan" => $this->input->post('keterangan', true),
            ];

            $this->db->where('id', $id1);
            $this->db->update('simpanan', $data);

            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('flash', 'Berhasil diedit');
            redirect('anggota');
        }
    }

    // prosees editnya(bawah)
    public function prosedex_simpanan()
    {
        $data['title'] = 'Kelola Anggota';


        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('anggota/edit_simpanan', $data);
            $this->load->view('template/footer');
        } else {

            $data = [
                "id_anggota" => $this->input->post('id_anggota', true),
                "angsuran" => $this->input->post('angsuran', true),
                "jumlah" => $this->input->post('jumlah', true),
                "tanggal_simpan" => $this->input->post('tanggal_simpan', true),
                "keterangan" => $this->input->post('keterangan', true),
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('simpanan', $data);

            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="success">
            Data Simpanan Berhasil Diperbarui
          </div>');
            redirect('anggota');
        }
    }


    public function hapus_simpanan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('simpanan');

        $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="success">
        Data Simpanan Berhasil Terhapus
      </div>');
        redirect('anggota');
    }


    public function anggota_tidakaktif()
    {

        $data['title'] = 'Kelola Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        // $data['anggota_tdk_aktif'] = $this->anggota_model->getAllAnggTidakAktif(); 
        $data['anggota_tdk_aktif'] = $this->db->get_where('anggota', ['status' =>
        0])->result_array();


        $data['status'] = [0, 1];


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('anggota/anggota_tidakaktif', $data);
        $this->load->view('template/footer');
    }

    public function hapus_ang_tdkaktif($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="success">
        Data Anggota Berhasil Dihapus!!
      </div>');
        redirect('anggota/anggota_tidakaktif');
    }


    //akun


    public function akun_index()
    {


        $data['title'] = 'Reset Akun Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $role = 2;
        $data['data_user'] = $this->db->get_where('user', ['role_id' =>
        $role])->result_array();
        // var_dump($data);
        // die;



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('anggota/index_akun', $data);
        $this->load->view('template/footer');
    }
    public function reset_pass($id)
    {
        $password = 123456;
        $data = [
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->where('id', $id);
        $this->db->update('user', $data);

        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="success">
            password berhasil direset!!
          </div>');
        redirect('anggota/akun_index');
    }
}
