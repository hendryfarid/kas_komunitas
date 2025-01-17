<div class="container">
    <!-- justify-content-center =code perataan tengah d row  -->
    <div class="row mt-3 ">
        <div class="col-md-6 ">
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Edit Menu</h6>
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
                            <label for="judul">Menu</label>
                            <input type="text" name="menu1" class="form-control" id="menu1" value="<?= $menued['menu'] ?>">

                        </div>

                        <button type="submit" class="btn btn-primary float-right" name="tambah">Perbarui Data</button>
                    </form>

                </div>
            </div>




        </div>
    </div>

</div>
</div>