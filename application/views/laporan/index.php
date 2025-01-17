<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function nmbulan($angka)
{

    switch ($angka) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rekap Data Bulanan</h6>
    </div>
    <div class="card-body">

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

        <form action="" method="post" class="form-inline text-gray-800">

            &nbsp;Tahun : &nbsp;

            <select name="th" id="th" class="form-control mb-3">
                <option value="">- PILIH -</option>
                <?php
                foreach ($list_th as $t) {
                    if ($thn == $t['th']) {
                ?>
                        <option selected value="<?php echo $t['th'];  ?>"><?php echo $t['th']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $t['th']; ?>"><?php echo $t['th']; ?></option>
                <?php
                    }
                }
                ?>
            </select>

            &nbsp;Bulan : &nbsp;

            <select name="bln" id="bln" class="form-control mb-3">
                <option value="">- PILIH -</option>
                <?php
                foreach ($list_bln as $t) {
                    if ($blnnya == $t['bln']) {
                ?>
                        <option selected value="<?php $t['bln'];  ?>"><?php echo nmbulan($t['bln']); ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $t['bln']; ?>"><?php echo nmbulan($t['bln']); ?></option>
                <?php
                    }
                }
                ?>
            </select>
            &nbsp;<button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i> Cari</button>
            <?php if ($blnnya == '' || $thn == '') { ?>
                &nbsp;<a target="_blank" href="" class="btn btn-danger mb-3" hidden><i class="fa fa-print"></i> Cetak</a>
            <?php } else { ?>
                &nbsp;<a target="_blank" href="<?= base_url(); ?>c_laporan/cetak_laptrans/<?php echo $thn  ?>/<?php echo $blnnya  ?>" class="btn btn-danger mb-3"><i class="fa fa-print"></i> Cetak</a>
            <?php } ?>
        </form>
        <div class="table-responsive">
            <table class="table table-hover text-gray-800" id="" width="100%" cellspacing="0">
                <thead class="border-5">
                    <tr class="table-primary ">
                    <tr>
                        <th valign="center">#</th>
                        <th valign="center">Tanggal</th>
                        <th valign="center">Kode Transaksi</th>
                        <th valign="center">keterangan</th>
                        <th valign="center">Pemasukan</th>
                        <th valign="center">Pengeluaran</th>
                        <th valign="center">saldo</th>


                    <tr>
                </thead>
                <tbody>

                    <?php $start = 1;
                    $saldo = 0;
                    $saldopm = 0;
                    $saldopl = 0;
                    $totpeng = 0;
                    $totpem = 0;
                    ?>
                    <?php
                    if ($blnnya == '' || $thn == '') {
                        echo "<tr><td colspan='9' align='center'>SILAHKAN PILIH TAHUN DAN BULAN  SECARA LENGKAP</td></tr>";
                    } else {
                    ?>


                        <?php foreach ($transaksi as $trans) : ?>
                            <tr>
                                <td><?= $start++; ?></td>
                                <td><?= $trans['tanggal']; ?></td>
                                <td><?= $trans['id_trans']; ?></td>
                                <td><?= $trans['keterangan']; ?></td>
                                <td><?= rupiah($trans['spemasukan']); ?></td>
                                <td><?= rupiah($trans['spengeluaran']); ?></td>
                                <?php $saldopm =  $trans['spemasukan'] ?>
                                <?php $saldopl =  $trans['spengeluaran']; ?>
                                <td><?php echo rupiah($saldo =  $saldo + $saldopm - $saldopl); ?></td>
                                <?php $totpeng = $totpeng +  $trans['spengeluaran'];
                                $totpem = $totpem +  $trans['spemasukan']; ?>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>TOTAL</td>
                            <td><?php echo rupiah($totpem) ?></td>
                            <td><?php echo rupiah($totpeng) ?></td>
                            <td style="font-weight:bold;"><?php echo rupiah($saldo) ?></td>
                        </tr>


                    <?php } ?>
                </tbody>
            </table>
            <div align="right"><small>laba rugi bulan ini : <a style="font-weight:bold;"><?php echo rupiah($saldo) ?></a></small></div>
        </div>

    </div>

</div>
</div>