<style>
    /* Ganti warna latar belakang sidebar dengan warna RGBA yang diinginkan */
    .custom-sidebar {
        background-color: rgba(13, 76, 146, 1) !important;
    }
</style>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav custom-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('direktur/dashboard') ?>">

            <i class="fas fa-university"></i> 
            <div class="sidebar-brand-text mx-3">Bumidhana</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('direktur/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('direktur/kelolaCuti') ?>">
                    <i class="fas fa-fw fal fa-calendar"></i>
                    <span>Cuti Karyawan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('direktur/kelolaIjin') ?>">
                    <i class="fas fa-fw fal fa-calendar"></i>
                    <span>Perijinan Karyawan</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fal fa-copy"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url('direktur/laporanGaji') ?>">Laporan Gaji</a>
                        <a class="collapse-item" href="<?php echo base_url('direktur/laporanPresensi') ?>">Laporan Presensi</a>
                        <a class="collapse-item" href="<?php echo base_url('direktur/laporanTHR') ?>">Laporan THR</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('direktur/posisiKaryawan') ?>">
                    <i class="fas fa-fw fad fa-user"></i>
                    <span>Posisi Karyawan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('direktur/gantiPassword') ?>">
                    <i class="fas fa-fw fad fa-lock"></i>
                    <span>Ubah Password</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('welcome/logout') ?>">
                    <i class="fas fa-fw fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <img src="<?php echo base_url() ?>assets/img/logo.png" style="width: 250px; height:75px">
                    


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang, <?php echo $this->session->userdata('nama_pegawai') ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/photo/') . $this->session->userdata('photo') ?>">
                            </a>

                        </li>

                    </ul>

                </nav>
                
                <!-- End of Topbar -->