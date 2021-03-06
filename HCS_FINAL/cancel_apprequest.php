<?php
	include('notification.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	
	$cancel = $_POST['cancelid'];
	$username = $_SESSION['username'];
	
	/*Get status of appointment to be cancelled*/
	$appstatus_query = pg_query("SELECT app_status FROM appointment WHERE app_number='$cancel'");
	$appstatus_array = pg_fetch_array($appstatus_query);
	
	/*Get the user who will be receiving the cancel notification
	  Assume for now that the sender will be the patient*/
	$receiver_query = pg_query("SELECT app_doctorusername FROM appointment WHERE app_number='$cancel'");
	$receiver_array = pg_fetch_array($receiver_query);
	
	/*If the appointment is already approved...*/
	if($appstatus_array[0] == 'Approved') {
		/*If the supposed sender is actually the doctor, modify*/
		if($receiver_array[0] == $username) {
			$receiver_query = pg_query("SELECT app_patientusername FROM appointment WHERE app_number='$cancel'");
			$receiver_array = pg_fetch_array($receiver_query);
		}
		pg_close($conn);
		
		send_notification($username, $receiver_array[0], 2);
	}
	else if($appstatus_array[0] == 'Pending') {
		/*If the supposed sender is actually the doctor, modify*/
		pg_close($conn);
		
		send_notification($username, $receiver_array[0], 4);
	}
	/*... or if the user is a doctor and he/she rejects and appointment*/
	else if($receiver_array[0] == $username) {
		$receiver_query = pg_query("SELECT app_patientusername FROM appointment WHERE app_number='$cancel'");
		$receiver_array = pg_fetch_array($receiver_query);
		pg_close($conn);
		
		send_notification($username, $receiver_array[0], 2);		
	}
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	$delete_query = "DELETE FROM appointment WHERE app_number='$cancel'"; 
	$delete_result = pg_query($delete_query);

	pg_close($conn);
?>