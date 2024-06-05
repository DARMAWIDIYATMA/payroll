<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Bulan/Tahun</th>
            <th>Gaji Pokok</th>
            <th>Tj. Transportasi</th>
            <th>Uang Makan</th>
            <th>Potongan Gaji</th>
            
            
            <th class="text-center bg-warning">Total Gaji</th>
            <th>Cetak Slip</th>
        </tr>

        <?php foreach ($potongan as $p) : ?>
            <?php $potongan = $p->jml_potongan; ?>
        <?php endforeach; ?>

        <?php foreach ($gaji as $g) : ?>
            <?php $pot_gaji = $g->alpha * $potongan + (($g->gaji_pokok + $g->transport + $g->uang_makan) * 0.03) ?>
            <tr>
                <td><?php echo $g->bulan ?></td>
                <td>Rp<?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
                <td>Rp<?php echo number_format($g->transport, 0, ',', '.') ?></td>
                <td>Rp<?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
                <td>Rp<?php echo number_format($pot_gaji, 0, ',', '.') ?></td>
              
               
              
                  
               
                <th class="text-center bg-warning">Rp<?php echo number_format($g->gaji_pokok + $g->transport + $g->uang_makan - $pot_gaji , 0, ',', '.') ?></td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('pegawai/dataGaji/cetakSlip/' . $g->id_kehadiran) ?>"><i class="fas fa-print"></i></a>
                    </center>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>