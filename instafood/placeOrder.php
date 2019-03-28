<?php
	
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$resID=$_POST['resID'];
$userID =$_POST['userId'];
$insertIntoOrders = mysqli_query($conn,"insert into Orders(user_id,restaurant_id,order_status) values ('$userID','$resID','Order placed')");
	if (!$insertIntoOrders) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
	$getOrderNumber = mysqli_query($conn,"select order_number from Orders where user_id='$userID' and restaurant_id='$resID' and order_status!='delivered' order by order_number DESC");	
	if (!$getOrderNumber) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
$MenuItems = mysqli_query($conn,"SELECT * FROM MenuItems where restaurant_id='$resID'");
if (!$MenuItems) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$total=0;	
$row1 = mysqli_fetch_array($getOrderNumber);
	$orderNum = $row1['order_number'];
	foreach ($_POST as $key => $value) {
        if($value!=null and $value!=0){
			$itemPrice = mysqli_query($conn,"SELECT item_price FROM MenuItems where restaurant_id='$resID' and item_id='$key'");
			while($row2 = mysqli_fetch_array($itemPrice))
			{			
			$price = $row2['item_price'];	
			$total = $total + ($price*$value);
			$insert = mysqli_query($conn,"insert into OrderDetails(order_number,item_id,quantity) values ('$orderNum','$key','$value')");
			}
		}
    };
	//Calling Stored Procedure total_price
	$total_price = mysqli_query($conn,"call total_price('$orderNum')");
	if (!$total_price) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
	echo "Order placed..!!";
echo "<html></br></br></br>";
echo "</br><button onClick='window.location=\"http://localhost/instafood/viewMyOrders.php?userId=".$userID."\"'> Manage Order </button>";
echo "</html>";
?>