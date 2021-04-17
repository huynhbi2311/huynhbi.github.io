<?php
	$laptop_isbn = $_GET['laptopisbn'];

	require_once "../functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM laptops WHERE laptop_isbn = '$laptop_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	 else {
        // echo '<a href="admin_edit.php?laptopisbn" class="btn btn-success">Confirm</a>';
             echo '<script language="javascript">';
             
echo 'alert("Đã Lưu")';
echo '</script>';
 
  	header("Location: ./admin_laptop.php");
    }

?>