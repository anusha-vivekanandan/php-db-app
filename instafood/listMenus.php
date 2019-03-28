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
if(isset($_GET['userId'])){
$userID =$_GET['userId'];
}
else{
$userID='';
}

$MenuItems = mysqli_query($conn,"SELECT * FROM MenuItems where restaurant_id='$resID'");
if (!$MenuItems) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

echo "<form method='POST' action='placeOrder.php?resID=$resID&userId=$userID'>";
echo "<table cellpadding='5' style='border: 1px solid black;border-collapse: collapse' >
<tr>
<th>Item name</th>
<th>Item price</th>";
if($userID!=''){
echo "<th>Order Quantity</th>";
}
echo "</tr>";

while($row = mysqli_fetch_array($MenuItems))
{
echo "<tr>";
echo "<td style='border: 1px solid black;'>" . $row['item_name'] . "</td>";
echo "<td style='border: 1px solid black;'>" . $row['item_price'] . "</td>";
if($userID!=''){
echo "<td style='border: 1px solid black;'><input type='number' min='0' name='" . $row['item_id'] . "' value='0'></td>";
}
echo "</tr>";
}
echo "</table></br></br></br>";
echo "<input type='hidden' value=$resID name='resID' id='resID'>";
if($userID!=''){
echo "<input type='hidden' value=$userID name='userId' id='userId'>";
echo "<button type='submit' value='PlaceOrder' name='PlaceOrder' id='PlaceOrder'>Place Order</button>";
}
echo "</form>";



mysqli_close($conn);
?>