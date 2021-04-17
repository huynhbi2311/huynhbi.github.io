 <?php  
  session_start();
  $count = 0;

  // connecto database
  
  $title = "Scarlet Witch";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4Latestlaptop($conn); 
  $query = "SELECT * FROM publisher ORDER BY publisherid";
  
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }
  if(mysqli_num_rows($result) == 0){
    echo "Empty publisher ! Something wrong! check again";
    exit;
  }
  // $query = "SELECT * FROM pubprice ORDER BY pubpriceid";
  // $result = mysqli_query($conn, $query);
  // if(!$result){
  //   echo "Can't retrieve data " . mysqli_error($conn);
  //   exit;
  // }
  // if(mysqli_num_rows($result) == 0){
  //   echo "Empty publisher ! Something wrong! check again";
  //   exit;
  // }

      // User rating
       $userid = 4;
$query = "SELECT * FROM laptops";
$result = mysqli_query($conn,$query);
 
      // User rating
                    $query = "SELECT * FROM post_rating WHERE postid and userid=".$userid;
                    $userresult = mysqli_query($conn,$query) or die(mysqli_error());
                    $fetchRating = mysqli_fetch_array($userresult);
                    $rating = $fetchRating['rating'];

                    // get average
                    $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid";
                    $avgresult = mysqli_query($conn,$query) or die(mysqli_error());
                    $fetchAverage = mysqli_fetch_array($avgresult);
                    $averageRating = $fetchAverage['averageRating'];

                    if($averageRating <= 0){
                        $averageRating = "No rating yet.";
                    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Template Main JS File -->
  <script src="./assets/js/main.js"></script>

         <link href="style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
        
        <!-- Script -->
        <script src="jquery-3.0.0.js" type="text/javascript"></script>
        <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {

                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');

                    // rating was selected by a user
                    if (typeof(event) !== 'undefined') {
                        
                        var split_id = el_id.split("_");

                        var postid = split_id[1];  // postid

                        // AJAX Request
                        $.ajax({
                            url: 'rating_ajax.php',
                            type: 'post',
                            data: {postid:postid,rating:value},
                            dataType: 'json',
                            success: function(data){
                                // Update average
                                var average = data['averageRating'];
                                $('#avgrating_'+postid).text(average);
                            }
                        });
                    }
                }
            });
        });
      
        </script>

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
  height: 100%;
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
.btn-9 {
  background-color: #f0ecfc;
background: radial-gradient(circle, rgba(247,150,192,1) 0%, rgba(118,174,241,1) 100%);
  line-height: 42px;
  padding: 0;
  border: none;
}
.btn-9 span {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}
.btn-9:before,
.btn-9:after {
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
.btn-9:before{
   height: 0%;
   width: 2px;
}
.btn-9:after {
  width: 0%;
  height: 2px;
}
.btn-9:hover:before {
  height: 85%;
}
.btn-9:hover:after {
  width: 100%;
}
.btn-9:hover{
  background: transparent;
}
.btn-9 span:hover{
  color: #c797eb;
}
.btn-9 span:before,
.btn-9 span:after {
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
.btn-9 span:before {
  width: 2px;
  height: 0%;
}
.btn-9 span:after {
  height: 2px;
  width: 0%;
}
.btn-9 span:hover:before {
  height: 100%;
}
.btn-9 span:hover:after {
  width: 100%;
}

.hd{
  height: 60vh;
  width:60vw;
  margin:auto;
 
  display:flex;
  justify-content:center;
  align-items:center;
}
  .img {
    background-image: url(https://www.setaswall.com/wp-content/uploads/2017/03/Apple-Macbook-Colors-Wallpaper-1920x1200.jpg);
    background-attachment: fixed;
  background-size:cover !important;
  background-position:center;
  box-shadow: 5px 5px 0px 0px rgba(0,0,0,0.1);
    width: 40%;
    height: 100%;
    margin: 0 10px 10px 0;
    margin-bottom: 30px
}
.img:nth-child(2),.img:nth-child(4){
  margin-top:100px;
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
    <a data-aos="fade-up" data-aos-delay="200" href="#about" class="btn-get-started scrollto" > <button class="custom-btn btn-8" style="width: 100px;border-radius: 10px"  > <span style="font-size: 9pt">Bắt Đầu</span></button></a>
     
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
 
  
    <!-- ======= Portfolio Section ======= -->
   <section id="about" class="portfolio">
        <div class="frontpage">
  <div class="hd">
    <div class="img"></div>
    <div class="img"></div>
    <div class="img">
    </div>
    <div class="img"></div>
    <div class="img"></div>
  </div>
</div> 
      <div class="container" style="box-shadow: 0px 0 30px rgb(21 21 21 / 8%);border-radius: 40px">

<!-- images -->

  
 
  <!--   <p class="lead1" style="margin-left:-20px"><a href="laptops.php">List full of Sản Phẩm</a></p> -->
      
  
        <div class="section-title" data-aos="fade-up" style="margin-top: 70px" >
          <h2 >Laptop Mới</h2>
         <!--  <p>Magnam dolores commodi suscipit eius consequatur ex aliquid fuga eum quidem</p> -->
        </div>


        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
 <?php foreach($row as $laptop) { ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app"  style="width: 33%">
            
            <div class="portfolio-wrap" >
              <img src="./assets/img/<?php echo $laptop['laptop_image']; ?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                
              
                <div class="portfolio-links">
                  <a href="laptop.php?laptopisbn=<?php echo $laptop['laptop_isbn']; ?>" data-aos="fade-up" data-aos-delay="200" class="btn-get-started scrollto" > <button class="custom-btn btn-9" style="width: 100px;border-radius: 10px"  > <span style="font-size: 9pt">Xem Chi Tiết</span></button></a>
     
                </div>
              </div>


            </div>
            <a href="laptop.php?laptopisbn=<?php echo $laptop['laptop_isbn']; ?>" style="text-decoration: none; color: black;">
               <p align="center" style="font-size: 11pt"> <?php echo $laptop['laptop_title']; ?> <br></p>
             
               <p align="center" style="color: red; font-size: 10pt"><b><?php echo $format_number = number_format($laptop['laptop_price']) ; ?>₫  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>      <del style="color:gray; font-size: 9pt;"><?php echo $format_number = number_format($laptop['laptop_khuyenmai']) ; ?>₫ </del></p></a>
                <div class="stars" align="center">
  
                   
                        <div class="post-action">
                            <!-- Rating -->
                            <select class='rating' id='rating_<?php echo $laptop['laptop_isbn']; ?>' data-id='rating_<?php echo $laptop['laptop_isbn']; ?>'>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                            </select>
                            <div style='clear: both;'></div>
                            Average Rating : <span id='avgrating_<?php echo $laptop['laptop_isbn']; ?>'><?php echo $averageRating; ?></span>

                            <!-- Set rating -->
                            <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#rating_<?php echo $laptop['laptop_isbn']; ?>').barrating('set',<?php echo $rating; ?>);
                            });
                            
                            </script>
                        </div>
                    </div>
            

  <div class="clearfix"></div>
          </div>

       <?php } ?>
        </div>
        

      </div>
    </section><!-- End Portfolio Section -->

  

  

  </main>
  <?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>