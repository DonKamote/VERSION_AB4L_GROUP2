<?php
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
?>

<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
	</head>
	<body>
		<!--div id = "profilePic">
			<img src = "sample.png" height = "200" width = "200"/>
		</div-->
		
		
		
		
		
		<div id = "menu_container">
			<div id="menu_wrapper">
				<ul class = "main_menu_left">
					<li><a class="top_menu" href = "dboardPatient.php">Dashboard</a></li>
					<li><a class="top_menu" href = "patient_profile.php">Profile</a></li>
					<li><a class="top_menu" href = "appointments_patient.php">Appointment</a></li>
					<!--li><a class="top_menu" href = "#">Settings</a></li-->
				</ul>
				
				<ul class = "main_menu_right">
					
						<li> 
							<form name='searchdoctor' action='search_patient.php' method='post'>
							Search by: 
							<select name="searchtype" id = "option">
								<option name="specialty">Specialty</option>
								<option name="name">Name</option>
								<option name="hospital">Hospital</option>
							</select>
							<input class='search_bar' type='text' name='searchinput'> </a>
							</form>
						</li>
					
					<!--li> <a id="notification" class="top_menu_right" href = "dboardPatient.php"> Notifications </a> </li-->
					<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
				</ul>
			</div>
		</div>
		
	
		
		<div class="content_wrapper">
			<div class="content_main">
			<?php
				$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
				
				/*Display doctor's name and specialization*/
				$doctor_user = $_POST['doctor_user'];
				$doctor_query = pg_query("SELECT doctor_lname, doctor_fname, doctor_mname, doctor_specialization FROM doctor WHERE doctor_username='$doctor_user'");
				$doctor_result = pg_fetch_array($doctor_query);
				echo '<p>' . $doctor_result[0] . ', ' . $doctor_result[1] . ' ' . $doctor_result[2] .'<br/>(' . $doctor_result[3] . ')</p>';					

				/*Display date picker and 'Add Time' button*/
				echo '<form action="request_page_time.php" method="post">
						<input type="date" name="app_date" value="' . date('Y-m-d') . '" min="' . date('Y-m-d') . '"/>
						<input type="hidden" name="doctor_user" value="' . $doctor_user . '"/>
						<input type="submit" value="Add Time"/>
					</form>';

				pg_close($conn);
			?>
			<a href="request_patient.php">< Cancel</a>
			</div>
		</div>
	</body>
</html>