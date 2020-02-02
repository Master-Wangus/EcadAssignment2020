<?php

session_start();


$email = $_POST["email"];



//include the utility class file for MySQL database access
include("mysql.php");
//Create an object for MQL database access
$conn = new Mysql_Driver();
//Connect to the MYSQL database
$conn->connect();


$qry = "SELECT * FROM Shopper WHERE email = '$email'";
$result = $conn->query($qry);
if ($conn->num_rows($result) > 0) {
	$MainContent .= "<h3 style='color:red'>Sorry the email address you entered are invalid.Please try again!! </h3>";
}

else {
	
	$qry = "SELECT * FROM Shopper WHERE email = '$email'";
	// Execute the SQL statement
	$result = $conn->query($qry);
	

	if ($result == true) { // SQL statement executed successfully
	
	header("Location:Provide_QuestionNAnswer.php");
	exit;
	
	}
	else {
	
	$MainContent .= "<h3 style='color:green'>Error!! </h3>";
	
}

}

// Close database connection
$conn->close();


include("MasterTemplate.php"); 
?>