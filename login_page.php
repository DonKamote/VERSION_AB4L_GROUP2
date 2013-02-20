<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();

	if ($_SESSION['login']==1)
		header('Location: dBoardDoctor.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/login_page.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
			
			$(document).ready(function() {
				
				
				
				$('.placeholder, .placeholder').animate({ opacity: "1" })
					.click(function() {
						var thisFor	= $(this).attr('for');
						$('.'+thisFor).focus();
				});
			
				$('.signin-username').focus(function() {
				
					$('.placeholder').animate({ opacity: "0" }, "fast");
				
						if($(this).val() == "signin-username")
							$(this).val() == "";
		
					}).blur(function() {
				
						if($(this).val() == "") {
							$(this).val() == "signin-username";
							$('.placeholder').animate({ opacity: "0.4" }, "fast");
						}
					});
			
				$('.signin-password').focus(function() {
				
					$('.placeholder').animate({ opacity: "0" }, "fast");
				
						if($(this).val() == "signin-password") {
							$(this).val() == "";
						}
					}).blur(function() {
				
						if($(this).val() == "") {
							$(this).val() == "signin-password";
							$('.placeholder').animate({ opacity: "0.4" }, "fast");
						}
				});
			
				
			});
			
		</script>
<title>Health Care System</title>
</head>

<body>
	<div class="topbar">
    	<div class="global-nav">
        	<div>
				<ul class="nav">
                  <li class="home" data-global-action="t1home">
                      <a class="nav-logo-link" href="/" data-nav="front">
                        <i class="bird-topbar-blue"></i>
                      </a>
                  </li>
                </ul>
				
			</div>
        </div>
    </div>
    <div id="page-outer">
    	<div id="page-container" style="border: 1px">
			<div class="front-container" id="front-container">
				<div class="front-bg">
					<img class="front-image" src="img/nurse.png" />
				</div>
				
				<div class="front-card">
					<!--div class="front-welcome">
						<div class="front-welcome-text">
							<h1>Welcome to HCS</h1>
							<p>Connect to Doctors and Patiens around your region.</p>
						</div>
					</div-->
				
					<div class="front-signin">
                    	
						<form action="login.php" class="signin" method="post">
							<div class="username">
								<input type="text" id="signin-username" class="text-input" name="input_uname" title="Username or email"/>
								<label for="signin-username" class="placeholder">Username</label>
							</div>
							
							<table class="password-signin">
                            	
								<tbody>
									<tr>
										<td class="primary">
											<div class="password">
												<input type="password" id="signin-password" class="table-input" name="input_pword" title="Password">
												<label for="signin-password" class="placeholder">Password</label>									
											</div>
										</td>
										
										<td class="secondary">
											<button type="submit" class="signin-btn-primary">Sign in</button>
										</td>
									</tr>
								</tbody>
							</table>
							
						</form>
					</div>
					 <div class="front-signup">
						<h2>
							<strong>No account yet?</strong>
							Sign Up as
						<form action="signup2.php" class="signup" method="post">
							<select name="signup_option">
								<option value="doctor">Doctor</option>
								<option value="patient">Patient</option>
							</select>
						</h2>
						
						
							<div class="placeholding-input">
								<input type="text" id="signup-user-name" class="text-input" name="uname" value="">
								<label for="signup-user-name" class="placeholder">Username</label>
							</div>
							<div class="placeholding-input">
								<input type="text" id="signup-user-email" class="text-input" name="eadd" value="">
								<label for="signup-user-email" class="placeholder">Email</label>
							</div>
							<div class="placeholding-input">
								<input type="password" id="signup-user-password" class="text-input" name="pword" value="">
								<label for="signup-user-password" class="placeholder">Password</label>
							</div>
							<button type="submit" class="btn signup-btn">Sign up for HCS</button>
						</form>
						
					 </div>
						
					</div>
					<div class="footer">
						<ul>
							<li>Copyright 2013 Assault Droid Productions CMSC 128 AB-4L</li>
						</ul>
					</div>
					
					
					
				</div>
			</div>	
        </div>
    </div>

</body>
</html>
