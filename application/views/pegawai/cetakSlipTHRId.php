<!DOCTYPE html>
<html>

<head>

    <title><?php echo $title ?></title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
    </style>
</head>

<body>
    <center>
    <h1><img src="<?php echo base_url() ?>assets/img/logo.png" style="width: 400px; height:110px"></h1>
        <h2>Slip THR Pegawai</h2>
        <hr style="width: 50%; border-width: 5px; color: black">
    </center>
    <?php foreach ($karyawan as $value) : ?>

        <table style="width: 50%">
            <tr>
                <td width="20%">Nama</td>
                <td width="2%">:</td>
                <td><?php echo $value->nama_pegawai ?></td>
            </tr>

            <tr>
                <td>NIP</td>
                <td>:</td>
                <td><?php echo $value->nip ?></td>
            </tr>

            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?php echo $value->nama_jabatan ?></td>
            </tr>
        </table>

        <table class="table table-striped table-bordered mt-3">
            <tr>
                <th class="text-center" width="5%">No</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Jumlah</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Gaji Pokok</td>
                <td>Rp. <?php echo number_format($thr[0]->gaji_pokok, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Masa Kerja</td>
                <td><?php echo $thr[0]->masa_kerja ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>THR</td>
                <td>Rp. <?php echo number_format($thr[0]->nominal, 0, ',', '.') ?></td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td></td>
                <td>
                    <p>Pegawai</p>
                    <br>
                    <br>
                    <p class="font-weight-bold"><?php echo $value->nama_pegawai ?></p>
                </td>

                <td width="200px">
                    <p>Tangerang, <?php echo date("d M Y") ?> <br>Finance,</p>
                    <br>
                    <br>
                    <p>____________________</p>
                </td>
            </tr>
        </table>
    <?php endforeach; ?>
</body>

</html>

<script type="text/javascript">
    window.print();
</script>