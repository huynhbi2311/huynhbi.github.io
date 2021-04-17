<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "cart";
	// require_once "./template/header1.php";
	require_once "./functions/database_functions.php";
	
	$conn = db_connect();
	$result = getAllorder($conn);
	  $query = "SELECT SUM (amount)   FROM orders  ";
// 	  $row = mysqli_fetch_assoc($query); 
// $sum = $row['amount_sum'];
	 //  $result = mysqli_query($conn, $query);
  // if(!$result){
  //   echo "Can't retrieve data " . mysqli_error($conn);
  //   exit;
  // }
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
           <li style="margin-top: 6px"><form method="get" action="">
  
  
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
    $sql = "SELECT * FROM orders WHERE orderid LIKE '%$key%' or ship_name LIKE '%$key%'";
}
else{
    $sql = "SELECT * FROM orders";
}
$result = mysqli_query($conn,$sql);
?>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          
          <li><a class="nav-link scrollto " href="admin_add.php">Add Laptops</a></li>
          
        
         
          <li><a class="nav-link scrollto" href="admin_laptop.php">Quản Lý Laptops</a></li>

           <li><a class="nav-link scrollto" href="admin_signout.php">Signout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
   <?php
      if(isset($title) && $title == "Scarlet Witch") ?>
       <div id="main">

	<!-- 	<a href="admin_signout.php" class="btn btn-primary" style="font-family: 'Itim', cursive; margin-left: 20px;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center;float: right;">Sign out!</a>
   <a href="admin_add.php" class="btn btn-primary" style="font-family: 'Itim', cursive;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center">Add new Laptop</a>
	<a href="admin_laptop.php" class="btn btn-primary" style="font-family: 'Itim', cursive; margin-left: 20px;background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 10px ;text-align: center">Quản lý laptops</a> -->
	<table class="table" style="margin-top: 20px;font-family: 'Patrick Hand', cursive; ">
		<tr>
			
			<th>date</th>
			<th>name</th>
			<th>address</th>
			<th>city</th>
			<th>country</th>
			<th>amount</th>
			
			
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
			
		<tr>
			
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['ship_name']; ?></td>
			<td><?php echo $row['ship_address']; ?></td>
			<td><?php echo $row['ship_city']; ?></td>
			<td><?php echo $row['ship_country']; ?></td>
			<td><?php echo $format_number = number_format($row['amount'])."₫"; ?></td>
			
		
			

		</tr>

		<?php } ?>
		
	<?php 
$query = "SELECT SUM(amount) FROM orders WHERE amount";
$result = mysqli_query($conn,$query);
while($rows = mysqli_fetch_assoc($result)){ ?>
   
		 <tr>
		
		 	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th>
<?php echo  $format_number= number_format( array_sum($rows))."₫"; ?>
   
				</th>
			
		    </tr>
	<?php } ?>
	</table>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>