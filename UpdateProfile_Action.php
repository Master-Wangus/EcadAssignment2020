
<?php
//Detect the current session

session_start();

$MainContent ="";

if (!isset ($_SESSION["ShopperID"])){
	// redirect to login page if the session variable shopperid is not set_error_handler
	header ("Location: login.php");
	exit;
}


if (isset($_SESSION["ShopperID"])){
	
	
//Read the data input from previous page
$name = $_POST["name"];
$birthdate = $_POST["birthdate"]; // Birthdate
$address = $_POST["address"];
$country = $_POST["country"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$password = $_POST["password"];
$pwdquestion = $_POST["pwdquestion"];
$pwdanswer = $_POST["pwdanswer"];
$shopperid = $_SESSION["ShopperID"];

//include the utility class file for MySQL database access
include("mysql.php");

//Create an object for MQL database access
$conn = new Mysql_Driver();
//Connect to the MYSQL database
$conn->connect();

$qry = "SELECT * FROM Shopper WHERE email = '$email'";
$result = $conn->query($qry);
if ($conn->num_rows($result) > 0) {
	$MainContent .= "<h3 style='color:red'>Sorry the email address has been used. Please use another email!! </h3>";
}

else{
	
//Define the UPDATE SQL statement
$qry = "UPDATE shopper SET Name='$name', Birthdate='$birthdate', Address='$address', Country='$country', Phone='$phone', Email='$email', Password='$password', PwdQuestion='$pwdquestion', PwdAnswer='$pwdanswer'
		WHERE ShopperID = $shopperid";
		
// Execute the SQL statement
$result = $conn->query($qry);

if ($result == true) {	// SQL statement executed successfully
		$MainContent .= "<h3 style='color:green'> Profile is successful updated!<br/>";
	}

else { // Display error message
	$MainContent .= "<h3 style='color:red'>Error in inserting record</h3>";
}

}

// Close database connection
$conn->close();

}

// Include the master template file for this page
include("MasterTemplate.php");

?>