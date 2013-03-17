<?php
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	include('view_schedule.php');
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
				<li> <a href = "dboardDoctor.php"> Notifications </a> </li>
				<li> <a href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
		
		<div class="headbanner"></div>
		
		<div id = "pageControls">
			<ul class = "controlsB">
				<li><a href = "dboardDoctor.php">Dashboard</a></li>
				<li><a href = "#">Profile</a></li>
				<li><a href = "appointments_doctor.php">Appointment</a></li>
				<li><a href = "#">Search</a></li>
				<li><a href = "#">Settings</a></li>
			</ul>
		</div>
		
		<div id = "main">
			<?php
				/*Display weekday scehduler*/
				echo 'Add/update weekday schedule:<br/>
						<form method="post" action="add_schedule.php">
							From <select name="sched_from">';
								$from_sched_array = array();
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
						echo '</select>
							To <select name="sched_to">';
								$to_sched_array = array();
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
						echo '</select>
							<input type="hidden" name="sched_type" value="Weekday"/>
							<input type="submit" value="Send Schedule"/>
						</form>';
						echo '<form method="post" action="remove_workschedule.php">
								<input type="hidden" name="sched_type" value="Weekday"/>
								<input type="submit" value="Reset Schedule"/>
						</form>';
						
				/*Display Saturday scehduler*/
				echo 'Add/update Saturday schedule:<br/>
						<form method="post" action="add_schedule.php">
							From <select name="sched_from">';
								$from_sched_array = array();
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
						echo '</select>
							To <select name="sched_to">';
								$to_sched_array = array();
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
						echo '</select>
							<input type="hidden" name="sched_type" value="Saturday"/>
							<input type="submit" value="Send Schedule"/>
						</form>';
						echo '<form method="post" action="remove_workschedule.php">
								<input type="hidden" name="sched_type" value="Saturday"/>
								<input type="submit" value="Reset Schedule"/>
						</form>';
						
				/*Display Sunday scehduler*/
				echo 'Add/update Sunday schedule:<br/>
						<form method="post" action="add_schedule.php">
							From <select name="sched_from">';
								$from_sched_array = array();
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
						echo '</select>
							To <select name="sched_to">';
								$to_sched_array = array();
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
						echo '</select>
							<input type="hidden" name="sched_type" value="Sunday"/>
							<input type="submit" value="Send Schedule"/>
						</form>';

						echo '<form method="post" action="remove_workschedule.php">
								<input type="hidden" name="sched_type" value="Sunday"/>
								<input type="submit" value="Reset Schedule"/>
						</form>';

			?>
			
			<!--Display table of weekly schedule of doctor//-->
			<table>
				<?php
					$username = $_SESSION['username'];
					$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');

					$counter = 0;
					for($i=0; $i<25 ;$i++) {
						echo '<tr>';
						
						for($j=0; $j<8; $j++) {
							echo '<td>';
							
							if($i == 0) {
								switch($j) {
									case 0:
										echo '';
										break;
									case 1:
										echo 'Monday';
										break;
									case 2:
										echo 'Tuesday';
										break;
									case 3:
										echo 'Wednesday';
										break;
									case 4:
										echo 'Thursday';
										break;
									case 5:
										echo 'Friday';
										break;
									case 6:
										echo 'Saturday';
										break;
									case 7:
										echo 'Sunday';
										break;
								}
							}
							else if($j == 0) {
								echo $counter . ':00';
								$counter += 1;
							}
							/*Weekday*/
							else if ($j!=0 && $j<6) {
								$sched_query = pg_query("SELECT doctor_sched_wday FROM doctor WHERE doctor_username='$username'");
								$sched_str = pg_result($sched_query, 0);
								$sched_array = explode(",", $sched_str);
								$count = count($sched_array);
								for($k=0; $k<($count-1); $k++) {
									if($counter-1 == $sched_array[$k]) {
										echo 'Available';
									}
								}
							}
							/*Saturday*/
							else if($j == 6) {
								$sched_query = pg_query("SELECT doctor_sched_sat FROM doctor WHERE doctor_username='$username'");
								$sched_str = pg_result($sched_query, 0);
								$sched_array = explode(",", $sched_str);
								$count = count($sched_array);
								for($k=0; $k<($count-1); $k++) {
									if($counter-1 == $sched_array[$k]) {
										echo 'Available';
									}
								}
							}
							/*Sunday*/
							else if($j == 7) {
								$sched_query = pg_query("SELECT doctor_sched_sun FROM doctor WHERE doctor_username='$username'");
								$sched_str = pg_result($sched_query, 0);
								$sched_array = explode(",", $sched_str);
								$count = count($sched_array);
								for($k=0; $k<($count-1); $k++) {
									if($counter-1 == $sched_array[$k]) {
										echo 'Available';
									}
								}
							}
							
							echo '</td>';
						}
						
						echo '</tr>';
					}

					pg_close($conn);
				?>
			</table>			
			<a href="dboardDoctor.php">< Back</a>
		</div>
	</body>
</html>