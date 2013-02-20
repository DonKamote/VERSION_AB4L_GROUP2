<?php
	$doctor_username = $_POST['uname'];
	$doctor_password = $_POST['password'];
	$doctor_eadd = $_POST['eadd'];
	$doctor_lname = $_POST['lname'];
	$doctor_fname = $_POST['fname'];
	$doctor_mname = $_POST['mname'];
	$doctor_specialization = $_POST['specialization'];
	$doctor_hospital = $_POST['hospital'];
	$doctor_bdate = $_POST['bdate'];
	$doctor_cinfo = $_POST['cinfo'];
	$licenseno = $_POST['licenseno'];
	$doctor_rstatus='pending';
	$a=0;
	$ctr=0;
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	
	$queryCount="select doctor_username from doctor;";
	$resultCount=pg_query($queryCount);
	$queryCheck1 = "select doctor_username from doctor where doctor_username='{$doctor_username}';";
	$resultCheck1 = pg_query($queryCheck1);
	$queryCheck2 = "select patient_username from patient where patient_username='{$doctor_username}';";
	$resultCheck2 = pg_query($queryCheck2);
	
	while($myrow1 = pg_fetch_assoc($resultCheck1)) {
			$a=$a+1;
	}
	while($myrow2 = pg_fetch_assoc($resultCheck2)) {
			$a=$a+1;
	}
	
	
	while($myrow3=pg_fetch_assoc($resultCount)){
		$ctr=$ctr+1;
	}
	echo $ctr;
	if ($a==0){
		$query = "insert into doctor values
			('{$doctor_username}','{$doctor_password}','{$doctor_eadd}','{$doctor_lname}','{$doctor_fname}','{$doctor_mname}','{$doctor_specialization}','{$doctor_hospital}',
			'{$doctor_cinfo}','{$licenseno}','{$doctor_rstatus}','{$ctr}');";
			 
		$result = pg_query($query); 
				if (!$result) { 
					echo "Problem with query " . $query . "<br/>"; 
					echo pg_last_error(); 
					exit(); 
				} 
				else{
					echo "New doctor was added.";
				}
			
	}
	else {

			echo "Username already exists!";
		
	}
	pg_close($conn);	
	
?>