<?php
require('./db.php');
require('./auth.php');

$usrquery = "SELECT * from `users`";
$usrresult = mysqli_query($con,$usrquery);
while ($usrarray[] = mysqli_fetch_object($usrresult));
	array_pop($usrarray);


if ($_SESSION['groupid'] != 2451){
	header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<head>
<title>Administration Portal</title>
<link rel="stylesheet" type="text/css" href="/CT4009 2020-21 002 1902834 28 May 2020/css/visuals.css"/>
</head>
<body>
<div class="form">
<p>Admin Dashboard</p>
	
<p><a href="../index.php">Home</a></p>
<a href="logout.php">Logout</a>
<form action="" method="post">
	<!-- Create Table to Display Form -->
	<table>
		<tr>
			<td colspan=2>
				<label for="userid">Select User:</label>
				<select name="userid">
					<?php 
						foreach ( $usrarray as $option ) :
					?>
    					<option value="<?php echo $option->userId; ?>"><?php echo $option->userName; ?></option>
     				<?php 
						endforeach; 
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="lowdate">From Date:</label>
				<input type="date" name="lowdate" />
			</td>
			<td>
				<label for="highdate">To Date:</label>
				<input type="date" name="highdate" />
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<input name="submit" type="submit" value="Search" />
			</td>
		</tr>

	</table>
</form>
	
</div>
<!-- PHP used to utilise form data in a MySQL/MariaDB query -->
<?php
	if (isset($_POST['userid'])){
		$userid=$_POST['userid'];
    	$lowdate=$_POST['lowdate'];
    	$highdate=$_POST['highdate'];

// Query to get Article Data for a specific user for a defined date range		
	require('db.php');
	$query = "SELECT date(a.articleDate) as date, count(*) as total FROM `article` a WHERE a.articleUser='$userid' and a.articleDate between '$lowdate 00:00:00' and '$highdate 23:59:59' group by date";
	$result = mysqli_query($con,$query);

//Query to identify username from returned query data.		
	$userquery = "SELECT userName from users where userId = '$userid'";
	$userresult = mysqli_query($con,$userquery);
	$userrow = mysqli_fetch_array($userresult)

	?>
<table>
	<tr>
<!-- Output from the above queries converted into a table -->
		<td colspan=2>
			<?php
				echo "Articles Created by ";
				echo $userrow[0];
				echo ", Between ";
				echo date('d/m/Y', strtotime($lowdate));
				echo " and ";
				echo date('d/m/Y', strtotime($highdate));
			?>
		</td>
	</tr>
	<tr>
		<th>Date</th>
		<th>Number of Articles</th>
	</tr>
	<?php
		
	while($row = mysqli_fetch_array($result)){
	$grandtotal = 0;
	
	?>
	<tr>
		<td>
			<?php
				
					echo date('d/m/Y', strtotime($row['date']));
			?>
		</td>
		<td>
			<?php
				echo $row['total'];
				if (is_numeric($row['total'])){
					$grandtotal+= (int)$row['total'];
				}
			};			
			?>
		</td>
	</tr>

	<tr>
		<th>
		Total Articles:
		</th>
		<td>
			<?php 
				echo $grandtotal
			
			?>
		</td>
	</tr>
		<?php
		};
	?>
</table>

</body>