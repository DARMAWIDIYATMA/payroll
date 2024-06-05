<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>


        <button type="button" class="btn btn-success" onclick="modalEdit()"><i class="fa fa-plus"></i> Tambah Baru</button>

    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Persentase</th>
                        <th>Batas Atas</th>
                        <th>Batas Bawah</th>
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
    function number_format(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

    function getData() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/dataPKP/masterPPH',
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
            html += '<tr>'
            html += '<td>' + (parseInt(key) + 1) + '</td>'
            html += '<td>' + value.persen + '</td>'
            html += '<td>' + number_format(value.batas_atas) + '</td>'
            html += '<td>' + number_format(value.batas_bawah) + '</td>'
            html += '<td>'
            html += '<button class="btn btn-sm btn-primary mr-1" onclick="modalEdit(' + value.id + ',' + "'" + value.persen + "'" + ',' + value.batas_atas + ',' + value.batas_bawah + ')"><i class="fa fa-pen"></i></button>'
            html += '<button class="btn btn-sm btn-danger" onclick="modalDelete(' + value.id + ',' + "'" + value.persen + "'" + ')"><i class="fa fa-trash"></i></button>'
            // html += '<button class="btn btn-sm btn-dark" onclick="link_relation(' + value.id + ')"><i class="fa fa-link"></i></button>'
            html += '</td>'
            html += '</tr>'
        })
        $('#listData').html(html)
    }

    function modalEdit(id = '', persen = '', batas_atas = '', batas_bawah = '') {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Master PKP</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'

        html_body += '<div class="col-2">'
        html_body += '<div class="form-group">'
        html_body += '<label for="inputPersen" class="control-label">Tarif (%)</label>'
        html_body += '<input type="number" name="inputPersen" id="inputPersen" class="form-control" required="required" value="' + persen + '">'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '<div class="col-5">'
        html_body += '<div class="form-group">'
        html_body += '<label for="inputBatasAtas" class="control-label">Batas Atas (Rp)</label>'
        html_body += '<input type="number" name="inputBatasAtas" id="inputBatasAtas" class="form-control" required="required" value="' + batas_atas + '">'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '<div class="col-5">'
        html_body += '<div class="form-group">'
        html_body += '<label for="inputBatasBawah" class="control-label">Batas Bawah (Rp)</label>'
        html_body += '<input type="number" name="inputBatasBawah" id="inputBatasBawah" class="form-control" required="required" value="' + batas_bawah + '">'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '<div class="col-12">'
        html_body += '<p>Karyawan akan kena PKP (penghasilan kena pajak) jika penghasilan lebih dari 4.5 Juta. Data diatas diklasifikasi berdasarkan akumulasi penghasilan selama 1 tahun</p>'
        html_body += '</div>'

        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        if (id != '') {

            html_footer += '<button type="button" class="btn btn-primary" onclick="ubahPKP(' + id + ')">Simpan</button>'
        } else {
            html_footer += '<button type="button" class="btn btn-primary" onclick="tambahPKP()">Simpan</button>'

        }
        $('#modalFooter').html(html_footer)
    }

    function modalDelete(id, persen) {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Hapus Master PKP</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'
        html_body += 'Apakah anda yakin ingin menghapus data PKP dengan tarif ' + persen + ' ?'
        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        html_footer += '<button type="button" class="btn btn-primary" onclick="hapusPKP(' + id + ')">Simpan</button>'

        $('#modalFooter').html(html_footer)
    }

    function hapusPKP(id) {
        var data = {
            id: id,
        }
        var url = '<?php echo base_url(); ?>admin/dataPKP/hapusPKP'
        ajaxPKP(data, url)
    }

    function ubahPKP(id) {
        var data = {
            id: id,
            persen: $('#inputPersen').val(),
            batasAtas: $('#inputBatasAtas').val(),
            batasBawah: $('#inputBatasBawah').val(),
        }
        var url = '<?php echo base_url(); ?>admin/dataPKP/ubahPKP'
        ajaxPKP(data, url)
    }

    function tambahPKP() {
        var data = {
            persen: $('#inputPersen').val(),
            batasAtas: $('#inputBatasAtas').val(),
            batasBawah: $('#inputBatasBawah').val(),
        }
        var url = '<?php echo base_url(); ?>admin/dataPKP/tambahPKP'
        ajaxPKP(data, url)
    }

    function ajaxPKP(data, url) {
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