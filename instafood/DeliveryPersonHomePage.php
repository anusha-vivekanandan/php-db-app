<?php
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dp_id =$_GET['dp_id'];

$sql = "select * from order_info where dp_id='$dp_id' group by order_number having order_status!='delivered'";

$orders = mysqli_query($conn,$sql);
if (!$orders) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$row1 = mysqli_fetch_array($orders);

echo "<div>";
echo "<h3> ORDERS </h3>";
echo "<b>Order No: </b>" . $row1['order_number'] .
"</br><b>Order_Status: </b>".$row1['order_status'].
"</br><b>Total Price: </b>".$row1['total_price']. 
"</br>";

echo "<h3> Customer Details</h3>";
if ($row1['addressline2'] == "")
{
echo "<b>Customer Name: </b>" . $row1['firstname'] .
"</br><b>Delivery Address: </b></br>".$row1['addressline1'].
"</br>".$row1['user_city'].
"</br>".$row1['user_state'].
"</br>".$row1['user_zipcode'].
"</br>Phone Number: ".$row1['phone_number1']. 
"</br>";
}
else
{
echo "<b>Customer Name: </b>" . $row1['firstname'] .
"</br><b>Delivery Address: </b></br>".$row1['addressline1'].
"</br>".$row1['addressline2'].
"</br>".$row1['user_city'].
"</br>".$row1['user_state'].
"</br>".$row1['user_zipcode'].
"</br>Phone Number: ".$row1['phone_number1']. 
"</br>";
}	
echo "<h3> Restaurant Details</h3>";
if ($row1['restaurant_address_line2'] == "")
{
echo "<b>Restaurant Name: </b>" . $row1['restaurant_name'] .
"</br><b>Address: </b></br>".$row1['restaurant_address_line1'].
"</br>".$row1['restaurant_city'].
"</br>".$row1['restaurant_state'].
"</br>".$row1['restaurant_zipcode'].
"</br>Phone Number: ".$row1['restaurant_phone_number1']. 
"</br>";
}
else
{
echo "<b>Restaurant Name: </b>" . $row1['restaurant_name'] .
"</br><b>Address: </b></br>".$row1['restaurant_address_line1'].
"</br>".$row1['restaurant_address_line2'].
"</br>".$row1['restaurant_city'].
"</br>".$row1['restaurant_state'].
"</br>".$row1['restaurant_zipcode'].
"</br>Phone Number: ".$row1['restaurant_phone_number1']. 
"</br>";
}

if(isset($_POST['status'])){
$status = $_POST['status'];
$order = $_POST['order'];
$sql = "UPDATE Orders set order_status='$status' where order_number='$order'";

if ($conn->query($sql) === TRUE) {
    echo "status updated successfully";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
mysqli_close($conn);

?>

<html>
<form method="POST" action="<?php $_PHP_SELF ?>">
    <legend><b><h2>Order Status</h2></b></legend>	
	<p><label for="Order"><b>Order number</b></label></p>
	<p><input type="text" name="order" value="" />  
	<p><label for="status"><b>Status</b></label></p>
	<p><input type="radio" name="status"
      value="order picked up" /> order picked up <input type="radio" name="status" value="on my way" /> on my way
      <input type="radio" name="status" value="delivered" /> delivered </p>
	
    <p><button type="submit"><b>Submit</b></button></p>

</form>
</html>
