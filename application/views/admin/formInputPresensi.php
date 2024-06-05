<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Input Presensi Pegawai
        </div>
        <?php
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        ?>
        <div class="card-body">
            <div class="form-inline">
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Bulan: </label>
                    <select class="form-control ml-3" name="bulan" id="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <option value="01" <?php if ($bulan == '01') { echo 'selected'; } ?>>Januari</option>
                        <option value="02" <?php if ($bulan == '02') { echo 'selected'; } ?>>Februari</option>
                        <option value="03" <?php if ($bulan == '03') { echo 'selected'; } ?>>Maret</option>
                        <option value="04" <?php if ($bulan == '04') { echo 'selected'; } ?>>April</option>
                        <option value="05" <?php if ($bulan == '05') { echo 'selected'; } ?>>Mei</option>
                        <option value="06" <?php if ($bulan == '06') { echo 'selected'; } ?>>Juni</option>
                        <option value="07" <?php if ($bulan == '07') { echo 'selected'; } ?>>Juli</option>
                        <option value="08" <?php if ($bulan == '08') { echo 'selected'; } ?>>Agustus</option>
                        <option value="09" <?php if ($bulan == '09') { echo 'selected'; } ?>>September</option>
                        <option value="10" <?php if ($bulan == '10') { echo 'selected'; } ?>>Oktober</option>
                        <option value="11" <?php if ($bulan == '11') { echo 'selected'; } ?>>November</option>
                        <option value="12" <?php if ($bulan == '12') { echo 'selected'; } ?>>Desember</option>
                    </select>
                </div>

                <div class="form-inline">
                    <div class="form-group mb-2 ml-5">
                        <label for="statisticEmail2">Tahun: </label>
                        <select class="form-control ml-3" name="tahun" id="tahun">
                            <option value="">--Pilih Tahun--</option>
                            <?php $tahun = date('Y');
                            for ($i = 2022; $i < $tahun + 5; $i++) { ?>
                                <option value="<?php echo $i ?>" <?php if ($tahun == $i) { echo 'selected'; } ?>><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary mb-2 ml-auto" onclick="getData()"><i class="fas fa-eye"></i>Generate Form</button>
            </div>
        </div>

        <div class="alert alert-info">Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold" id="tampilBulan"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold" id="tampilTahun"><?php echo $tahun ?></span></div>
        <div class="container p-3" id="formTable"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            getData();
        });

        var dataForTable = '';
        var bulan = '';
        var tahun = '';

        function getData() {
            bulan = $('#bulan').val();
            tahun = $('#tahun').val();
            $('#tampilBulan').html(bulan);
            $('#tampilTahun').html(tahun);
            $.ajax({
                url: '<?php echo base_url(); ?>admin/dataPresensi/listPresensi',
                type: 'POST',
                data: {
                    bulantahun: bulan + tahun,
                },
                beforeSend: function() {},
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.length == 0) {
                        generateNewForm();
                    } else {
                        dataForTable = data;
                        form();
                    }
                }
            });
        }

        function generateNewForm() {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/dataPresensi/newListPresensi',
                type: 'GET',
                beforeSend: function() {},
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);
                    dataForTable = data;
                    form();
                }
            });
        }

        function form() {
            var html = "";
            html += '<table class="table table-bordered table-striped">';
            html += '<tr>';
            html += '<th class="text-center">No</th>';
            html += '<th class="text-center">NIP</th>';
            html += '<th class="text-center">Nama Pegawai</th>';
            html += '<th class="text-center" width="10%">Hadir</th>';
            html += '<th class="text-center" width="10%">Izin</th>';
            html += '<th class="text-center" width="10%">Sakit</th>';
            html += '<th class="text-center" width="10%">Alpha</th>';
            html += '</tr>';
            $.each(dataForTable, function(key, value) {
                html += '<tr>';
                html += '<td>' + (parseInt(key) + 1) + '</td>';
                html += '<td>' + value['nip'] + '</td>';
                html += '<td>' + value['nama_pegawai'] + '</td>';
                html += '<td><input type="number" class="form-control hadir" min="0" max="25" data-nip="' + value['nip'] + '" data-jabatan="' + value['id_jabatan'] + '" data-id="' + value['id_kehadiran'] + '" value="' + value['hadir'] + '"></td>';
                html += '<td><input type="number" class="form-control izin" min="0" max="25" data-nip="' + value['nip'] + '" data-jabatan="' + value['id_jabatan'] + '" data-id="' + value['id_kehadiran'] + '" value="' + value['izin'] + '"></td>';
                html += '<td><input type="number" class="form-control sakit" min="0" max="25" data-nip="' + value['nip'] + '" data-jabatan="' + value['id_jabatan'] + '" data-id="' + value['id_kehadiran'] + '" value="' + value['sakit'] + '"></td>';
                html += '<td><input type="number" class="form-control alpha" min="0" max="25" data-nip="' + value['nip'] + '" data-jabatan="' + value['id_jabatan'] + '" data-id="' + value['id_kehadiran'] + '" value="' + value['alpha'] + '"></td>';
                html += '</tr>';
            });
            html += '</table>';
            html += '<button class="btn btn-sm btn-success float-right" onclick="simpan()">Simpan</button>';
            $('#formTable').html(html);
        }

        function simpan() {
            var hadir = $('.hadir').map(function() {
                return $(this).val();
            }).get();
            var izin = $('.izin').map(function() {
                return $(this).val();
            }).get();
            var sakit = $('.sakit').map(function() {
                return $(this).val();
            }).get();
            var alpha = $('.alpha').map(function() {
                return $(this).val();
            }).get();
            var id_kehadiran = $('.alpha').map(function() {
                return $(this).data('id');
            }).get();
            var id_jabatan = $('.alpha').map(function() {
                return $(this).data('jabatan');
            }).get();
            var nip = $('.alpha').map(function() {
                return $(this).data('nip');
            }).get();
            var data = [];
            for (let i = 0; i < id_kehadiran.length; i++) {
                data.push({
                    hadir: hadir[i],
                    izin: izin[i],
                    sakit: sakit[i],
                    alpha: alpha[i],
                    id_kehadiran: id_kehadiran[i],
                    nip: nip[i],
                    id_jabatan: id_jabatan[i],
                    bulan: bulan + tahun
                });
            }
            var datas = {
                data: data
            };
            console.log(data);
            $.ajax({
                url: '<?php echo base_url(); ?>admin/dataPresensi/insertPresensi',
                type: 'POST',
                data: datas,
                beforeSend: function() {},
                success: function(response) {
                    if (JSON.parse(response).status == 'success') {
                        alert('Berhasil Input');
                    } else {
                        alert('Gagal Input');
                    }
                    getData();
                }
            });
        }
    </script>
</div>
