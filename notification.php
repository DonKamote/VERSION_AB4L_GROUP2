<?php

function send_notification($user,$receiver,$notif_type){
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	
	$result1 = pg_query($conn, "select count(notif_no) from notification_system");
	$notif_no = pg_fetch_array($result1);
	$notif_no[0] = $notif_no[0] + 1; 
	$query = "insert into notification_system values ('{$notif_no[0]}','{$user}','{$receiver}','{$notif_type}');";
	$result = pg_query($query); 
	
}

function display_notification($user){
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	echo "<div class = 'notification'>";
	echo "<table class = 'notif_table'>";
	
	$result1 = pg_query($conn, "select count(notif_no) from notification_system");
	$counter = pg_fetch_array($result1);
	
	$result1 = pg_query($conn, "select sender from notification_system");
	$result2 = pg_query($conn, "select notif_type from notification_system");
	$result3 = pg_query($conn, "select receiver from notification_system");
		
	$sender = pg_fetch_all_columns($result1);
	$type = pg_fetch_all_columns($result2);
	$receiver = pg_fetch_all_columns($result3);
	
	for($i = 0; $i<$counter[0]; $i++){
		
		if($receiver[$i] == $user){
		
			if($type[$i] == 1){
				echo "<tr><td>";
				echo $sender[$i]. " notification #1.";
				echo "</td></tr>";
			}
			else if($type[$i] == 2){
				echo "<tr><td>";
				echo $sender[$i]. " notification #2.";
				echo "</td></tr>";
			}
			else if ($type[$i] == 3){
				echo "<tr><td>";
				echo $sender[$i]. " notification #3.";
				echo "</td></tr>";
			}
			
		}
		//echo $receiver[$i];
	}
	
	echo "</table>";
	echo "</div>";
}


?>