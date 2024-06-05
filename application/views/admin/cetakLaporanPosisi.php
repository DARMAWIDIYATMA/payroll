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
        <h2>Laporan Posisi Pegawai</h2>
    </center>

    <table style="width: 50%">
        <tr>
            <td width="20%">Tanggal</td>
            <td width="2%">:</td>
            <td><?php echo $tanggal_awal ?> - <?= $tanggal_akhir ?></td>
        </tr>
        <tr>
            <td width="20%">Kategori</td>
            <td width="2%">:</td>
            <td><?php echo $kategori ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-striped">
        <?php if ($kategori == 'PROMOSI') { ?>
            <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Karyawan</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Jabatan Lama</th>
                <th>Jabatan Baru</th>
                <th>Alasan</th>
                <th>Status Approval</th>
            </tr>

            <?php $no = 1;
            foreach ($laporan as $value) { ?>
                <td><?php echo $no++ ?></td>
                <td><?php echo $value->nip_pk ?></td>
                <td><?php echo $value->nama_pegawai ?></td>
                <td><?php echo $value->keterangan ?></td>
                <td><?php echo $value->tanggal ?></td>
                <td><?php echo $value->jabatan_lama ?></td>
                <td><?php echo $value->jabatan_baru ?></td>
                <td><?php echo $value->alasan_promosi ?></td>
                <td><?php echo $value->status ?></td>
                </tr>
            <?php } ?>
        <?php } else if ($kategori == 'MUTASI') { ?>
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
                <th>Status Approval</th>
            </tr>

            <?php $no = 1;
            foreach ($laporan as $value) { ?>
                <td><?php echo $no++ ?></td>
                <td><?php echo $value->nip_pk ?></td>
                <td><?php echo $value->nama_pegawai ?></td>
                <td><?php echo $value->tanggal ?></td>
                <td><?php echo $value->jabatan_lama ?></td>
                <td><?php echo $value->jabatan_baru ?></td>
                <td><?php echo $value->lokasi_lama ?></td>
                <td><?php echo $value->lokasi_baru ?></td>
                <td><?php echo $value->alasan_mutasi ?></td>
                <td><?php echo $value->status ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Alasan</th>
                <th>Status Approval</th>
            </tr>

            <?php $no = 1;
            foreach ($laporan as $value) { ?>
                <td><?php echo $no++ ?></td>
                <td><?php echo $value->nip_pk ?></td>
                <td><?php echo $value->nama_pegawai ?></td>
                <td><?php echo $value->tanggal ?></td>
                <td><?php echo $value->alasan_phk ?></td>
                <td><?php echo $value->status ?></td>
                </tr>
            <?php } ?>
        <?php } ?>

    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <p>Tangerang, <?php echo date("d M Y") ?> <br> Finance</p>
                <br>
                <br>
                <p>_________________</p>
            </td>
        </tr>
    </table>
</body>

</html>
<script type="text/javascript">
    window.print();
</script>