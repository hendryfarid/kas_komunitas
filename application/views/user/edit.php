<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit MyAccount</h6>
                </div>
                <div class="card-body ">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif ?>

                    <!-- //menampilkan pesan error yang sudah diset tadi controler -->

                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" name="id" class="form-control" id="id" value="<?= $user['id'] ?> " hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" name="passlam" class="form-control" id="passlam" value="<?= $user['password'] ?>" hidden>
                        </div>

                        <div class="form-group">
                            <label for="judul">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $user['name'] ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="judul">password baru</label>
                                <input type="password" class="form-control form-control-user" id="password1" name="password1">

                            </div>
                            <div class="col-sm-6">
                                <label for="judul">ulangi password baru</label>
                                <input type="password" class="form-control form-control-user" id="password2" name="password2">

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right" name="edit">Perbarui data</button>
                    </form>

                </div>
            </div>




        </div>
    </div>

</div>