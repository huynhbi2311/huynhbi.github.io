<?php
  session_start();
  $count = 0;
 
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

 
  
  

  $title = "Full Catalogs of Laptop";
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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Vendor CSS Files -->
  <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="./assets/css/style.css" rel="stylesheet">
  <link href="./assets/css/style1.css" rel="stylesheet">
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
    a{
      color:#fff;
    }
.btn-8 {
  background-color: #f0ecfc;
background: radial-gradient(circle, rgba(247,150,192,1) 0%, rgba(118,174,241,1) 100%);
  line-height: 42px;
  padding: 0;
  border: none;
}
.btn-8 span {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}
.btn-8:before,
.btn-8:after {
  position: absolute;
  content: "";
  right: 0;
  bottom: 0;
  background: #c797eb;
  /*box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3);*/
  transition: all 0.3s ease;
}
.btn-8:before{
   height: 0%;
   width: 2px;
}
.btn-8:after {
  width: 0%;
  height: 2px;
}
.btn-8:hover:before {
  height: 85%;
}
.btn-8:hover:after {
  width: 100%;
}
.btn-8:hover{
  background: transparent;
}
.btn-8 span:hover{
  color: #c797eb;
}
.btn-8 span:before,
.btn-8 span:after {
  position: absolute;
  content: "";
  left: 0;
  top: 0;
  background: #c797eb;
  /*box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3);*/
  transition: all 0.3s ease;
}
.btn-8 span:before {
  width: 2px;
  height: 0%;
}
.btn-8 span:after {
  height: 2px;
  width: 0%;
}
.btn-8 span:hover:before {
  height: 100%;
}
.btn-8 span:hover:after {
  width: 100%;
}
  


  </style>
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li style="margin-top: 6px; opacity: 0" ><form method="get" action="chitietdonhang.php">
  
  
  <input type="search" name="search" placeholder="Search" value="<?php if (isset($_GET['search'])){ echo $_GET['search'];} 
     ?>">
</form></li>
 <?php
 
  require_once "./functions/database_functions.php";
  $conn = db_connect();
?>
<?php 
if(isset($_GET['search']) && !empty($_GET['search']))
{
    $key = $_GET['search'];
    $sql = "SELECT * FROM order_hd WHERE macode LIKE '%$key%' or ship_name LIKE '%$key%' ";
}
else{
    $sql = "SELECT * FROM order_hd";
}
$result = mysqli_query($conn,$sql);
?>
          <li><a class="nav-link scrollto " href="index.php">Home</a></li>
        
          <li> <a href="laptops.php"  class="nav-link scrollto">Laptops </a>

          </li>
          <!-- <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
         
         
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
   <?php
      if(isset($title) && $title == "Scarlet Witch") ?>
     <div id="main">

  <!--  <a href="admin_signout.php" class="btn btn-primary" style="font-family: 'Itim', cursive; margin-left: 20px;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center;float: right;">Sign out!</a>
   <a href="admin_add.php" class="btn btn-primary" style="font-family: 'Itim', cursive;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center">Add new Laptop</a>
  <a href="admin_laptop.php" class="btn btn-primary" style="font-family: 'Itim', cursive; margin-left: 20px;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center">Quản lý laptops</a> -->
      <section id="portfolio-details" class="portfolio-details" style="margin-right: -110px; width: 100%">
        <div class="container">
        <div class="row gy-4">
        <div class="col-lg-4" style="margin-top: 50px">
        <div class="portfolio-info" style="width: 1000px; margin-left: 50px">
           <h3 >Thông Tin Đơn Hàng</h3>
            <?php 
        $total = 0;
        while($row = mysqli_fetch_assoc($result)){ ?>
                 
                  <ul style="list-style: none">
                    <li><strong>Mã Sản Phẩm:</strong>&nbsp;&nbsp; &nbsp; &nbsp;  <b style="color:red;font-size: 14pt"><?php echo $row['macode']; ?></b></li>
                    <li><strong>Tên Sản Phẩm:</strong>&nbsp; &nbsp; &nbsp; <?php echo $row['laptop_title']; ?> <br>
                   <img src="./assets/img/<?php echo $row['laptop_image']; ?>" alt="" style="margin-left: 140px;margin-top: 30px"></li>
                    <li><strong>Giá:</strong>&nbsp; &nbsp; &nbsp; <?php echo $format_number = number_format($row['amount']) ; ?>₫</li>
                    <li><strong>Số Lượng:</strong>&nbsp; &nbsp; &nbsp; <?php echo $row['quatity'];?></li>
                    <li><strong>Địa Chỉ Người Nhận:</strong>&nbsp; &nbsp; &nbsp; <?php echo $row['ship_name'];?> , <?php echo $row['ship_address'];?> ,  
              <?php echo $row['ship_city'];?> , 
              <?php echo $row['ship_country'];?></li>
                    
                  </ul>
                  <?php 
                   $total += $row['amount'];}
                   ?>

                      <ul style="list-style: none">
                        <hr>
                    <li><strong>Tạm Tính:</strong> &nbsp; &nbsp; &nbsp; <b style="color: red; font-size: 13pt"><?= number_format($total, 0, ",", ".") ?> </b>₫</li>
                    
                    
                  </ul>
                </div>
              </div>
            </div>
           </div>
         </section>
            <!--  -->

  
<!--   <a href="index.php" style="color:red">Quay lại trang chủ</a> -->


<?php
// require_once "logingg.php";
//      if(!empty($_SESSION['username'])) // Nếu user tồn tại thì show thông tin hiện có
//     {
//         echo '<img src="'.$_SESSION['userpic'].'" style="border-radius:30px; width:30px;" align="left" />';
//         echo  'Welcome back '.$_SESSION['username'].'! [<a href="logout.php">Log Out</a>]';
//     }
  if(isset($conn)) { mysqli_close($conn); }
 
  require_once "./template/footer.php";
?>


