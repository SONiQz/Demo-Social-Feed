<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="../css/visuals.css"/>
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){

		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
		$userdate = date("Y-m-d H:i:s");
		$userLevel = 1;
		
        $query = "INSERT into `users` (userName, userPass, userEmail, userDate, userLevel) VALUES ('$username', md5('$password'), '$email', '$userdate','$userLevel')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='./login.php'>Login</a></div>";
        } else {
			echo "<div class='form'><h3>There has been an issue with your Registration</h3><br/>Click here to <a href='registration.php'>Try Again</a></div>";
		}
	}
?>
<center>
	CT4009-A002 Social Media Application<br>
	<img src="../images/generic-social-media.png" width=5% height=auto>
</center>
<div class="registrationform">
<center><h1>Registration</h1>
<form name="registration" action="" method="post">
	<input id="registrationinput" type="text" name="username" placeholder="Username" required /></br>
	<input id="registrationinput" type="email" name="email" placeholder="Email" required /></br>
	<input id="registrationinput" type="password" name="password" placeholder="Password" required /></br>
	<input type="submit" name="submit" value="Register" /></br>
</form>
<br>
<p>Already registered? <a href="../index.php">Try Logging In</a></p>
</center>
</body>
</html>
