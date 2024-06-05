<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
</div>

<div class="card" style="width: 60% ; margin-bottom: 100px">
    <div class="card-body">

    <form method ="POST" action="<?php echo base_url('admin/dataPegawai/tambahDataAksi') ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label>NIP</label>
        <?php foreach($id as $i):
                        $a= $i['nip'];
                        $no= '179120983049281';
                        $urutan= (int)substr($a, 15,2);
                        $urutan++;
                        $id= $no.sprintf("%01s", $urutan);
                    ?>
                    <input type="number" name="nip" class="form-control" value="<?php echo $id?>" readonly>
        <?php endforeach;?>
    </div>
    
    <div class="form-group">
        <label>NIK</label>
        <input type="number" name="nik" class="form-control" min="1000000000000000" max="9999999999999999" required> 
    </div>

    <div class="form-group">
        <label>Nama Pegawai</label>
        <input type="text" name="nama_pegawai" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control">
                <option value="">--Pilih Jenis Kelamin--</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
        </select>
        <?php echo form_error('jenis_kelamin','<div class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" required>
    </div>

    <div class="form-group">
        <label>No Telepon</label>
        <input type="number" name="no_telp" class="form-control" min="000000000000" max="999999999999" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Jabatan</label>
        <select name="id_jabatan" class="form-control">
                <option value="">--Pilih Jabatan--</option>
                <?php foreach($jabatan as $j) : ?>
                <option value="<?php echo $j->id_jabatan?>"><?php echo $j->nama_jabatan?></option>
                <?php endforeach; ?>
        </select>
        <?php echo form_error('id_jabatan','<div class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input type="date" name="tgl_masuk" value="<?php echo date('Y-m-d'); ?>" class="form-control"> 
        <?php echo form_error('tgl_masuk','<div class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
                <option value="">--Pilih Status--</option>
                <option value="Pegawai Tetap">Pegawai Tetap</option>
                <option value="Pegawai Tidak Tetap">Pegawai Tidak Tetap</option>
        </select>
        <?php echo form_error('status','<div class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Hak Akses</label>
        <select name="id_akses" class="form-control" >
            <option value="">--Pilih Hak Akses--</option>
            <option value="1">Admin</option>
            <option value="2">Pegawai</option>
            <option value="3">Manager</option>
        </select>
    </div>

    <div class="form-group">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control"> 
    </div>

    <div class="form-group">
        <label>Status Keaktifan</label>
        <select name="status_keaktifan" class="form-control">
                <option value="">--Pilih Status--</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
        </select>
        <?php echo form_error('status_keaktifan','<div class="text-small text-danger"></div>') ?>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>                

    </form>
    </div>
</div>


</div>




