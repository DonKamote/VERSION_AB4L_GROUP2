<html>
<head>
	<title>Healthcare System</title>
	<link rel="stylesheet" type="text/css" href="css/dboardCSS.css" />
		
	
</head>

<body>
	<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
					<!--li> <a class="top_menu" href = "dboardDoctor.php"> &nbsp;&nbsp;Settings&nbsp;&nbsp;</a> </li-->
			</ul>
			
			<ul class = "main_menu_right">
				<li> 
					<form name='searchpatient' action='search_doctor.php' method='post'>
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
							<option name="age">Age</option>
						</select>
						<input class='search_bar' type='text' name='searchinput' />
					</form>
				</li>
				
				<!--li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li-->
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	
	</div>
	
	<div class="clearance"></div>
	
<div class="main_wrapper">
		<div class="content_wrapper">
<?php
	$input = $_GET['id'];	
	
	//connecting to database
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');

	if(isset($input)){	
		$resultCheck = pg_query($conn, "select * from patient where patient_username = '".$input."';");
	}
	
	$rows = pg_num_rows($resultCheck);
	
	for($j=0; $j<$rows; $j++){
		$tuple=pg_fetch_array($resultCheck);		 
		echo 'NAME: ', $tuple['patient_lname'],', ', $tuple['patient_fname'] ,' ', $tuple['patient_mname'], '<br />';	
		echo 'SICKNESS: ', $tuple['patient_sickness'], '<br />';	
		echo 'GENDER: ', $tuple['patient_gender'], '<br />';	
		echo 'ADDRESS: ', $tuple['patient_address'], '<br />';	
		echo 'AGE: ', $tuple['patient_age'], '<br />';	
		echo 'HEIGHT: ', $tuple['patient_height'], '<br />';	
		echo 'WEIGHT: ', $tuple['patient_weight'], '<br />';	
		echo 'BIRTHDATE: ', $tuple['patient_birthdate'], '<br />';	
		echo 'EMAIL ADDRESS:', $tuple['patient_eadd'], '<br />';	
		echo 'CONTACT NUMBER:', $tuple['patient_contactno'], '<br />';	
	}
?>
</div>
</div>

</body>

</html>