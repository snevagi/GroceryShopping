<?php

	include 'db.php';
	$con = connect_db();
	
	$query = "SELECT * from category";
			$rows = $con->prepare($query);
			$rows->execute();

?>		
	
<div class="table-responsive">
  <table class="table table-hover">
     <thead>
       <th>
         <h5><b>Categories</b></h5>
       </th>
     </thead>
     <tbody>
        <tr>
	
	     <td>
	      <a href="<?php echo $url; ?>">All Items</a>
	     </td>
	 </tr>  
       	
	<?php foreach($rows as $row){ ?>
	   <tr>
             <td>
	     <?php
		$cat = $row['name'];
		$urlCat = $url."?q=".urlencode($cat);
		$catId = $row['id'];
	       	echo "
	       	   <a href='$urlCat' class='select-category' data-cat-id='$catId'>$cat</a>	       ";
	       ?>  
	     </td>
       	   </tr>
	<?php }?>  
     </tbody>
  </table>
 </div>