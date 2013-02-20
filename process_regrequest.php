<?php
	$numD = $_POST['iVal'];
	$numP = $_POST['jVal'];
	for($i=0; $i<$numD; $i++){
		$doctor_rstatus[$i] = $_POST['dstat'. $i];
	}
	for($j=0; $j<$numP; $j++){
		$patient_rstatus[$j] = $_POST['pstat'. $j];
	}
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=12345');
		
	
	for($i=0; $i<$numD; $i++){
		$query1="update doctor set (doctor_rstatus)=('{$doctor_rstatus[$i]}') where doctor_id={$i};";
		$result1 = pg_query($query1);
	}
	
	for($j=0; $j<$numP; $j++){
		$query2="update patient set (patient_rstatus)=('{$patient_rstatus[$j]}') where patient_id={$j};";
		$result2 = pg_query($query2);
	}
	pg_close($conn);
?>