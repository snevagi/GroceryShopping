<?php

	function connect_db(){
		$username = "root";
		$password = "";
		$dbName = "test";
		try{
			$con = new PDO("mysql:host=127.0.0.1;dbname=".$dbName, $username, $password);
			$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $ex) {
  			echo "<p>Sorry, a database error occurred. Please try again later.</p>";
  			exit;		
		}

		return $con;	
	}

?>