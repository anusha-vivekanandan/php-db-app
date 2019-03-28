<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Delivery Person Login</h2>
  </div>
   
  <form method="post" action="DeliveryPersonLogin.php">
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="dp_id" >
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
  </form>
</body>
</html>
<?php
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if (isset($_POST['login_user']))
 {
    $dp_id = $_POST['dp_id'];
    $password = $_POST['password'];

    if (empty($dp_id))
    {
      echo "Username required";
    }
    if (empty($password))
    {
      echo "Password required";
    }

  if (!empty($dp_id) && !empty($password)) 
  {
    $query = "SELECT * FROM DeliveryPerson WHERE dp_id='$dp_id' AND dp_password='$password'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) == 1)
    {
      $_SESSION['username'] = $dp_id;
      $_SESSION['success'] = "You are now logged in";
	  //$row = mysqli_fetch_array($query);
	  //$availability = $row['availability'];
	  //if ($availability == 0)
	  //{
		header('location:DeliveryPersonHomePage.php?dp_id='.$dp_id);
	  //}
	  //else
	  //{
		//  header('location:DeliveryPersonHomePage1.php?dp_id='.$dp_id);
	  //}
    }
    else 
    {
      echo  "Wrong username/password combination";
    }
  }
}
?>