<?php
	session_start();
	if ($_SESSION['login']==0){

		$username = $_POST['input_uname'];
		$password = $_POST['input_pword'];
		$a=0;
		$b=0;
		$c=0;
		$d=0;
		
		$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		
		$resultCheck1=pg_query($conn, "select patient_username from patient where patient_username='{$username}' and patient_password!='{$password}'");
		$resultCheck2=pg_query($conn, "select patient_username from patient where patient_username='{$username}' and patient_password='{$password}'");
		$resultCheck3=pg_query($conn, "select doctor_username from doctor where doctor_username='{$username}' and doctor_password!='{$password}'");
		$resultCheck4=pg_query($conn, "select doctor_username from doctor where doctor_username='{$username}' and doctor_password='{$password}'");
		
		while($myrow = pg_fetch_assoc($resultCheck1)) {	//doctor username
			$a=$a+1;
		}
		while($myrow = pg_fetch_assoc($resultCheck2)) {	//doctor username and password
			$b=$b+1;
		}
		while($myrow = pg_fetch_assoc($resultCheck3)) {	//doctor username
			$c=$c+1;
		}
		while($myrow = pg_fetch_assoc($resultCheck4)) {	//doctor username and password
			$d=$d+1;
		}
		
		if (($a==0 && $b==0) && ($c==0 && $d==0)){
			echo "Username does not exist.";
		}else if($a!=0 && $c!=0){
			echo "Password did not match.";
		}else if($b!=0 || $d!=0){
			$_SESSION["login"] = 1;
			$result = pg_query($conn, "select patient_fname from patient where patient_username='{$username}'");
			$name = pg_fetch_row($result);
			$_SESSION["name"] = $name[0];
			header("Location: dboardDoctor.php");
			exit;
		}
		pg_close($conn);
	}
	else{
		header('Location: dBoardDoctor.php');
	}

?>