<?php

	include 'db.php';
	$con = connect_db();
	
	$userId = $_POST['userId'];
		

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
					<td colspan='3'><button type='button' class='checkout btn btn-default'>Checkout</button></td>
				</tr>
		
			";


?>