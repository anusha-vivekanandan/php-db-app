<html>
<form method="POST" action="<?php $_PHP_SELF ?>">
    <legend><b><h2>Rate and Review the Restaurant</h2></b></legend>	
    <p><label for="rating"><b>Rating</b></label><input type="radio" name="rating"
      value="5" /> 5 <input type="radio" name="rating" value="4" /> 4
      <input type="radio" name="rating" value="3" /> 3 <input type="radio"
      name="rating" value="2" /> 2 <input type="radio" name="rating" value="1" /> 1</p>
	<p><b>Review</b></p>
    <p><textarea name="review" rows="8" cols="40">
       </textarea></p>
    <p><button type="submit"><b>Submit</b></button></p>

</form>
</html>
<?php
if(isset($_POST['rating'])){

$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$restaurant_id = $_GET['resID'];
$user_id= $_GET['userId'];
$rating = $_POST['rating'];
$review = $_POST['review'];

$sql = "INSERT INTO RatingsReviews (restaurant_id, user_id, rating, review) VALUES ('$restaurant_id', '$user_id', '$rating', '$review')";

if ($conn->query($sql) === TRUE) {
    echo "New rating added successfully";
	header('location: viewRestaurants.php?userId='.$user_id);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>
