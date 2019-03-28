<?php
	
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$userID =$_GET['userId'];
$getOrders = mysqli_query($conn,"select * from OrderAndRestaurantInfo where user_id='$userID' and order_status!='delivered' order by order_number DESC");	
	if (!$getOrders) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
while($row = mysqli_fetch_array($getOrders)){
	echo "<h3>Order num: ". $row['order_number']."</h3>";
	echo "Restaurant name: ". $row['restaurant_name']."</br>";
	echo "Bill amount: ". $row['total_price']."</br>";
	echo "Order status: ". $row['order_status']."</br>";
$or=$row['order_number'];
$getOrdersDetails = mysqli_query($conn,"select distinct item_name, quantity from Orders o join OrderDetails od on o.order_number=od.order_number join MenuItems m on od.item_id=m.item_id join Orders  where o.user_id='$userID' and od.order_number='$or'");	
	if (!$getOrdersDetails) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
	
	echo "<b>Order Details</b></br><table>";
while($row1 = mysqli_fetch_array($getOrdersDetails)){
	echo "<tr><td>"	;
	echo $row1['item_name'];
	echo "</td>";
	echo "<td>".$row1['quantity']."</tr>";
}
	echo "</table>";
	if($row['order_status']!='delivered'){	
		echo "</br><button onClick='window.location=\"http://localhost/instafood/cancelOrder.php?or=".$row['order_number']."\"'> Cancel Order </button> </br></br>";
}
}
?>