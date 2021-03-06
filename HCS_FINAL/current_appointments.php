<?php
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
				
	$username = $_SESSION['username'];	
	$query = "SELECT app_doctorname, app_number, app_patientname, app_date, app_time, app_hospital, app_status FROM appointment WHERE app_doctorusername='$username' ORDER BY app_number";

	$result = pg_query($query);
				
	echo '<div class = "present_appointments">';
	echo "<b>Present Appointments</b>";
	echo '<table><tr>
	<tr>
	<th>App #</th>
	<th>Patient</th>
	<th>Date</th>
	<th>Time</th>
	<th>Hospital</th>
	<th>Status</th>
	<th>Manage</th>
	</tr>';

					$x = 1;
					while ($row = pg_fetch_row($result)) {
						if($row[6] == "Pending" || $row[6] == "Approved"){
							echo '<tr>';
							
							$count = count($row);
							for ($datacounter=0; $datacounter<$count; $datacounter++) {
								$c_row = current($row);
								if($datacounter > 0) {
									echo '<td>' . $c_row . '</td>';
								}
								if($datacounter == 1) {
									$tableID = $c_row;
								}
								if($datacounter == 6) {
									/*Checks if the request has been approved or still pending*/
									if($c_row == 'Pending') {
										$buttontoggler = 'P';
									}
									else {
										$buttontoggler = 'A';
									}
								}
								next($row);
							}
								
							/*Buttons*/
						if($buttontoggler == 'P') {
							echo '<td><form action="approve_apprequest.php" method="post">
							<input type="hidden" name="approveid" value="' . $tableID . '">
							<input type="submit" value="Approve" onclick="return confirm(\'Approve appointment?\');"/>
							</form>
							<form action="cancel_apprequest.php" method="post">
								<input type="hidden" name="cancelid" value="' . $tableID . '">
								<input type="submit" value="Reject" onclick="return confirm(\'Reject appointment?\');"/>
								</form>
							</td></tr>';
						}
						else {
							echo '<td>
							<form action="cancel_apprequest.php" method="post">';
								
							/*Get time difference in minutes*/
							$timestamp_query = pg_query("SELECT app_date, app_time FROM appointment WHERE app_number='$tableID'");
							$timestamp_array = pg_fetch_array($timestamp_query);
							$time_difference = check_time($timestamp_array[0], $timestamp_array[1]);
								
							/*If the time_difference is more than 24 hours*/
							if($time_difference <= 1440) {
							echo '<button type="button" onclick="alert(\'Cannot cancel appointment!\');">Cancel</button>';
						}
						else {
							echo '<input type="hidden" name="cancelid" value="' . $tableID . '">
							<button type="submit" onclick="return confirm(\'Cancel appointment?\');">Cancel</button>';
						}
								
					echo '</form></td></tr>';
				}
			
			}
		}
					
	echo '</table>';
	echo '</div>';
				
	echo '<br/>';
?>