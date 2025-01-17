<!-- Begin Page Content -->
<div class="container-fluid">





    <div class="container">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary"> Form tambah kategori</h6>
                    </div>
                    <div class="card-body">


                        <!-- //menampilkan pesan error yang sudah diset tadi controler (dihapus karena pake required)-->
                        <!-- <?php echo form_open_multipart('berita/tambah_data'); ?> -->
                        <!-- ///menmapilkan input kode otomatis -->
                        <?php

                        $koneksi = mysqli_connect('localhost', 'root', '', 'koperasi');

                        //
                        $query = mysqli_query($koneksi, "SELECT max(id_kategori) as kodeTerbesar FROM kategori_berita");
                        $data = mysqli_fetch_array($query);
                        $kodeKategori = $data['kodeTerbesar'];
                        $urutan = (int) substr($kodeKategori, 3, 3);

                        $urutan++;
                        $huruf = "K";
                        $kodeKategori = $huruf . sprintf("%03s", $urutan);

                        ?>

                        <form action="<?= base_url('berita/tambah_kategori'); ?>" method="POST">
                            <div class="form-group">
                                <label for="judul">Id Kategori</label>
                                <input type="text" name="id_kategori" class="form-control" id="id_kategori" value="<?php echo $kodeKategori; ?>" readonly>
                                <?= form_error('id_kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="judul">Kategori</label>
                                <input type="text" name="kategori_nama" class="form-control" id="kategori_nama">
                                <?= form_error('kategori_nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="tambah">tambah data</button>
                            <button type="reset" class="btn btn-danger float-right mr-3" name="tambah">reset data</button>
                        </form>

                    </div>
                </div>




            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->