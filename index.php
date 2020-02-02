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
$MainContent = "<div id='demo' class='carousel slide' data-ride'=carousel' >";
$MainContent .= "<div class='carousel-inner'>";
$rowcount = 0;
while ($row = $conn -> fetch_array($result))
{
	$rowcount++;
	$name = "$row[ProductTitle]";
	$img = "./Images/products/$row[ProductImage]";
	$product = "productDetails.php?pid=$row[ProductID]";
	$Quantity=$row["Quantity"];
	$formattedPrice = number_format($row["Price"],2);
	$offerend = new DateTime($row["OfferEndDate"]);
	$today = new DateTime(Date("y-m-d"));
	$daysleft = $today->diff($offerend)->days;
	$formattedOfferedPrice = number_format($row["OfferedPrice"],2);
	if($rowcount==1)
	{
		$MainContent .= "<div class='carousel-item active'>";
	}
	else
	{
		$MainContent .= "<div class='carousel-item'>";
	}
	$MainContent .= "<div class='image'><a href='$product'><img class='d-block mx-auto' src='$img' alt='$name'></a></div>";
	$MainContent .= "<div class='top'>
	<div class='text1'>Quick! Only $Quantity left! Offer ends in $daysleft days!</div></div>";
	$MainContent .= "<div class='middle'>
	<div class='text'>$name</div>
	<div class='text'><s>S$$formattedPrice</s></div>
	<div class='text'>S$$formattedOfferedPrice</div>
	</div>";
	$MainContent .= "</div>";
	}
	$MainContent .="</div>";
	$MainContent .= "<a class='carousel-control-prev' href='#demo' data-slide='prev'>";
	$MainContent .= "<span class='carousel-control-prev-icon'></span>";
	$MainContent .= "</a>";
	$MainContent .= "<a class='carousel-control-next' href='#demo' data-slide='next'>";
	$MainContent .= "<span class='carousel-control-next-icon'></span>";
	$MainContent .= "</a>";
	$MainContent .= "</div>";
}
include("MasterTemplate.php"); 

