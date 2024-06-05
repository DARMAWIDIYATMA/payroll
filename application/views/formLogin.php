<!DOCTYPE html>
<html>
<head>
  <title>Login | Aplikasi Penggajian</title>
  <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/js/a81368914c.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
      margin: 0;
      height: 100vh;
      position: relative;
    }
    .container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      text-align: center;
      margin: 20px 0;
    }
    .img img {
      width: 300px;
      margin-bottom: 10px;
    }
    h1 {
      font-size: 20px;
      margin-bottom: 20px;
      color: #333;
    }
    h1 b {
      display: block;
      font-size: 16px;
      color: #555;
    }
    .input-div {
      position: relative;
      margin-bottom: 20px;
    }
    .i {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #9b59b6;
    }
    .div {
      position: relative;
    }
    .div input {
      width: calc(100% - 40px);
      padding: 10px 20px 10px 40px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .btn {
      background: #9b59b6;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .btn:hover {
      background: #8e44ad;
    }
    .social_links {
      position: absolute;
      bottom: 20px;
      left: 20px;
      display: flex;
      flex-direction: column;
    }
    .social {
      margin: 5px 0;
    }
    .social a {
      color: #fff;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: #9b59b6;
      border-radius: 50%;
      transition: background 0.3s;
    }
    .social a:hover {
      background: #8e44ad;
    }
    .datetime {
      margin-top: 20px;
      font-size: 14px;
      color: #555;
    }
    .datetime span {
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="img">
      <img src="<?php echo base_url(); ?>assets/img/Logo.png">
    </div>
    <h1>APLIKASI PENGGAJIAN</h1>
    <?php echo $this->session->flashdata('pesan') ?>
    <div class="login-content">
      <form class="user" method="POST" action="<?php echo base_url('welcome') ?>">
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username..." name="username" required>
          </div>
        </div>
        <div class="input-div pass">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">
            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Password..." name="password" required>
          </div>
        </div>
        <input type="submit" class="btn" value="Login">
      </form>
    </div>
    <div class="datetime">
      <span id="date"></span>
      <span id="time"></span>
    </div>
  </div>

  <div class="social_links">
    <div class="social">
      <a href="https://maps.app.goo.gl/zMTs9kDNWrDQ82Qh7"><i class="fab fa-google" aria-hidden="true"></i></a>
    </div>
    <div class="social">
      <a href="https://www.instagram.com/bprbumidhana_/"><i class="fab fa-instagram" aria-hidden="true"></i></a>
    </div>
    <div class="social">
      <a href="https://bprbumidhana.co.id/"><i class="fas fa-globe" aria-hidden="true"></i></a>
    </div>
  </div>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
  <script>
    function updateDateTime() {
      var now = new Date();
      var dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      var timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
      
      var dateString = now.toLocaleDateString('id-ID', dateOptions);
      var timeString = now.toLocaleTimeString('id-ID', timeOptions);
      
      document.getElementById('date').innerText = dateString;
      document.getElementById('time').innerText = timeString;
    }
    
    setInterval(updateDateTime, 1000); // Update every second
    updateDateTime(); // Initial call to display date and time immediately on load
  </script>
  <script>
    $(document).ready(function(){
        setTimeout(function(){
            $('.alert').fadeOut('slow');
        }, 3000); // Waktu tunda dalam milidetik (2 detik)
    });
</script>

  <div class="copyright text-center my-auto">
    <span>Copyright &copy; PT.Bank Perekonomian Rakyat Bumidhana</span>
  </div>
</body>
</html>
