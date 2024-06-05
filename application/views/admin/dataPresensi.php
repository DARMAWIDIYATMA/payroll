<div class="container-fluid" style="margin-bottom: 100px">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Presensi Pegawai
        </div>

        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="bulan">Bulan: </label>
                    <select class="form-control ml-3" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <div class="form-group mb-2 ml-5">
                    <label for="tahun">Tahun: </label>
                    <select class="form-control ml-3" name="tahun">
                        <option value="">--Pilih Tahun--</option>
                        <?php 
                        $tahun = date('Y');
                        for ($i = 2022; $i < $tahun + 5; $i++) { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
                <a class="mb-2 ml-2 btn btn-success" href="<?php echo base_url('admin/dataPresensi/inputPresensi') ?>"><i class="fas fa-plus"></i> Input Kehadiran</a>
                <a class="mb-2 ml-2 btn btn-info" href="<?php echo base_url('admin/dataPresensi/exportToExcel?bulan=' . (isset($_GET['bulan']) ? $_GET['bulan'] : '') . '&tahun=' . (isset($_GET['tahun']) ? $_GET['tahun'] : '')) ?>"><i class="fas fa-file-excel"></i> Export to Excel</a>
            </form>
        </div>

        <?php
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        ?>

    </div>

    <div class="alert alert-info">Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span></div>

    <?php
    $jml_data = count($presensi);
    if ($jml_data > 0) { ?>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">NIP</th>
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">Hadir</th>
                    <th class="text-center">Izin</th>
                    <th class="text-center">Sakit</th>
                    <th class="text-center">Alpha</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($karyawan as $a) : ?>
                    <?php foreach ($presensi as $p) : ?>
                        <?php if ($a->nip == $p->nip) : ?>
                            <tr>
                                <td class="text-center"><?php echo $no++ ?></td>
                                <td class="text-center"><?php echo $a->nip ?></td>
                                <td class="text-center"><?php echo $a->nama_pegawai ?></td>
                                <td class="text-center"><?php echo $p->hadir ?></td>
                                <td class="text-center"><?php echo $p->izin ?></td>
                                <td class="text-center"><?php echo $p->sakit ?></td>
                                <td class="text-center"><?php echo $p->alpha ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } else { ?>
        <span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data Masih Kosong, Silahkan Input Data Kehadiran Pada Bulan dan Tahun yang Anda pilih.</span>
    <?php } ?>
</div>
