<?php

  require_once "functions/database_functions.php";
  $conn = db_connect();

$userid = 4;
$laptop_isbn = $_POST['postid'];
$rating = $_POST['rating'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM post_rating WHERE postid=".$laptop_isbn." and userid=".$userid;

$result = mysqli_query($con,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

if($count == 0){
    $insertquery = "INSERT INTO post_rating(userid,postid,rating) values(".$userid.",".$laptop_isbn.",".$rating.")";
    mysqli_query($conn,$insertquery);
}else {
    $updatequery = "UPDATE post_rating SET rating=" . $rating . " where userid=" . $userid . " and postid=" . $laptop_isbn;
    mysqli_query($conn,$updatequery);
}


// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid=".$laptop_isbn;
$result = mysqli_query($conn,$query) or die(mysqli_error());
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];

$return_arr = array("averageRating"=>$averageRating);

echo json_encode($return_arr);