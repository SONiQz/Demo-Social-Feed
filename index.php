<?php
include("auth.php");
require("db.php");

$row="";

$query = "SELECT * FROM `article` order by articleId desc LIMIT 0,10";
$result = mysqli_query($con,$query);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

$catquery = "SELECT * from `categories`";
$catresult = mysqli_query($con,$catquery);
$catrow = mysqli_fetch_array($catresult);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CT4009-A002 Social Media Platform</title>	
</head>
<body>
<script>
function myMap() {
	var mapProp= {
  		center:new google.maps.LatLng(51.88736338693454, -2.0875431308738426),
  		zoom:17,
	};
	
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker;

function placeMarker(location) {
  if ( marker ) {
    marker.setPosition(location);
  } else {
    marker = new google.maps.Marker({
      position: location,
      map: map
    });
  }
}

google.maps.event.addListener(map, 'click', function(event) {
  placeMarker(event.latLng);
});
}
function submit(){
	document.getElementById('marker').value = marker;
	document.getElementById("form").submit();
}
</script>	
	
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p><a href="dashboard.php">Dashboard</a></p>
<a href="logout.php">Logout</a>
<h3>Have something to say?</h3>
<form id="form" action="" method="post" name="article">
<input type="text" name="subject" placeholder="..." required />
<input type="text" name="content" placeholder="..." required />
<select name ="category">
	<option value="<?php $catrow['categoryId']?>">
		<?php $catrow['categoryName']?>
	</option>
<input type='hidden' name='marker' id='marker'
</form>
<input name="submit" type="submit" value="Add" />
<div id="googleMap" style="max-width:60%;height:200px;"></div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq0j6Mo1A-WewY7mIXsuWeLbUmc71KMIg&callback=myMap"></script>
	
	
</div>	
<?php
while($row = mysqli_fetch_array($result)){
	echo "<div id='article'>";
	echo "<a href='post.php?$row[articleId]'>".$row['articleSubject']."</a>";
	echo "".$row['articleDate']."";
	echo "".$row['articleContent']."";
}
?>
	
<?php
$articleSubject = stripslashes($_REQUEST['subject']); // removes backslashes
$articleSubject = mysqli_real_escape_string($con,$articleSubject); //escapes special characters in a string
$articleContent = stripslashes($_REQUEST['content']);
$articleContent = mysqli_real_escape_string($con,$email);

$articleDate = date("Y-m-d H:i:s");
		
$query = "INSERT into `users` (userName, userPass, userEmail, userDate, userLevel) VALUES ('$username', md5('$password'), '$email', '$userdate','$userLevel')";
$result = mysqli_query($con,$query);
if($result){
	echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
}
?>
</body>
</html>
