<form class='add-item' action="updateItems.php" method="POST">
      <legend>Add Item</legend>
      <div class="form-group">
      	   <label for="itemName">Item Name</label>
	   <input type="text" class="form-control" name="itemName"
	   	  pattern=".{3,}"   required title="3 characters minimum"
	   	  placeholder="Item Name">
      </div>
      <div class="form-group">
      	   <label for="price">Price</label>
	   <input type="number" min="0" step="0.01" class="form-control" name="price" placeholder="Price">
       </div>
        <div class="form-group">
      	   <label for="price">Quantity</label>
	   <input type="number" min="0" step="1" class="form-control" name="itemQty" placeholder="Quantity">
       </div>
       <div class="form-group">
      	   <label for="price">Category</label>
	   <select class="form-control" name="catId">
	   <?php
		$con = connect_db();
	
		$query = "SELECT * from category";
			$rows = $con->prepare($query);
			$rows->execute();
		foreach($rows as $row){
			$cat = $row['name'];
			$catId = $row['id'];
		 echo "<option value='$catId'>$cat</option>";
       	
		}

	    ?>		
       	    </select>
       </div>
       <div class="form-group">
       	    <button type="submit" class="btn btn-primary">Submit</button>
       </div>
     
</form>