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
    $admin_id = $_POST['user_id'];
    $password = $_POST['password'];

    if (empty($admin_id))
    {
      echo "Username required";
    }
    if (empty($password))
    {
      echo "Password required";
    }

  if (!empty($admin_id) && !empty($password)) 
  {
    $query = "SELECT * FROM Admin WHERE admin_id='$admin_id' AND password='$password'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) == 1)
    {
      $_SESSION['username'] = $admin_id;
      $_SESSION['success'] = "You are now logged in";
      header('location:adminHomepage.php');
    }
    else 
    {
      echo  "Wrong username/password combination";
    }
  }
}
?>