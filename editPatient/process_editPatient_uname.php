<?php
	session_start();
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	
	$username=$_SESSION["username"];
	$newuname=$_POST["newusername"];
	$olduname=$_POST["oldusername"];
	$i=0;
	
	$checkUname = "select patient_username from patient where patient_username='{$newuname}';";
		$resultCheck = pg_query($checkUname);
		
	while($myrow = pg_fetch_assoc($resultCheck)) {
			$i=$i+1;
	}
	
	if($newuname==$olduname) $i=0;
	
	if ($i>0) echo "Username already exists!";
	else{
		$query = "update patient set (patient_username)=('{$newuname}') where patient_username='{$olduname}';"; 
		$result = pg_query($query); 
				if (!$result) { 
					echo "Problem with query " . $query . "<br/>"; 
					echo pg_last_error(); 
					exit(); 
				} 
				else{
					$_SESSION["username"]=$newuname;
					echo "Username successfully edited.";
				}
	}
	pg_close($conn);
?>