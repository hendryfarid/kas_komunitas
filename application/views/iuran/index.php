<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">IURAN Anggota</h6>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <?= $this->session->flashdata('messege'); ?>
            <table class="table table-hover text-gray-900" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th> 
                        <th>Jumlah</th>
                        <th>Total simpanan</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $start = 1;
                    foreach ($kum_anggota as $ags) : ?>
                        <tr>
                            <td><?= $start++; ?></td>
                            <td><?= $ags['nama']; ?></td> 
                           
                            <td><?php foreach ($query  as $rinci) : ?>
                                    <?= rupiah($rinci['jumlah'])  . ',-'; ?><br>
                                    <hr class="mb-0">
                                <?php endforeach ?>
                            </td> 
                            <td>
                                <?php if ($ags['totaljumlah'] < 1000000) : ?>
                                    <span class="badge badge-danger">Belum Lunas</span>
                                <?php else : ?>
                                    <span class="badge badge-primary">Lunas</span>
                                <?php endif ?>
                            </td>

                            <td>
                                <a href="<?= base_url(); ?>iuran/tambah_simpanan/<?= $ags['id_anggota']; ?>" class=" float-left  btn btn-primary btn-circle mr-1 "> <i class="fas fa-plus-circle"></i></a>
                                <a href="<?= base_url(); ?>iuran/info_edit/<?= $ags['id_anggota']; ?>" class=" float-left  btn btn-info btn-circle mr-1"> <i class="fas fa-info-circle"></i></a>
                                &nbsp;<a target="_blank" href="<?= base_url(); ?>c_laporan/cetak_lapSimAng/<?= $ags['id_anggota']; ?>" class="btn btn-danger btn-circle mr-1 mb-3"><i class="fa fa-print"></i> </a>


                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>