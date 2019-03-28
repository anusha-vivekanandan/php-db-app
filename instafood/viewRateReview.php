<?php
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$resID=$_GET['resID'];
$rating = mysqli_query($conn,"SELECT * FROM RatingsReviews where restaurant_id='$resID'");

if (!$rating) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$conn1 = new mysqli($servername, $username, $password, $dbname);
$sql = "call calculate_avg('$resID')";
$avg_rating = mysqli_query($conn1,$sql);
if (!$avg_rating) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
echo "<div><h2>RATINGS AND REVIEWS</h2>";
while($row = mysqli_fetch_array($avg_rating))
{
	$out=$row['Average_Rating'];
	echo "<b>Average Rating:  </b>";
	echo $out;
	echo"</br>";
}
echo "</br>";

while($row = mysqli_fetch_array($rating))
{
echo "<div>";
$id=$row['user_id'];
$user = mysqli_query($conn,"SELECT * FROM RegisteredUser where user_id='$id'");
if (!$user) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$userrow = mysqli_fetch_array($user);
echo "<b>Reviewed by:  </b>" . $userrow['firstname'] ." ". $userrow['middlename'] ." ". $userrow['lastname'] . "</br>";
echo "<b>Rating:  </b>" . $row['rating'] . "</br>";
echo "<b>Review:  </b>" . $row['review'] . "</br>";
echo "</div></br></br>";
}
echo "</div>";
mysqli_close($conn);
mysqli_close($conn1);
?>