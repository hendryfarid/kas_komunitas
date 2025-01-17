<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
    </div>
    <div class="card-body ">
        <?= $this->session->flashdata('messege'); ?>
        <div class="row">
            <div class="col-md-5">
                <form action="<?= base_url('Anggota') ?>" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control " name="keyword" placeholder="cari berdasarkan keyword" autocomplete="off" autofocus>
                        <div class="input-group-append">
                            <input class="btn btn-primary" type="submit" name="submit">
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-12">
                <small>
                    <h7>total: <?= $total_rows  ?></h7>
                </small>
                <table class="table table-hover text-gray-900" width=" 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>nama</th>
                            <!-- <th>email </th> -->
                            <th>alamat </th>
                            <th>No hp</th>
                            <th>Pekerjaan</th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($anggota)) : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger" role="alert">
                                        data tida ditemukan
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php
                        foreach ($anggota as $agt) : ?>
                            <tr>
                                <td><?= ++$start; ?></td>
                                <td><?= $agt['nama']; ?></td>
                                <!-- <td><?= $agt['email']; ?></td> -->
                                <td><?= $agt['alamat']; ?></td>
                                <td><?= $agt['No_hp']; ?></td>
                                <td><?= $agt['pekerjaan']; ?></td>
                                <td>
                                    <?php if ($agt['status'] == 1) : ?>
                                        <span class="badge badge-primary">aktif</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">tidak aktif</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a href="<?= base_url(); ?>anggota/info_edit/<?= $agt['id_anggota']; ?>" class=" float-left  btn btn-info btn-circle mr-1"> <i class="fas fa-info-circle"></i></a>
                                    <a href="<?= base_url(); ?>anggota/edit_anggota/<?= $agt['id_anggota']; ?>" class=" float-left  btn btn-success btn-circle mr-1 "> <i class="far fa-edit"></i></a>
                                    <a href="<?= base_url(); ?>anggota/hapus/<?= $agt['id_user']; ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin Ingin Menghapus Data?');"> <i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>
</div>