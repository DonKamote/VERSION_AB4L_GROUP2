<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
	include('time_checker.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: index.php');
?>

<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">

	</head>
	<body>
		<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
					<li> <a class="top_menu" href = "dboardDoctor.php"> &nbsp;&nbsp;Settings&nbsp;&nbsp;</a> </li>
			</ul>
			
			<ul class = "main_menu_right">
				<form name='searchpatient' action='search_doctor.php' method='post'>
					<li> 
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
						</select>
						<input type='text' name='searchinput' />
					</li>
				</form>
				<li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li>
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	
	</div>
	<div class="clearance"></div>	
	<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
			<?php
				//connecting to database
				$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');

				$resultCheck = pg_query($conn, "select * from patient;");
				
				$rows = pg_num_rows($resultCheck);
				
				echo 'LIST OF PATIENTS <br/>';
				for($j=0; $j<$rows; $j++){
					$tuple=pg_fetch_array($resultCheck);
					echo '<a href = "records.php?id='.$tuple['patient_username'].'">', $tuple['patient_lname'],', ', $tuple['patient_fname'] ,' ', $tuple['patient_mname'], '</a> <br />';
				}
			?>
		</div>
	</div>
</body>
</html>