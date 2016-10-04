
<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.php'; ?>
    <script src="js/admin.js"></script>
  </head>
  <body>
<header>
</header>
<?php
   include 'secure.php';
   if($role != 'admin'){
      
/* 
 * Redirect to a different page in the current directory that was requested 
 */
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
$protocol = isSecure() ? 'https' : 'http'; 

header("Location: $protocol://$host$uri/$extra");
exit;

 } ?> 
 <?php include 'navbar.php'; ?>
<div class='container-fluid'>
<div class="row">
  <div class="col-md-2">
    <?php include 'categories.php' ?>
  </div>
  <div class="col-md-8">
    <?php include 'listing-editable.php'?>  
  </div>
  <div class="col-md-2">
    <?php include 'add-item.php' ?>
  </div>
</div>
</div>
<footer>
</footer>
</body>
</html> 
