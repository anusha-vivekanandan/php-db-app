<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Restaurants Login</h2>
  </div>
   
  <form method="post" action="restaurantslogin.php">
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="restaurant_id" >
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_restaurant">Login</button>
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


if (isset($_POST['login_restaurant']))
 {
    $restaurant_id = $_POST['restaurant_id'];
    $password = $_POST['password'];

    if (empty($restaurant_id))
    {
      echo "Username required";
    }
    if (empty($password))
    {
      echo "Password required";
    }

  if (!empty($restaurant_id) && !empty($password)) 
  {
    $query = "SELECT * FROM Restaurants WHERE restaurant_id='$restaurant_id' AND res_password='$password'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) == 1)
    {
      $_SESSION['username'] = $restaurant_id;
      $_SESSION['success'] = "You are now logged in";
      header('location:restaurantshomepage.php?resID='.$restaurant_id);
    }
    else 
    {
      echo  "Wrong username/password combination";
    }
  }
}
?>