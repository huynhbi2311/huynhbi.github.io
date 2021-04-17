<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "List Laptop";
	// require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Itim|Lobster|Montserrat:500|Noto+Serif|Nunito|Patrick+Hand|Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i|Roboto+Slab|Saira" rel="stylesheet">
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

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          
          <li><a class="nav-link scrollto " href="admin_add.php">Add Laptops</a></li>
          
        
         
          <li><a class="nav-link scrollto" href="admin_cart.php">Quản Lý Giỏ Hàng</a></li>

           <li><a class="nav-link scrollto" href="admin_signout.php">Signout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
   <?php
      if(isset($title) && $title == "Scarlet Witch") ?>
       <div id="main">



	<!-- <a href="admin_signout.php" class="btn btn-primary" style="font-family: 'Itim', cursive; margin-left: 20px;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center;float: right;">Sign out!</a>
   <a href="admin_add.php" class="btn btn-primary" style=";background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center">Add new Laptop</a>
	<a href="admin_cart.php" class="btn btn-primary" style="font-family: 'Itim', cursive; margin-left: 20px;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center">Quản lý giỏ hàng</a> -->
	<table class="table" style="margin-top: 20px; font-size: 11pt">
		<tr>
			<th>M.Sản Phẩm</th>
			<th>T.Sản Phẩm</th>
			<th>S.L Kho</th>
			<th>Drive</th>
			<th>Ram</th>
			<th>Size</th>
			<th>CPU</th>
			<th>Ổ Cứng</th>
			<th>Năm.PH</th>
			<th>Image</th>
			
			<th>Price</th>
			<th>Giá.KM</th>
			<th>Nhãn Hàng</th>
        <th>Theo Giá</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['laptop_isbn']; ?></td>
			<td><?php echo $row['laptop_title']; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['laptop_drive']; ?></td>
			<td><?php echo $row['laptop_ram']; ?></td>
			<td><?php echo $row['laptop_size']; ?></td>
			<td><?php echo $row['laptop_cpu']; ?></td>
			<td><?php echo $row['laptop_ocung']; ?></td>
			<td><?php echo $row['laptop_year']; ?></td>
			<td><img class="img-responsive img-thumbnail" src="./assets/img/<?php echo $row['laptop_image']; ?>"></td>
			
			<td><?php echo $format_number = number_format($row['laptop_price']); ?>₫</td>
			<td><?php echo $format_number = number_format($row['laptop_khuyenmai']); ?>₫</td>
			<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
      <td><?php echo getPubpriceName($conn, $row['pubpriceid']); ?></td>

			<td><a href="admin_edit.php?laptopisbn=<?php echo $row['laptop_isbn']; ?>">   <i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i></a></td>
			<td><a href="admin_delete.php?laptopisbn=<?php echo $row['laptop_isbn']; ?>"><i class="fa fa-trash-o" aria-hidden="true">Delete</i></a></td>
		</tr>
		<?php } ?>
	</table>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>