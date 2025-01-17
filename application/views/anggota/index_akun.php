<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Reset Passoword Anggota</h6>
    </div>
    <div class="card-body ">

        <?= $this->session->flashdata('messege'); ?>
        <div class="row ">
            <div class="col-md-12">

                <table class="table table-hover text-gray-900" width=" 100%" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>nama</th>
                            <th>email </th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $start = 1; ?>
                        <?php
                        foreach ($data_user as $agt) : ?>

                            <tr>
                                <td><?= $start++; ?></td>
                                <td><?= $agt['name']; ?></td>
                                <td><?= $agt['email']; ?></td>

                                <td>
                                    <?php if ($agt['is_active'] == 1) : ?>
                                        <span class="badge badge-primary">aktif</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">tidak aktif</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a href="<?= base_url(); ?>anggota/reset_pass/<?= $agt['id']; ?>" class=" float-left mb-2 btn btn-primary " onclick="return confirm('Yakin Ingin Mereset Password?');"> <i class="fas fa-tools"></i> reset password</i></a>
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