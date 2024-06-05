<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

    </div>
    <div class="card mb-3">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Cetak Slip</th>
                    </tr>
                </thead>
                <tbody id="listData">
                </tbody>
            </table>
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
        var data_kalender = ''

        function getData() {
            $.ajax({
                url: '<?php echo base_url(); ?>pegawai/dataTHR/dataKalender',
                type: 'POST',
                beforeSend: function() {},
                success: function(response) {
                    data_kalender = JSON.parse(response)
                    var html = ''
                    $.each(data_kalender.kalender, function(key, value) {
                        var hasil = data_kalender.seleksi.filter((values, keys) => {
                            if (values.id_kalender_thr_pk == value.id) return true
                        })
                        html += '<tr>'
                        html += '<td>' + (parseInt(key) + 1) + '</td>'
                        html += '<td>' + value.tanggal_thr + '</td>'
                        html += '<td>'
                        if (hasil.length > 0) {
                            html += '<button class="btn btn-sm btn-primary" onclick="cetakSlipTHRPerPerson(' + "'" + value.tanggal_thr + "'" + ')"><i class="fa fa-print"></i></button>'
                        } else {
                            html += '<i>Belum Realisasi</i>'
                        }
                        html += '</td>'
                        html += '</tr>'
                    })
                    $('#listData').html(html)
                }
            })
        }

        function cetakSlipTHRPerPerson(tgl_thr) {
            var url = '<?= base_url() ?>pegawai/dataTHR/slipTHRPerPerson/' + tgl_thr
            window.open(url, '_blank')
        }
    </script>