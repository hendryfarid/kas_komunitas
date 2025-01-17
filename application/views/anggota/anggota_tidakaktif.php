<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Anggota Tidak Aktif</h6>
    </div>
    <div class="card-body ">


        <div class="row ">
            <div class="col-md-12">

                <table class="table table-hover text-gray-800" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>nama</th>
                            <th>email </th>
                            <th>alamat </th>
                            <th>No hp</th>
                            <th>Pekerjaan</th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no = 1;
                        foreach ($anggota_tdk_aktif as $agt) :  ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $agt['nama']; ?></td>
                                <td><?= $agt['email']; ?></td>
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
                                    <a href="<?= base_url(); ?>anggota/hapus_ang_tdkaktif/<?= $agt['id_user']; ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin Ingin Menghapus Data?');"> <i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>