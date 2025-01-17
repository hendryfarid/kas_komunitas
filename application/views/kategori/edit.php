<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kategori</h6>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif ?>

                    <!-- //menampilkan pesan error yang sudah diset tadi controler -->

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="judul">Id Kategori</label>
                            <input type="text" name="id_kategori" class="form-control" id="id_kategori" value="<?= $kategori['id_kategori'] ?>" readonly>

                        </div>
                        <div class="form-group">
                            <label for="judul">Kategori</label>
                            <input type="text" name="kategori_nama" class="form-control" id="kategori_nama" value="<?= $kategori['kategori'] ?>">

                        </div>

                        <button type="submit" class="btn btn-primary float-right" name="tambah">Perbarui Data</button>
                    </form>

                </div>
            </div>




        </div>
    </div>

</div>
</div>