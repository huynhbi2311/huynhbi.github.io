<?php
	/*
		loop through array of $_SESSION['cart'][book_isbn] => number
		get isbn => take from database => take book price
		price * number (quantity)
		return sum of price
	*/
	function total_amount($amount){
		$price = 0.0;
		if(is_array($amount)){
		  	foreach($amount as $idod ){
		  		$amt = getamount($idod);
		  		if($amt){
		  			$price += $amt;
		  		}
		  	}
		}
		return $price;
	}

	/*
		loop through array of $_SESSION['cart'][book_isbn] => number
		$_SESSION['cart'] is associative array which is [book_isbn] => number of books for each book_isbn
		calculate sum of books 
	*/
// 	function total_items($amount){
// 		$items = 0;
// 		if(is_array($amount)){
// 			foreach($amount as $isbn){
// 				$items;
// 			}
// 		}
// 		return $items;
// 	}
// ?>