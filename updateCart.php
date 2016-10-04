<?php
	include 'db.php';
	$con = connect_db();
	
	$itemName = $_POST['itemName'];
	$userId = $_POST['userId'];	
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	$ops = $_POST['ops'];
	
		$queryQty = "SELECT itemQty from items where itemId = 
			(SELECT itemId from items where itemName = '$itemName')";
		$qtyResult = $con->prepare($queryQty);
		$qtyResult->execute();
		
		$itemQty = $qtyResult->fetchColumn();
		if($itemQty  <= 0 && $ops == "plus"){
			echo "error";
			exit;
		}
		
		$price = number_format($price, 2, '.', '');
		if($qty == 0){
			$updtQuery = "Delete from cart where userId = '$userId' and 
				itemId = (select itemId from items where itemName = '$itemName') and status ='cart'";
			echo 	$updtQuery;
		}
		else{
			$updtQuery = "Update cart set quantity = '$qty', totalPrice = '$price', updatedOn = now()
				where userId = '$userId' and itemId = (select itemId from items where itemName = '$itemName') and status='cart'";
		}
			
	
	
		$con->query($updtQuery);	
		
		if($con){
		
			updateItemQty($con,$itemName,$itemQty,$ops);
			loadCart($con,$userId);
		}else{
			echo "Failed to add item. Please try again.";
		}

	function updateItemQty($con,$itemName,$itemQty,$ops){
		if($ops == "plus"){
			$itemQty = $itemQty -1;
		}
		else if($ops == "minus"){
			$itemQty = $itemQty + 1;		
		}
		$getItemId = "SELECT itemId from items where itemName = '$itemName'";
		$result = $con->prepare($getItemId);
		$result->execute();
		$itemId = $result->fetchColumn();
		
			$query = "UPDATE items set itemQty = '$itemQty' where itemId = '$itemId'";
			$res = $con->prepare($query);
			$res->execute();
	}
	
	function loadCart($con,$userId){
			
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
				$totalPr = number_format($totalPrize, 2, '.', '');	
			echo "
			         <tr>
					<td colspan='2'> Total </td>
					<td class='total'>$totalPr</td>
				</tr>
				<tr>
					<td colspan='3'>
					  <button type='button' class='checkout btn btn-default'>Checkout</button>
					 </td>
				</tr>
			
			";
	}


?>