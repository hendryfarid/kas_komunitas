<?php


class Berita_model extends CI_model
{
    public function getAllBerita()
    {
        //cara1
        // $query = $this->db->get('berita');
        // return $query->result_array();

        //cara 2
        return $this->db->get('berita')->result_array();
        $query = $this->db->get('berita');
    }

    public function tambahDataBerita()
    {
        $data = [
            "judul" => $this->input->post('judul', true),
            "isi" => $this->input->post('isi', true),
            "kategori" => $this->input->post('kategori', true),
            "tanggal_publish" => $this->input->post('tanggal', true)
        ];

        $this->db->insert('berita', $data);
    }

    public function hapusdataberita($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('berita');
        // untuk hapus ada 2 cara (cara diatas dan dibbawah)
        //$this->db->delete('berita', ['id' => $id]);
    }

    public function getBeritaById($id)
    {
        return $this->db->get_where('berita', ['id' => $id])->row_array();
    }


    public function editDataBerita()
    {
        $data = [
            "judul" => $this->input->post('judul', true),
            "isi" => $this->input->post('isi', true),
            "kategori" => $this->input->post('kategori', true),
            "tanggal_publish" => $this->input->post('tanggal_publish', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('berita', $data);
    }

    public function getBerita($limit, $start, $keyword_berita = null) ///tidak dipakai untuk pagnition cari
    {
        if ($keyword_berita) {
            $this->db->like('judul', $keyword_berita);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get('berita', $limit, $start)->result_array();
    }

    public function getfBerita($namket, $limit, $start, $keyword_berita = null) ///tidak dipakai untuk pagnition cari
    {
        if ($keyword_berita) {
            $this->db->like('judul', $keyword_berita);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('berita', ['kategori' =>
        $namket], $limit, $start)->result_array();
    }

    // public function getCariBerita() karena sudah pake pagination
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('judul', $keyword);
    //     $this->db->or_like('kategori', $keyword);
    //     return $this->db->get('berita')->result_array();
    // }
}
