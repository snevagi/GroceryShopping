<?php
	include 'db.php';
	session_start();
	$con = connect_db();
	
	if(empty($_POST{'email'})){
		echo "Email is required";
		return;
	}else{
		$email = $_POST{'email'};
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      		echo "Invalid email format"; 
      		return;
    	}
	}

	if(empty($_POST{'passwd'})){
	  	echo  "Password is empty";
	}else{
		$password = $_POST{'passwd'};
	}
	
	$query = "SELECT firstName,lastName,email,passwd,userId,role FROM user WHERE email = :email";
	$rows = $con->prepare($query);
	$rows->execute(array(":email" => $email));
	$result = array();
	if($rows->rowCount() != 1){
		http_response_code(404);
	     	$message = "No record found with entered email Id. Please sign Up";
		array_push($result, $message);
		echo json_encode($result);
		exit; 	
	}else{
		foreach($rows as $row){
		   $passwd = $row['passwd'];
		   $user['role'] = htmlentities($row['role']);
		   $user['firstName'] = htmlentities($row['firstName']);
	 	   $user['lastName'] = htmlentities($row['lastName']);
		   $user['userId'] = $row['userId'];
		   $user['email'] = $email;
		}
		
		if(password_verify($password,$passwd)){
		   $_SESSION['user'] = $user;
		}else{
		   http_response_code(404);
		   $message = "Invalid password. Please try again";
		   array_push($result, $message);
		   echo json_encode($result);
		   exit;
		}
	}	
	
?>