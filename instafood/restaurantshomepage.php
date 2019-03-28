
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
$orders = mysqli_query($conn,"SELECT * FROM Orders where restaurant_id='$resID'");
if (!$orders) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

echo "<div><h2>Order Details</h2>";
while($row = mysqli_fetch_array($orders))
{
echo "<div>";
$or=$row['order_number'];
$orderdetails=mysqli_query($conn,"select  m.item_name as item_name,od.item_id as item_id,od.quantity as quantity from OrderDetails od join Orders o on od.order_number=o.order_number join MenuItems m on m.item_id=od.item_id  where o.order_number='$or'") ;

if (!$orderdetails) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
	
}

echo "<b>Order Number:  </b>" . $row['order_number'] . "</br>";
echo "<b>User ID:  </b>" . $row['user_id'] . "</br>";
echo "<b>Order Status:  </b>" . $row['order_status'] . "</br>";
echo "<b>Delivery Person ID:  </b>" . $row['dp_id'] . "</br>";
echo "<b>Total Price:  </b>" . $row['total_price'] . "</br>";
while($row1 = mysqli_fetch_array($orderdetails))
{
echo "<b>Item name:  </b>" . $row1['item_name'] . "</br>";
echo "<b>Quantity:  </b>" . $row1['quantity'] . "</br>";
}
echo "</div></br></br>";
}
echo "</div>";
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
      value="order placed" /> order placed <input type="radio" name="status" value="preparing order" /> preparing order
      <input type="radio" name="status" value="order is with delivery person" /> order is with delivery person </p>
	
    <p><button type="submit"><b>Submit</b></button></p>

</form>
</html>

