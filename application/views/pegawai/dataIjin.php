<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
            <i class="fa fa-plus"></i> Tambah Ijin
        </button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Ijin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputJenisIjin" class="control-label">Jenis Ijin</label>
                                        <select name="inputJenisIjin" id="inputJenisIjin" class="form-control" required="required" onchange="validation()">
                                            <option value="" disabled selected>Pilih Jenis Ijin</option>
                                            <option value="IJIN">IJIN</option>
                                            <option value="SAKIT">SAKIT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="inputTglMulai" class="control-label">Tanggal Mulai</label>
                                        <input type="date" name="inputTglMulai" id="inputTglMulai" class="form-control" required="required" onchange="validation()">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="inputTglMulai" class="control-label">Tanggal Akhir</label>
                                        <input type="date" name="inputTglAkhir" id="inputTglAkhir" class="form-control" required="required" onchange="validation()">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputKeterangan" class="control-label">Keterangan</label>
                                        <textarea id="inputKeterangan" class="form-control" onchange="validation()"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnPengajuan" onclick="pengajuanIjin()" disabled>Buat Pengajuan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Jenis Ijin</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Mulai Ijin</th>
                        <th>Tanggal Akhir Ijin</th>
                        <th>Jumlah Hari</th>
                        <th>Status Approval</th>
                    </tr>
                </thead>
                <tbody id="listData">
                </tbody>
            </table>
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

    function bulan(currentDate) {
        var d = new Date(currentDate);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = (month < 10 ? '0' : '') + month + '' + d.getFullYear()
        return current_date;
    }

    function datediff(first, second) {
        var day_start = new Date(first);
        var day_end = new Date(second);
        var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
        var d = Math.round(total_days);
        return d;
    }
    $(document).ready(function() {
        getData()
    })

    function getData() {
        $.ajax({
            url: '<?php echo base_url(); ?>pegawai/kelolaIjin/data_ijin',
            type: 'GET',
            beforeSend: function() {},
            success: function(response) {
                if (JSON.parse(response).length != 0) {
                    formData(JSON.parse(response))
                }
            }
        })
    }

    function formData(data) {
        var html = ""
        $.each(data, function(key, value) {
            if (value.status == 'PENDING') {
                bg = 'bg-secondary text-white'
            } else if (value.status == 'FAILED') {
                bg = 'bg-danger text-white'
            } else {
                bg = 'bg-success text-white'
            }
            html += '<tr>'
            html += '<td>' + (parseInt(key) + 1) + '</td>'
            html += '<td>' + value.nip_pk + '</td>'
            html += '<td>' + value.nama_pegawai + '</td>'
            html += '<td>' + value.nama_jabatan + '</td>'
            html += '<td>' + value.jenis_sia + '</td>'
            html += '<td>' + value.tanggal_pengajuan + '</td>'
            html += '<td>' + value.tanggal_awal + '</td>'
            html += '<td>' + value.tanggal_akhir + '</td>'
            html += '<td>' + value.jumlah_hari + '</td>'
            html += '<td><span class="badge ' + bg + '">' + value.status + '</span></td>'
            html += '</tr>'
        })
        $('#listData').html(html)
    }

    function getDates(startDate, endDate) {
        const dates = []
        let currentDate = startDate
        const addDays = function(days) {
            const date = new Date(this.valueOf())
            date.setDate(date.getDate() + days)
            return date
        }
        while (currentDate <= endDate) {
            dates.push(currentDate)
            currentDate = addDays.call(currentDate, 1)
        }
        return dates
    }

    function pengajuanIjin() {
        var jumlah_hari = (datediff($('#inputTglMulai').val(), $('#inputTglAkhir').val()) + 1)
        ajaxPengajuanIjin(jumlah_hari)
    }

    function ajaxPengajuanIjin(jumlah_hari) {
        var data = {
            nip: '<?= $nip ?>',
            jenis_sia: $('#inputJenisIjin').val(),
            jumlah_hari: jumlah_hari,
            status: 'PENDING',
            tanggal_pengajuan: currentDate(),
            tanggal_awal: $('#inputTglMulai').val(),
            tanggal_akhir: $('#inputTglAkhir').val(),
            bulan: bulan($('#inputTglAkhir').val()),
            keterangan: $('#inputKeterangan').val(),
        }
        $.ajax({
            url: '<?php echo base_url(); ?>pegawai/kelolaIjin/insertIjin',
            type: 'POST',
            data: data,
            beforeSend: function() {},
            success: function(response) {
                if (JSON.parse(response).status == 'success') {
                    alert('Berhasil Input')
                } else {
                    alert('Gagal Input')
                }
                $('#modal').modal('hide')
                getData()
            }
        })
    }

    function validation() {
        var a = $('#inputJenisIjin').val()
        var b = $('#inputTglMulai').val()
        var c = $('#inputTglAkhir').val()
        var d = $('#inputKeterangan').val()
        if (a != "" && b != "" && c != "" && d != "") {
            $('#btnPengajuan').removeAttr('disabled')
        } else {
            $('#btnPengajuan').attr('disabled')
        }
    }
</script>