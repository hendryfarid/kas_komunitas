<div class="container">
    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Berita</h6>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif ?>

                    <!-- //menampilkan pesan error yang sudah diset tadi controler -->

                    <?php echo form_open_multipart(''); ?>
                    <input type="hidden" name="id" class="form-control" id="id" value="<?= $berita['id'] ?>">

                    <div class="form-group">
                        <label for="judul">judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" value="<?= $berita['judul'] ?>">
                    </div>
                    <!-- <div class="form-group">
                        <label for="isi">isi</label>
                        <input type="text" name="isi" class="form-control" id="isi" value="<?= $berita['isi'] ?>">
                    </div> -->
                    <div class="form-group">
                        <label for="isi">Isi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="isi" class="form-control" id="isi"><?= $berita['isi'] ?></textarea>
                        <?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class=" form-group">
                        <label for="kategori">kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <?php foreach ($kategori as $kt) : ?>
                                <?php if ($kt['id_kategori'] == $berita['kategori']) : ?>
                                    <option value="<?= $kt['id_kategori']; ?>" selected> <?= $kt['kategori']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $kt['id_kategori']; ?>"> <?= $kt['kategori']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">tanggal</label>
                        <input type="date" class="form-control" name="tanggal_publish" id="tanggal_publish" value="<?= $berita['tanggal_publish'] ?>">
                    </div>

                    <label for="tanggal">Gambar</label><br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php echo base_url('/gambar/berita/') . $berita['gambar']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input mb3" id="userfile" name="userfile" size="20" value="<?= $berita['gambar'] ?>">
                                        <label class=" custom-file-label" for="userfile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right" name="edit">Perbarui Data</button>
                    </form>

                </div>
            </div>




        </div>
    </div>

</div>