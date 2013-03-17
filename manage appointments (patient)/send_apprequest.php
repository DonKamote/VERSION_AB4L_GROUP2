<?php
	include('notification.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	
	header('Location: appointments_patient.php');
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	
	$doctor_id = $_POST['doctor_user'];
	$doctor_query = pg_query("SELECT doctor_lname, doctor_fname, doctor_hospital FROM doctor WHERE doctor_username='$doctor_id'");
	$doctor_array = pg_fetch_array($doctor_query);
	$doctor_name = $doctor_array[0] . ", " . $doctor_array[1];

	$max_appnumber = pg_query("SELECT MAX(app_number) FROM appointment");
	$app_no = pg_fetch_array($max_appnumber);
	$app_no[0] = $app_no[0] + 1;
	
	$username = $_SESSION['username'];
	$patient_query = pg_query("SELECT patient_lname, patient_fname, patient_mname FROM patient WHERE patient_username='$username'");
	$patient_array = pg_fetch_array($patient_query);
	$patient_name = $patient_array[0] . ", " . $patient_array[1] . " " . $patient_array[2];
	
	$query = "INSERT INTO appointment (app_number, app_patientname, app_doctorname, app_time, app_date, app_hospital, app_status, app_patientusername, app_doctorusername)
			VALUES ('{$app_no[0]}', '{$patient_name}', '{$doctor_name}', '{$_POST['app_time']}', '{$_POST['app_date']}', '{$doctor_array[2]}', 'Pending', '{$username}', '{$doctor_id}')";
	$result = pg_query($query);

	pg_close($conn);

	send_notification($username, $doctor_id, 1);
?> 