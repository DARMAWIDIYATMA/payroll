<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

    </div>
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Gaji Pegawai
        </div>

        <div class="card-body">
            <div class="form-inline">
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Tanggal THR: </label>
                    <select class="form-control ml-3" name="tgl_thr" id="tgl_thr">
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-auto" onclick="tampilData()"><i class="fas fa-eye"></i>Tampilkan Data</button>
                <button type="button" class="btn btn-success mb-2 ml-3" data-toggle="modal" data-target="#exampleModal" id="btnCetak">
                    <i class="fas fa-print mr-1"></i>Cetak Daftar THR</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIP</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal THR</th>
                            <th>Masa Kerja</th>
                            <th>Gaji Pokok</th>
                            <th>Nominal THR</th>
                            <th>Cetak Slip</th>
                        </tr>
                    </thead>
                    <tbody id="listData">
                    </tbody>
                </table>
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
        $(document).ready(function() {
            getData()
        })
        var data_karyawan = ''
        var data_kalender = ''

        function getData() {
            $.ajax({
                url: '<?php echo base_url(); ?>direktur/laporanTHR/dataKalender',
                type: 'GET',
                beforeSend: function() {},
                success: function(response) {
                    data_kalender = JSON.parse(response)
                    var html = ''
                    html += '<option value="" selected disabled>--Pilih Tanggal THR--</option>'
                    $.each(data_kalender, function(key, value) {
                        html += '<option value="' + value.tanggal_thr + '">' + value.tanggal_thr + '</option>'
                    })
                    $('#tgl_thr').html(html)
                }
            })
        }

        function tampilData() {
            var tgl_thr = $('#tgl_thr').val()
            $.ajax({
                url: '<?php echo base_url(); ?>direktur/laporanTHR/dataKaryawan',
                type: 'POST',
                data: {
                    tgl_thr: tgl_thr,
                },
                beforeSend: function() {},
                success: function(response) {
                    data_karyawan = JSON.parse(response)
                    var html = ''
                    if (data_karyawan.thr.length != 0) {
                        $.each(data_karyawan.thr, function(key, value) {
                            html += '<tr>'
                            html += '<td>' + (parseInt(key) + 1) + '</td>'
                            html += '<td>' + value.nip + '</td>'
                            html += '<td>' + value.nama_pegawai + '</td>'
                            html += '<td>' + value.tgl_masuk + '</td>'
                            html += '<td>' + value.tgl_thr + '</td>'
                            html += '<td>' + value.masa_kerja + '</td>'
                            html += '<td>' + number_format(value.gaji_pokok) + '</td>'
                            html += '<td>' + number_format(value.nominal) + '</td>'
                            html += '<td><button class="btn btn-sm btn-primary" onclick="cetakSlipTHRPerPerson(' + "'" + tgl_thr + "'" + ',' + "'" + value.nip + "'" + ')"><i class="fa fa-print"></i></button></td>'
                            html += '</tr>'
                        })
                    } else {
                        html += '<tr>'
                        html += '<td colspan="9" class="text-center"><i>Tidak Ada Data, Silahkan Input Terlebih Dahulu</i></td>'
                        html += '</tr>'
                    }
                    $('#listData').html(html)
                }
            })
        }

        function cetakSlipTHRPerPerson(tgl_thr, nip) {
            var url = '<?= base_url() ?>direktur/laporanTHR/slipTHRPerPerson/' + tgl_thr + '/' + nip
            window.open(url, '_blank')
        }
        $(document).on('click', '#btnCetak', function(e) {
            var tgl_thr = $('#tgl_thr').val()
            cetakSlipTHR(tgl_thr)
        })

        function cetakSlipTHR(tgl_thr) {
            var url = '<?= base_url() ?>direktur/laporanTHR/slipTHR/' + tgl_thr
            window.open(url, '_blank')
        }
    </script>