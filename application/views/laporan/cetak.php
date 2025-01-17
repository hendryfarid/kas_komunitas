<!DOCTYPE html>
<html>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
} ?>

<head>
    <title>Cetak Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php base_url(); ?>asset/css/style.css">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <div>

        <table style="width: 100% ;">
            <tr>
                <td align="center">
                    <span style="line-height: 1.1; font-weight:bold;">
                        KOPERASI MANDANI DAN MERDEKA<br>
                    </span>
                    <small style=" font-weight:bold;">(Menyediakan Pangan Sehat, Fresh and healthy, Simple and easy to get,<br> Interconnected between producers and consumers)</small>

                </td>
            </tr>
        </table>
    </div>
    <hr class="line-title">

    <bold>LAPORAN TRANSAKSI BULANAN</bold><br>
    <small>
        PERIODE : <?php echo $thn ?> Bulan : <?php echo $blnnya ?><br>
    </small>
    <small>
        Waktu Cetak Laporan : <?php echo date('d-m-Y'); ?>
    </small>

    <div>
        <table width="100%" cellspacing="0" class="mt-3" border="3">
            <thead>


                <tr>
                    <th rowspan="2" align="center">#</th>
                    <th rowspan="2" align="center">Tanggal</th>
                    <th rowspan="2" align="center">Kode</th>
                    <th rowspan="2" align="center">keterangan</th>

                    <th colspan="2" align="center">Jenis saldo</th>
                    <th rowspan="2" align="center">saldo</th>


                </tr>

                <tr>
                    <th align="center">Pemasukan</th>
                    <th align="center">Pengeluaran</th>


                </tr>
            </thead>
            <tbody>

                <?php $start = 1;
                $saldo = 0;
                $saldopm = 0;
                $saldopl = 0;
                $totpeng = 0;
                $totpem = 0;
                ?>

                <?php foreach ($transaksi as $trans) : ?>
                    <tr align="center">
                        <td><?= $start++; ?></td>
                        <td><?= $trans['tanggal']; ?></td>
                        <td><?= $trans['id_trans']; ?></td>
                        <td align="left"><?= $trans['keterangan']; ?></td>
                        <td><?= $trans['spemasukan']; ?></td>
                        <td><?= $trans['spengeluaran']; ?></td>
                        <?php $saldopm =  $trans['spemasukan'] ?>
                        <?php $saldopl =  $trans['spengeluaran']; ?>
                        <td><?php echo $saldo =  $saldo + $saldopm - $saldopl; ?></td>
                        <?php $totpeng = $totpeng +  $trans['spengeluaran'];
                        $totpem = $totpem +  $trans['spemasukan']; ?>
                    </tr>
                <?php endforeach ?>
                <tr align="center">
                    <td colspan="3"></td>

                    <td>TOTAL</td>
                    <td><?php echo $totpem ?></td>
                    <td><?php echo $totpeng ?></td>
                    <td style="font-weight:bold;"><?php echo $saldo ?></td>
                </tr>



            </tbody>
        </table>
        <div align="right"><small>laba rugi bulan ini : <a style="font-weight:bold;"><?php echo rupiah($saldo) ?></a></small></div>
    </div>
    <br><br><br><br>
    <table border="0" width="100%">
        <tr>
            <td width="35%"></td>
            <td width="35%"></td>
            <td width="30%" align="center">
                <p>Padang, <?= date('d F Y') ?></p>
                <br><br><br><br>
                <p> (ADMIN KMDM)</p>

            </td>
        </tr>

    </table>
</body>

</html>