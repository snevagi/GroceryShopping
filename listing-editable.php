 <?php

	$con = connect_db();
	if(isset($_GET["q"]) && !empty($_GET["q"])){
		$q = strtolower(trim($_GET["q"]));
		$query = "SELECT * FROM items WHERE lower(itemName) like '%$q%' OR category IN (SELECT id FROM category WHERE isDeleted = 0 AND lower(name) like '%$q%')";
	}	
	else{	
		$query = "SELECT * FROM items WHERE isDeleted = 0";
	}
	$rows = $con->prepare($query);
	$rows->execute();

?>		
 
 <div class="row">
  <?php foreach($rows as $row){
		$itemId = $row['itemId'];
		$itemName = $row['itemName'];
		$price = $row['prize'];
		$itemQty = $row['itemQty'];
		$category = $row['category'];
		$cquery = "SELECT name FROM category WHERE id = $category";
		$crows = $con->prepare($cquery);
		$crows->execute();
 		foreach($crows as $crow){
		  $category = $crow['name'];
 	        }

   echo "		
   <div class='item col-md-3 $category'>
   	 <div class='prod_box well' data-item-id='$itemId'>
	     <div class='product_img'>
	     	     <img src='images/$itemId.jpg' class='center'
				 onError=\"this.onerror=null;this.src='images/default-1.jpg';\" >
	      </div>
	      <div class='prod_price row'>
	      	   <div class='col-md-9'>
	      	      <div class='product_title'>$itemName</div>
	              <span class='price'>$price</span> x <span class='itemQty'>$itemQty</span>
		   </div>
		   <div class='col-md-2'>
		    	<a href='#' class='edit' id='$itemId' title='Edit Item'>
  			  <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
		        </a>
			<a href='#' class='save hidden' title='Save Item'>
			<span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span>			
      		       </a>
		       	<a href='#' class='delete' title='Delete Item'>
			<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>			
      		       </a>		  
		 </div>
	      </div>
	      <div>
		 <span class='category'>$category</span>
	     </div>
	</div>			
   </div>
  ";
  } ?>
   
</div>