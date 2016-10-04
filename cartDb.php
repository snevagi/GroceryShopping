<?php
	include 'db.php';
	$con = connect_db();
	
	$itemId = $_POST['itemId'];
	$userId = $_POST['userId'];	
	
	$queryPrice = "SELECT itemQty,prize from items where itemId = '$itemId'";
	$priceRes = $con->prepare($queryPrice);
	$priceRes->execute();

	foreach($priceRes as $row){
			$itemQty = $row['itemQty'];
			$price = $row['prize'];
	}		

	if($itemQty <= 0){
		echo "error";
		exit;
	}	
	
	$query = "SELECT quantity,itemId from cart where itemId = '$itemId' and userId = '$userId' and status = 'cart'";
	$rows = $con->prepare($query);
	$rows->execute();
	
	
	
	if($rows->rowCount() == 0){
		$query = "Insert into cart (userId,itemId,quantity,totalPrice,status,updatedOn) values('$userId','$itemId',1,'$price','cart',now())";
		$con->query($query); 	
		
		if($con){
			updateItemQty($con,$itemId,$itemQty);
			loadCart($con,$userId);
		}else{
			echo "Failed to add item. Please try again.";
		}
	}else{
		$qty = $rows->fetchColumn();
		$updtQty = $qty + 1;
		$updtPrize = ($updtQty)* $price;
		$updtQuery = "Update cart set quantity = '$updtQty', totalPrice = '$updtPrize', updatedOn = now() where userId = '$userId' and itemId = '$itemId'";
		$con->query($updtQuery);	
		
		if($con){
			updateItemQty($con,$itemId,$itemQty);
			loadCart($con,$userId);
		}else{
			echo "Failed to add item. Please try again.";
		}
	}
	function updateItemQty($con,$itemId,$itemQty){
		
			$itemQty = $itemQty -1;
			$query = "UPDATE items set itemQty = '$itemQty' where itemId = '$itemId'";
			$res = $con->prepare($query);
			$res->execute();
	}
	function loadCart($con,$userId){
			$cartQuery = "SELECT count(quantity) from cart where userId = '$userId' and status='cart'";
			$qtyRes = $con->prepare($cartQuery);
			$qtyRes->execute();

			$qty = $qtyRes->fetchColumn();	
	
				$detQuery = "SELECT * from cart where userId = '$userId' and status='cart'";
				$rows = $con->prepare($detQuery);
				$rows->execute();
				foreach($rows as $row){
					$id = $row['itemId'];
					$quant = $row['quantity'];
					$price = $row['totalPrice'];
						
					$findItem = "SELECT itemName from items where itemId = '$id'";
					$name = $con->prepare($findItem);
					$name->execute();

					$itemName = $name->fetchColumn();
					echo "
						
						<tr>
							<td>$itemName</td>
							<td>
<span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span>
														$quant
<span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span>
							
							</td>
							<td>$price</td>
						</tr>
						
					";		
					
				}
				$totalQuery = "SELECT sum(totalPrice)from cart where userId = '$userId' and status ='cart'";
				$totalP = $con->prepare($totalQuery);
				$totalP->execute();

				$totalPrize = $totalP->fetchColumn();
				$totalPrize = number_format($totalPrize, 2, '.', '');	
			echo "
			         <tr>
					<td colspan='2'> Total </td>
					<td class='total'>$totalPrize</td>
				</tr>
				<tr>
					<td colspan='3'>
					  <button type='button' class='checkout btn btn-default'>Checkout</button>
					 </td>
				</tr>
			
			";
	}


?>