<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

    </div>
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter THR Pegawai
        </div>

        <div class="card-body">
            <div class="form-inline">
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Tanggal THR: </label>
                    <select class="form-control ml-3" name="tgl_thr" id="tgl_thr">
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-auto" onclick="tampilData()"><i class="fas fa-eye"></i>Tampilkan Data</button>
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
                        </tr>
                    </thead>
                    <tbody id="listData">
                    </tbody>
                </table>

                <button type="button" class="btn btn-success float-right" onclick="simpan()"><i class="fa fa-save mr-2"></i>Simpan</button>

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
                url: '<?php echo base_url(); ?>admin/dataTHR/dataKalender',
                type: 'GET',
                beforeSend: function() {},
                success: function(response) {
                    data_kalender = JSON.parse(response)
                    var html = ''
                    html += '<option value="" selected disabled>--Pilih Tanggal THR--</option>'
                    $.each(data_kalender, function(key, value) {
                        html += '<option value="' + value.tanggal_thr + '" data-id="' + value.id + '">' + value.tanggal_thr + '</option>'
                    })
                    $('#tgl_thr').html(html)
                }
            })
        }
        var data_simpan = []

        function tampilData() {
            var tgl_thr = $('#tgl_thr').val()
            var id = $('#tgl_thr').find(':selected').data('id')
            $.ajax({
                url: '<?php echo base_url(); ?>admin/dataTHR/dataKaryawan',
                type: 'POST',
                data: {
                    tgl_thr: tgl_thr,
                    id: id,
                },
                beforeSend: function() {},
                success: function(response) {
                    data_karyawan = JSON.parse(response)
                    var html = ''
                    if (data_karyawan.masaKaryawan.length != 0) {
                        $.each(data_karyawan.masaKaryawan, function(key, value) {
                            html += '<tr>'
                            html += '<td>' + (parseInt(key) + 1) + '</td>'
                            html += '<td>' + value.nip + '</td>'
                            html += '<td>' + value.nama_pegawai + '</td>'
                            html += '<td>' + value.tgl_masuk + '</td>'
                            html += '<td>' + value.tgl_thr + '</td>'
                            html += '<td>' + value.masa_kerja + '</td>'
                            html += '<td>' + number_format(value.gaji_pokok) + '</td>'
                            html += '<td>'
                            if (value.masa_kerja_bulan >= 12) {
                                var total = value.gaji_pokok
                            } else {
                                var total = (parseInt(value.masa_kerja_bulan) / 12) * value.gaji_pokok
                            }
                            html += number_format(total)
                            html == '</td>'
                            html += '</tr>'
                            data_simpan.push({
                                'nip': value.nip,
                                'nominal': total,
                            })
                        })
                    } else {
                        html += '<tr>'
                        html += '<td colspan="8" class="text-center"><i>Tidak Ada Data, Data Telah Tersimpan</i></td>'
                        html += '</tr>'
                    }
                    $('#listData').html(html)
                }
            })
        }

        function simpan() {
            var data = {
                tanggal_thr: $('#tgl_thr').find(':selected').data('id'),
                detail: data_simpan,
            }
            var url = '<?php echo base_url(); ?>admin/dataTHR/simpan'
            ajaxKalenderTHR(data, url)
        }

        function ajaxKalenderTHR(data, url) {
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                beforeSend: function() {},
                success: function(response) {
                    alert(JSON.parse(response).message)
                    getData()
                }
            })
        }
    </script>