<!-- Begin Page Content -->
<div class="container-fluid">





    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Transaksi</h6>
                    </div>
                    <div class="card-body">


                        <!-- //menampilkan pesan error yang sudah diset tadi controler (dihapus karena pake required)-->

                        <!-- ///menmapilkan input kode otomatis -->
                        <?php

                        $koneksi = mysqli_connect('localhost', 'root', '', 'koperasi');

                        //
                        $query = mysqli_query($koneksi, "SELECT max(id_trans) as kodeTerbesar FROM transaksi");
                        $data = mysqli_fetch_array($query);
                        $kodeTrans = $data['kodeTerbesar'];
                        $urutan = (int) substr($kodeTrans, 1, 3);

                        $urutan++;
                        $huruf = "T";
                        $kodeTrans = $huruf . sprintf("%03s", $urutan);

                        ?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="judul">Id Kas</label>
                                <input type="text" name="id_trans" class="form-control" id="id_trans" value="<?php echo $kodeTrans; ?>" readonly>
                                <?= form_error('id_trans', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="judul">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal">
                                <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <label for="kategori">Jenis Kas</label>
                                <select class="form-control" id="jenis_kas" name="jenis_kas">
                                    <option value="" selected> -pilih- </option>
                                    <option value="Kas Masuk"> Kas Masuk </option>
                                    <option value="Kas Keluar"> Kas Keluar</option>
                                </select>
                                <?= form_error('jenis_kas', '<small class="text-danger pl-3">', '</small>'); ?>
                                <?= form_error('kas_keluar', '<small class="text-danger pl-3">', '</small>'); ?>
                                <?= form_error('kas_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>


                            <div class="form-group" name="kas_msk" id="kas_msk" hidden>
                                <label for="kategori">Kas Masuk</label>
                                <select class="form-control" id="kas_masuk" name="kas_masuk">
                                    <option value="">-pilih-</option>
                                    <?php foreach ($kmsk as $km) : ?>
                                        <option value="<?= $km['nama_kas']; ?>"> <?= $km['nama_kas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kas_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group" name="kas_klr" id="kas_klr" hidden>
                                <label for="kas_keluar">Kas Keluar</label>
                                <select class="form-control" id="kas_keluar" name="kas_keluar">
                                    <option value="">-pilih-</option>
                                    <?php foreach ($kklr as $kl) : ?>
                                        <option value="<?= $kl['nama_kas']; ?>"> <?= $kl['nama_kas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kas_keluar', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="judul">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="keterangan">
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="judul">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control" id="jumlah">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="tambah">tambah data</button>
                            <button type="reset" class="btn btn-danger float-right mr-3" name="tambah">reset data</button>
                        </form>

                    </div>
                </div>




            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- //cuman menmpilkan isi combo box ke input text  -->
<!-- <script>
    function ddlselect() {
        var d = document.getElementById("jenis_kas");
        var displaytext = d.options[d.selectedIndex].text;
        document.getElementById("kas_masuk").value = displaytext;
    }
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript'>
    $(window).load(function() {
        $("#jenis_kas").change(function() {
            console.log($("#jenis_kas option:selected").val());
            if ($("#jenis_kas option:selected").val() == '') {
                $('#kas_msk').prop('hidden', 'true');
                $('#kas_klr').prop('hidden', 'true');
            } else if ($("#jenis_kas option:selected").val() == 'Kas Masuk') {
                $('#kas_msk').prop('hidden', false);
                $('#kas_klr').prop('hidden', 'true');
            } else if ($("#jenis_kas option:selected").val() == 'Kas Keluar') {
                $('#kas_msk').prop('hidden', 'true');
                $('#kas_klr').prop('hidden', false);
            }
        });
    });
</script>