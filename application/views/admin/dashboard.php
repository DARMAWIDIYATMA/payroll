<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .bg-grey {
            background-color: #F5EAEA;
        }
        .custom-bg {
            background-color: #7B8FA1 !important;
            color: white !important;
        }
        .bg-purple {
            background-color: #539165 !important;
        }
        .bg-blue {
            background-color: #3F4E4F !important;
        }
        @media (max-width: 576px) {
            .card-header {
                font-size: 1rem;
            }
            .h3 {
                font-size: 1.25rem;
            }
            .fa-3x {
                font-size: 2rem;
            }
            .h5 {
                font-size: 1rem;
            }
        }
    </style>
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
                                <div class="h5 mb-0 font-weight-bold"><?php echo $pegawaii ?></div>
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
                                <i class="fas fa-user-tie fa-3x"></i>
                            </div>
                            <div class="col">
                                <div class="text-uppercase mb-1">Data Jabatan</div>
                                <div class="h5 mb-0 font-weight-bold"><?php echo $jabatan ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
        
        <!-- Status Chart -->
        <div class="card mt-4 ml-4 mr-4">
            <div class="card-header bg-primary text-white text-center">
                <h4>Status Data Pegawai<a href="<?= base_url('admin/dataPegawai'); ?>"><i class="fas fa-eye text-white mt-2 float-right"></i></a></h4>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="aksesChart" width="400" height="130"></canvas>
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
    
    <?php 
      $no = 1; 
      $akses_counts = array('Admin' => 0, 'Pegawai' => 0, 'Manager' => 0);
      foreach($pegawai as $p) : 
          if($p->id_akses == '1'){ 
              $akses_counts['Admin']++; 
          } elseif($p->id_akses == '2'){ 
              $akses_counts['Pegawai']++; 
          } else { 
              $akses_counts['Manager']++; 
          }
      ?>
      <?php endforeach; ?>
    
    <script>
        $(document).ready(function() {
            updateDateTime();
            setInterval(updateDateTime, 1000);
            generateChart();
        });

        function updateDateTime() {
            var now = new Date();
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false };
            var formattedDate = now.toLocaleDateString('en-US', options);
            var formattedTime = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false });
            document.getElementById('date').innerText = formattedDate;
        }

        function generateChart() {
            var ctx = document.getElementById('aksesChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Admin', 'Pegawai', 'Manager'],
                    datasets: [{
                        label: 'Jumlah Pegawai',
                        data: [<?php echo $akses_counts['Admin'] ?>, <?php echo $akses_counts['Pegawai'] ?>, <?php echo $akses_counts['Manager'] ?>],
                        backgroundColor: [
                          'rgba(123, 201, 255, 0.8)',
                            'rgba(123, 201, 255, 0.8)',
                            'rgba(123, 201, 255, 0.8)'
                        ],
                        borderColor: [
                            'rgba(123, 201, 255, 1)',
                            'rgba(123, 201, 255, 1)',
                            'rgba(123, 201, 255, 1)'
                        ],
                        borderWidth: 1,
                        hoverBackgroundColor: [
                            'rgba(123, 201, 255, 1)',
                            'rgba(123, 201, 255, 1)',
                            'rgba(123, 201, 255, 1)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
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
                        text: 'Data Pegawai'
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

</body>

</html>
