<?php

include 'db.php';
$con = connect_db();
	
	$userId = $_POST['userId'];	
		
		$query = "SELECT distinct(updatedOn) from cart where userId = '$userId' and status = 'checkedout' order by updatedOn desc;";  
		$rows = $con->prepare($query);
		$rows->execute();
		foreach($rows as $row){
			$updatedOn = $row['updatedOn'];
			
			$selectQuery = "SELECT * from cart c,items i where c.userId = '$userId' and c.status = 'checkedout' and c.updatedOn ='$updatedOn' and c.itemId = i.itemId";
			$res = $con->prepare($selectQuery);
			$res->execute();
			$time = strtotime('10/16/2003');
			$date = date($updatedOn,$time);
			echo "
			<h4>Ordered on: $date</h4>
			<table class=\"table\">
			<thead>
			<tr>
				<th>Item Name</th>
				<th>Quantity</th>
				<th>Price</th>
			</tr>
			</thead>
			<tbody>
			";
			foreach($res as $val){
				$itemName = $val['itemName'];
				$qty = $val['quantity'];
				$price = $val['totalPrice'];
				
		
			
			echo"<tr>
					<td>$itemName</td>
					<td>$qty</td>
					<td>$price</td>
				</tr>";
			}	
			$totalQuery = "SELECT sum(totalPrice)from cart where userId = '$userId' and status ='checkedout' and updatedOn ='$updatedOn'";
			$totalP = $con->prepare($totalQuery);
			$totalP->execute();

				$totalPrize = $totalP->fetchColumn();
				$totalPrize = number_format($totalPrize, 2, '.', '');
			
			echo "
			<tr>
				<td colspan='2'>Total</td>
				<td>$totalPrize</td>
			</tr></tbody>
			</table>
			";	
			
			
		
		}

?>