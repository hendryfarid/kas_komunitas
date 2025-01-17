<?php

class Simpanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation'); //membuat sebuah validation
        $this->load->model('Simpanan_model'); //kemodel simpanan
        // $this->load->helper(array('form', 'url'));
        // is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'Simpanan Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //komulatif anggota
        $data['kum_anggota'] = $this->Simpanan_model->getKomAng(); //meenglompkokan 2 table berdasarkan nama sum
        $data['rinci_anggota'] = $this->Simpanan_model->getRinAng();



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('simpanan/index', $data);
        $this->load->view('template/footer');
    }

    //link ke view
    public function tambah_simpanan($id)
    {
        $data['title'] = 'Simpanan Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['anggota'] =  $this->db->get_where('anggota', ['id_anggota' => $id])->row_array();

        $data['angmax1'] = $this->Simpanan_model->getAnggMax($id);



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('simpanan/tambah_simpanan', $data);
        $this->load->view('template/footer');
    }

    //proses tambah
    public function prostam_simpanan()
    {
        $data['title'] = 'Simpanan Anggota';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'required', [
            'required' => 'id anggota belum diisi!'
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
            $this->load->view('simpanan/tambah_simpanan', $data);
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
            redirect('simpanan');
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
        $this->email->subject('Simpanan Anggota');
        $this->email->message($message);

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        } else {
            echo 'Success to send email';
        }
    }



    public function info_edit($id)
    {

        $data['title'] = 'Simpanan Anggota';
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
        $this->load->view('simpanan/detail', $data);
        $this->load->view('template/footer');
    }

    public function prosed_simpanan($id, $id1)
    {
        $data['title'] = 'Simpanan Anggota';
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
            $this->load->view('simpanan/edit_simpanan', $data);
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
        $data['title'] = 'Simpanan Anggota';


        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('simpanan/edit_simpanan', $data);
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
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('simpanan', $data);

            // $this->Berita_model->editDataBerita();
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="success">
             Data Simpanan Berhasil Diperbarui
           </div>');
            redirect('simpanan');
        }
    }

    public function hapus_simpanan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('simpanan');
        $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="success">
        Data Simpanan Berhasil Terhapus
      </div>');
        redirect('simpanan');
    }
}
