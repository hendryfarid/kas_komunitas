<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="<?= base_url(); ?>berita/tambah_kategori" class="btn btn-primary mb-4">Tambah Kategori </a>
            </div>
        </div>
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="div row mt-3 ">
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
        <div class="table-responsive text-gray-900">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="table-primary text-gray-900">
                        <th>#</th>
                        <th>id kategori</th>
                        <th>Kategori</th>
                        <th>action</th>
                    </tr>

                </thead>
                <tbody class="text-gray-800">

                    <?php $start = 1;
                    foreach ($kategori as $ktg) : ?>
                        <tr>
                            <td><?= $start++; ?></td>
                            <td><?= $ktg['id_kategori']; ?></td>
                            <td><?= $ktg['kategori']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>berita/kategori_edit/<?= $ktg['id_kategori']; ?>" class=" float-left  btn btn-success btn-circle mr-1"> <i class="far fa-edit"></i></a>
                                <a href="<?= base_url(); ?>berita/hapus_kategori/<?= $ktg['id_kategori']; ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin Ingin Menghapus Data?');"> <i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>