<?php
	include('notification.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	
	$approve = $_POST['approveid'];
	$username = $_SESSION['username'];
	
	$receiver_query = pg_query("SELECT app_patientusername FROM appointment WHERE app_number='$approve'");
	$receiver_array = pg_fetch_array($receiver_query);
	
	pg_close($conn);
	send_notification($username, $receiver_array[0], 3);
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	$query = "UPDATE appointment SET app_status='Approved' WHERE app_number='$approve'";
	$result = pg_query($query);	
	pg_close($conn); 
?>