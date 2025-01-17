<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kas Masuk</h6>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="<?= base_url(); ?>master_trans/tambah_kas_msk" class="btn btn-primary mb-4">Tambah Kas Masuk </a>
            </div>
        </div>
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="div row mt-3">
                <div class="col md 6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data Kategori <?= $this->session->flashdata('flash'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="table-responsive">
            <table class="table table-hover text-gray-800" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>Id Kas Masuk</th>
                        <th>Nama Kas</th>
                        <th>action</th>
                    </tr>

                </thead>
                <tbody>

                    <?php $start = 1;
                    foreach ($kas_msk as $ks) : ?>
                        <tr>
                            <td><?= $start++; ?></td>
                            <td><?= $ks['id_kas']; ?></td>
                            <td><?= $ks['nama_kas']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>master_trans/edit_kas_masuk/<?= $ks['id_kas']; ?>" class=" float-left  btn btn-success btn-circle mr-1"> <i class="far fa-edit"></i></a>
                                <a href="<?= base_url(); ?>master_trans/hapus_kas_masuk/<?= $ks['id_kas']; ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin Ingin Menghapus Data?');"> <i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>