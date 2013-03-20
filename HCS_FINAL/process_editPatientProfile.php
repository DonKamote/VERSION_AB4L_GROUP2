<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">

	</head>
	
<body>
<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardPatient.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "patient_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_patient.php"> Appointment </a> </li>
					
			</ul>
			
			<ul class = "main_menu_right">
				<li> 
					<form name='searchpatient' action='search_doctor.php' method='post'>
					
						Search by: 
						<select name="searchtype" id = "option">
							<option name="specialty">Sickness</option>
							<option name="name">Name</option>
							<option name="hospital">Hospital</option>
						</select>
						<input class="searchbar"type='text' name='searchinput' />
						</form>
					</li>
				
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	</div>
	<div class="clearance"></div>
<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
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
</div>
</div>
</div>

</body>
</html>