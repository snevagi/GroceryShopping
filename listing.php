 <?php

	$con = connect_db();
	if(isset($_GET["q"]) && !empty($_GET["q"])){
		$q = strtolower(trim($_GET["q"]));
		$query = "SELECT * FROM items WHERE lower(itemName) like '%$q%' OR category IN (SELECT id FROM category WHERE  isDeleted = 0 AND lower(name) like '%$q%')";
	}	
	else{	
		$query = "SELECT * from items WHERE isDeleted = 0";
	}
	$rows = $con->prepare($query);
	$rows->execute();

	if($rows->rowCount() == 0){
	    echo "<h2> No items found :(</h2>";
	}

?>		
 
 <div class="row">
  <?php foreach($rows as $row){
		$itemId = $row['itemId'];
		$itemName = $row['itemName'];
		$price = $row['prize'];
		$category = $row['category'];
  ?>
   <div class='item col-md-3  <?php echo $category; ?> '>
   	 <div class="prod_box well">
	     <div class="product_img">
	     	  <a href="">
	     	 <?php echo  "<img src='images/$itemId.jpg' class='center' 
		  onError=\"this.onerror=null;this.src='images/default-1.jpg';\" 
		 >"; ?>
	     	   </a>
	      </div>
	      <div class="prod_price row">
	      	   <div class='col-md-8'>
	      	   <div class="product_title">
		      <a href=""><?php echo $itemName ?></a>
		   </div>
	              <span class="price"><?php echo $price ?></span>
		   </div>
		   
		   <div class='col-md-4'>
		    <?php echo "  <a href=\"\" class=\"cart\" id=\"$itemId\" title=\"Add to cart\">"; ?>
		      <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
		      </a> 
		 </div>
	      </div>
	</div>			
   </div>
  <?php } ?>
   
</div>