<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit SubMenu</h6>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif ?>

                    <!-- //menampilkan pesan error yang sudah diset tadi controler -->


                    <form method="POST" action="">

                        <div class="form-group">
                            <input type="text" id="title" name="title" class="form-control" value="<?= $submenued['title'] ?>">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">

                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($m['id'] == $submenued['menu_id']) : ?>
                                        <option value="<?= $m['id'] ?>" selected> <?= $m['menu'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $m['id'] ?>"> <?= $m['menu'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <input type="text" id="url" name="url" class="form-control" value="<?= $submenued['url'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="icon" name="icon" class="form-control" value="<?= $submenued['icon'] ?>">
                        </div>
                        <div class="form-gorup">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                <label class="form-check-label" for="is_avtive">
                                    active!
                                </label>
                            </div>
                        </div>


                        <button type="Submit" class="btn btn-primary float-right">Perbarui</button>

                    </form>

                </div>
            </div>




        </div>
    </div>

</div>
</div>