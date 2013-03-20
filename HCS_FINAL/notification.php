<?php
	function send_notification($user,$receiver,$notif_type){
		$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		$result1 = pg_query("SELECT MAX(notif_no) FROM notification_system");
		$notif_no = pg_fetch_array($result1);
		$notif_no[0] = $notif_no[0] + 1;
		$query = "INSERT INTO notification_system (notif_no, sender, receiver, notif_type)
				VALUES ('{$notif_no[0]}', '{$user}', '{$receiver}', '{$notif_type}')";
		$result = pg_query($query);

		pg_close($conn);
	}

	function display_notification($user){
		$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');

		echo "<div class = 'notification'>";
		echo "<table class = 'notif_table'>";
		
		$result1 = pg_query("SELECT count(notif_no) FROM notification_system");
		$counter = pg_fetch_array($result1);
		
		$result1 = pg_query("SELECT sender FROM notification_system");
		$result2 = pg_query("SELECT notif_type FROM notification_system");
		$result3 = pg_query("SELECT receiver FROM notification_system");
			
		$sender = pg_fetch_all_columns($result1);
		$type = pg_fetch_all_columns($result2);
		$receiver = pg_fetch_all_columns($result3);
		
		for($i = 0; $i<$counter[0]; $i++){			
			if($receiver[$i] == $user){
				if($type[$i] == 1){
					echo "<tr><td>";
					echo $sender[$i]. " has requested an appointment with you.";
					echo "</td></tr>";
				}
				else if($type[$i] == 2){
					echo "<tr><td>";
					echo $sender[$i]. " has canceled your approved appointment.";
					echo "</td></tr>";
				}
				else if ($type[$i] == 3){
					echo "<tr><td>";
					echo $sender[$i]. " has accepted your appointment request.";
					echo "</td></tr>";
				}
				else if ($type[$i] == 4){
					echo "<tr><td>";
					echo $sender[$i]. " has canceled a pending appointment request.";
					echo "</td></tr>";
				}
			}
		}
		
		echo "</table>";
		echo "</div>";

		pg_close($conn);
	}
?>