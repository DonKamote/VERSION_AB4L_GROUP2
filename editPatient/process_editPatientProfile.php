<?php
	session_start();
	
	$username=$_SESSION["username"];
	$fname=$_POST["fName"];
	$mname=$_POST["mName"];
	$lname=$_POST["lName"];
	$sickness=$_POST["sickness"];
	$age=$_POST["age"];
	$birthdate=$_POST["bdate"];
	$gender=$_POST["gender"];
	$height=$_POST["height"];
	$weight=$_POST["weight"];
	$status=$_POST["status"];
	$address=$_POST["address"];
	$contactno=$_POST["contactNum"];
			
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	
	$query = "update patient set (patient_lname, patient_fname, patient_mname, patient_sickness, patient_age, patient_birthdate, patient_gender, patient_height, patient_weight, patient_status, patient_address, patient_contactno) = 
									('{$lname}','{$fname}','{$mname}','{$sickness}','{$age}','{$birthdate}', '{$gender}', '{$height}','{$weight}','{$status}','{$address}','{$contactno}')
				where patient_username='{$username}'";
				
	$result = pg_query($query); 
	if (!$result) { 
		echo "Problem with query " . $query . "<br/>"; 
		echo pg_last_error(); 
		exit(); 
	} 
	else{
		echo "Your profile information was successfully edited.";
	}
	
	pg_close($conn);
?>