<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title ?></title>
        <style type="text/css">
            body{
                font-family:Arial;
                color: black;
            }
        </style>
    </head>
    <body>

            <center>
                <h1><h1><img src="<?php echo base_url() ?>assets/img/logo.png" style="width: 400px; height:110px"></h1></h1>
                <h2>Laporan Kehadiran Pegawai</h2>
            </center>

            <?php
                if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun'])&& $_GET['tahun']!='')){
                    $bulan = $_GET['bulan'];
                    $tahun = $_GET['tahun'];
                    $bulantahun = $bulan.$tahun;
                }else{
                    $bulan = date('m');
                    $tahun = date('Y');
                    $bulantahun = $bulan.$tahun;
                }
            ?>

            <table>
                <tr>
                    <td>Bulan</td>
                    <td>:</td>
                    <td><?php echo $bulan?></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td><?php echo $tahun?></td>
                </tr>
            </table>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alpha</th>
                </tr>

                <?php $no=1; foreach($lap_kehadiran as $l) : ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $l->nip ?></td>
                        <td><?php echo $l->hadir ?></td>
                        <td><?php echo $l->izin ?></td>
                        <td><?php echo $l->sakit ?></td>
                        <td><?php echo $l->alpha ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <table width="100%">
            <tr>
                <td></td>
            
                <td width="200px">
                    <p>Tangerang, <?php echo date("d M Y")?> <br>HRD,</p>
                    <br>
                    <br>
                    <p>____________________</p>
                </td>
            </tr>
        </table>

    </body>
    </html>
<script type="text/javascript">
    window.print();
</script>

