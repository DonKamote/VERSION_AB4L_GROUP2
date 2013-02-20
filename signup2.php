<?php
	$role = $_POST['signup_option'];
	$uname= $_POST['uname'];
	$pword= $_POST['pword'];
	$eadd= $_POST['eadd'];
	
	if($role=='doctor'){
			echo"
			<html>
			<head>
				<title>Sign Up - Doctor</title>
				<link rel='stylesheet' type='text/css' href='signup_doctor_css.css'/>
			</head>
			<body>
				<div id='wrapper'>
				<!--Sign Up Form-->
				<div id='form-content'>
				<form action='process_signup_doctor.php' method='post'>
				<table>
					<tr>
						<th>Username</th>
						<td><input type='text' name='uname' value='$uname' required='required'/></td>
					</tr>
					<tr>
						<th>Password</th>
						<td><input type='password' name='password' value='$pword' required='required'/></td>
					</tr>
					<tr>
						<th>E-mail Address</th>
						<td><input type='text' name='eadd' value='$eadd' required='required'/></td>
					</tr>
					<tr>
						<th>Name</th>
						<td><input type='text' name='lname' value='Last Name' required='required'/>
						<input type='text' name='fname' value='First Name' required='required'/>
						<input type='text' name='mname' value='Middle Name' required='required'/></td>
					</tr>
					<tr>
						<th>Specialization</th>
						<td><input type='text' name='specialization' required='required'></td>
					</tr>
					<tr>
						<th>Hospital</th>
						<td><input type='text' name='hospital' required='required'/></td>
					</tr>
					<tr>
						<th>Birthdate</th>
						<td><input type='date' name='bdate' required='required' /></td>
					</tr>
					<tr>
						<th>Contact Information</th>
						<td><input type='text' name='cinfo' required='required'/></td>
					</tr>
					<tr>
						<th>License No.:</th>
						<td><input type='text' name='licenseno' required='required'/></td>
					</tr>
				</table>
					<input id='submit_btn' type='submit'/>
				</form>
				</div>
			
			<!--Footer-->
			<div id='footer'></div>
			</div>
			</body>
			<html>";
	}
	
	if($role=='patient'){
		echo"
			<html>
			<head>
			<title>Healthcare System</title>
			<link rel='stylesheet' type='text/css' href='CSS/indexCSS.css'>
		
	
			</head>
	
			<body>
			<div id = 'userInfo'>
			<table>
			<form action='process_signup_patient.php' method='post'>
				
				<tr>
					<td> Username: </td>
					<td> <input type='text' name='username' value='$uname' required='required'> </td>
				</tr>
				<tr>
					<td> Password: </td>
					<td> <input type='password' name='password' value='$pword' required='required'> </td>
				</tr>
				<tr>
					<td> Email Address: </td>
					<td> <input type='text' name='eadd' value='$eadd' required='required'> </td>
				</tr>
				<tr>
					<td> Name: </td>
					<td> <input type='text' name='fName' value='First name' required='required'> </td>
					<td> <input type='text' name='mName' value='Middle name' required='required'> </td>
					<td> <input type='text' name='lName' value='Last name' required='required'> </td>
				</tr>
				<tr>
					<td> Sickness: </td>
					<td> <input type='text' name='sickness' value=''> </td>
				</tr>
				<tr>
					<td> Age: </td>
					<td> <input type='text' name='age' value=''> </td>
				</tr>
				<tr>
					<td> Birthdate: </td>
					<td><input type='date' name='bdate' required='required' /></td>
				</tr>
				<tr>
					<td> Gender: </td>
					<td>
						<select name='gender'>
							<option value='male'>Male</option>
							<option value='female'>Female</option>
						</select>
					</td>
				</tr>
				<tr>
					<td> Height: </td>
					<td> <input type='text' name='height' value='' required='required'> </td>
				</tr>
				<tr>
					<td> Weight: </td>
					<td> <input type='text' name='weight' value='' required='required'> </td>
				</tr>
				<tr>
					<td> Status: </td>
					<td><select name='status'>
							<option value='single'>Single</option>
							<option value='married'>Married</option>
							<option value='widowed'>Widowed</option>
						</select>
					</td>
				</tr>
				<tr>
					<td> Address: </td>
					<td> <input type='text' name='address' value='' required='required'> </td>
				</tr>
				<tr>
				
				<tr>
					<td> Contact Information: </td>
					<td> <input type='text' name='contactNum' value='' required='required'> </td>
				</tr>
				<input type='submit' name='submit'/> </td>
			</form>
			</table>
			
		</div>
	
</body>


</html>
		
		";
	}
?>