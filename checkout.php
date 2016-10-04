<?php

	include 'db.php';
	$con = connect_db();
	
	$id = $_POST['userId'];
	
	$searchQuery = "SELECT * from cart where userId = '$id'AND status = 'cart'";
	$rows = $con->prepare($searchQuery);
	$rows->execute();
	
	if($rows->rowCount() == 0){
		echo "Please add items to the cart.";
		exit;
	}
		
	
	$updtQuery = "Update cart set status = 'checkedout', updatedOn = now() where userId = '$id' AND  status = 'cart'";
	$con->query($updtQuery);	
		
		if($con){
			echo "You have successfully checked out. Please check order history for details.";
		}else{
			echo "Failed to add item. Please try again.";
		}
	

?>