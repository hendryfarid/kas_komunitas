<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="<?= base_url(); ?>master_trans/tambah_trans" class="btn btn-primary mb-4">Tambah Transaksi </a>
            </div>
        </div>
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="div row mt-3">
                <div class="col md 6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data Transaksi <?= $this->session->flashdata('flash'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="table-responsive">
            <table class="table table-hover text-gray-800" id="dataTable" width="100%" cellspacing="0">
                <thead class="border-5">
                    <tr class="table-primary ">
                    <tr>
                        <th valign="center">#</th>
                        <th valign="center">Id Transaksi</th>
                        <th valign="center">Tanggal</th>
                        <th valign="center">jenis kas</th>
                        <th>Kas Masuk</th>
                        <th>Kas Keluar</th>
                        <th valign="center">keterangan</th>
                        <th valign="center">jumlah</th>
                        <th valign="center">action</th>


                    </tr>
                </thead>
                <tbody>


                    <?php $start = 1;
                    foreach ($transaksi as $trans) : ?>
                        <tr>
                            <td><?= $start++; ?></td>
                            <td><?= $trans['id_trans']; ?></td>
                            <td><?= $trans['tanggal']; ?></td>
                            <td><?= $trans['jenis_kas']; ?></td>
                            <td><?= $trans['kas_masuk']; ?></td>
                            <td><?= $trans['kas_keluar']; ?></td>
                            <td><?= $trans['keterangan']; ?></td>
                            <td><?= rupiah($trans['jumlah']); ?></td>


                            <td>
                                <a href="<?= base_url(); ?>master_trans/edit_trans/<?= $trans['id_trans']; ?>" class=" float-left  btn btn-success btn-circle mr-1"> <i class="far fa-edit"></i></a>
                                <a href="<?= base_url(); ?>master_trans/hapus_trans/<?= $trans['id_trans']; ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin Ingin Menghapus Data?');"> <i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>