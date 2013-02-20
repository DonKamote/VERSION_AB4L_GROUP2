<?php
	$i=0;
	$j=0;
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=12345');
	
	$query1 = "select doctor_username, doctor_email, doctor_lname, doctor_fname, doctor_mname, doctor_licenseno, doctor_rstatus from doctor;"; 
	$result1 = pg_query($query1);
	
	$query2 = "select patient_username, patient_eadd, patient_lname, patient_fname, patient_mname, patient_rstatus from patient;"; 
	$result2 = pg_query($query2);
	
	if (!$result1 || !$result2) { 
            echo "Problem with query " . $query . "<br/>"; 
            echo pg_last_error(); 
            exit(); 
    }
	echo"<form action='process_regrequest.php' method='post'>";
	echo "<center>";
	echo "<h1>LIST OF DOCTORS</h1>";
	echo "<table border='2'>";
	echo "<tr><td><b>Username</b></td><td><b>Email Add</b></td><td><b>Lastname</b></td><td><b>First Name</b></td><td><b>Middle Name</b></td><td><b>License No.</b></td><td span='2'><b>Registration Status</b></td></tr>";
	while($myrow1 = pg_fetch_assoc($result1)){
		echo "<tr>";
		echo "<td>".htmlspecialchars($myrow1['doctor_username'])."</td>";
		echo "<td>".htmlspecialchars($myrow1['doctor_email'])."</td>";
		echo "<td>".htmlspecialchars($myrow1['doctor_lname'])."</td>";
		echo "<td>".htmlspecialchars($myrow1['doctor_fname'])."</td>";
		echo "<td>".htmlspecialchars($myrow1['doctor_mname'])."</td>";
		echo "<td>".htmlspecialchars($myrow1['doctor_licenseno'])."</td>";
		echo "<td>".htmlspecialchars($myrow1['doctor_rstatus'])."</td>";
		$dname='dstat'. $i;
		if($myrow1['doctor_rstatus']=='pending'){
			echo "<td><input type='radio' name='$dname' value='approved'>Accept<br/>
						<input type='radio' name='$dname' value='disapproved'>Reject<br/>
						<input type='radio' name=$dname' value='pending'>Pending</td>";
		}
		else if($myrow1['doctor_rstatus']=='approved'){
			echo "<td><input type='radio' name=$dname' value='approved'></td>";
		}
		else{
			echo "<td><input type='radio' name=$dname' value='disapproved'></td>";
		}
		
		$i++;
	}
	echo "<input type='hidden' name='iVal' value='$i'>";
	echo"</table><br/>";
	echo "<h1>LIST OF PATIENTS</h1>";
	echo "<table border='2'>";
	echo "<tr><td><b>Username</b></td><td><b>Email Add</b></td><td><b>Lastname</b></td><td><b>First Name</b></td><td><b>Middle Name</b></td><td><b>Registration Status</b></td></tr>";
	while($myrow2 = pg_fetch_assoc($result2)){
		echo "<tr>";
		echo "<td>".htmlspecialchars($myrow2['patient_username'])."</td>";
		echo "<td>".htmlspecialchars($myrow2['patient_eadd'])."</td>";
		echo "<td>".htmlspecialchars($myrow2['patient_lname'])."</td>";
		echo "<td>".htmlspecialchars($myrow2['patient_fname'])."</td>";
		echo "<td>".htmlspecialchars($myrow2['patient_mname'])."</td>";
		echo "<td>".htmlspecialchars($myrow2['patient_rstatus'])."</td>";
		$pname='pstat'. $j;
		if($myrow2['patient_rstatus']=='pending'){
			echo "<td><input type='radio' name='$pname' value='approved'>Accept<br/>
						<input type='radio' name='$pname' value='disapproved'>Reject<br/>
						<input type='radio' name=$pname' value='pending'>Pending</td>";
		}
		else if($myrow2['patient_rstatus']=='approved'){
			echo "<td><input type='radio' name=$pname' value='approved'></td>";
		}
		else{
			echo "<td><input type='radio' name=$pname' value='disapproved'></td>";
		}
		$j++;
	}
	echo "<input type='hidden' name='jVal' value='$j'>";
	echo "</table>";
	echo "<br/><br/><input type='submit' name='submit' value='SAVE'/>";
	echo"</center>";
	echo"</form>";
	
	
	pg_close($conn);
?>