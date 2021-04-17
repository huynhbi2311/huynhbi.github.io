<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "Add new Laptop";
	// require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$ram = trim($_POST['ram']);
		$ram = mysqli_real_escape_string($conn, $ram);

		$size = trim($_POST['size']);
		$size = mysqli_real_escape_string($conn, $size);

		$cpu = trim($_POST['cpu']);
		$cpu = mysqli_real_escape_string($conn, $cpu);

		$ocung = trim($_POST['ocung']);
		$ocung = mysqli_real_escape_string($conn, $ocung);

		$year = trim($_POST['year']);
		$year = mysqli_real_escape_string($conn, $year);

		$author = trim($_POST['author']);
		$author = mysqli_real_escape_string($conn, $author);
		
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);

		$khuyenmai = floatval(trim($_POST['khuyenmai']));
		$khuyenmai = mysqli_real_escape_string($conn, $khuyenmai);
		
		$publisher = trim($_POST['publisher']);
		$publisher = mysqli_real_escape_string($conn, $publisher);

		$quantity = floatval($_POST['quantity']);
		$quantity = mysqli_real_escape_string($conn, $quantity);

		$pubprice = trim($_POST['pubprice']);
		$pubprice = mysqli_real_escape_string($conn, $pubprice);

		// add image
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}

		// find publisher and return pubid
		// if publisher is not in db, create new
		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
		$findResult = mysqli_query($conn, $findPub);
		if(!$findResult){
			// insert into publisher table and return id
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
			$insertResult = mysqli_query($conn, $insertPub);
			if(!$insertResult){
				echo "Can't add new publisher " . mysqli_error($conn);
				exit;
			}
			$publisherid = mysql_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($findResult);
			$publisherid = $row['publisherid'];
		}
		$findPrice = "SELECT * FROM pubprice WHERE pubpriceid = '$pubprice'";
		$findResult = mysqli_query($conn, $findPrice);
		if(!$findResult){
			// insert into publisher table and return id
			$insertPubprice = "INSERT INTO pubprice(pubpriceid) VALUES ('$pubprice')";
			$insertResult = mysqli_query($conn, $insertPubprice);
			if(!$insertResult){
				echo "Can't add new publisher " . mysqli_error($conn);
				exit;
			}
			$pubpriceid = mysql_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($findResult);
			$pubpriceid = $row['pubpriceid'];
		}


		$query = "INSERT INTO laptops VALUES ('" . $isbn . "', '" . $title . "', '" . $author . "', '" . $image . "', '" . $descr . "', '" . $publisherid . "', '" . $ram . "', '" . $size . "', '" . $cpu . "', '" . $ocung . "', '" . $year . "', '" . $price . "', '" . $khuyenmai . "', '" . $quantity . "', '" . $pubpriceid . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {header("Location: admin_laptop.php");
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
   <script type="text/javascript" src="template/ckeditor/ckeditor.js"></script>

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
          <li><a class="nav-link scrollto" href="#portfolio">Home</a></li>
          
          <li><a class="nav-link scrollto " href="laptops.php">Laptops</a></li>
          
        
         
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

           <li><a class="nav-link scrollto" href="cart.php">Giỏ Hàng</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
   <?php
      if(isset($title) && $title == "Scarlet Witch") ?>
       <div id="main">


	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Mã Sản Phẩm</th>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr>
				<th>Tên Sản Phẩm</th>
				<td><input type="text" name="title" required></td>
			</tr>
			<tr>
				<th>Drive</th>
				<td><input type="text" name="author" required></td>
			</tr>
			<tr>
				<th>Ram</th>
				<td><input type="text" name="ram" required></td>
			</tr>
			<tr>
				<th>Size</th>
				<td><input type="text" name="size" required></td>
			</tr>
			<tr>
				<th>CPU</th>
				<td><input type="text" name="cpu" required></td>
			</tr>
			<tr>
				<th>Ổ Cứng</th>
				<td><input type="text" name="ocung" required></td>
			</tr>
			<tr>
				<th>Năm Phát Hành</th>
				<td><input type="text" name="year" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Nội Dung</th>
				<td><textarea name="descr" rows="5" cols="150"></textarea></td>
				<!-- <td><textarea name="descr" cols="40" rows="5"></textarea></td> -->
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="price" required></td>
			</tr>
			<tr>
				<th>Giá khuyến mãi</th>
				<td><input type="text" name="khuyenmai" required></td>
			</tr>
			<tr>
				<th>Số Lượng Trong Kho</th>
				<td><input type="text" name="quantity" required></td>
			</tr>
			<tr>
				<th>Publisher</th>
				<td><input type="text" name="publisher" required></td>
			</tr>
			<tr>
				<th>Pubprice</th>
				<td><input type="text" name="pubprice" required></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Add new Laptop" class="btn btn-primary">
		<input type="reset" value="cancel" class="btn btn-default">
	</form>

	<br/>
	<script>
    // Thay thế <textarea id="post_content"> với CKEditor
    CKEDITOR.replace( 'descr' );// tham số là biến name của textarea
</script>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>