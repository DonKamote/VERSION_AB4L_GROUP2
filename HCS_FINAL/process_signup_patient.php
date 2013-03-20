<html>
<head>
	<title>Health Care System</title>
	
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
	</head>
</head>
	<body>
		<div id = "menu_container">
		<div id="menu_wrapper">
			<!--<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
			</ul>
			-->
			<ul class = "main_menu_right">
				<!--<li> 
					<form name='searchpatient' action='search_doctor.php' method='post'>
					
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
							<option name="age">Age</option>
						</select>
						<input type='text' name='searchinput' />
						</form>
					</li>-->
				
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Return to Home </a> </li>
			</ul>
		</div>
	</div>
	<div class="clearance"></div>
<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
<?php
	$patient_username = $_POST['username'];
	$patient_password = md5($_POST['password']);
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
	
	/*
	$doctor_username = str_ireplace(' ', '_', strtolower($rUname));
	$doctor_password = str_ireplace(' ', '_', strtolower($rPassword));
	$doctor_eadd = str_ireplace(' ', '_', strtolower($rEadd));
	$doctor_lname = str_ireplace(' ', '_', strtolower($rLname));
	$doctor_fname = str_ireplace(' ', '_', strtolower($rFname));
	$doctor_mname = str_ireplace(' ', '_', strtolower($rMname));
	$doctor_specialization = str_ireplace(' ', '_', strtolower($rSpecial));
	$doctor_hospital = str_ireplace(' ', '_', strtolower($rHospital));
	$doctor_bdate = str_ireplace(' ', '_', strtolower($rBdate));
	$doctor_cinfo = str_ireplace(' ', '_', strtolower($rCinfo));
	$licenseno = str_ireplace(' ', '_', strtolower($rLicense)); */
	
	$patient_username = str_ireplace(' ', '_', strtolower($patient_username));
	$patient_password = str_ireplace(' ', '_', strtolower($patient_password));
	$patient_eadd = str_ireplace(' ', '_', strtolower($patient_eadd));
	$patient_lname = str_ireplace(' ', '_', strtolower($patient_lname));
	$patient_fname = str_ireplace(' ', '_', strtolower($patient_fname));
	$patient_mname = str_ireplace(' ', '_', strtolower($patient_mname));
	$patient_sickness = str_ireplace(' ', '_', strtolower($patient_sickness));
	$patient_age = str_ireplace(' ', '_', strtolower($patient_age));
	$patient_bdate = str_ireplace(' ', '_', strtolower($patient_bdate));
	$patient_gender = str_ireplace(' ', '_', strtolower($patient_gender));
	$patient_height = str_ireplace(' ', '_', strtolower($patient_height));
	$patient_weight = str_ireplace(' ', '_', strtolower($patient_weight));
	$patient_status = str_ireplace(' ', '_', strtolower($patient_status));
	$patient_address = str_ireplace(' ', '_', strtolower($patient_address));
	$patient_contactnum = str_ireplace(' ', '_', strtolower($patient_contactnum));
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	
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
		$query = "insert into patient (patient_username, patient_password, patient_eadd, patient_lname, patient_fname, patient_mname, patient_sickness, patient_age, patient_birthdate, patient_gender, patient_height, patient_weight, patient_status, patient_address, patient_contactno, patient_rstatus) values
			('{$patient_username}','{$patient_password}','{$patient_eadd}','{$patient_lname}','{$patient_fname}','{$patient_mname}','{$patient_sickness}','{$patient_age}',
			'{$patient_bdate}','{$patient_gender}','{$patient_height}','{$patient_weight}','{$patient_status}','{$patient_address}','{$patient_contactnum}','{$patient_rstatus}');";
			 
		$result = pg_query($query); 
				if (!$result) { 
					echo "Problem with query " . $query . "<br/>"; 
					echo pg_last_error(); 
					exit(); 
				} 
				else{
					echo "Patient successfully added. <br/>";
					echo "Your account is currently pending. Please wait for the confirmation. Thank you.";
				}
			
	}
	else {

			echo "Username already exists!";
		
	}
	pg_close($conn);
	
?>
</div>
</div>
</div>
</body>
</html>