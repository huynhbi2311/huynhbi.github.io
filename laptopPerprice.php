<?php
	session_start();
	require_once "./functions/database_functions.php";
	// get pubid
	if(isset($_GET['puid'])){
		$puid = $_GET['puid'];
	} else {
		echo "Wrong query! Check again!";
		exit;
	}

	// connect database
	$conn = db_connect();
	$pubpriceName = getPubpriceName($conn, $puid);

	$query = "SELECT laptop_isbn, laptop_title, laptop_image,laptop_price,laptop_khuyenmai FROM laptops WHERE pubpriceid = '$puid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Sản Phẩm Trống ! Xin vui lòng đợi thêm sản phẩm mới!";
		exit;
	}

	$title = "Laptop Per Publisher";
	require "./template/header1.php";
?>
	<p class="lead"><a href="index.php">Giá Tiền</a> > <?php echo $pubpriceName; ?></p>
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="./assets/img/<?php echo $row['laptop_image'];?>">
		</div>
		<div class="col-md-7">
			<h5><?php echo $row['laptop_title'];?></h5>
			 <p  style="color: red; font-size: 10pt"><b><?php echo $format_number = number_format($row['laptop_price']) ; ?>₫  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>      <del style="color:gray; font-size: 9pt;"><?php echo $format_number = number_format($row['laptop_khuyenmai']) ; ?>₫ </del></p>
			<a href="laptop.php?laptopisbn=<?php echo $row['laptop_isbn'];?>" class="btn btn-primary" style="background-image: linear-gradient(-90deg ,#FF0076 , #590FB7); border-radius: 10px ">Xem Chi Tiết</a>
		</div>
	</div>
	<br>
<?php
	}
	if(isset($conn)) { mysqli_close($conn);}
	require "./template/footer.php";
?>