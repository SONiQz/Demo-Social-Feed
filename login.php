<?php
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>
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
		$rows = mysqli_num_rows($result);
       	
		$levelquery = "SELECT userLevel from `users` where userName='$username'";
       	$levelresult = mysqli_query($con,$levelquery);
		$levelrow = mysqli_fetch_array($levelresult);
		$levelrow = $levelrow[0];
		
		if($rows==1){
			$_SESSION['username'] = $username;
			if($levelrow=="1"){
				echo "<div class='form'><h3> $levelrow - User is correct</a></div>";
				header("Location: index.php");
				exit();
			} if($levelrow=="2451"){
				echo "<div class='form'><h3> $levelrow - Admin is correct</a></div>";
				header("Location: admin.php");
				exit();
			} else {
				echo "<div class='form'><h3> $levelrow - U NO COME IN!</h3>";
				}
				
            }else{
				echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				exit();
			}
    }else{
?>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>

<?php } ?>
</body>
</html>
