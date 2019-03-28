<?php

$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

if(isset($_POST['reg_user']))
{
	//signup();

	if(!empty($_POST['user_id']))
    {
		$query = "SELECT * FROM UserAccount WHERE user_id = '$_POST[user_id]'";
		$result = $conn -> query($query);
		if($result->num_rows == 0)
		{ 
			//Newuser();
			//echo "hello";
			  $user_id = $_POST['user_id'];
				$firstname = $_POST['fname'];
				$lastname = $_POST['lname'];
				$middlename = $_POST['mname'];
			if ($middlename == "")
				{
					$middlename = null;
				}
			$al1 = $_POST['addressline_1'];
			$al2 = $_POST['addressline_2'];
			if ($al2 == "")
			{
				$al2 = null;
			}
			$city = $_POST['City'];
			$state = $_POST['State'];
			$zip_code = $_POST['zipcode'];
			$phone1 = $_POST['PhoneNumber1'];
			$phone2 = $_POST['PhoneNumber2'];
			if ($phone2 == "")
			{
				$phone2 = null;
			}
			$email = $_POST['email'];
			$password = $_POST['password'];
			
	
			$query1 = "INSERT INTO RegisteredUser(user_id,firstname,lastname,middlename,addressline1,addressline2,zip_code,phone_number1,phone_number2,email_id) VALUES('$user_id','$firstname','$lastname','$middlename','$al1','$al2','$zip_code','$phone1','$phone2','$email')";
			$query2 = "INSERT INTO UserAccount(user_id,password) VALUES ('$user_id','$password')";

$query3 = "INSERT INTO ZipCode (zipcode,city,state )VALUES ('$zip_code', '$city', '$state')";

mysqli_query($conn,$query3)	;

			if(mysqli_query($conn,$query1) and mysqli_query($conn,$query2))
			{
				//echo "YOUR REGISTRATION IS COMPLETED...";
					 $_SESSION['user_id'] = $user_id;
					$_SESSION['success'] = "You are now logged in";
					header('location: viewRestaurants.php?userId='.$user_id);

			}
			else
			{
				echo mysqli_error($conn);
			}

}
else
{
	echo "SORRY...YOU ARE ALREADY REGISTERED USER...";
}
}

}

if (isset($_POST['login_user']))
 {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    if (empty($user_id))
    {
      echo "Username required";
    }
    if (empty($password))
    {
      echo "Password required";
    }

  if (!empty($user_id) && !empty($password)) 
  {
    $query = "SELECT * FROM UserAccount WHERE user_id='$user_id' AND password='$password'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) == 1)
    {
      $_SESSION['username'] = $user_id;
      $_SESSION['success'] = "You are now logged in";
      header('location:viewRestaurants.php?userId='.$user_id);
    }
    else 
    {
      echo  "Wrong username/password combination";
    }
  }
}



?>