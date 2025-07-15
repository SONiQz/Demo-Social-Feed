<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../css/visuals.css"/>
</head>
<body>
<!-- Load PHP to handle DB Connector
and then the controls for user authentication
processing the input from the "loginform" div-->
<?php
	require('db.php');
	session_start();
    if (isset($_POST['username'])){	
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
		//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE userName='$username' and userPass=md5('$password')";
		$result = mysqli_query($con,$query);
		$rowcount = mysqli_num_rows($result);
		$authrows = mysqli_fetch_array($result);
		$authid = $authrows[0];
		$authuser = $authrows[1];
		
		//Checking if user has is 'Admin' or 'User' access
		$levelquery = "SELECT userLevel from `users` where userName='$username'";
       	$levelresult = mysqli_query($con,$levelquery);
		$levelrow = mysqli_fetch_array($levelresult);
		$levelrow = $levelrow[0];
		
		//Granting User Access to Specific Page based on User Group
		if($rowcount==1){
			$_SESSION['username'] = $authuser;
			$_SESSION['authid'] = $authid;
			$_SESSION['groupid'] = $levelrow;
			if($levelrow==1){
				echo "<div class='form'><h3> $levelrow - User is correct</a></div>";
				header("Location: ../index.php");
				exit();
				
			} if($levelrow==2451){
				echo "<div class='form'><h3> $levelrow - Admin is correct</a></div>";
				header("Location: ./admin.php");
				exit();
			} else {
				echo "<div class='form'><h3> $levelrow - There Is An Issue With Your Credentials Please Contact Support!</h3>";
				}
				
            }else{
				echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				exit();
			}
    }else{
?>
<!-- Generate the HTML Output for the Login Page
Including the Login Form and Registration Link -->
<center>
	CT4009-A002 Social Media Application<br>
	<img src="../images/generic-social-media.png" width=5% height=auto>
</center>
<div class="loginform">
<center><h1>Log In</h1>
<form action="" method="post" name="login">
<input id=logininput type="text" name="username" placeholder="Username" required /></br>
<input id=logininput type="password" name="password" placeholder="Password" required /></br>
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
</center>
<?php } ?>
</body>
</html>
