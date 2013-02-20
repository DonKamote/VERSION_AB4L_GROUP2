<?php
	include('notification.php');
	session_start();
	if ($_SESSION['login']==0)
		header('Location: login_page.php');
	else if ($_SESSION["name"]!=NULL)
?>

<html>
<head>
	<title>Healthcare System</title>
	<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
		
	
</head>

<body>
	<div id = "profilePic">
		<img src = "sample.png" height = "200" width = "200"/>
	</div>
	
	<div id = "topControls">
		<ul class = "controlsA">
			<li> Search: <input type='text' name='search' value='input query'> </a> </li>
			<li> <a href = "notifications.php"> Notifications </a> </li>
			<li> <a href = "logout.php"> Log Out </a> </li>
		</ul>
	
	</div>
	
	<div id = "pageControls">
		<ul class = "controlsB">
			<li> <a href = "dboardDoctor.php"> Dashboard </a> </li>
			<li> <a href = "profile_doctor.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
			<li> <a href = "dboardDoctor.php"> Appointment </a> </li>
			<li> <a href = "dboardDoctor.php"> &nbsp;&nbsp;&nbsp;&nbsp;Search&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
			<li> <a href = "dboardDoctor.php"> &nbsp;&nbsp;Settings&nbsp;&nbsp;</a> </li>
		</ul>
	
	</div>
	
	<div id = "main">
		<?php
			echo "Welcome ".$_SESSION["name"]  ;
			display_notification($_SESSION["name"]);
		?>
		
		
		
	</div>
	
<body/>

</html>