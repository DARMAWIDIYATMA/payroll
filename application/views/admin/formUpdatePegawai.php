<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
</div>

<div class="card" style="width: 60% ; margin-bottom: 100px">
    <div class="card-body">

    <?php foreach ($pegawai as $p) : ?>
    <form method ="POST" action="<?php echo base_url('admin/dataPegawai/updateDataAksi') ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label>NIP</label>
        <input type="number" name="nip" class="form-control" value="<?php echo $p->nip?>" readonly> 
    </div>
    
    <div class="form-group">
        <label>NIK</label>
        <input type="number" name="nik" class="form-control" value="<?php echo $p->nik?>" required>  
    </div>

    <div class="form-group">
        <label>Nama Pegawai</label>
        <input type="text" name="nama_pegawai" class="form-control" value="<?php echo $p->nama_pegawai?>" required>
        
    </div>

    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control">
                <option value="<?php echo $p->jenis_kelamin ?>"><?php echo $p->jenis_kelamin?></option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
        </select>
        <?php echo form_error('jenis_kelamin','<div class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" value="<?php echo $p->alamat?>" required>
    </div>

    <div class="form-group">
        <label>No Telepon</label>
        <input type="number" name="no_telp" class="form-control" value="<?php echo $p->no_telp?>" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $p->email?>" required>
    </div>

    <div class="form-group">
        <label>Jabatan</label>
        <select name="id_jabatan" class="form-control">
                <option value="<?php echo $p->id_jabatan?>">--Pilih Jabatan--</option>
                <?php foreach($jabatan as $j) : ?>
                <option value="<?php echo $j->id_jabatan?>"><?php echo $j->nama_jabatan?></option>
                <?php endforeach; ?>
        </select>
        <?php echo form_error('id_jabatan','<div class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input type="date" name="tgl_masuk" class="form-control" value="<?php echo $p->tgl_masuk?>" required> 
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
                <option value="<?php echo $p->status?>"><?php echo $p->status?></option>
                <option value="Pegawai Tetap">Pegawai Tetap</option>
                <option value="Pegawai Tidak Tetap">Pegawai Tidak Tetap</option>
        </select>
        <?php echo form_error('status','<div class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control"> 
    </div>

    <div class="form-group">
        <label>Hak Akses</label>
        <select name="id_akses" class="form-control" >
            <option value="<?php echo $p->id_akses ?>">
                    <?php if($p->id_akses=='1'){
                        echo "Admin";
                    }else if($p->id_akses=='2'){
                        echo "Pegawai";
                    }else{
                        echo "Manager";
                    }?>
            <option value="1">Admin</option>
            <option value="2">Pegawai</option>
            <option value="3">Manager</option>
        </select>
    </div>

    <div class="form-group">
        <label>Status Keaktifan</label>
        <select name="status_keaktifan" class="form-control" value="<?php echo $p->status_keaktifan?>" required>
                <option value="">--Pilih Status--</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
        </select>
        <?php echo form_error('status_keaktifan','<div class="text-small text-danger"></div>') ?>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>                

    </form>
    <?php endforeach; ?>
    </div>
</div>


</div>




