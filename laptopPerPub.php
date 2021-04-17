<?php
	session_start();
	require_once "./functions/database_functions.php";
	// get pubid
	if(isset($_GET['pubid'])){
		$pubid = $_GET['pubid'];
	} else {
		echo "Wrong query! Check again!";
		exit;
	}

	// connect database
	$conn = db_connect();
	$pubName = getPubName($conn, $pubid);

	$query = "SELECT laptop_isbn, laptop_title, laptop_image FROM laptops WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty laptops ! Please wait until new laptops coming!";
		exit;
	}

	$title = "Laptop Per Publisher";
	require "./template/header1.php";
?>
	<p class="lead"><a href="index.php">Nhãn Hàng</a> > <?php echo $pubName; ?></p>
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="./assets/img/<?php echo $row['laptop_image'];?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $row['laptop_title'];?></h4>
			<a href="laptop.php?laptopisbn=<?php echo $row['laptop_isbn'];?>" class="btn btn-primary" style="background-image: linear-gradient(-90deg ,#FF0076 , #590FB7); border-radius: 10px ">Xem Chi Tiết</a>
		</div>
	</div>
	<br>
<?php
	}
	if(isset($conn)) { mysqli_close($conn);}
	require "./template/footer.php";
?>