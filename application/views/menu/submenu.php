<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data SubMenu</h6>
    </div>
    <div class="card-body">

        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>

        <?php endif; ?>

        <?= $this->session->flashdata('messege'); ?>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newexampleModal">Tambah SubMenu </a>
        <div class="table-responsive text-gray-900">
            <table class=" table table-hover" id="dataTable" width="100%">
                <thead>
                    <tr class="text-gray-900">
                        <th scope=" col">#</th>
                        <th scope="col">SubMenu</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody class="text-gray-900">
                    <?php $i = 1 ?>
                    <?php foreach ($submenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td><?= $sm['is_active']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>menu/edit_submenu/<?= $sm['id']; ?>" class=" float-left  btn btn-success btn-circle mr-1"> <i class="far fa-edit"></i></a>
                                <a href="<?= base_url(); ?>menu/hapus_submenu/<?= $sm['id'] ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin ingin menghapus data?');"> <i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- modal -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newexampleModal" tabindex="-1" aria-labelledby="newexampleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newexampleModal">Tambah SubMenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('menu/submenu') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Menu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">select menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" id="url" name="url" class="form-control" placeholder="Menu url">
                    </div>
                    <div class="form-group">
                        <input type="text" id="icon" name="icon" class="form-control" placeholder="Menu icon">
                    </div>
                    <div class="form-gorup">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_avtive">
                                active!
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="Submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>