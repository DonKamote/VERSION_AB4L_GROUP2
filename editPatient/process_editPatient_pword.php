<?php
	session_start();
	
	$username=$_SESSION["username"];
	$password=$_SESSION["password"];
	$old=$_POST["oldpassword"];
	$new=$_POST["newpassword"];
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	if ($old!=$password){
		echo "You have entered an incorrect password.";
	}
	else{
		$query = "update patient set (patient_password)=('{$new}') where patient_username='{$username}';"; 
		$result = pg_query($query); 
				if (!$result) { 
					echo "Problem with query " . $query . "<br/>"; 
					echo pg_last_error(); 
					exit(); 
				} 
				else{
					$_SESSION["password"]=$new;
					echo "Password successfully edited.";
				}
	}

	pg_close($conn);
	
?>