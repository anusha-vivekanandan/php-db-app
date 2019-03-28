<html>
<body style="padding-left:50px">
<form method="POST" action="<?php $_PHP_SELF ?>">
  <div class="container">
    <h1>Remove Restaurant</h1>
    <hr>
    
</br>
    <label for="id"><b>Restaurant ID : </b></label>
    <input type="text" placeholder="Enter Restaurant ID" name="id" required>
</br>

    <hr>
    <button style="width:300px;" type="submit"><h4>Remove</h4></button>
  </div>
</form>
</body>
</html>

<?php
if(isset($_POST['id'])){
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id = $_POST['id'];

$sql = sprintf("DELETE FROM Restaurants WHERE restaurant_id = '".$id."'");

if ($conn->query($sql) === TRUE) {
    echo "Restaurants removed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?> 