<?php 
// Detect the current session
session_start();
// Check if user logged in 
if (! isset($_SESSION["ShopperID"])) {
	// redirect to login page if the session variable shopperid is not set
	header ("Location: login.php");
	exit;
}

// Include the class file for database access
include("mysql.php");
$conn = new Mysql_Driver();
$conn->connect();

if (isset($_SESSION["Cart"])) {
	// Retrieve from database and display shopping cart in a table
	$qry = "SELECT shopcartitem.ProductID, Name, product.Price, 
	shopcartitem.Quantity, (shopcartitem.Price*shopcartitem.Quantity) AS Total, ProductImage, product.Quantity as productQuantity, Offered, OfferedPrice, OfferStartDate, OfferEndDate FROM ShopCartItem 
	INNER JOIN product ON shopcartitem.ProductID= product.ProductID WHERE ShopCartID = $_SESSION[Cart]";
	$result = $conn->query($qry);
	
	if ($conn->num_rows($result) > 0) {
		// the page header and header row of shopping cart page
		$MainContent = "<p class = 'page-title' style = 'text-align:center'>Shopping Cart</p>";
		$MainContent .= "<div class ='table-responsive'>";
		$MainContent .= "<table class = 'table table-hover' >";
		$MainContent .= "<thead class = 'cart-header'>";
		$MainContent .= "<tr>";
		$MainContent .= "<th width = '100px'>Products</th>";
		$MainContent .= "<th>&nbsp</th>";
		$MainContent .= "<th></th>";
		$MainContent .= "<th width = '60px'>Quantity</th>";
		$MainContent .= "<th width = '90px'>Price</th>";
		$MainContent .= "<th width = '60px'>Total</th>";
		$MainContent .= "</tr>";
		$MainContent .= "</thead>";
		
		
		// Declare an array to store the shopping cart items in session variable 
		$_SESSION["Items"]=array();
		// Display the shopping cart content
		$MainContent .= "<tbody>";
		while ($row = $conn -> fetch_array($result))
		{
		$MainContent .= "<tr>";
		$img = "./Images/products/$row[ProductImage]";
		$MainContent .= "<td><img src = '$img' alt='$row[Name]'style='width:120px;height:120px;'/></td>";
		$product = "productDetails.php?pid=$row[ProductID]";
		$productQuantity=$row["productQuantity"];
		$MainContent .= "<td><a href =$product>$row[Name]</a><div style='font-style:italic'>In stock:&nbsp$productQuantity&nbspleft</div></td>";
		$MainContent .= "<td><form action = 'cart-functions.php' method = 'post'>";
		$MainContent .= "<input type = 'hidden' name = 'actionR' value = 'remove'/>";
		$MainContent .= "<input type = 'hidden' name = 'product_id' value = '$row[ProductID]'/>";
		$MainContent .= "<button type ='submit' class='btn btn-info'>Remove</button>";
		$MainContent .= "</form></td>";
		$MainContent .= "<form action = 'cart-functions.php' method = 'post'>";
		$formattedPrice = number_format($row["Price"],2);
		$formattedTotal = number_format($row["Total"],2);
		$MainContent .= "<td>";
		$MainContent .= "<input type ='hidden' name = 'actionU' value ='update'/>";
		$MainContent .= "<input type = 'hidden' name = 'product_id' value = '$row[ProductID]'/>";
		$MainContent .= "<input type = 'number' name = 'quantity' style = 'width:40px' value = '$row[Quantity]' min ='1' max = '10' onchange='this.form.submit()' required/>";
		$MainContent .= "</td>";
		$MainContent .= "</form>";
		$offerstart = new DateTime($row["OfferStartDate"]);
		$offerend = new DateTime($row["OfferEndDate"]);
		$today = new DateTime(Date("y-m-d"));
		if ($offerend>$today && $offerstart<$today)
		{
			$formattedOfferedPrice = number_format($row["OfferedPrice"],2);
			$MainContent .= "<td><s>S$$formattedPrice</s>";
			$MainContent .= "<div>S$$formattedOfferedPrice</div></td>";
		}
		else
		{
			$MainContent .= "<td>S$$formattedPrice</td>";			
		}
		$MainContent .= "<td>S$$formattedTotal</td>";
		$MainContent .= "</tr>";
		
		
		
		    // Store the shopping cart items in session variable as an associate array
			$_SESSION["Items"][] = array("productId"=>$row["ProductID"],"name"=>$row["Name"],"price"=>$row["Price"],"quantity"=>$row["Quantity"]);
	}
	$MainContent .= "</tbody>";
	$MainContent .= "</table>";
	$MainContent .= "</div>";
		
		
		// Display the subtotal at the end of the shopping cart
		$qry = "SELECT SUM(Price * Quantity) as SubTotal FROM shopcartitem WHERE ShopCartID=$_SESSION[Cart]";
		$result = $conn->query($qry);
		$row = $conn->fetch_array($result);
		$_SESSION["SubTotal"] = round($row["SubTotal"],2);
		$MainContent .= "<p style = 'text-align:right'>SubTotal = S$". number_format($row["SubTotal"],2);
		$MainContent .= "<div style = 'text-align:right'>Shipping Fee = S$". number_format($_SESSION["ShipCharge"],2);
		
		
		// Add PayPal Checkout button on the shopping cart page
		$MainContent .="</div><form method = 'post' action = 'process.php'>";
		$MainContent .= "<input type='image' style ='float:right;' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif'>";
		$MainContent .="</form></p>";
}
	else {
		$MainContent = "<span style='font-weight:bold; color:red;'>
		                 Empty shopping cart!</span>";
	}
}
else {
	$MainContent = "<span style='font-weight:bold; color:red;'>
	                 Empty shopping cart!</span>";
}

$conn->close();
include("MasterTemplate.php"); 
?>
