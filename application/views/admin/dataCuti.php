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
                        <th>No</th>
                        <th>Nama Cuti</th>
                        <th>Batas Hari</th>
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
            url: '<?php echo base_url(); ?>admin/dataCuti/masterCuti',
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
            html += '<td>' + value.nama_cuti + '</td>'
            html += '<td>' + value.batas_hari + '</td>'
            html += '<td>'
            html += '<button class="btn btn-sm btn-primary mr-1" onclick="modalEdit(' + value.id + ',' + "'" + value.nama_cuti + "'" + ',' + value.batas_hari + ')"><i class="fa fa-pen"></i></button>'
            html += '<button class="btn btn-sm btn-danger" onclick="modalDelete(' + value.id + ',' + "'" + value.nama_cuti + "'" + ')"><i class="fa fa-trash"></i></button>'
            // html += '<button class="btn btn-sm btn-dark" onclick="link_relation(' + value.id + ')"><i class="fa fa-link"></i></button>'
            html += '</td>'
            html += '</tr>'
        })
        $('#listData').html(html)
    }

    function modalEdit(id = '', nama = '', batas_hari = '') {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Edit Master Cuti</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'

        html_body += '<div class="col-12">'
        html_body += '<div class="form-group">'
        html_body += '<label for="inputNama" class="control-label">Nama Cuti</label>'
        html_body += '<input type="text" name="inputNama" id="inputNama" class="form-control" required="required" value="' + nama + '">'
        html_body += '</div>'
        html_body += '</div>'
        html_body += '<div class="col-12">'
        html_body += '<div class="form-group">'
        html_body += '<label for="inputBatasHari" class="control-label">Batas Hari</label>'
        html_body += '<input type="number" name="inputBatasHari" id="inputBatasHari" class="form-control" required="required" value="' + batas_hari + '">'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        if (id != '') {

            html_footer += '<button type="button" class="btn btn-primary" onclick="ubahCuti(' + id + ')">Simpan</button>'
        } else {
            html_footer += '<button type="button" class="btn btn-primary" onclick="tambahCuti()">Simpan</button>'

        }
        $('#modalFooter').html(html_footer)
    }

    function modalDelete(id, nama) {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Hapus Master Cuti</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'
        html_body += 'Apakah anda yakin ingin menghapus data ' + nama + ' ?'
        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        html_footer += '<button type="button" class="btn btn-primary" onclick="hapusCuti(' + id + ')">Simpan</button>'

        $('#modalFooter').html(html_footer)
    }

    function hapusCuti(id) {
        var data = {
            id: id,
        }
        var url = '<?php echo base_url(); ?>admin/dataCuti/hapusCuti'
        ajaxCuti(data, url)
    }

    function ubahCuti(id) {
        var data = {
            id: id,
            nama: $('#inputNama').val(),
            batas_hari: $('#inputBatasHari').val(),
        }
        var url = '<?php echo base_url(); ?>admin/dataCuti/ubahCuti'
        ajaxCuti(data, url)
    }

    function tambahCuti() {
        var data = {
            nama: $('#inputNama').val(),
            batas_hari: $('#inputBatasHari').val(),
        }
        var url = '<?php echo base_url(); ?>admin/dataCuti/tambahCuti'
        ajaxCuti(data, url)
    }

    function ajaxCuti(data, url) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            beforeSend: function() {},
            success: function(response) {
                console.log(JSON.parse(response).message)
                alert(JSON.parse(response).message)
                $('#modal').modal('hide')
                getData()
            }
        })
    }

    function link_relation(id = '') {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/dataCuti/masterRelation',
            type: 'GET',
            data: {
                id: id,
            },
            beforeSend: function() {},
            success: function(response) {
                if (JSON.parse(response).length != 0) {
                    formRelation(id, JSON.parse(response))
                } else {
                    formRelation(id)
                }
            }
        })
    }

    function formRelation(id = '', data = '') {
        console.log(data)
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Create Link Relation</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'

        if (id != '') {
            var index = data.findIndex(p => p.col_jabatan == "gaji_pokok");
            if (index == -1) {
                var id_relation = ''
                var check = ''
            } else {
                var id_relation = data[index].id
                var check = 'checked'
            }
        } else {
            var id_relation = ''
            var check = ''
        }
        html_body += '<div class="col-12">'
        html_body += '<div class="form-check">'
        html_body += '<input class="form-check-input" type="checkbox" value="gaji_pokok" id="defaultGajiPokok" data-id="' + id_relation + '" ' + check + '>'
        html_body += '<label class="form-check-label" for="defaultGajiPokok">Gaji Pokok</label>'
        html_body += '</div>'
        html_body += '</div>'

        if (id != '') {
            var index = data.findIndex(p => p.col_jabatan == "transport");
            if (index == -1) {
                var id_relation = ''
                var check = ''
            } else {
                var id_relation = data[index].id
                var check = 'checked'
            }
        } else {
            var id_relation = ''
            var check = ''
        }
        html_body += '<div class="col-12">'
        html_body += '<div class="form-check">'
        html_body += '<input class="form-check-input" type="checkbox" value="transport" id="defaultTransport" data-id="' + id_relation + '" ' + check + '>'
        html_body += '<label class="form-check-label" for="defaultTransport">Transport</label>'
        html_body += '</div>'
        html_body += '</div>'

        if (id != '') {
            var index = data.findIndex(p => p.col_jabatan == "uang_makan");
            if (index == -1) {
                var id_relation = ''
                var check = ''
            } else {
                var id_relation = data[index].id
                var check = 'checked'
            }
        } else {
            var id_relation = ''
            var check = ''
        }
        html_body += '<div class="col-12">'
        html_body += '<div class="form-check">'
        html_body += '<input class="form-check-input" type="checkbox" value="uang_makan" id="defaultUangMakan" data-id="' + id_relation + '" ' + check + '>'
        html_body += '<label class="form-check-label" for="defaultUangMakan">Uang Makan</label>'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        html_footer += '<button type="button" class="btn btn-primary" onclick="simpanRelation(' + id + ')">Simpan</button>'
        $('#modalFooter').html(html_footer)
    }

    function simpanRelation(id) {
        if (id != '' && id != undefined) {
            // jika ubah
        } else {
            // jika tambah
            var gaji = $('#defaultGajiPokok:checked').val()
            var transport = $('#defaultTransport:checked').val()
            var uang_makan = $('#defaultUangMakan:checked').val()
            var data = {
                gaji: gaji,
                transport: transport,
                uang_makan: uang_makan
            }
            var url = '<?php echo base_url(); ?>admin/dataCuti/tambahRelation'
        }
        console.log(data)
        // ajaxCuti(data, url)
    }
</script>