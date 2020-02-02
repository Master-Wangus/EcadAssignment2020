<?php 
// Detect the current session
session_start();
//Start SQL and obtain the products on sale
include("mysql.php");
$conn = new Mysql_Driver();
$conn->connect();
$qry = "SELECT * FROM product WHERE OfferStartDate < CURDATE() AND OfferEndDate> CURDATE()";
$result = $conn->query($qry);
	
if ($conn->num_rows($result) > 0) {
// the page header and header row of offer
$MainContent = "<p class = 'page-title' style = 'text-align:center'>On Offer!</p>";
$MainContent .= "<table class = 'table table-hover'>";
$MainContent .= "<thead class = 'cart-header'>";
$MainContent .= "<tr bgcolor='#FF8C00'>";
$MainContent .= "<th width = '100px'>Products</th>";
$MainContent .= "<th>&nbsp</th>";
$MainContent .= "<th></th>";
$MainContent .= "<th width = '90px'>Price</th>";
$MainContent .= "<th width = '140px'>Days Left!</th>";
$MainContent .= "</tr>";
$MainContent .= "</thead>";
// Display the shopping cart content
$MainContent .= "<tbody>";
while ($row = $conn -> fetch_array($result))
{
	$MainContent .= "<tr>";
	$img = "./Images/products/$row[ProductImage]";
	$MainContent .= "<td><img src = '$img' alt='$row[ProductTitle]'style='width:120px;height:120px;'/></td>";
	$product = "productDetails.php?pid=$row[ProductID]";
	$Quantity=$row["Quantity"];
	$MainContent .= "<td><a href =$product>$row[ProductTitle]</a><div style='font-style:italic'>In stock:&nbsp$Quantity&nbspleft</div></td>";
	$MainContent .= "<td>";
	$formattedPrice = number_format($row["Price"],2);
	$offerend = new DateTime($row["OfferEndDate"]);
	$today = new DateTime(Date("y-m-d"));
	$daysleft = $today->diff($offerend)->days;
	$formattedOfferedPrice = number_format($row["OfferedPrice"],2);
	$MainContent .= "<td><s>S$$formattedPrice</s>";
	$MainContent .= "<div>S$$formattedOfferedPrice</div></td>";
	$MainContent .= "<td>$daysleft</td>";
	$MainContent .= "</tr>";
	}
	$MainContent .= "</tbody>";
	$MainContent .= "</table>";
}

$MainContent .= "<img src='Images/baby.jpg'  
                     class='img-fluid' 
                     style='display:block; margin:auto;'/>";
include("MasterTemplate.php"); 
?>
