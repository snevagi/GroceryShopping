<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><b>SPS</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       <?php if($isLoggedIn && $role == 'admin'){ ?>
        <li>
	   <a href="admin.php">Admin Panel</a>
	</li>
	<?php }
	  if($isLoggedIn){
 	?>    
        <li><a href="order-history.php">Order History</a></li>
	<?php } ?>
      </ul>
      
      <form class="navbar-form navbar-left search" role="search"
        action="<?php $url ?>" >
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="q">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
        <script>
	  $(function(){
		var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

		for (i = 0; i < sURLVariables.length; i++) {
		    sParameterName = sURLVariables[i].split('=');
		    if (sParameterName[0] === sParam) {
		       return sParameterName[1] === undefined ? true : sParameterName[1];
		    }
		 }
		 };
		var q = decodeURIComponent(getUrlParameter('q')).replace(/\+/g,' ');
		if(q != 'undefined'){
		$('form.search input').val(q);
	    }
	    });
	</script>
      <ul class="nav navbar-nav navbar-right">
      <?php
	if($isLoggedIn){
	echo "
	  <li><a href='logout.php'>Logout</a></li>
	  <li  id='user-id' data-user-id='$id'><a href='#'>Welcome, $firstName $lastName</a></li>
	  ";
	}else{
	echo "
	 <li><a href='signUp.html'>Login / Sign Up</a></li>
	 <li><a href='#'>Welcome, Guest</a></li>
	 ";
	}
      ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>