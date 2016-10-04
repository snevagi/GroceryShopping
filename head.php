<?php session_start();

	$isLoggedIn = isset($_SESSION['user']) && !empty($_SESSION['user']);
        if($isLoggedIn){
                $firstName = $_SESSION['user']['firstName'];
		$lastName = $_SESSION['user']['lastName'];
		$role = $_SESSION['user']['role'];
                $id = $_SESSION['user']['userId'];
        }

	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) {
		return true;
		}

		return (substr($haystack, -$length) === $needle);
	}

	
	$uri = strtok($_SERVER["REQUEST_URI"],'?');
	$isAdmin = endsWith($uri, "admin.php");
	if($isAdmin){
		$url = "admin.php";
	}else{
		$url = "index.php";
	}
?>
<title>Online Grocery Shopping</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script
	 src="https://code.jquery.com/jquery-2.2.3.min.js"
	integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
	crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link rel="stylesheet" href="index1.css">
<script type="text/javascript" src="js/cart.js"></script>
<script type="text/javascript" src="js/history.js"></script>
