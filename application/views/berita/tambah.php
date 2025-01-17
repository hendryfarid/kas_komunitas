<!-- Begin Page Content -->
<div class="container-fluid">





    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary"> Form tambah berita</h6>
                    </div>
                    <div class="card-body">


                        <!-- //menampilkan pesan error yang sudah diset tadi controler (dihapus karena pake required)-->

                        <!-- <form action="<?= base_url('berita/tambah_data'); ?>" method="POST"> -->
                        <?php echo form_open_multipart('berita/tambah_data'); ?>
                        <div class="form-group">
                            <label for="judul">judul</label>
                            <input type="text" name="judul" class="form-control" id="judul">
                            <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="isi" id="isi"></textarea>
                            <?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="kategori">kategori</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <option value="">-pilih-</option>
                                <?php foreach ($list_kategori as $kt) : ?>
                                    <option value="<?= $kt['id_kategori']; ?>"> <?= $kt['kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">tanggal</label>
                            <input type="date" class="form-control" name="tanggal_publish" id="tanggal_publish">
                            <?= form_error('tanggal_publish', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <!-- <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="userfile" size="20" required="">
                        </div> -->
                        <label>Gambar</label><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input mb3" id="userfile" name="userfile" size="20" required="">
                            <label class="custom-file-label" for="userfile">Choose file</label>
                        </div>

                        <button type="submit" class="btn btn-primary float-right mt-3" name="tambah">tambah data</button>
                        <button type="reset" class="btn btn-danger float-right mr-3 mt-3" name="tambah">reset data</button>
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