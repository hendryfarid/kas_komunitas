<!-- Begin Page Content -->
<div class="container-fluid">





    <div class="container">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Kas Masuk</h6>
                    </div>
                    <div class="card-body">


                        <!-- //menampilkan pesan error yang sudah diset tadi controler (dihapus karena pake required)-->
                        <!-- <?php echo form_open_multipart('berita/tambah_data'); ?> -->
                        <!-- ///menmapilkan input kode otomatis -->

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="judul">Id Kas</label>
                                <input type="text" name="id_kas" class="form-control" id="id_kas" value="<?= $ksm['id_kas'] ?>" readonly>

                            </div>
                            <div class="form-group">
                                <label for="judul">Nama Kategori</label>
                                <input type="text" name="nama_kas" class="form-control" id="nama_kas" value="<?= $ksm['nama_kas'] ?>">
                                <?= form_error('nama_kas', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="tambah">Perbarui Data</button>

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