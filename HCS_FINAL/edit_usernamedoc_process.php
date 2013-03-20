<html>
	<head>
		<title>Editing Success</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
	</head>

	<body>
<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
			</ul>
			
			<ul class = "main_menu_right">
				<li> 
					<form name='searchpatient' action='search_doctor.php' method='post'>
					
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
							<option name="age">Age</option>
						</select>
						<input type='text' name='searchinput' />
						</form>
					</li>
				
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	</div>
	<div class="clearance"></div>
	<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
<?php
	session_start();
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	
	$username=$_SESSION["username"];
	$newuname=$_POST["newuname"];
	$olduname=$_POST["olduname"];
	$i=0;
	
	$checkUname = "select doctor_username from doctor where doctor_username='{$newuname}';";
		$resultCheck = pg_query($checkUname);
		
	while($myrow = pg_fetch_assoc($resultCheck)) {
			$i=$i+1;
	}
	
	if($newuname==$olduname) $i=0;
	
	if ($i>0){
		print '<script type="text/javascript">';
						echo "Username already exists.";

	}
	else{
		$query = "update doctor set (doctor_username)=('{$newuname}') where doctor_username='{$olduname}';"; 
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
</div>
</div>
</div>
</body>
</html>