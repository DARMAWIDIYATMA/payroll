<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

    </div>
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Posisi Pegawai
        </div>

        <div class="card-body">
            <div class="form-inline">
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Kategori</label>
                    <select class="form-control ml-3 mr-3" name="kategori" id="kategori">
                        <option value="PROMOSI">PROMOSI / DEMOSI</option>
                        <option value="MUTASI">MUTASI</option>
                        <option value="PHK">PHK</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Pegawai</label>
                    <select class="form-control ml-3 mr-3" name="karyawan" id="karyawan">
                        <option value="">Semua Pegawai</option>
                        <?php foreach ($karyawan as $key => $value) { ?>
                            <option value="<?= $value->nip ?>"><?= $value->nama_pegawai ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Tanggal Awal</label>
                    <input type="date" name="" id="tanggal_awal" class="form-control ml-3 mr-3" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Tanggal Akhir</label>
                    <input type="date" name="" id="tanggal_akhir" class="form-control ml-3 mr-3" value="<?= date('Y-m-d') ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-auto" onclick="tampilData()"><i class="fas fa-eye"></i>Tampilkan Data</button>
                  
            </div>
        </div>
        <div class="card">
            <div class="card-body" id="tampilLaporan">

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                </div>
                <div class="modal-body" id="modalBody">
                </div>
                <div class="modal-footer" id="modalFooter">
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        function currentDate() {
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var current_date = d.getFullYear() + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                (day < 10 ? '0' : '') + day
            return current_date;
        }

        function datediff(first, second) {
            var day_start = new Date(first);
            var day_end = new Date(second);
            var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
            var d = Math.round(total_days);
            return d;
        }

        function number_format(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        $(document).ready(function() {})

        function tampilData() {
            $('#tampilLaporan').html('')
            var kategori = $('#kategori').val()
            if (kategori == 'PROMOSI') {
                tampilPromosi()
            } else if (kategori == 'MUTASI') {
                tampilMutasi()
            } else {
                tampilPhk()
            }
        }

        function tampilPromosi() {
            ajax('dataPromosi', 'PROMOSI')
        }

        function tampilMutasi() {
            ajax('dataMutasi', 'MUTASI')
        }

        function tampilPhk() {
            ajax('dataPHK', 'PHK')
        }

        function ajax(link, kategori) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/laporanPosisiKaryawan/' + link,
                type: 'POST',
                data: {
                    tanggal_awal: $('#tanggal_awal').val(),
                    tanggal_akhir: $('#tanggal_akhir').val(),
                    nip: $('#karyawan').val(),
                },
                beforeSend: function() {},
                success: function(response) {
                    if (kategori == 'PROMOSI') {
                        formPromosi(JSON.parse(response))
                    } else if (kategori == 'MUTASI') {
                        formMutasi(JSON.parse(response))
                    } else {
                        formPHK(JSON.parse(response))
                    }
                }
            })
        }

        function formPromosi(data) {
            var html = ""
            html += '<table class="table table-bordered table-hover">'
            html += '<thead>'
            html += '<tr>'
            html += '<th>#</th>'
            html += '<th>NIP</th>'
            html += '<th>Nama Karyawan</th>'
            html += '<th>Keterangan</th>'
            html += '<th>Tanggal</th>'
            html += '<th>Jabatan Lama</th>'
            html += '<th>Jabatan Baru</th>'
            html += '<th>Alasan</th>'
            html += '<th>Status Approval</th>'
            html += '</tr>'
            html += '</thead>'
            html += '<tbody>'
            $.each(data, function(key, value) {
                html += '<tr>'
                html += '<td>' + (parseInt(key) + 1) + '</td>'
                html += '<td>' + value.nip_pk + '</td>'
                html += '<td>' + value.nama_pegawai + '</td>'
                html += '<td>' + value.keterangan + '</td>'
                html += '<td>' + value.tanggal + '</td>'
                html += '<td>' + value.jabatan_lama + '</td>'
                html += '<td>' + value.jabatan_baru + '</td>'
                html += '<td>' + value.alasan_promosi + '</td>'
                html += '<td>' + value.status + '</td>'
                html += '</tr>'
            })
            html += '</tbody>'
            html += '</table>'
            $('#tampilLaporan').html(html)
        }

        function formMutasi(data) {
            var html = ""
            html += '<table class="table table-bordered table-hover">'
            html += '<thead>'
            html += '<tr>'
            html += '<th>#</th>'
            html += '<th>NIP</th>'
            html += '<th>Nama Karyawan</th>'
            html += '<th>Tanggal</th>'
            html += '<th>Jabatan Lama</th>'
            html += '<th>Jabatan Baru</th>'
            html += '<th>Lokasi Lama</th>'
            html += '<th>Lokasi Baru</th>'
            html += '<th>Alasan</th>'
            html += '<th>Status Approval</th>'
            html += '</tr>'
            html += '</thead>'
            html += '<tbody>'
            $.each(data, function(key, value) {
                html += '<tr>'
                html += '<td>' + (parseInt(key) + 1) + '</td>'
                html += '<td>' + value.nip_pk + '</td>'
                html += '<td>' + value.nama_pegawai + '</td>'
                html += '<td>' + value.tanggal + '</td>'
                html += '<td>' + value.jabatan_lama + '</td>'
                html += '<td>' + value.jabatan_baru + '</td>'
                html += '<td>' + value.lokasi_lama + '</td>'
                html += '<td>' + value.lokasi_baru + '</td>'
                html += '<td>' + value.alasan_mutasi + '</td>'
                html += '<td>' + value.status + '</td>'
                html += '</tr>'
            })
            html += '</tbody>'
            html += '</table>'
            $('#tampilLaporan').html(html)
        }

        function formPHK(data) {
            var html = ""
            html += '<table class="table table-bordered table-hover">'
            html += '<thead>'
            html += '<tr>'
            html += '<th>#</th>'
            html += '<th>NIP</th>'
            html += '<th>Nama Karyawan</th>'
            html += '<th>Tanggal</th>'
            html += '<th>Alasan</th>'
            html += '<th>Status Approval</th>'
            html += '</tr>'
            html += '</thead>'
            html += '<tbody>'
            $.each(data, function(key, value) {
                html += '<tr>'
                html += '<td>' + (parseInt(key) + 1) + '</td>'
                html += '<td>' + value.nip_pk + '</td>'
                html += '<td>' + value.nama_pegawai + '</td>'
                html += '<td>' + value.tanggal + '</td>'
                html += '<td>' + value.alasan_phk + '</td>'
                html += '<td>' + value.status + '</td>'
                html += '</tr>'
            })
            html += '</tbody>'
            html += '</table>'
            $('#tampilLaporan').html(html)
        }

        $(document).on('click', '#btnCetak', function(e) {
            var kategori = $('#kategori').val()
            var tanggal_awal = $('#tanggal_awal').val()
            var tanggal_akhir = $('#tanggal_akhir').val()
            var nip = $('#karyawan').val()
            cetakSlipTHR(kategori, tanggal_awal, tanggal_akhir, nip)
        })

        function cetakSlipTHR(kategori, tanggal_awal, tanggal_akhir, nip) {
            var url = '<?= base_url() ?>admin/laporanPosisiKaryawan/cetakLaporan/' + kategori + '/' + tanggal_awal + '/' + tanggal_akhir + '/' + nip
            window.open(url, '_blank')
        }
    </script>