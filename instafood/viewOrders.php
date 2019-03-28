<?php
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$dp = mysqli_query($conn,"SELECT * FROM  DeliveryPerson where availability='1'");
if (!$dp) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
echo "<div><h2>Avaialable DeliveryPersons</h2>";
while($row = mysqli_fetch_array($dp))
{
echo "<div>";
echo "<b>DeliveryPerson_id: </b>" . $row['dp_id'] .
"</br><b>FirstName: </b>".$row['first_name'].
"</br><b>MiddleName: </b>".$row['middle_name'].
"</br><b>LastName: </b>".$row['last_name'].
"</br><b>Avaialable: </b>".$row['availability']. 
"</br></br>";
echo "</div>";
}
echo "<div><h2>ORDERS</h2>";

$orders = mysqli_query($conn,"SELECT * FROM  Orders where order_status<>'delivered'");
if (!$orders) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$length = 0;
while($row = mysqli_fetch_array($orders))
{
		$length += 1;
}
//echo $length;
$arr = array();
$i = 0;
$orders1 = mysqli_query($conn,"SELECT * FROM  Orders where order_status<>'delivered'");

while($row = mysqli_fetch_array($orders1) and $i != $length)
{
echo "<div>";
echo "<b>Order No: </b>" . $row['order_number'] .
"</br><b>User_ID: </b>".$row['user_id'].
"</br><b>Restaurant_ID: </b>".$row['restaurant_id'].
"</br><b>Order_Status: </b>".$row['order_status'].
"</br><b>Total Price: </b>".$row['total_price']. 
"</br></br>";
if ($row['dp_id'] == null or $row['dp_id'] == "")
{
echo "
<form method=\"POST\">
<b>Enter DeliveryPerson_id: </b></br>
<input type='text' name='dp_id'></br>
<div style='padding-top:15px;'>
<input type='submit' name=$i onClick='clickhandler()'>
<script>
function clickhandler()
{
	alert(\"Assigned Successfully\");
}
</script>
</form>
</div>";
}

array_push($arr,$row['order_number']);
$i += 1;

}


$flag = true;
$i = 0;

while($flag)
{
	//echo "hello";
	if(isset($_POST[$i]))
	{
			$order = $arr[$i];
			$check = mysqli_query($conn,"select dp_id from Orders where order_number='$order'");
			$flag = false;
			$dp_id = $_POST['dp_id'];
			$dp_status = mysqli_query($conn,"UPDATE DeliveryPerson set availability='0' where dp_id='$dp_id'");
			$assign_dp = mysqli_query($conn,"UPDATE Orders set dp_id='$dp_id' where order_number='$order'");

				if (!$dp_status) {
					printf("Error: %s\n", mysqli_error($conn));
					exit();
				}
			 echo "<meta http-equiv='refresh' content='0'>";
		}
		else
		{
			$i += 1;
			if ($i==100){
				$flag=false;
			}
		}		
}
?>