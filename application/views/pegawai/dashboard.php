<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
        <div class="text-right text-gray-500" id="current-time"><?php echo date("l, F j, Y \a\\t H:i:s"); ?></div> <!-- Tambahkan baris ini -->
    </div>

    <div class="alert alert-success font-weight-bold mb-4" style="width: 70%">Selamat Datang, Anda Login Sebagai Pegawai.</div>


    <div class="card" style="margin-bottom: 120px; width: 70%">
        <div class="card-header font-weight-bold bg-primary text-white">
            Data Pegawai

        </div>

        <?php foreach ($pegawai as $p) : ?>

            <div class="card body">

                <div class="row">

                    <div class="col-md-5">
                        <img style="width:250px" src="<?php echo base_url('assets/photo/' . $p->photo) ?>">
                    </div>

                    <div class="col-md-6">
                        <table class="table">

                            <tr>
                                <td>NIP</td>
                                <td>:</td>
                                <td><?php echo $p->nip ?></td>
                            </tr>

                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><?php echo $p->nik ?></td>
                            </tr>

                            <tr>
                                <td>Nama Pegawai</td>
                                <td>:</td>
                                <td><?php echo $p->nama_pegawai ?></td>
                            </tr>

                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><?php echo $p->nama_jabatan ?></td>
                            </tr>

                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?php echo $p->jenis_kelamin ?></td>
                            </tr>

                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?php echo $p->alamat ?></td>
                            </tr>

                            <tr>
                                <td>No Telepon</td>
                                <td>:</td>
                                <td>+62<?php echo $p->no_telp ?></td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $p->email ?></td>
                            </tr>

                            <tr>
                                <td>Tanggal Masuk</td>
                                <td>:</td>
                                <td><?php echo $p->tgl_masuk ?></td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><?php echo $p->status ?></td>
                            </tr>
                            <tr>
                                <td>History Jabatan</td>
                                <td>:</td>
                                <td>
                                    <?php foreach ($historyJabatan as $key => $value) { ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col"><b class="small"><?= $value->tanggal ?></b></div>
                                                    <div class="col">
                                                        <p class="m-0 small"><?= $value->nama_jabatan ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>

<!-- Tambahkan skrip JavaScript untuk memperbarui waktu dan tanggal -->
<script>
    // Fungsi untuk memperbarui waktu secara real-time
    function updateTime() {
        var now = new Date();
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var day = days[now.getDay()];
        var month = months[now.getMonth()];
        var date = now.getDate();
        var year = now.getFullYear();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        // Formatting waktu
        var timeString = day + ', ' + month + ' ' + date + ', ' + year + ' at ' + hours + ':' + minutes + ':' + seconds;

        // Memperbarui teks pada elemen dengan ID "current-time"
        document.getElementById('current-time').textContent = timeString;
    }

    // Memanggil fungsi updateTime setiap detik
    setInterval(updateTime, 1000);
</script>
