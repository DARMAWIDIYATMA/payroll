<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
</div>

    <?php echo $this->session->flashdata('pesan')  ?>

    


    <table id="example" class="table table-hover table-bordered" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Jenis Potongan</th>
            <th class="text-center">Jumlah Potongan</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
            <?php $no=1; foreach($pot_gaji as $p) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $p->potongan ?></td>
                <td><?php echo $p->jml_potongan?></td>
                <td>
                    <center>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/potonganGaji/updateData/'.$p->id_pot)?>"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Yakin Hapus?')"class="btn btn-sm btn-danger" href="<?php echo base_url('admin/potonganGaji/deleteData/'.$p->id_pot)?>"><i class="fas fa-trash"></i></a>    
                    </center>
                </td>
            </tr>

        <?php endforeach; ?>
        </thead>
</tbody>
    </table>


</div>




