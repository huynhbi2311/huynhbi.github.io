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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Vendor CSS Files -->
  <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
      <link href="./assets/css/style1.css" rel="stylesheet">
       <link href="./assets/css/stl.css" rel="stylesheet">
  <link href="./assets/css/style.css" rel="stylesheet">
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
  <style>
    a :hover{
      color:violet;
    }
  </style>
</head>

<body>

  <!-- ======= Hero Section ======= -->
    <section id="hero">
    <div class="hero-container">
      <a href="index.php" class="hero-logo" data-aos="zoom-in" ><svg viewBox="0 0 960 300" style="width: 400px">
  <symbol id="s-text">
    <text text-anchor="middle" x="50%" y="80%">Astronaut</text>
  </symbol>

  <g class = "g-ants">
    <use xlink:href="#s-text" class="text-copy"></use>
    <use xlink:href="#s-text" class="text-copy"></use>
    <use xlink:href="#s-text" class="text-copy"></use>
    <use xlink:href="#s-text" class="text-copy"></use>
    <use xlink:href="#s-text" class="text-copy"></use>

  </g>
</svg></a>
      <h1 data-aos="zoom-in" style="margin-top: -30px;">Welcome To Laptops Store</h1>
      <!-- <h2 data-aos="fade-up">We are team of talented designers making websites with Bootstrap</h2> -->
     <!--  <a data-aos="fade-up" data-aos-delay="200" href="#about" class="btn-get-started scrollto" style="background-color: pink;background-image: linear-gradient(to right,#BF045B, #F20587,#59153A, #046009, #05F2F2); border-radius: 10px ">Bắt Đầu</a> -->
   <!--   <a data-aos="fade-up" data-aos-delay="200" href="#about" class="btn-get-started scrollto" style="background-color: pink;background-image: linear-gradient(180deg ,#FF0076 , #590FB7); border-radius: 10px ">Bắt Đầu</a> -->
     <button class="custom-btn btn-6"><span>Read More</span></button>
    </div>
  </section><!-- End Hero -->
 <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#portfolio">Home</a></li>
          
          <li><a class="nav-link scrollto " href="laptops.php">Laptops</a></li>
          
        
         
          <li><a class="nav-link scrollto" href="contact.php">Contact</a></li>
 <li><a href="cart.php"><i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 20pt"></i></span></a> </li>
           
             <li> <a href="login.php">
                 <?php   
require_once "logingg.php";
   if(!empty($_SESSION['username'])) // Nếu user tồn tại thì show thông tin hiện có
    {
         echo '<ul>
              <li class="dropdown"><a href="#"><img src="'.$_SESSION['userpic'].'" style="border-radius:30px; width:30px;margin-top:-40px"/></a>
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
  <!-- ======= Header ======= -->
 
   <?php
      if(isset($title) && $title == "Scarlet Witch") ?>
       <div id="main">