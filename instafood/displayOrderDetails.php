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
$or =$_GET['or'];
$getOrdersDetails = mysqli_query($conn,"select item_name, quantity from OrderDetails od join MenuItems m on od.restaurant_id=o.restaurant_id where user_id='$userID' and order_status!='delivered' order by order_number DESC");	
	if (!$getOrdersDetails) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
while($row = mysqli_fetch_array($getOrdersDetails)){
	echo "<b>Order num: ". $row['order_number']."</b></br>";
	echo "Restaurant name: ". $row['restaurant_name']."</br>";
	echo "Bill amount: ". $row['total_price']."</br>";
	if($row['order_status']!='delivered'){	
		echo "</br><button onClick='window.location=\"http://localhost/instafood/viewMyOrders.php?userId=".$userID."\"'> Cancel Order </button> </br></br>";
}
	$or=$row['order_number'];
	echo "</br><button onClick='window.location=\"http://localhost/instafood/displayOrderDetails.php?userId=".$userID."&or=".$or."\"'> View Order Details </button> </br></br>";
}
?>