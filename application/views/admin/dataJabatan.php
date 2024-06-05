<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
</div>

<a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('admin/dataJabatan/tambahData/')?>"><i class="fas fa-plus"></i> Tambah Data</a>

<?php echo $this->session->flashdata('pesan') ?>

<table id="example" class="table table-hover table-bordered" style="width:100%">
<thead>
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">Nama jabatan</th>
        <th class="text-center">Gaji Pokok</th>
        <th class="text-center">Tj. Transport</th>
        <th class="text-center">Uang Makan</th>
        <th class="text-center">Total Gaji</th>
        <th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php $no=1 ; foreach($jabatan as $j) : ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $j->nama_jabatan ?></td>
        <td>Rp <?php echo number_format($j->gaji_pokok,0,',','.')?></td>
        <td>Rp <?php echo number_format($j->transport,0,',','.')?></td>
        <td>Rp <?php echo number_format($j->uang_makan,0,',','.')?></td>
        <td>Rp <?php echo number_format($j->gaji_pokok + $j->transport + $j->uang_makan,0,',','.')?></td>
        <td>
            <center>
                <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/dataJabatan/updateData/'.$j->id_jabatan)?>"><i class="fas fa-edit"></i></a>
                <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/dataJabatan/deleteData/'.$j->id_jabatan)?>"><i class="fas fa-trash"></i></a>
            </center>
        </td>
    </tr>
    <?php endforeach; ?>
    </thead>
</tbody>

</table>

</div>




