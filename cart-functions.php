<?php 
session_start();

// Check if user logged in 
if (! isset($_SESSION["ShopperID"])) {
	// redirect to login page if the session variable shopperid is not set
	header ("Location: login.php");
	exit;
}

include("mysql.php");
$conn = new Mysql_Driver();
//For Basic Requirement 1
if (isset($_POST['actionA']))
{
	$conn->connect();
	// Check if a shopping cart exist, if not create a new shopping cart
	if(isset($_POST['actionA']))
	{
	if (!isset ($_SESSION["Cart"]))
	{
		//Create a shopping cart for the shopper
		$qry = "INSERT INTO shopcart(ShopperID) VALUES ($_SESSION[ShopperID])";
		$conn -> query($qry);
		$qry = "SELECT LAST_INSERT_ID() AS ShopCartID";
		$result = $conn -> query($qry);
		$row = $conn -> fetch_array($result);
		$_SESSION["Cart"] = $row["ShopCartID"];
	}

  	// If the ProductID exists in the shopping cart, 
  	// update the quantity, else add the item to the Shopping Cart.
	$pid = $_POST["product_id"];
	$quantity = $_POST["quantity"];
	$qry = "SELECT * from shopcartitem WHERE ShopCartID = $_SESSION[Cart] AND ProductID = $pid";
	$result = $conn ->query ($qry);
	$addNewItem = 0;
	if ($conn->num_rows($result) > 0)
	{
		$qry = "UPDATE shopcartitem SET Quantity = Quantity + $quantity
		        WHERE ShopCartID = $_SESSION[Cart] AND ProductID = $pid";
		$conn->query($qry);
	}
	else
	{
		$qry = "SELECT * FROM product WHERE ProductID=$pid";
		$result = $conn->query($qry);
		if($conn->num_rows($result)>0)
		{
		$row = $conn -> fetch_array($result);
		$offeredprice = $row["OfferedPrice"];
		$offerstart = new DateTime($row["OfferStartDate"]);
		$offerend = new DateTime($row["OfferEndDate"]);
		$today = new DateTime(Date("y-m-d"));
		if ($offerend>$today && $offerstart<$today)
		{
			$price = $row["OfferedPrice"];
		}
		else
		{
			$price = $row["Price"];
		}
		$productname = $row["ProductTitle"];
		$qry = "INSERT INTO shopcartitem(ShopCartID,ProductID, Price, Name, Quantity)
		        VALUES($_SESSION[Cart],$pid,$price,'$productname',$quantity)";
		$conn->query($qry);
		$addNewItem = 1;
		}
	}
  	$conn->close();
	
  	// Update session variable used for counting number of items in the shopping cart.
	recountTotalItemsInCart();
	calculateDeliveryCharge();
	// Redirect shopper to shopping cart page
	header("Location: shoppingCart.php");
	exit;
}
}
//For Basic Requirement 2
if (isset($_POST['actionU']))
{
	$cartid = $_SESSION["Cart"];
	$pid = $_POST["product_id"];
	$quantity = $_POST["quantity"];
	$conn->connect();
	$qry = "UPDATE ShopCartItem SET Quantity = $quantity WHERE ProductID=$pid AND ShopCartID = $cartid";
	$conn ->query($qry);
	$conn->close();
	recountTotalItemsInCart();
	calculateDeliveryCharge();
	header ("Location: shoppingCart.php");
	exit;
}
//For Basic Requirement 2.3
if (isset($_POST['actionR']))
{
	$cartid = $_SESSION["Cart"];
	$pid = $_POST["product_id"];
	$quantity = $_POST["quantity"];
	$conn->connect();
	$qry = "DELETE FROM shopcartitem WHERE ProductID=$pid AND ShopCartID = $cartid";
	$conn ->query($qry);
	$conn->close();
	recountTotalItemsInCart();
	calculateDeliveryCharge();
	header ("Location: shoppingCart.php");
	exit;
}		
//For Additional Requreiment 1
function calculateDeliveryCharge()
{
	global $conn;
	$conn->connect();
	$qry = "SELECT SUM(Price * Quantity) as SubTotal FROM shopcartitem WHERE ShopCartID=$_SESSION[Cart]";
	$result = $conn->query($qry);
	$row = $conn->fetch_array($result);
	if(number_format($row["SubTotal"],2)>=200)
	{
		$_SESSION["ShipCharge"] = 0;
	}
	else
	{
		$_SESSION["ShipCharge"] = 2.00;		
	}
	$qry = "UPDATE shopcart SET ShipCharge = $_SESSION[ShipCharge] WHERE ShopCartID=$_SESSION[Cart]";
	$conn ->query($qry);
	$conn->close();	
}
//For Additional Requreiment 2
function recountTotalItemsInCart()
{
	global $conn;
	$conn->connect();
	$qry = "SELECT SUM(Quantity) as Total FROM shopcartitem WHERE ShopCartID=$_SESSION[Cart]";
	$result = $conn->query($qry);
	$row = $conn->fetch_array($result);
	$conn->close();
	$_SESSION["NumCartItem"]=$row["Total"];
}

?>

