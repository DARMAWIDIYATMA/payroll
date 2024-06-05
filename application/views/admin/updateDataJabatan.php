<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
</div>

<div class="card" style="width: 60%; margin-bottom: 100px">
    <div class="card-body">

    <?php foreach ($jabatan as $j): ?>
    <form method="POST" action="<?php echo base_url ('admin/dataJabatan/updateDataAksi')?>">
        
    <div class="form-group">
        <label>Nama Jabatan</label>
        <input type="hidden" name="id_jabatan" class="form-control" value="<?php echo $j->id_jabatan?>">
        <input type="text" name="nama_jabatan" class="form-control" value="<?php echo $j->nama_jabatan?>" required>
    </div>

    <div class="form-group">
        <label>Gaji Pokok</label>
        <input type="number" name="gaji_pokok" class="form-control" min="1" value="<?php echo $j->gaji_pokok?>" required>
    </div>

    <div class="form-group">
        <label>Tunjangan Transport</label>
        <input type="number" name="transport" class="form-control" min="1" value="<?php echo $j->transport?>" required>
    </div>

    <div class="form-group">
        <label>Uang Makan</label>
        <input type="number" name="uang_makan" class="form-control" min="1" value="<?php echo $j->uang_makan?>" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>
<?php endforeach; ?>

</div>




