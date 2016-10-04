<?php
	include 'db.php';
	session_start();
	$con = connect_db();
	
	
	$result = array();
	$errors = array();
	
	if(empty($_POST['firstName'])){
	  array_push($errors, "First Name is required");
	}else{
		$firstName = strip_tags($_POST['firstName']);

		if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
        	array_push($errors,"First Name - Only letters and white space allowed"); 
    	}
	}
	
	if(empty($_POST['lastName'])){
	  array_push($errors, "Last Name is required");
	}else{  
		$lastName = strip_tags($_POST{'lastName'});
		if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
        	array_push($errors,"Last Name - Only letters and white space allowed"); 
    	}	
	}


	if(empty($_POST{'email'})){
		array_push ($errors,"Email is required");
	}else{
		$email = strip_tags($_POST{'email'});
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      		array_push($errors,"Invalid email format");
    	}
	}

	if(empty($_POST{'passwd'})){
	  	array_push($errors, "Password is empty");
	}else{
		$password = $_POST{'passwd'};
		$password = password_hash($password,PASSWORD_DEFAULT);
	}

	
	if(!empty($errors)){
	  http_response_code(400);
	  array_push($result, $errors);
	  echo json_encode($result);
	  exit;
	}

	$query = "SELECT email from user where email = :email";
	$rows = $con->prepare($query);
	$rows->execute(array('email' => $email));
	
	$usr = 'user';
	if($rows->rowCount() == 0){
		$query = "Insert into user (firstName,lastName,email,passwd,role) values(:firstName,:lastName,:email,:password,:user)";
		$row = $con->prepare($query);
		$row->bindParam(':firstName',$firstName);
		$row->bindParam(':lastName',$lastName);
		$row->bindParam(':email',$email);
		$row->bindParam(':password',$password);
		$row->bindParam(':user',$usr);
		$row->execute();
		
		if($con){
		 
		   
		   $query = "SELECT userId from user where email = '$email'";
		   $res = $con->prepare($query);
		   $res->execute();

		   $last_id = $res->fetchColumn();	
		  
		   $user['role'] = 'user';
		   $user['firstName'] = $firstName;
	 	   $user['lastName'] = $lastName;
		   $user['userId'] = $last_id;
		   $user['email'] = $email;
		  
		   $_SESSION['user'] = $user;
		   array_push($result, "Account Successfully created");
		}else{
	 	   array_push($errors,  "Failed to create account. Please try again");
		}
	}
	else{
	  array_push($errors,  "Email already exist. Please try to sign In");
	}

	if(!empty($errors)){
	  http_response_code(400);
	  array_push($result, $errors);
	}

	echo json_encode($result);
	

?>