<?php	
	// if save change happen
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}


	$isbn = trim($_POST['isbn']);
	$title = trim($_POST['title']);
	$author = trim($_POST['author']);
	$descr = trim($_POST['descr']);
	$price = floatval(trim($_POST['price']));
	$khuyenmai = trim($_POST['khuyenmai']);
	$quantity = floatval(trim($_POST['quantity']));
	$publisher = trim($_POST['publisher']);
	$pubprice = trim($_POST['pubprice']);

	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}

	require_once("../functions/database_functions.php");
	$conn = db_connect();

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
	}
	$findPrice = "SELECT * FROM pubprice WHERE pubprice_name = '$pubprice'";
	$findResult = mysqli_query($conn, $findPrice);
	if(!$findResult){
		// insert into publisher table and return id
		$insertPubprice = "INSERT INTO pubprice(pubprice_name) VALUES ('$pubprice')";
		$insertResult = mysqli_query($conn, $insertPubprice);
		if(!$insertResult){
			echo "Can't add new publisher " . mysqli_error($conn);
			exit;
		}
	}


	$query = "UPDATE laptops SET  
	laptop_title = '$title', 
	laptop_drive = '$author', 
	laptop_descr = '$descr', 
	laptop_price = '$price',
	laptop_khuyenmai = '$khuyenmai', 
	quantity = '$quantity'";
	if(isset($image)){
		$query .= ", laptop_image='$image' WHERE laptop_isbn = '$isbn'";
	} else {
		$query .= " WHERE laptop_isbn = '$isbn'";
	}
	// two cases for fie , if file submit is on => change a lot
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't update data " . mysqli_error($conn);
		exit;
	} else {
	
	header("Location: ./admin_edit.php?laptopisbn=$isbn");	

	}

?>