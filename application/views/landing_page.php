<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Penggajian</title>
   <!-- StyleSheets -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/bootstrap/bootstrap.min.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/fontawesome/css/all.min.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/style.css" />
   <style>
      .navbar-brand {
         color: #4B0082 !important; /* Warna ungu gelap */
      }

      /* Tambahkan CSS untuk latar belakang warna abu-abu muda pada halaman About Me */
      .Team {
         background-color: #f2f2f2; /* Warna abu-abu muda */
      }
   </style>
</head>
<body>
   <!-- Pre Loader -->
   <div class="Loader" id="Loader">
      <div class="LoaderWrapper">
         <div class="circleBall"></div>
         <div class="circleBall"></div>
         <div class="circleBall"></div>
      </div>
   </div>
   <!-- Go to top Button -->
   <a href="#Home">
      <div class="Gototop">
            <i class="fa fa-angle-double-up text-white" aria-hidden="true"></i>
      </div>
   </a>
   <!-- Header Section -->
   <div class="Header" id="Home">
      <nav class="navbar fixed-top">
         <div class="container">
            <a class="navbar-brand" href="#">PT.Bank Perekonomian Rakyat Bumidhana</a>
            <div class="collapse_menu deactive">
               <i class="fa fa-bars" aria-hidden="true"></i>
               <i class="fa fa-times" aria-hidden="true"></i>
               <ul class="nav">
                  <li class="nav-item">
                     <a class="nav-link" href="#Home">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#Tentang">Informasi</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#AboutMe">About Me</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo base_url('welcome');?>">Login</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="banner">
         <div class="layer">
            <div class="row Section">
               <div class="col">
                  <div class="box">
                     <div>
                        <h2><b><i>Penggajian Karyawan</i></b></h2>
                     </div>
                     <p>Sistem Informasi Penggajian Karyawan Berbasis Website <br>PT.Bank Perekonomian Rakyat Bumidhana</p>
                  </div>
               </div>
               <div class="col headerImg" style="background-image: url('<?php echo base_url()?>assets/img/Bumidhana.png');"></div>
               <div class="col-12 Dicover_Parent">
                  <a href="#AboutMe">
                     <div class="Discover">
                        <i class="fa fa-angle-double-down text-white" aria-hidden="true"></i>
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Service Section -->
   <div class="Service" id="Tentang">
      <div class="Section">
         <div class="text-center">
            <h2><b>Informasi</b></h2>
            <p></p>
            <p></p>
            <div class="subHeading">
               Berikut informasi lebih lengkap tentang website <br>informasi penggajian karyawan PT.Bank Perekonomian Rakyat Bumidhana</div>
         </div>

         <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
         <script> 
            $(document).ready(function(){
               $("#flip1").click(function(){
                  $("#panel1").slideToggle("slow");
               });
            });
         </script>
         <style> 
            #panel1, #flip1 {
               padding: 5px;
               text-align: center;
               background-color: #00BFD8;
               border: solid 1px #c3c3c3;
               border-radius: 10px 10px 10px 10px;
            }

            #panel1 {
               padding: 10px;
               display: none;
            }
         </style>
         <div class="content">
            <div class="row">
               <div class="col-md-6 col-lg-4 col-xl-3 ">
                  <div class="card">
                     <div class="CardImage"><img src="<?php echo base_url(); ?>assets/img/tentang.svg"></div>
                     <div class="body">
                        <div class="title"><font size="4"><b><i>Tentang Website</font></b></i></div>
                        <div id="flip1"><font color="white">Baca Selengkapnya</font></div>
                        <div id="panel1">Aplikasi ini dibuat untuk membantu perusahaan dalam proses penggajian karyawan</div>
                     </div>
                  </div>
               </div>

               <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
               <script> 
                  $(document).ready(function(){
                     $("#flip2").click(function(){
                        $("#panel2").slideToggle("slow");
                     });
                  });
               </script>
               <style> 
                  #panel2, #flip2 {
                     padding: 5px;
                     text-align: center;
                     background-color: #00BFD8;
                     border: solid 1px #c3c3c3;
                     border-radius: 10px 10px 10px 10px;
                  }

                  #panel2 {
                     padding: 10px;
                     display: none;
                  }
               </style>
               <div class="col-md-6 col-lg-4 col-xl-3 ">
                  <div class="card">
                     <div class="CardImage"><img src="<?php echo base_url(); ?>assets/img/administrator.svg"></div>
                     <div class="body">
                        <div class="title"><font size="4"><b><i>Halaman Admin</font></b></i></div>
                        <div id="flip2"><font color="white">Baca Selengkapnya</font></div>
                        <div id="panel2">Administrator menggunakan website untuk mengelola data, halaman administrator terdapat dashboard / informasi singkat mengenai data-data, data karyawan untuk pengelolaan karyawan, data jabatan untuk pengelolaan jabatan, data transaksi yang memiliki sub menu data absensi, setting potongan gaji, dan data gaji.</div>
                     </div>
                  </div>
               </div>

               <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
               <script> 
                  $(document).ready(function(){
                     $("#flip3").click(function(){
                        $("#panel3").slideToggle("slow");
                     });
                  });
               </script>
               <style> 
                  #panel3, #flip3 {
                     padding: 5px;
                     text-align: center;
                     background-color: #00BFD8;
                     border: solid 1px #c3c3c3;
                     border-radius: 10px 10px 10px 10px;
                  }

                  #panel3 {
                     padding: 10px;
                     display: none;
                  }
               </style>
               <div class="col-md-6 col-lg-4 col-xl-3 ">
                  <div class="card">
                     <div class="CardImage"><img src="<?php echo base_url(); ?>assets/img/karyawan.svg"></div>
                     <div class="body">
                        <div class="title"><font size="4"><b><i>Halaman Karyawan</font></b></i></div>
                        <div id="flip3"><font color="white">Baca Selengkapnya</font></div>
                        <div id="panel3">Halaman karyawan terdapat informasi tentang karyawan dan cetak slip gaji.</div>
                     </div>
                  </div>
               </div>

               <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
               <script> 
                  $(document).ready(function(){
                     $("#flip4").click(function(){
                        $("#panel4").slideToggle("slow");
                     });
                  });
               </script>
               <style> 
                  #panel4, #flip4 {
                     padding: 5px;
                     text-align: center;
                     background-color: #00BFD8;
                     border: solid 1px #c3c3c3;
                     border-radius: 10px 10px 10px 10px;
                  }

                  #panel4 {
                     padding: 10px;
                     display: none;
                  }
               </style>
               <div class="col-md-6 col-lg-4 col-xl-3 ">
                  <div class="card">
                     <div class="CardImage"><img src="<?php echo base_url(); ?>assets/img/others-fitur.svg"></div>
                     <div class="body">
                        <div class="title"><font size="4"><b><i>Fitur Lainnya</font></b></i></div>
                        <div id="flip4"><font color="white">Baca Selengkapnya</font></div>
                        <div id="panel4">Cetak slip gaji, cetak data absensi, cetak data gaji, dan ganti password</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Team Section -->
   <div class="Team" id="AboutMe">
      <div class="Section">
         <div class="text-center">
            <h2><b>About Me</b></h2>
            <br>
         </div>
         <div class="content">
            <div class="team row">
               <div class="team-memeber col-md-6 col-lg-4 col-xl-3">
                  <div class="card">
                     <div class="headerImg">
                        <img src="<?php echo base_url(); ?>assets/img/Bumidhana.png" class="rounded-circle w-100 d-block">
                     </div>
                     <div class="TeamInfo text-center">
                        <div class="Name">PENGGAJIAN KARYAWAN</div>
                        <div class="Job">PT.Bank Perekonomian Rakyat Bumidhana</div>
                        <div class="social_links">
                           <div class="social">
                              <a class="" href="https://maps.app.goo.gl/zMTs9kDNWrDQ82Qh7"><i class="fab fa-google" aria-hidden="true"></i></a>
                           </div>
                           <div class="social">
                              <a class="" href="https://www.instagram.com/bprbumidhana_/"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                           </div>
                           <div class="social">
                              <a class="" href="https://bprbumidhana.co.id/"><i class="fas fa-globe" aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Footer Section -->
   <div class="Footer" id="Footer">
      <div class="container">
         <div class="row">
            <div class="col-12 text-center my-3">
               Copyright &copy; PT.Bank Perekonomian Rakyat Bumidhana | Penggajian 2024 - All Rights Reserved
            </div>
         </div>
      </div>
   </div>
   <!-- Javascripts -->
   <script src="<?php echo base_url(); ?>assets/landing/js/jquery.js"></script>
   <script src="<?php echo base_url(); ?>assets/landing/js/bootstrap.js"></script>
   <script src="<?php echo base_url(); ?>assets/landing/js/script.js"></script>
</body>
</html>
