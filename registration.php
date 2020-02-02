
<?php
//Detect the current session

session_start();
$MainContent ="";



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
date_default_timezone_set('Asia/Singapore');
$activestatus = 1;
$dateentered = date('Y/m/d H:i:s');

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


else {
//Define the INSERT SQL statement
$qry = "INSERT INTO Shopper (name, birthdate, address, country, phone, email, password, pwdquestion, pwdanswer, activestatus, dateentered)
		VALUES ('$name', '$birthdate', '$address', '$country', '$phone', '$email', '$password', '$pwdquestion', '$pwdanswer', '$activestatus', '$dateentered')";
// Execute the SQL statement
$result = $conn->query($qry);

if ($result == true) { // SQL statement executed successfully
 	//Retrieve the shopper ID assigned to the new shopper // Line 39 to 45
	$qry = "SELECT LAST_INSERT_ID() AS ShopperID";
	$result = $conn->query($qry);
	//save the shopper ID in a session variable
	while ($row = $conn->fetch_array($result)){
		$_SESSION["ShopperID"] = $row["ShopperID"];
	} 
	//Display successful message and Shopper ID
	$MainContent .= "<h3 style='color:green'>Registration is Successfully!! </h3>";
	$MainContent .= "Your ShopperID is $_SESSION[ShopperID] <br/>";
	// Save the shopper Name in a session variable
	$_SESSION["ShopperName"] = $name;
}
else { // Display error message
	$MainContent .= "<h3 style='color:red'>Error in inserting record</h3>";
}

}
// Close database connection
$conn->close();
	
// Include the master template file for this page
include("MasterTemplate.php");


?>