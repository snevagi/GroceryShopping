<?php

	include 'db.php';
	include 'secure.php';
	$con = connect_db();
	
	
	$ops = $_POST['ops'];
	$itemId = $_POST['itemId'];
	
	if(isset($ops) && $ops == "save"){
		$itemName = $_POST['itemName'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$itemQty = $_POST['itemQty'];
		$category = html_entity_decode($category);
	
		$getCat = "select id from category where name = '$category'";
		$res = $con->prepare($getCat);
		$res->execute();
		
		if($res->rowCount() == 0){
			echo "Category does not exist";
			exit;
		}	

		$id = $res->fetchColumn();
		
		$query = "update items set itemName = '$itemName', itemQty = '$itemQty',prize = '$price',category = '$id' where itemId = '$itemId'"; 
	}else if(isset($ops) && $ops == "delete"){
		$itemId = $_POST['itemId'];
		$query = "UPDATE items SET isDeleted = 1 WHERE itemId = '$itemId'";
	}else{
		$catId = $_POST['catId'];
		$itemName = $_POST['itemName'];
		$price = $_POST['price'];
		$itemQty = $_POST['itemQty'];
		$query = "Insert into items (itemName,prize,category,itemQty,isDeleted) values ('$itemName','$price','$catId',$itemQty,0)";
		
	}
	
	$res = $con->prepare($query);
	$res->execute();
	
	if($res && $ops == "save"){
		echo "Item updated successfully";
	}else if($res && $ops == "delete"){
	     $query = "DELETE FROM cart WHERE itemId = '$itemId' AND status = 'cart'";
	     $res = $con->prepare($query);
	     $res->execute();

		echo "Item deleted successfully";
	}else{
	     /* 
	     * Redirect to a different page in the current directory that was requested 
	     */
	     $host  = $_SERVER['HTTP_HOST'];
	     $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	     $extra = 'admin.php';
	     $protocol = isSecure() ? 'https' : 'http';
	     header("Location: $protocol://$host$uri/$extra");
	     exit;
	}
	
?>