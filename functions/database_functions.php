<?php
if(!function_exists('db_connect')) {
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "", "www_project");
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}
}

if(!function_exists('select4Latestlaptop')){
	function select4Latestlaptop($conn){
		$row = array();
		$query = "SELECT laptop_isbn, laptop_image, laptop_title,laptop_price, laptop_khuyenmai FROM laptops ORDER BY rand(laptop_isbn)";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		for($i = 0; $i < 6; $i++){
			array_push($row, mysqli_fetch_assoc($result));
		}
		return $row;
	}
}
if (!function_exists('tangdan')) {
	function tangdan($conn){
		$row = array();
		$query ="SELECT laptop_isbn, laptop_image,laptop_price,laptop_title,laptop_khuyenmai FROM laptops ORDER BY laptop_price ASC";
		$result = mysqli_query($conn, $query);
		if (!$result) {
			echo "Lỗi không loadđược dữ liệu ra" . mysqli_error($conn);
			exit;
			# code...
		}
		for($i = 0;$i < mysqli_num_rows($result); $i++){
			array_push($row, mysqli_fetch_assoc($result));
		}
		return $row;
	}
	# code...
}
if (!function_exists('giamdan')) {
	function giamdan($conn){
		$row = array();
		$query = " SELECT laptop_isbn,laptop_image,laptop_title,laptop_price,laptop_khuyenmai FROM laptops ORDER BY laptop_price DESC";
		$result = mysqli_query($conn,$query);
		if (!$result) {
			echo "Lỗi không thể load dữ  liệu ra được" . mysqli_error($conn);
			exit;
			# code...
		}
		for ($i=0 ; $i <  mysqli_num_rows($result); $i++ ) { 
			array_push($row, mysqli_fetch_assoc($result));
			# code...
		}
		return $row;
	}
	# code...
}
if(!function_exists('getlaptopByIsbn')){
	function getlaptopByIsbn($conn, $isbn){
		$query = "SELECT laptop_title, laptop_drive, laptop_price, laptop_khuyenmai, quantity FROM laptops WHERE laptop_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
// if(!function_exists('getOrderId')){
// 	function getOrderId($conn, $customerid){
// 		$query = "SELECT orderid FROM orders WHERE customerid = '$customerid'";
// 		$result = mysqli_query($conn, $query);
// 		if(!$result){
// 			echo "retrieve data failed!" . mysqli_error($conn);
// 			exit;
// 		}
// 		$row = mysqli_fetch_assoc($result);
// 		return $row['orderid'];
// 	}
// }
// if(!function_exists('insertIntoOrder')){
// 	function insertIntoOrder($conn, $customerid, $total_price, $date, $ship_name, $ship_address, $ship_city, $ship_zip_code, $ship_country){
// 		$query = "INSERT INTO orders VALUES 
// 		('', '" . $customerid . "', '" . $total_price . "', '" . $date . "', '" . $ship_name . "', '" . $ship_address . "', '" . $ship_city . "', '" . $ship_zip_code . "', '" . $ship_country . "')";
// 		$result = mysqli_query($conn, $query);
// 		if(!$result){
// 			echo "Insert orders failed " . mysqli_error($conn);
// 			exit;
// 		}
// 	}
// }
if(!function_exists('getlaptopprice')){
	function getlaptopprice($isbn){
		$conn = db_connect();
		$query = "SELECT laptop_price, laptop_khuyenmai FROM laptops WHERE laptop_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get laptop price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['laptop_price'];
	}
}
// if(!function_exists('getCustomerId')){
// 	function getCustomerId($name, $address, $city, $zip_code, $country){
// 		$conn = db_connect();
// 		$query = "SELECT customerid from customers WHERE 
// 		name = '$name' AND 
// 		address= '$address' AND 
// 		city = '$city' AND 
// 		zip_code = '$zip_code' AND 
// 		country = '$country'";
// 		$result = mysqli_query($conn, $query);
// 		// if there is customer in db, take it out
// 		if($result){
// 			$row = mysqli_fetch_assoc($result);
// 			return $row['customerid'];
// 		} else {
// 			return null;
// 		}
// 	}
// }
// if(!function_exists('setCustomerId')){
// 	function setCustomerId($name, $address, $city, $zip_code, $country){
// 		$conn = db_connect();
// 		$query = "INSERT INTO customers VALUES 
// 			('', '" . $name . "', '" . $address . "', '" . $city . "', '" . $zip_code . "', '" . $country . "')";

// 		$result = mysqli_query($conn, $query);
// 		if(!$result){
// 			echo "insert false !" . mysqli_error($conn);
// 			exit;
// 		}
// 		$customerid = mysqli_insert_id($conn);
// 		return $customerid;
// 	}
// }
if(!function_exists('getPubName')){
	function getPubName($conn, $pubid){
		$query = "SELECT publisher_name, publisher_img FROM publisher WHERE publisherid = '$pubid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Empty laptops ! Something wrong! check again";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['publisher_name'];
	}
}
if(!function_exists('getPubpriceName')){
	function getPubpriceName($conn, $puid){
		$query = "SELECT pubprice_name FROM pubprice WHERE pubpriceid = '$puid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Empty laptops ! Something wrong! check again";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['pubprice_name'];
	}
}
if(!function_exists('getAll')){
	function getAll($conn){
		$query = "SELECT * from laptops ORDER BY laptop_isbn ASC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
if(!function_exists('getAllorder')){
	function getAllorder($conn){
		$query = "SELECT * from orders ORDER BY orderid DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}

if(!function_exists('getamount')){
	function getamount($isbn){
		$conn = db_connect();
		$query = "SELECT amount FROM orders WHERE orderid = '$idod'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get laptop price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['amount'];
	}
}
if(!function_exists('getallamount')){
	function getallamount($conn){
		$conn = db_connect();
		$query = "SELECT SUM(amount) FROM orders WHERE orderid";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get laptop price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
}
if (!function_exists('showall')) {
	function showall($id)
		{
			$conn =db_connect();
			$query = "SELECT * FROM google_users WHERE google_id='$id' ";
			$result = mysqli_query($conn,$query);
			return $result;
		}
	# code...
}
?>
