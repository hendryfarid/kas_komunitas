<div class="container">

    <div class="card o-hidden border-0 shadow-lg col-lg-7 mx-auto my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <!-- kode otomatis -->
            <?php

            $koneksi = mysqli_connect('localhost', 'root', '', 'koperasi');

            //
            $query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM anggota");
            $data = mysqli_fetch_array($query);
            $kodeAnggota = $data['kodeTerbesar'];
            $urutan = $kodeAnggota - 1;

            $urutan++;
            $huruf = "A";
            $kodeAnggota = $huruf . sprintf("%03s", $urutan);


            ?>
            <?php

            $koneksi1 = mysqli_connect('localhost', 'root', '', 'koperasi');
            //iduser input manual otomatis
            $query1 = mysqli_query($koneksi1, "SELECT max(id) as kodeTerbesar1 FROM user");
            $data1 = mysqli_fetch_array($query1);
            $kodeAnggota1 = $data1['kodeTerbesar1'];
            $urutan1 = (int) ($kodeAnggota1);

            $urutan1 = $urutan1 + 1;

            $kodeAnggota1 = sprintf("%1s", $urutan1);
            ?>
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Daftar Anggota!</h1>
							<center><p>Repost by <a href='https://stokcoding.com/' title='StokCoding.com' target='_blank'>StokCoding.com</a></p></center>

                        </div>
                        <form class="user" method="POST" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="id_anggota" name="id_anggota" placeholder="Member ID" value="<?php echo $kodeAnggota; ?>" readonly>
                                <?= form_error('id_anggota', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="id" name="id" value="<?php echo $kodeAnggota1; ?>" hidden readonly>
                                <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name') ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit " class="btn btn-primary btn-user btn-block">
                                Daftar
                            </button>

                        </form>
                        <hr>

                        <div class="text-center">
                            <a class="small" href="<?= base_url() ?>auth">Sudah punya akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
