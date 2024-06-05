<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
</div>

<div class="card" style="width: 60%; margin-bottom: 100px">
    <div class="card-body">

    <?php foreach ($pot_gaji as $p): ?>
    <form method="POST" action="<?php echo base_url ('admin/potonganGaji/updateDataAksi')?>">
        
    <div class="form-group">
        <label>Jenis Potongan</label>
        <input type="hidden" name="id_pot" class="form-control" value="<?php echo $p->id_pot?>">
        <input type="text" name="potongan" class="form-control" value="<?php echo $p->potongan?>" required>
    </div>

    <div class="form-group">
        <label>Jumlah Potongan</label>
        <input type="number" name="jml_potongan" class="form-control" min="1" value="<?php echo $p->jml_potongan?>" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    </form>
    <?php endforeach; ?>
    </div>
</div>
</div>




