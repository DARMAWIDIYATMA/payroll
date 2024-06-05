<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
            <i class="fa fa-plus"></i> Tambah Cuti
        </button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Cuti</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputJenisCuti" class="control-label">Jenis Cuti</label>
                                        <select name="inputJenisCuti" id="inputJenisCuti" class="form-control" required="required" onchange="batasCuti(),validation()">
                                            <option value="" disabled selected>Pilih Jenis Cuti</option>
                                            <?php foreach ($master_cuti as $key => $value) { ?>
                                                <option value="<?= $value->id ?>"><?= $value->nama_cuti ?></option>
                                            <?php } ?>
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
                                    <p>Jumlah Cuti Tersisa : <b id="jumlahCuti">-</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnPengajuan" onclick="pengajuanCuti()" disabled>Buat Pengajuan</button>
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
                        <th>Jenis Cuti</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Mulai Cuti</th>
                        <th>Tanggal Akhir Cuti</th>
                        <th>Jumlah Hari</th>
                        <th>Atasan</th>
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
            url: '<?php echo base_url(); ?>pegawai/kelolaCuti/data_cuti',
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
            if (value.status_approval == 'PENDING') {
                bg = 'bg-secondary text-white'
            } else if (value.status_approval == 'FAILED') {
                bg = 'bg-danger text-white'
            } else {
                bg = 'bg-success text-white'
            }
            html += '<tr>'
            html += '<td>' + (parseInt(key) + 1) + '</td>'
            html += '<td>' + value.nip + '</td>'
            html += '<td>' + value.nama_pegawai + '</td>'
            html += '<td>' + value.nama_jabatan + '</td>'
            html += '<td>' + value.nama_cuti + '</td>'
            html += '<td>' + value.tanggal_pengajuan + '</td>'
            html += '<td>' + value.tgl_mulai_cuti + '</td>'
            html += '<td>' + value.tgl_akhir_cuti + '</td>'
            html += '<td>' + value.jumlah_hari + '</td>'
            html += '<td>' + value.nama_atasan + '</td>'
            html += '<td><span class="badge ' + bg + '">' + value.status_approval + '</span></td>'
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
    var sisa = null

    function batasCuti() {
        $.ajax({
            url: '<?php echo base_url(); ?>pegawai/kelolaCuti/batas_cuti',
            type: 'POST',
            data: {
                year: new Date().getFullYear(),
                nip: '<?= $nip ?>',
                id_cuti: $('#inputJenisCuti').val(),
            },
            beforeSend: function() {},
            success: function(response) {
                var data = JSON.parse(response)[0]
                if (data.batas_hari > 0) {
                    sisa = parseInt(data.batas_hari) - parseInt(data.jumlah_cuti)
                    $('#jumlahCuti').html(sisa)
                } else {
                    $('#jumlahCuti').html('-')
                }
            }
        })
    }

    function pengajuanCuti() {
        var jumlah_hari = (datediff($('#inputTglMulai').val(), $('#inputTglAkhir').val()) + 1)
        if (sisa != null) {
            if (jumlah_hari >= sisa) {
                alert('Jumlah Hari Melebihi Batas Sisa Cuti')
            } else {
                ajaxPengajuanCuti(jumlah_hari)
            }
        } else {
            ajaxPengajuanCuti(jumlah_hari)
        }

    }

    function ajaxPengajuanCuti(jumlah_hari) {
        var data = {
            nip: '<?= $nip ?>',
            id_cuti: $('#inputJenisCuti').val(),
            jumlah_hari: jumlah_hari,
            status_approval: 'PENDING',
            nip_atasan: 1791209830491801,
            tanggal_pengajuan: currentDate(),
            tgl_mulai_cuti: $('#inputTglMulai').val(),
            tgl_akhir_cuti: $('#inputTglAkhir').val(),
        }
        $.ajax({
            url: '<?php echo base_url(); ?>pegawai/kelolaCuti/insertCuti',
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
        var a = $('#inputJenisCuti').val()
        var b = $('#inputTglMulai').val()
        var c = $('#inputTglAkhir').val()
        if (a != "" && b != "" && c != "") {
            $('#btnPengajuan').removeAttr('disabled')
        } else {
            $('#btnPengajuan').attr('disabled')
        }
    }
</script>