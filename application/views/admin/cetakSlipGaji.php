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
        <h1>PT. GLORY OFFSET PRESS</h1>
        <h2>Slip Gaji Pegawai</h2>
        <hr style="width: 50%; border-width: 5px; color: black">
    </center>

    <?php foreach ($potongan as $p) {
        $potongan = $p->jml_potongan;
    } ?>
    <?php foreach ($print_slip as $ps) : ?>
        <?php $potongan_gaji = $ps->alpha * $potongan + (($ps->gaji_pokok + $ps->transport + $ps->uang_makan) * 0.04); ?>

        <table style="width: 50%">
            <tr>
                <td width="20%">Nama Pegawai</td>
                <td width="2%">:</td>
                <td><?php echo $ps->nama_pegawai ?></td>
            </tr>

            <tr>
                <td>NIP</td>
                <td>:</td>
                <td><?php echo $ps->nip ?></td>
            </tr>

            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?php echo $ps->nama_jabatan ?></td>
            </tr>

            <tr>
                <td>Bulan</td>
                <td>:</td>
                <td><?php echo substr($ps->bulan, 0, 2) ?></td>
            </tr>

            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td><?php echo substr($ps->bulan, 2, 4) ?></td>
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
                <td>Rp. <?php echo number_format($ps->gaji_pokok, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tunjangan Transportasi</td>
                <td>Rp. <?php echo number_format($ps->transport, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Uang Makan</td>
                <td>Rp. <?php echo number_format($ps->uang_makan, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Potongan Jaminan Kesehatan (1%)</td>
                <td>(Rp. <?php echo number_format(($ps->gaji_pokok + $ps->transport + $ps->uang_makan) * 0.01, 0, ',', '.') ?>)</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Potongan Jaminan Hari Tua (2%)</td>
                <td>(Rp. <?php echo number_format(($ps->gaji_pokok + $ps->transport + $ps->uang_makan) * 0.02, 0, ',', '.') ?>)</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Potongan Jaminan Pensiun (1%)</td>
                <td>(Rp. <?php echo number_format(($ps->gaji_pokok + $ps->transport + $ps->uang_makan) * 0.01, 0, ',', '.') ?>)</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Potongan Alpha</td>
                <td>(Rp. <?php echo number_format($ps->alpha * $potongan, 0, ',', '.') ?>)</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Potongan Cuti</td>
                <td>(Rp. <?php
                            $total_day_in_month = cal_days_in_month(CAL_GREGORIAN, substr($ps->bulan, 0, 2), substr($ps->bulan, 2));
                            $jumlah_potongan_cuti = 0;
                            foreach ($potongan_cuti as $key => $value) {
                                if ($value->nip == $ps->nip) {
                                    $jumlah_hari_cuti = 0;
                                    if ($value->kode_mulai != $ps->bulan || $value->kode_akhir != $ps->bulan) {
                                        $date = new DateTime($value->tgl_mulai_cuti);
                                        $date->modify("last day of this month");
                                        $endDate = $date->format("Y-m-d");
                                        $tgl1 = date_create($value->tgl_mulai_cuti);
                                        $tgl2 = date_create($endDate);
                                        $diff = date_diff($tgl1, $tgl2);
                                        $jumlah_hari_cuti = $diff->format("%d%") + 1;
                                    } else {
                                        $jumlah_hari_cuti = $value->jumlah_hari;
                                    }
                                    $pot =  (eval('return $value->' . $value->col_jabatan . ';') / $total_day_in_month) * $jumlah_hari_cuti;
                                    $jumlah_potongan_cuti = $jumlah_potongan_cuti + $pot;
                                }
                            }
                            echo number_format($jumlah_potongan_cuti, 0, ',', '.');
                            ?>)</td>
            </tr>
            <tr>
                <th colspan="2" style="text-align: right;">Total Gaji</th>
                <th>Rp. <?php echo number_format($ps->gaji_pokok + $ps->transport + $ps->uang_makan - $potongan_gaji - $jumlah_potongan_cuti, 0, ',', '.') ?></th>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td></td>
                <td>
                    <p>Pegawai</p>
                    <br>
                    <br>
                    <p class="font-weight-bold"><?php echo $ps->nama_pegawai ?></p>
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