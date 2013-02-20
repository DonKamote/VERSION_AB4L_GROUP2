<?php
	$patient_username = $_POST['username'];
	$patient_password = $_POST['password'];
	$patient_eadd = $_POST['eadd'];
	$patient_lname = $_POST['lName'];
	$patient_fname = $_POST['fName'];
	$patient_mname = $_POST['mName'];
	$patient_sickness = $_POST['sickness'];
	$patient_age = $_POST['age'];
	$patient_bdate = $_POST['bdate'];
	$patient_gender = $_POST['gender'];
	$patient_height = $_POST['height'];
	$patient_weight = $_POST['weight'];
	$patient_status = $_POST['status'];
	$patient_address = $_POST['address'];
	$patient_contactnum = $_POST['contactNum'];
	$patient_rstatus='pending';
	$a=0;
	$ctr=0;
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=12345');
	
	$queryCheck1 = "select patient_username from patient where patient_username='{$patient_username}';";
	$resultCheck1 = pg_query($queryCheck1);
	$queryCheck2 = "select doctor_username from doctor where doctor_username='{$patient_username}';";
	$resultCheck2 = pg_query($queryCheck2);
	
	while($myrow1 = pg_fetch_assoc($resultCheck1)) {
			$a=$a+1;
	}
	while($myrow2 = pg_fetch_assoc($resultCheck2)) {
			$a=$a+1;
	}
	
	if ($a==0){
		$query = "insert into patient values
			('{$patient_username}','{$patient_password}','{$patient_eadd}','{$patient_lname}','{$patient_fname}','{$patient_mname}','{$patient_sickness}','{$patient_age}',
			'{$patient_bdate}','{$patient_gender}','{$patient_height}','{$patient_weight}','{$patient_status}','{$patient_address}','{$patient_contactnum},'{$patient_rstatus}');";
			 
		$result = pg_query($query); 
				if (!$result) { 
					echo "Problem with query " . $query . "<br/>"; 
					echo pg_last_error(); 
					exit(); 
				} 
				else{
					echo "New patient was added.";
				}
			
	}
	else {

			echo "Username already exists!";
		
	}
	pg_close($conn);
	
?>