<?php
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	header('Location: ' . $_SERVER['HTTP_REFERER']);

	$username = $_SESSION['username'];
	$sched_from = $_POST['sched_from'];
	$sched_to = $_POST['sched_to'];
	$sched_type = $_POST['sched_type'];
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');	
		
	/*if($sched_type == "Saturday") {
		$time_query = pg_query("SELECT doctor_sched_sat FROM doctor WHERE doctor_username='$username'");
	}
	else if($sched_type == "Sunday") {
		$time_query = pg_query("SELECT doctor_sched_sun FROM doctor WHERE doctor_username='$username'");
	}
	else {
		$time_query = pg_query("SELECT doctor_sched_wday FROM doctor WHERE doctor_username='$username'");
	}
	
	$time_array = pg_fetch_array($time_query);*/
	$time_array = array();
	$sched_diff = abs($sched_to - $sched_from);
	for($i=0; $i<=$sched_diff; $i++) {
		$sched_str = ($sched_from + $i) . ':00,';
		$time_array[0] = $time_array[0] . $sched_str;
	}
	
	if($sched_type == "Saturday") {
		$query = "UPDATE doctor SET doctor_sched_sat='". $time_array[0] . "' WHERE doctor_username='$username'";
	}
	else if($sched_type == "Sunday") {
		$query = "UPDATE doctor SET doctor_sched_sun='". $time_array[0] . "' WHERE doctor_username='$username'";
	}
	else {
		$query = "UPDATE doctor SET doctor_sched_wday='". $time_array[0] . "' WHERE doctor_username='$username'";
	}
	
	$result = pg_query($query);
	
	pg_close($conn);
?>