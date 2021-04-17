<?php 
 session_start();

 
 
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

 
 $title = "Contacts";
if(isset($_POST['add'])){
   
    
    $name = trim($_POST['name']);
    $name = mysqli_real_escape_string($conn, $name);

    $email = trim($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $content = trim($_POST['content']);
    $content = mysqli_real_escape_string($conn, $content);


    // add image
    


    $query = "INSERT INTO contact VALUES (NULL, '" . $name . "', '" . $email . "', '" . $content. "')";
    $result = mysqli_query($conn, $query);
    if(!$result){
      echo "Can't add new data " . mysqli_error($conn);
      exit;
    } else {header("Location: contact.php");
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./assets/img/favicon.png" rel="icon">
  <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  

  <!-- Vendor CSS Files -->
  <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Template Main CSS File -->
  <link href="./assets/css/style.css" rel="stylesheet">
     <script type="text/javascript" src="template/ckeditor/ckeditor.js"></script>
  <script src="./assets/vendor/aos/aos.js"></script>
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./assets/vendor/php-email-form/validate.js"></script>
  <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="./assets/js/main.js"></script>

  <!-- =======================================================
  * Template Name: Knight - v4.0.1
  * Template URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar" >
        <ul>
           <li><a class="nav-link scrollto " href="#portfolio">Home</a></li>
          
          <li><a class="nav-link scrollto " href="laptops.php">Laptops</a></li>
          
        
         
          <li><a class="nav-link scrollto active" href="contact.php">Contact</a></li>

           <li><a class="nav-link scrollto" href="cart.php">Giỏ Hàng</a></li>
              <li> <a href="login.php">
                   <?php   
require_once "logingg.php";
   if(!empty($_SESSION['username'])) // Nếu user tồn tại thì show thông tin hiện có
    {
         echo '<ul>
              <li class="dropdown"><a href="#"><img src="'.$_SESSION['userpic'].'" style="border-radius:30px; width:30px;margin-top:-30px"/></a>
                <ul>
                 <li style="margin-left:20px">'.$_SESSION['username'].'</li>
                  <li><a href="logout.php">Đăng Xuất</a></li>
                  
                </ul>
              </li>   ';
       
    }
    else{
   echo '<i class="fa fa-user-o " aria-hidden="true" style="font-size: 20pt"></i>';  }
?>
 </a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
   <?php
      if(isset($title) && $title == "Scarlet Witch") ?>
       <div id="main">
  <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Mọi Thắc Mắc Xin Vui Lòng Liên Hệ Tại Đây</p>
        </div>

        <div class="row">

          <div class="col-lg-4">
            <div class="info d-flex flex-column justify-content-center" data-aos="fade-right">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Địa Chỉ:</h4>
                <p>470 Đường Trần Đại Nghĩa, Hòa Quý, Ngũ Hành Sơn, TP.Đẵng </p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>team.19i@cit.udn.vn</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Số Điện Thoại:</h4>
                <p>+84 769 738 299</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="contact.php" method="post" role="form" class="php-email-form" data-aos="fade-left">
              <div class="row">
                <div class="col-md-6 form-group">
                    <?php   
require_once "logingg.php";
   if(!empty($_SESSION['username'])) // Nếu user tồn tại thì show thông tin hiện có
    {
        
         echo ' <input type="text" name="name" class="form-control" id="name" placeholder="'.$_SESSION['username'].'" >';
       
    }
    else{
      echo  '<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" >';
    }
  
?>
                  
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                             <?php   
require_once "logingg.php";
   if(!empty($_SESSION['username'])) // Nếu user tồn tại thì show thông tin hiện có
    {
         echo ' <input type="email" class="form-control" name="email" id="email" placeholder="'.$_SESSION['useremail'].'" 
                  >  ';
       
    }
    else{
      echo  '<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" >';
    }
  
?>
                 
                </div>
              </div>
             <!--  <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div> -->
              <div class="form-group mt-3">
                <textarea class="form-control" name="content" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><input type="submit" name="add" value="Submit" class="btn btn-primary"></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
<footer id="footer">

    <div class="footer-top">

      <div class="container">

       

       <!--  <div class="row footer-newsletter justify-content-center">
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email" placeholder="Enter your Email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div> -->

        <div class="social-links">
          <a href="#" class="twitter" style="background-image: linear-gradient(180deg ,violet, skyblue); "><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook" style="background-image: linear-gradient(180deg ,blue, skyblue); "><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram" style="background-image: linear-gradient(190deg ,blue, yellow,red,purple); "><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus" style="background-image: linear-gradient(180deg ,blue, #fff,blue); "><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin" style="background-image: linear-gradient(190deg ,blue,purple,skyblue); "><i class="bx bxl-linkedin"></i></a>
        </div>

      </div>
    </div>

    <div class="container footer-bottom clearfix">
     <!--  <div class="copyright">
        &copy; Copyright <strong><span>Knight</span></strong>. All Rights Reserved
      </div> -->
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/knight-free-bootstrap-theme/ -->
        Designed by <a href="admin.php">AdminLogin ||2021</a>
      </div>
    </div>
  </footer><!-- End Footer -->

    </div>
    <!-- Footer -->
<!-- Footer -->

  </body>
</html>