<!-- Nav Item - Pages Collapse Menu -->




<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Akses Menu</h6>
    </div>
    <div class="card-body">


        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('messege'); ?>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Tambah Acces Menu </a>
        <div class="table-responsive text-gray-900">
            <table class="table table-hover" id="dataTable" width="100%">
                <thead>
                    <tr class="text-gray-900">
                        <th scope="col">#</th>
                        <th scope="col">id</th>
                        <th scope="col">role</th>
                        <th scope="col">menu</th>
                        <th scope="col">action</th>

                    </tr>
                </thead>
                <tbody class="text-gray-900">
                    <?php $i = 1 ?>
                    <?php foreach ($useracc as $usracc) : ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $usracc['uaccid']; ?></td>
                            <td><?= $usracc['rolename']; ?></td>
                            <td><?= $usracc['menuname']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>menu/edit_user_accmenu/<?= $usracc['uaccid']; ?>" class=" float-left mb-2 btn btn-success btn-circle mr-1"> <i class="far fa-edit"></i></a>
                                <a href="<?= base_url(); ?>menu/hapus_accmenu/<?= $usracc['uaccid']; ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin ingin menghapus data?');"> <i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- /.container-fluid -->

    </div>
</div>
<!-- End of Main Content -->


<!-- modal -->

<!-- Button trigger modal -->


<!-- Modal tamah-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Access Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="menu" id="menu" class="form-control">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="role" id="role" class="form-control">
                            <option value="">Pilih Role</option>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Tambah akses</button>
                </div>
            </form>
        </div>
    </div>
</div>



</div>