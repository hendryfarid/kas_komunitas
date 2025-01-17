<!DOCTYPE html>
<html>
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


<head>
    <title>Cetak Rekap</title>
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
    <div>
        <hr class="line-title">

        <bold><a>LAPORAN REKAPITULASI TAHUNAN</a></bold>
    </div><br>


    </div>

    <div class="card-body">

        <?php $start = 1;
        // $list_blnth;
        // var_dump($list_blnth['bln']);
        ?>
        <?php $saldo = $totsim ?>
        <?php foreach ($list_th as $listth) : ?>
            tahun : <?php echo $listth['th'] ?>

            <table class="table table-hover text-gray-800 mt-9" width="100%" cellspacing="0">

                <thead class="border-5 ">

                    <tr>
                        <th rowspan="2" valign="center">#</th>
                        <th rowspan="2" valign="center">bulan</th>
                        <th rowspan="2" valign="center">pemasukan</th>
                        <th rowspan="2" valign="center">pengeluaran</th>
                        <th rowspan="2" valign="center">saldo</th>
                    <tr>
                </thead>
                <tbody>


                    <?php $start = 1;
                    $totSpeng = 0;
                    $totSpem = 0;
                    $labarugi = 0;
                    $saldotahunan = 0;
                    ?>

                    <?php
                    $thn = $listth['th'];
                    $koneksi = mysqli_connect('localhost', 'root', '', 'koperasi');

                    //
                    $thnpilihan1 = $thn . '-' . '01' .  '-' . '01';
                    $thnpilihan2 = $thn . '-' . '12' . '-' . '31';
                    $sql = "SELECT month(tanggal) as bln from  transaksi where tanggal between '$thnpilihan1' and '$thnpilihan2' group by bln";
                    $result = $this->db->query($sql);
                    $data_bulan = $result->result_array();
                    // var_dump($data1);
                    // die;

                    ?>


                    <tr>

                        <td colspan="4" align="center">Saldo Awal</td>
                        <?php $sawal = $saldo ?>
                        <td><?= rupiah($saldo); ?></td>
                    </tr>

                    <?php foreach ($data_bulan as $listbln) : ?>
                        <?php

                        $bln = $listbln['bln'];
                        $koneksi = mysqli_connect('localhost', 'root', '', 'koperasi');

                        //
                        $thnpilihan1 = $thn . '-' . '0' . $bln . '-' . '31';
                        $thnpilihan2 = $thn . '-' . '0' . $bln . '-' . '01';
                        $query = mysqli_query($koneksi, "SELECT sum(history_trans.pengeluaran) as pengeluaran, sum(history_trans.pemasukan) as pemasukan  FROM  transaksi, history_trans where transaksi.id_trans=history_trans.id_trans and tanggal between '$thnpilihan2' and '$thnpilihan1'");
                        $data = mysqli_fetch_array($query);
                        $totpeng = $data['pengeluaran'];
                        $totpem = $data['pemasukan'];

                        ?>

                        <tr>

                            <td><?= $start++ ?></td>
                            <td><?= nmbulan($listbln['bln']) ?></td>
                            <td><?php echo rupiah($totpem) ?></td>
                            <td><?php echo rupiah($totpeng) ?></td>
                            <?php $totSpeng = $totSpeng +  $totpeng;
                            $totSpem = $totSpem +  $totpem; ?>
                            <?php $saldo = $saldo + $totpem - $totpeng; ?>
                            <td><?php echo rupiah($saldo) ?></td>
                        </tr>

                    <?php endforeach ?>

                    <tr style="font-weight:bold;">
                        <td></td>
                        <td>Jumlah</td>
                        <td><?= rupiah($totSpem) ?> </td>
                        <td><?= rupiah($totSpeng) ?></td>

                    </tr>
                    <tr style="font-weight:bold;">
                        <td></td>
                        <td>Laba Rugi <br> Saldo Tahun Ini</td>
                        <td><?= rupiah($labarugi = $totSpem - $totSpeng)  ?><br> <?= rupiah($saldotahunan = $sawal - $totSpeng + $totSpem) ?></td>
                        <td></td>
                    </tr>




                </tbody>
            </table>









        <?php endforeach ?>
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