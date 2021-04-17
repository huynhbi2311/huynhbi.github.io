<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "Edit Laptop";
	require_once "./template/header1.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['laptopisbn'])){
		$laptop_isbn = $_GET['laptopisbn'];
	} else {
		// echo '<a href="admin_edit.php?laptopisbn" class="btn btn-success">Confirm</a>';
		echo "Empty query!";
		exit;
	}

	if(!isset($laptop_isbn)){
		echo "Empty isbn! check again!";
		exit;
	}

	// get book data
	$query = "SELECT * FROM laptops WHERE laptop_isbn = '$laptop_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);
?>
	<form method="post" action="edit_laptop.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="isbn" value="<?php echo $row['laptop_isbn'];?>" readOnly="true"></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><input type="text" name="title" value="<?php echo $row['laptop_title'];?>" required></td>
			</tr>
			<tr>
				<th>Drive</th>
				<td><input type="text" name="author" value="<?php echo $row['laptop_drive'];?>" required></td>
			</tr>
			<tr>
				<th>Ram</th>
				<td><input type="text" name="ram" value="<?php echo $row['laptop_ram'];?>" required></td>
			</tr>
			<tr>
				<th>Size</th>
				<td><input type="text" name="size" value="<?php echo $row['laptop_size'];?>" required></td>
			</tr>
			<tr>
				<th>CPU</th>
				<td><input type="text" name="cpu" value="<?php echo $row['laptop_cpu'];?>" required></td>
			</tr>
			<tr>
				<th>Ổ Cứng</th>
				<td><input type="text" name="ocung" value="<?php echo $row['laptop_ocung'];?>" required></td>
			</tr>
			<tr>
				<th>Năm Phát Hành</th>
				<td><input type="text" name="year" value="<?php echo $row['laptop_year'];?>" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Description</th>

				<td><textarea name="descr" rows="5" cols="150"><?php echo $row['laptop_descr'];?></textarea></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="price" value="<?php echo $row['laptop_price'];?>" required></td>
			</tr>
				<tr>
				<th>Giá Khuyến Mãi</th>
				<td><input type="text" name="khuyenmai" value="<?php echo $row['laptop_khuyenmai'];?>" required></td>
			</tr>
			</tr>
				<tr>
				<th>Số Lượng Trong Kho</th>
				<td><input type="text" name="quantity" value="<?php echo $row['quantity'];?>" required></td>
			</tr>
			<tr>
				<th>Publisher</th>
				<td><input type="text" name="publisher" value="<?php echo getPubName($conn, $row['publisherid']); ?>" required></td>
			</tr>
			<tr>
				<th>Pubprice</th>
				<td><input type="text" name="pubprice" value="<?php echo getPubpriceName($conn, $row['pubpriceid']); ?>" required></td>
			</tr>
		</table>
		<input type="submit" name="save_change" value="Change" class="btn btn-primary">
		<input type="reset" value="cancel" class="btn btn-default">
	</form>
	<br/>
		<script>
    // Thay thế <textarea id="post_content"> với CKEditor
    CKEDITOR.replace( 'descr' );// tham số là biến name của textarea
</script>
	<a href="admin_laptop.php" class="btn btn-success">Confirm</a>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>