<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .bg-grey {
            background-color: #F5EAEA;
        }
        .custom-bg {
            background-color: #7B8FA1 !important; /* Tambahkan !important untuk prioritas lebih tinggi */
            color: white !important; /* Pastikan teks tetap putih */
        }
        .bg-purple {
    background-color: #539165 !important;
}
.bg-blue {
    background-color: #3F4E4F !important;
}
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
</head>

<body>
    <div class="container-fluid" style="margin-bottom: 100px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
            <div id="date" class="text-gray-600"></div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Data Pegawai Card -->
            <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-blue text-white shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                            <div class="col">
                                <div class="text-uppercase mb-1">Data Pegawai</div>
                                <div class="h5 mb-0 font-weight-bold"><?php echo $pegawai ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Admin Card -->
            <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-purple text-white shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-user-cog fa-3x"></i>
                            </div>
                            <div class="col">
                                <div class="text-uppercase mb-1">Data Admin</div>
                                <div class="h5 mb-0 font-weight-bold"><?php echo $admin ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
    
    <div id="date" class="text-gray-600"></div>
    <span id="date"></span>  <span id="time"></span>
</div>
<!-- End of Content Row -->

        <!-- Status Chart -->
        <div class="card mt-4 ml-4 mr-4">
        <div class="card-header bg-primary text-white text-center">
                <h4>Status Approval Cuti<a href="<?= base_url('direktur/kelolaCuti'); ?>"><i class="fas fa-eye text-white mt-2 float-right"> </i></a></h4>
                
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart" width="400" height="130"></canvas>
                </div>
            </div>
        </div>

    </div> <!-- End of Container Fluid -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader"></div>
                <div class="modal-body" id="modalBody"></div>
                <div class="modal-footer" id="modalFooter"></div>
            </div>
        </div>
    </div>
    

    <script type="text/javascript">
        function currentDate() {
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var current_date = d.getFullYear() + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                (day < 10 ? '0' : '') + day;
            return current_date;
        }

        function datediff(first, second) {
            var day_start = new Date(first);
            var day_end = new Date(second);
            var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
            var d = Math.round(total_days);
            return d;
        }

        $(document).ready(function () {
            getData();
        });

        function getData() {
            $.ajax({
                url: '<?php echo base_url(); ?>direktur/kelolaCuti/data_cuti',
                type: 'GET',
                beforeSend: function () { },
                success: function (response) {
                    if (JSON.parse(response).length != 0) {
                        formData(JSON.parse(response));
                        generateChart(JSON.parse(response));
                    }
                }
            });
        }

        function formData(data) {
            var html = "";
            $.each(data, function (key, value) {
                if (value.status_approval == 'PENDING') {
                    bg = 'bg-secondary text-white';
                } else if (value.status_approval == 'FAILED') {
                    bg = 'bg-danger text-white';
                } else {
                    bg = 'bg-success text-white';
                }
               
                if (value.status_approval == 'PENDING') {
                    html += '<button class="btn btn-sm btn-primary" onclick="modalApproval(' + value.id + ')"><i class="fa fa-check"></i> Approval</button>';
                }
                html += '</td>';
                html += '</tr>';
            });
            $('#listData').html(html);
        }

        function generateChart(data) {
            var statusCounts = {
                'PENDING': 0,
                'FAILED': 0,
                'SUCCESS': 0
            };

            data.forEach(function (item) {
                if (item.status_approval in statusCounts) {
                    statusCounts[item.status_approval]++;
                }
            });

            var ctx = document.getElementById('myBarChart').getContext('2d');
            new Chart(ctx, {
                type:'bar',
                data: {
                    labels: ['Pending', 'Failed', 'Success'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [statusCounts.PENDING, statusCounts.FAILED, statusCounts.SUCCESS],
                        backgroundColor: [
                            'rgba(123, 143, 161, 0.8)',
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(40, 167, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgba(123, 143, 161, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(40, 167, 69, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(0, 0, 0, 0.1)"
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Approval Status'
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutQuart'
                    },
                    hover: {
                        animationDuration: 0
                    },
                    responsiveAnimationDuration: 0
                }
            });
        }

      
    </script>
    
   <script type="text/javascript">
    $(document).ready(function () {
        updateDateTime();
        setInterval(updateDateTime, 1000); // Update every second
    });

    function updateDateTime() {
        var now = new Date();
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false };
        var formattedDate = now.toLocaleDateString('en-US', options);
        var formattedTime = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false });
        // Tampilkan tanggal dan waktu di dalam elemen dengan id "date"
        document.getElementById('date').innerText = formattedDate
        
    }
</script>



</body>

</html>


