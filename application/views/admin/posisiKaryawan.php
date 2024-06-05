<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>


        <button type="button" class="btn btn-success" onclick="modalEdit()"><i class="fa fa-plus"></i> Tambah Baru</button>

    </div>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Promosi/Demosi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mutasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">PHK</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Jabatan Lama</th>
                                <th>Jabatan Baru</th>
                                <th>Alasan</th>
                                <th>Approval</th>
                            </tr>
                        </thead>
                        <tbody id="listDataPromosi">
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Jabatan Lama</th>
                                <th>Jabatan Baru</th>
                                <th>Lokasi Lama</th>
                                <th>Lokasi Baru</th>
                                <th>Alasan</th>
                                <th>Approval</th>
                            </tr>
                        </thead>
                        <tbody id="listDataMutasi">
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Alasan</th>
                                <th>Approval</th>
                            </tr>
                        </thead>
                        <tbody id="listDataPHK">
                        </tbody>
                    </table>
                </div>
            </div>

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
    function bulan(currentDate) {
        var d = new Date(currentDate);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = (month < 10 ? '0' : '') + month + '' + d.getFullYear()
        return current_date;
    }

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
    var data_karyawan

    function getData() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/posisiKaryawan/dataKaryawan',
            type: 'GET',
            beforeSend: function() {},
            success: function(response) {
                data_karyawan = JSON.parse(response)
                getDataPosisi()
            }
        })
    }

    function getDataPosisi() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/posisiKaryawan/dataPosisi',
            type: 'GET',
            beforeSend: function() {},
            success: function(response) {
                formDataPromosi(JSON.parse(response).promosi)
                formDataMutasi(JSON.parse(response).mutasi)
                formDataPHK(JSON.parse(response).PHK)
            }
        })
    }

    function formDataPromosi(data) {
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
            html += '<td>' + value.keterangan + '</td>'
            html += '<td>' + value.tanggal + '</td>'
            html += '<td>' + value.jabatan_lama + '</td>'
            html += '<td>' + value.jabatan_baru + '</td>'
            html += '<td>' + value.alasan_promosi + '</td>'
            html += '<td><span class="badge ' + bg + '">' + value.status + '</span></td>'
            html += '</tr>'
        })
        $('#listDataPromosi').html(html)
    }

    function formDataMutasi(data) {
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
            html += '<td>' + value.tanggal + '</td>'
            html += '<td>' + value.jabatan_lama + '</td>'
            html += '<td>' + value.jabatan_baru + '</td>'
            html += '<td>' + value.lokasi_lama + '</td>'
            html += '<td>' + value.lokasi_baru + '</td>'
            html += '<td>' + value.alasan_mutasi + '</td>'
            html += '<td><span class="badge ' + bg + '">' + value.status + '</span></td>'
            html += '</tr>'
        })
        $('#listDataMutasi').html(html)
    }

    function formDataPHK(data) {
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
            html += '<td>' + value.tanggal + '</td>'
            html += '<td>' + value.alasan_phk + '</td>'
            html += '<td><span class="badge ' + bg + '">' + value.status + '</span></td>'
            html += '</tr>'
        })
        $('#listDataPHK').html(html)
    }

    function modalEdit(id = '', nama = '', batas_hari = '') {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Pengajuan Posisi Karyawan</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'

        html_body += '<div class="col-12">'

        html_body += '<div class="form-group">'
        html_body += '<label for="karyawan" class="control-label">Karyawan</label>'
        html_body += '<select name="" id="karyawan" class="form-control" required="required" onchange="changePengajuan()">'
        html_body += '<option value="" selected disabled>Pilih Karyawan</option>'
        $.each(data_karyawan.karyawan, function(key, value) {
            html_body += '<option value="' + value.nip + '" data-id_jabatan="' + value.id_jabatan + '" data-nama_jabatan="' + value.nama_jabatan + '" data-id_lokasi="' + value.id_lokasi_kerja_pk + '" data-nama_lokasi="' + value.nama_lokasi + '">' + value.nama_pegawai + '</option>'
        })
        html_body += '</select>'
        html_body += '</div>'

        html_body += '<div class="form-group">'
        html_body += '<label for="jenisPengajuan" class="control-label">Jenis Pengajuan</label>'
        html_body += '<select name="" id="jenisPengajuan" class="form-control" required="required" onchange="changePengajuan()">'
        html_body += '<option value="PROMOSI">PROMOSI</option>'
        html_body += '<option value="DEMOSI">DEMOSI</option>'
        html_body += '<option value="MUTASI">MUTASI</option>'
        html_body += '<option value="PHK">PHK</option>'
        html_body += '</select>'
        html_body += '</div>'

        html_body += '</div>'

        html_body += '<div class="col-12" id="field">'
        html_body += '</div>'

        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        html_footer += '<button type="button" class="btn btn-primary" onclick="tambahPosisiKaryawan()">Simpan</button>'
        $('#modalFooter').html(html_footer)
    }

    function changePengajuan() {
        var pengajuan = $('#jenisPengajuan').val()
        var id_jabatan = $('#karyawan').find(':selected').data('id_jabatan')
        var nama_jabatan = $('#karyawan').find(':selected').data('nama_jabatan')
        var id_lokasi = $('#karyawan').find(':selected').data('id_lokasi')
        var nama_lokasi = $('#karyawan').find(':selected').data('nama_lokasi')
        if (pengajuan == 'PROMOSI' || pengajuan == 'DEMOSI') {
            promosiDemosi(id_jabatan, nama_jabatan)
        } else if (pengajuan == 'MUTASI') {
            mutasi(id_jabatan, nama_jabatan, id_lokasi, nama_lokasi)
        } else {
            phk()
        }
    }

    function promosiDemosi(id_jabatan, nama_jabatan) {
        var html = ''
        html += '<div class="row">'
        html += '<div class="col-12">'
        html += 'Jabatan Lama : <span class="text-danger"><b>' + nama_jabatan + '</b></span>'
        html += '<hr>'
        html += '</div>'
        html += '<div class="col-12">'
        html += '<div class="form-group">'
        html += '<label for="inputJabatan" class="control-label">Jabatan Baru</label>'
        html += '<select name="" id="inputJabatan" class="form-control" required="required">'
        html += '<option value="" selected disabled>Pilih Jabatan</option>'
        $.each(data_karyawan.jabatan, function(key, value) {
            html += '<option value="' + value.id_jabatan + '">' + value.nama_jabatan + '</option>'
        })
        html += '</select>'
        html += '</div>'
        html += '</div>'
        html += '<div class="col-12">'
        html += '<div class="form-group">'
        html += '<label for="inputAlasan" class="control-label">Alasan</label>'
        html += '<textarea class="form-control" id="inputAlasan"></textarea>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
        $('#field').html(html)
    }

    function mutasi(id_jabatan, nama_jabatan, id_lokasi, nama_lokasi) {
        var html = ''
        html += '<div class="row">'

        html += '<div class="col-12">'
        html += 'Jabatan Lama : <span class="text-danger"><b>' + nama_jabatan + '</b></span><br>'
        html += 'Lokasi Lama : <span class="text-danger"><b>' + nama_lokasi + '</b></span>'
        html += '<hr>'
        html += '</div>'

        html += '<div class="col-12">'
        html += '<div class="form-group">'
        html += '<label for="inputJabatan" class="control-label">Jabatan Baru</label>'
        html += '<select name="" id="inputJabatan" class="form-control" required="required">'
        html += '<option value="" selected disabled>Pilih Jabatan</option>'
        $.each(data_karyawan.jabatan, function(key, value) {
            html += '<option value="' + value.id_jabatan + '">' + value.nama_jabatan + '</option>'
        })
        html += '</select>'
        html += '</div>'
        html += '</div>'

        html += '<div class="col-12">'
        html += '<div class="form-group">'
        html += '<label for="lokasi_kerja" class="control-label">Lokasi Kerja Baru</label>'
        html += '<select name="" id="lokasi_kerja" class="form-control" required="required">'
        html += '<option value="" selected disabled>Pilih Lokasi Kerja</option>'
        $.each(data_karyawan.lokasi_kerja, function(key, value) {
            html += '<option value="' + value.id + '">' + value.nama_lokasi + '</option>'
        })
        html += '</select>'
        html += '</div>'
        html += '</div>'

        html += '<div class="col-12">'
        html += '<div class="form-group">'
        html += '<label for="inputAlasan" class="control-label">Alasan</label>'
        html += '<textarea class="form-control" id="inputAlasan"></textarea>'
        html += '</div>'
        html += '</div>'

        html += '</div>'
        $('#field').html(html)
    }

    function phk() {
        var html = ''
        html += '<div class="row">'
        html += '<div class="col-12">'
        html += '<hr>'
        html += '</div>'
        html += '<div class="col-12">'
        html += '<div class="form-group">'
        html += '<label for="inputAlasan" class="control-label">Alasan PHK</label>'
        html += '<textarea class="form-control" id="inputAlasan"></textarea>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
        $('#field').html(html)
    }

    function tambahPosisiKaryawan() {
        var data = {
            nip: $('#karyawan').val(),
            pengajuan: $('#jenisPengajuan').val(),
            jabatan_lama: $('#karyawan').find(':selected').data('id_jabatan'),
            jabatan_baru: $('#inputJabatan').val(),
            lokasi_lama: $('#karyawan').find(':selected').data('id_lokasi'),
            lokasi_baru: $('#lokasi_kerja').val(),
            alasan: $('#inputAlasan').val(),
            tanggal: currentDate(),
            bulan: bulan(currentDate()),
        }
        var url = '<?php echo base_url(); ?>admin/posisiKaryawan/tambahPosisiKaryawan'
        ajaxCuti(data, url)
    }

    function ajaxCuti(data, url) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            beforeSend: function() {},
            success: function(response) {
                alert(JSON.parse(response).message)
                $('#modal').modal('hide')
                getData()
            }
        })
    }
</script>