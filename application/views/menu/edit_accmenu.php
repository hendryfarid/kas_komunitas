<div class="container">
    <!-- justify-content-center =code perataan tengah d row  -->
    <div class="row mt-3 ">
        <div class="col-md-6 ">
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Edit Akses Menu</h6>
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
                            <select name="menu" id="menu" class="form-control">
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($m['menu'] == $useracc['menuname']) : ?>
                                        <option value="<?= $m['id'] ?>" selected><?= $m['menu'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </select>
                        </div>




                        <div class="form-group">
                            <select name="role" id="role" class="form-control">
                                <?php foreach ($role as $r) : ?>
                                    <?php if ($r['role'] == $useracc['rolename']) : ?>
                                        <option value="<?= $r['id'] ?>" selected><?= $r['role'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                                    <?php endif; ?>

                                <?php endforeach ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary float-right" name="tambah">Perbarui Data</button>
                    </form>

                </div>
            </div>




        </div>
    </div>

</div>
</div>