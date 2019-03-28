<html>
<body style="padding-left:50px">
<form method="POST" action="<?php $_PHP_SELF ?>">
  <div class="container">
    <h1>Add new Menu Item</h1>
    <hr>
	<label for="resId"><b>Restaurant ID : </b></label>
    <input type="text" placeholder="Enter Restaurant ID" name="resId" required>
</br>
</br>
    <label for="itemname"><b>Item Name : </b></label>
    <input type="text" placeholder="Enter Item Name" name="itemname" required>
</br>
</br>
    <label for="itemprice"><b>Item Price : </b></label>
    <input type="text" placeholder="Enter Item Price" name="itemprice" required>
</br>
</br>
    <hr>
    <button style="width:300px;" type="submit"><h4>Add</h4></button>
  </div>
</form>
</body>
</html>

<?php
if(isset($_POST['resId'])){

$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$restaurantid = $_POST['resId'];
$itemname = $_POST['itemname'];
$itemprice = $_POST['itemprice'];

$sql = "INSERT INTO MenuItems (restaurant_id,item_name,item_price)
VALUES ('$restaurantid', '$itemname', '$itemprice')";

if ($conn->query($sql) === TRUE) {
    echo "New MenuItem added successfully";
	header('location: adminHomepage.php');

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>