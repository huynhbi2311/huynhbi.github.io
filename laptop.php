<?php
  session_start();
  $laptop_isbn = $_GET['laptopisbn'];
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM laptops WHERE laptop_isbn = '$laptop_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty Laptop";
    exit;
  }

  $title = $row['laptop_title'];
  // require "./template/header.php";
  $userid = 4;
      // User rating
                    $query = "SELECT * FROM post_rating WHERE postid=".$laptop_isbn." and userid=".$userid;
                    $userresult = mysqli_query($conn,$query) or die(mysqli_error());
                    $fetchRating = mysqli_fetch_array($userresult);
                    $rating = $fetchRating['rating'];

                    // get average
                    $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid=".$laptop_isbn;
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

  <!-- Template Main CSS File -->
  <link href="./assets/css/style.css" rel="stylesheet">
  <script src="./assets/vendor/aos/aos.js"></script>
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./assets/vendor/php-email-form/validate.js"></script>
  <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="./assets/js/main.js"></script>

   <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  <link rel="stylesheet" href="./assets/css/vote.css">
  <script  src="./assets/js/vote.js"></script>

   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
 <!--  <script>
  $(document).ready(function() {
    /*
     * Hiệu ứng khi rê chuột lên ngôi sao
     */
    $('a.star').mouseenter(function() {
        if ($('#cate-rating').hasClass('rating-ok') == false) {
            var eID = $(this).attr('id');
            eID = eID.split('-').splice(-1);
            $('a.star').removeClass('vote-active');
            for (var i = 1; i <= eID; i++) {
                $('#star-' + i).addClass('vote-hover');
            }
        }
    }).mouseleave(function() {
        if ($('#cate-rating').hasClass('rating-ok') == false) {
            $('a.star').removeClass('vote-hover');
        }
    });

    /*
     * Sự kiện khi cho điểm
     */
    $('a.star').click(function() {
        if ($('#cate-rating').hasClass('rating-ok') == false) {
            var eID = $(this).attr('id');
            eID = eID.split('-').splice(-1).toString();
            for (var i = 1; i <= eID; i++) {
                $('#star-' + i).addClass('vote-active');
            }
            $('p#vote-desc').html('<span class="blue">' + eID + ' (' + eID * 20 + '%)</span> &middot; ' + 1 + ' đánh giá');
            $('#cate-rating').addClass('rating-ok');
        }
    });
});
</script> -->

<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>

</head>

<body>

  <!-- ======= Hero Section ======= -->
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo" align="left">
        <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="index.php">Home</a></li>
          
          <li><a class="nav-link scrollto " href="laptops.php">Laptops</a></li>
          
        
         
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

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
 <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
         
          <ol>
            <li><a href="laptops.php">Laptops</a></li>
            <li> <?php echo $row['laptop_title']; ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper-container">
              <!-- <div class="swiper-wrapper align-items-center"> -->

                <div class="swiper-slide" style="margin-top: 100px">
                  <img src="./assets/img/<?php echo $row['laptop_image']; ?>" alt="">
                </div>

               <!--  <div class="swiper-slide">
                  <img src="assets/img/portfolio/portfolio-2.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="assets/img/portfolio/portfolio-3.jpg" alt="">
                </div> -->

            <!--   </div> -->
              <!-- <div class="swiper-pagination"></div> -->
            </div>

          </div>

          <div class="col-lg-4" style="margin-top: 50px">
             <b> <p align="center" style="color: red;font-size: 17pt;margin-left: -20px  "><?php echo $format_number = number_format($row['laptop_price']) ; ?>₫ * </b> <del style="color:gray; font-size: 11pt"><?php echo $format_number = number_format($row['laptop_khuyenmai']) ; ?>₫ </del></p>
           <p id="cate-rating" class="cate-rating"> 
            
  <div class="stars" align="center">
  
                   
                        <div class="post-action">
                            <!-- Rating -->
                            <select class='rating' id='rating_<?php echo $laptop_isbn; ?>' data-id='rating_<?php echo $laptop_isbn; ?>'>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                            </select>
                            <div style='clear: both;'></div>
                            Average Rating : <span id='avgrating_<?php echo $laptop_isbn; ?>'><?php echo $averageRating; ?></span>

                            <!-- Set rating -->
                            <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#rating_<?php echo $laptop_isbn; ?>').barrating('set',<?php echo $rating; ?>);
                            });
                            
                            </script>
                        </div>
                    </div>
            

  <div class="clearfix"></div>
</p>

            <div class="portfolio-info">
              <h3  style="font-family: 'Patrick Hand', cursive; ">Product Detail</h3>
              <ul>
                <li><strong>Cổng Kết Nối:</strong><?php echo $row['laptop_drive']; ?></li>
                <li><strong>Ram:</strong><?php echo $row['laptop_ram']; ?></li>
                <li><strong>Size:</strong><?php echo $row['laptop_size']; ?></li>
                <li><strong>CPU:</strong><?php echo $row['laptop_cpu']; ?></li>
                <li><strong>Ổ Cứng:</strong><?php echo $row['laptop_ocung']; ?></li>
                <li><strong>Năm Phát Hành:</strong><?php echo $row['laptop_year']; ?></a></li>
                
              </ul>
               <?php if ($row['quantity'] > 0) { ?>
                        <div class="product-quantity"><label>Còn :</label><strong><?= $row['quantity'] ?> </strong><label>Máy </label></div>
                        <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                          <input onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty) &amp; qty > 1 ) result.value--;return false;" type='button' value='-' style="margin-left:10px " />
<input id='quantity' min='1' name='quantity[<?= $row['laptop_isbn'] ?>]' type='text' value='1' size="2"/>
<input onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty)) result.value++;return false;" type='button' value='+' />
                       <br/>
                        <button type="submit" class="btn btn-info" style="background-color: pink;background: radial-gradient(circle, rgba(247,150,192,1) 0%, rgba(118,174,241,1) 100%);margin-left: 8.5px;margin-top: 10px">
          <span class="glyphicon glyphicon-shopping-cart" ></span> Mua Hàng
       </button>
                        </form>
                    <?php } else { ?>
                        <p style="font-size: 15pt; margin-top: 20px ">Hết hàng</p>
                    <?php } ?>
            </div>
            <!--  -->

          </div>
<div  style="width: 100%; float: left; margin-top:-3px;">
  <div class="portfolio-description" style="width: 71.5%; float: left; margin-top: -30px;" >
              <h3  style="font-family: 'Patrick Hand', cursive;">Thông Tin Sản Phẩm:</h3>
              <p>
               <?php echo $row['laptop_descr']; ?>
              </p>

            </div>
            
 <?php  
  $count = 0;
  // connecto database
  
  
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4Latestlaptop($conn); ?>
  <div class="row gy-4" style="width: 28.1%; margin-top: 60px; ">
  <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200" > 
<?php foreach($row as $laptop) { ?>
 
        <!--  <div class="col-lg-4 col-md-6 portfolio-item filter-app" > -->
             
            <div class="portfolio-wrap"  style="width: 340px;">
<a href="laptop.php?laptopisbn=<?php echo $laptop['laptop_isbn']; ?>" style="text-decoration: none;">              <img src="./assets/img/<?php echo $laptop['laptop_image']; ?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                    <p align="center" style="font-size: 10pt;margin-left: -16px"> <?php echo $laptop['laptop_title']; ?> <br></p>
             <p align="center" style="color: red; font-size: 8.75pt"><b><?php echo $format_number = number_format($laptop['laptop_price']) ; ?>₫  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>      <del style="color:gray; font-size: 7.76pt;"><?php echo $format_number = number_format($laptop['laptop_khuyenmai']) ; ?>₫ </del></p>
                
              </div>
              </a>
            </div>
          
<!-- 
          </div> -->
 
<?php } ?>
        </div>
      </div>
      </div>  
          </div>
   
        </div>
     

      </div>
    </section><!-- End Portfolio Details Section -->

  </main>
  <?php
 if(isset($conn)) {mysqli_close($conn);}
  require "./template/footer.php";
?>