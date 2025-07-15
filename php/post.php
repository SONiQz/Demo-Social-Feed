<?php
require('db.php');
require('auth.php');

// Read Article ID so Article data can be read.
$identity=$_GET['id'];

// Calling the MySQL/MariaDB Connector
$articlequery = "SELECT * FROM `article` where articleId = $identity";
$articleresult = mysqli_query($con,$articlequery);
$articlerow = mysqli_fetch_array($articleresult);

if (!$articleresult) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

$postquery = "SELECT * FROM `posts` where postArticle = $identity";
$postresult = mysqli_query($con,$postquery);

if (!$postresult) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

// Function defining the variables for the form so PHP can be used to write values to the database.
if (isset($_POST['postcontent'])){
    $postContent=$_POST['postcontent'];
	$postUser=$_SESSION['authid'];
	
//	Insert Script for writing the collected form data to database.
    $query = "INSERT INTO `posts` (postContent, postDate, postArticle, postUser) VALUES('$postContent',NOW(),'$identity','$postUser')";
    $formresult = mysqli_query($con,$query);
	
//	Provide User Feedback on Success/Failure of Insert
	if($formresult){
	    echo "<div class='form'><h3>Your Post Has Been Submitted.</h3>";
		sleep(3);
		header("Location:" .$_SERVER['REQUEST_URI']);
    } else {
		echo "There Appears To Have Been An Error Writing This Data - Please Try Again Later";
		echo $query;
		
		}
	}
?>
<!-- Start of HTML/PHP Hybrid -->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Posts</title>
<link rel="stylesheet" type="text/css" href="/CT4009 2020-21 002 1902834 28 May 2020/css/visuals.css"/>
</head>
<body>
<?php
	include('./header.php');
?>
	
<!-- Displaying Aricle Data -->
<div class="post">
	<table>
		<tr>
			<th>Subject</th>
			<th>Created Date</th>
		</tr>
		<tr>
			<td>
<!-- Defining the Lat/Lng Values within divs for further use -->
				<div id="latitude" style="display:none;"> 
					<?php
						echo $articlerow['articleLat'];
					?>
				</div>
				<div id="longitude" style="display:none;">
					<?php
						echo $articlerow['articleLng'];
					?>
				</div>
				<?php
								
					echo $articlerow['articleSubject'];
				?>
			</td>
			<td>
				<?php
					echo $articlerow['articleDate'];
				?>
			</td>
		</tr>
		<tr>
			<th colspan=2>Details</th>
		</tr>
		<tr>
			<td colspan=2>
				<?php
					echo $articlerow['articleContent'];
				?>
			</td>
		</tr>

		<tr>
		
			<td colspan=2>
				<?php
				if (!empty ($articlerow['articleFile'])){
					echo "<img src='../image/";
					echo $articlerow['articleFile'];
					echo "' width='600'>";
				};
				?>
			</td>
		</tr>			

<!-- Only display Map if Location is defined -->		
		<?php
		if ($articlerow['articleLat'] != 0 && $articlerow['articleLng'] != 0){	
			echo "<tr>";
			echo "<th>Location Info</th>";
			echo "<th>Event Date/Time</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<td align=center>";
			echo "<div id='googleMap2'>";
			echo "<script src='../js/map.js'></script>";
			echo "<script src='https://maps.googleapis.com/maps/api/js?key=<insert key>&callback=postMap'></script>";
			echo "</div>";
			echo "</td>";
			echo "<td valign='top'>";
			echo "<div id='eventDateTime'>";
			echo "<b>Date: </b>";
			echo date('d/m/Y', strtotime($articlerow['articleEventDate']));
			echo "</br><b>Time: </b>";
			echo $articlerow['articleEventTime'];
			echo "</div>";
			echo "</td>";
			echo "</tr>";
				}
		?>
		</table>

<!-- Provde function to provide comments on an article -->
	<h3>Have a comment?</h3>

		<form name="post" action="" method="post">
			<table width=95%;>
				<tr>
					<td>
						<label for="postcontent">Comment:</label>
					</td>
					<td>
						<textarea cols="60" rows="6" name="postcontent" placeholder="..." required /></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						</br>
						<input name="submit" type="submit" value="Add" />
						<input name="cancel" type="button" value="Cancel" onclick=reset() />
					</td>
				</tr>
			</table>
	</form>
	
		<?php
			while($postrow = mysqli_fetch_array($postresult)){
		?>
	<table id="commentTable">
		<tr>
			<td>
				<b>Post Date: </b>
				<?php
					$postDate = $postrow['postDate'];
					echo date('d/m/Y H:i:s', strtotime($postDate));
				?>
			</td>
			<td>
				<b>Post User: </b>
				<?php
				$userId = $postrow['postUser'];
				$userquery = "SELECT userName FROM `users` WHERE userId='$userId'";
				$userresult = mysqli_query($con,$userquery);
				$userrow = mysqli_fetch_array($userresult);
				echo $userrow[0];
				?>
			</td>
		</tr>	
		<tr>
			<td colspan=2>
				<?php
					echo $postrow['postContent'];
				?>
			</td>
		</tr>
	</table>
	</br>
		<?php
			}
		?>
	
</div>
</body>
</html>
