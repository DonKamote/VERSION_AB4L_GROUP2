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
		<div id = "profilePic">
			<img src = "sample.png" height = "200" width = "200"/>
		</div>
		
		<div id = "topControls">
			<ul class = "controlsA">
				<form name='searchdoctor' action='search_patient.php' method='post'>
					<li> 
						Search by: 
						<select name="searchtype" id = "option">
							<option name="specialty">Specialty</option>
							<option name="name">Name</option>
							<option name="hospital">Hospital</option>
						</select>
						<input type='text' name='searchinput'> </a>
					</li>
				</form>
				<li> <a href = "dboardPatient.php"> Notifications </a> </li>
				<li> <a href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
		
		<div class="headbanner"></div>
		
		<div id = "pageControls">
			<ul class = "controlsB">
				<li><a href = "dboardPatient.php">Dashboard</a></li>
				<li><a href = "#">Profile</a></li>
				<li><a href = "appointments_patient.php">Appointment</a></li>
				<li><a href = "#">Search</a></li>
				<li><a href = "#">Settings</a></li>
			</ul>
		</div>
		
		<div id = "main">
			<?php
				$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
				
				$query = 'SELECT doctor_username, doctor_lname, doctor_fname, doctor_mname, doctor_specialization FROM doctor ORDER BY doctor_lname';

				$result = pg_query($query);
				echo '<form action="request_page_date.php" method="post">
						<table>
						<tr>
							<th>Doctor Name</th>
							<th>Specialization</th>
							<th>Request</th>
						</tr>';
					
				while ($row = pg_fetch_row($result)) {
					$count = count($row);
					$doctor_name = "";
					$doctor_special = "";
					for ($datacounter=0; $datacounter<$count; $datacounter++) {
						$c_row = current($row);
						if($datacounter==0) {
							/*Doctor's username*/
							$doctor_user = $c_row;
						}
						else {
							if ($datacounter == $count-1) {
								/*Doctor's specialization*/
								$doctor_special = $c_row;
							}
							else {
								/*Doctor's name*/
								$doctor_name = $doctor_name . $c_row;
								if ($datacounter == 1) {
									$doctor_name = $doctor_name . ",";
								}
								$doctor_name = $doctor_name . " ";
							}
						}
						next($row);
					}
					
					echo '<tr>
							<td>' . $doctor_name . '</td>
							<td>' . $doctor_special . '</td>
							<td><center><input type="submit" name="doctor_user" value="' . $doctor_user . '"/></center></td>
						</tr>';
				}
				echo '</table></form>';
					
				pg_close($conn);
			?>
			<a href="appointments_patient.php">< Cancel</a>
		</div>
	</body>
</html>