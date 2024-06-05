<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Table</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/DataTables/datatables.min.css') ?>">
  <script src="<?php echo base_url('assets/DataTables/datatables.min.js') ?>"></script>
  <style>
    .container-fluid {
      margin-bottom: 100px;
    }
    table {
      width: 100%;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>

  <a class="mb-2 mt-2 btn btn-sm btn-success" href ="<?php echo base_url('admin/dataPegawai/tambahData')?>"><i class="fas fa-plus"></i> Tambah Pegawai</a>

  <?php echo $this->session->flashdata('pesan') ?>

  <div class="table-responsive">
    <table id="example" class="table table-hover table-bordered">
      <thead>
          <tr>
              <th class="text-center">No</th>
              <th class="text-center">NIP</th>
              <th class="text-center">NIK</th>
              <th class="text-center">Nama Karyawan</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">No Telepon</th>
              <th class="text-center">Email</th>
              <th class="text-center">Jabatan</th>
              <th class="text-center">Tanggal Masuk</th>
              <th class="text-center">Status</th>
              <th class="text-center">Photo</th>
              <th class="text-center">Status Keaktifan</th>
              <th class="text-center">Hak Akses</th>
              <th class="text-center">Action</th>
          </tr>
      </thead>
      <tbody>
      <?php $no=1; foreach($pegawai as $p) : ?>
      <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $p->nip ?></td>
          <td><?php echo $p->nik ?></td>
          <td><?php echo $p->nama_pegawai ?></td>
          <td><?php echo $p->jenis_kelamin ?></td>
          <td><?php echo $p->alamat ?></td>
          <td>+62<?php echo $p->no_telp ?></td>
          <td><?php echo $p->email ?></td>
          <td><?php echo $p->nama_jabatan ?></td>
          <td><?php echo $p->tgl_masuk ?></td>
          <td><?php echo $p->status ?></td>
          <td><img src="<?php echo base_url().'assets/photo/'.$p->photo ?>" width="75px"></td>
          <td><?php echo $p->status_keaktifan ?></td>
          <?php if($p->id_akses =='1'){?> 
              <td>Admin</td>
          <?php }else if($p->id_akses =='2'){?>
              <td>Pegawai</td>
          <?php }else{?>
              <td>Manager</td>
          <?php } ?>
          <td>
              <center>
                  <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/dataPegawai/updateData/'.$p->nip)?>"><i class="fas fa-edit"></i></a>
                     
              </center>
          </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
      $('#example').DataTable({
          "scrollX": true
      });
  });
</script>
</body>
</html>
