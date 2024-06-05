<style>
    .bg-grey {
        background-color: #F5EAEA;
    }
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
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
                                <th>Action</th>
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
                                <th>Action</th>
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
                                <th>Action</th>
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
            url: '<?php echo base_url(); ?>direktur/posisiKaryawan/dataKaryawan',
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
            url: '<?php echo base_url(); ?>direktur/posisiKaryawan/dataPosisi',
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
            html += '<td>'
            if (value.status == 'PENDING') {
                html += '<button class="btn btn-sm btn-primary" onclick="modalApproval(' + value.id + ',0)"><i class="fa fa-check"></i> Approval</button>'
            }
            html += '</td>'
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
            html += '<td>'
            if (value.status == 'PENDING') {
                html += '<button class="btn btn-sm btn-primary" onclick="modalApproval(' + value.id + ',1)"><i class="fa fa-check"></i> Approval</button>'
            }
            html += '</td>'
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
            html += '<td>'
            if (value.status == 'PENDING') {
                html += '<button class="btn btn-sm btn-primary" onclick="modalApproval(' + value.id + ',2)"><i class="fa fa-check"></i> Approval</button>'
            }
            html += '</td>'
            html += '</tr>'
        })
        $('#listDataPHK').html(html)
    }

    function modalApproval(id, jenis) {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Approval Posisi Karyawan</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'

        html_body += '<div class="col-6">'
        html_body += '<div class="card card-type shadow-none" style="cursor:pointer;" onclick="btnOption(0)" id="option0">'
        html_body += '<div class="card-body text-center">'
        html_body += '<i class="fa fa-check text-success"></i> Setujui'
        html_body += '</div>'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '<div class="col-6">'
        html_body += '<div class="card card-type shadow-none" style="cursor:pointer;" onclick="btnOption(1)" id="option1">'
        html_body += '<div class="card-body text-center">'
        html_body += '<i class="fa fa-times text-danger"></i> Batalkan'
        html_body += '</div>'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        html_footer += '<button type="button" class="btn btn-primary" onclick="pengajuanPosisi(' + id + ',' + jenis + ')">Simpan</button>'
        $('#modalFooter').html(html_footer)
    }
    var approveType = ''

    function btnOption(type) {
        $('.card-type').removeClass('bg-grey')
        $('#option' + type).addClass('bg-grey')
        approveType = type
    }

    function pengajuanPosisi(id, jenis) {
        var status_approval = 'FAILED'
        if (approveType == 0) {
            var status_approval = 'SUCCESS'
        }
        var data = {
            id: id,
            status_approval: status_approval,
            jenis: jenis,
        }
        $.ajax({
            url: '<?php echo base_url(); ?>direktur/posisiKaryawan/approvalPosisi',
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
</script>