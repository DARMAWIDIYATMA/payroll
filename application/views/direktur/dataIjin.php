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
                        <th>Keterangan</th>
                        <th>Status Approval</th>
                        <th>Action</th>
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
    $(document).ready(function() {
        getData()
    })

    function getData() {
        $.ajax({
            url: '<?php echo base_url(); ?>direktur/kelolaIjin/data_ijin',
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
            html += '<td>' + value.keterangan + '</td>'
            html += '<td><span class="badge ' + bg + '">' + value.status + '</span></td>'
            html += '<td>'
            if (value.status == 'PENDING') {
                html += '<button class="btn btn-sm btn-primary" onclick="modalApproval(' + value.id + ',' + "'" + value.bulan + "'" + ',' + "'" + value.nip_pk + "'" + ',' + "'" + value.jenis_sia + "'" + ',' + value.jumlah_hari + ')"><i class="fa fa-check"></i> Approval</button>'
            }
            html += '</td>'
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

    function modalApproval(id, bulan, nip, sia, jumlah_hari) {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Approval Cuti</h5>'
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
        html_footer += '<button type="button" class="btn btn-primary" onclick="pengajuanCuti(' + id + ',' + "'" + bulan + "'" + ',' + "'" + nip + "'" + ',' + "'" + sia + "'" + ',' + jumlah_hari + ')">Kirim Approval</button>'
        $('#modalFooter').html(html_footer)
    }
    var approveType = ''

    function btnOption(type) {
        $('.card-type').removeClass('bg-grey')
        $('#option' + type).addClass('bg-grey')
        approveType = type
    }

    function pengajuanCuti(id, bulan, nip, sia, jumlah_hari) {
        var status = 'FAILED'
        if (approveType == 0) {
            var status = 'SUCCESS'
        }
        var data = {
            id: id,
            status: status,
            bulan: bulan,
            nip: nip,
            sia: sia,
            jumlah_hari: jumlah_hari,
        }
        $.ajax({
            url: '<?php echo base_url(); ?>direktur/kelolaIjin/approvalIjin',
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