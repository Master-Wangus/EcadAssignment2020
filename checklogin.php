<?php
// Detect the current session
session_start();
include ("mysql.php");
$MainContent = "";

// Reading inputs entered in previous page
$email = $_POST["email"];
$pwd = $_POST["password"];

// Create an onject for MySQL database access
$conn = new Mysql_Driver();
// Connect to the MySQL database
$conn ->connect();
// Define the SELECT SQL statement
$qry = "SELECT ShopperID, Name, Password from Shopper WHERE Email LIKE '$email'";
// Execute the SQL statement
$result = $conn->query($qry);
if ($conn->num_rows($result) > 0) {	
	while ($row = $conn->fetch_array($result)){
		//Save the Password in a session varaiable
		$_SESSION["Password"] = $row["Password"];
	// Display successful message and Shopper ID
	if ($_SESSION["Password"]==$pwd)
	{
		//Save the ShopperID in a session varaiable
		$_SESSION["ShopperID"] = $row["ShopperID"];
		//Save the Name in a session varaiable
		$_SESSION["ShopperName"] = $row["Name"];
		// To Do 2 (Practical 4): Get active shopping cart
		$sid = $_SESSION["ShopperID"];
		$qry = "SELECT * from shopcart WHERE ShopperID = $sid AND OrderPlaced = 0";
		$result = $conn->query($qry);
		if ($conn->num_rows($result) > 0) {	
		while ($row = $conn->fetch_array($result)){
			//Save the ShopCartID in a session varaiable
			$_SESSION["Cart"] = $row["ShopCartID"];
			$shid = $_SESSION["Cart"];
			}
			$qry = "SELECT * from shopcartitem WHERE ShopCartID = $shid";
			$result = $conn->query($qry);
			$_SESSION["NumCartItem"] = $conn->num_rows($result);
			}
		// Redirect to home page
		// Close database connection
		$conn->close();
		header("Location: index.php");
		exit;
	}
	else
	{
		$MainContent .= "<h3 style='color:red'>Wrong password!</h3>";
	}
}
}
else {//Display error message
$MainContent .= "<h3 style='color:red'>No such account!</h3>";
}
include("MasterTemplate.php");
?>