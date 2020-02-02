<?php 
// Detect the current session
session_start();


// HTML Form to collect search keyword and submit it to the same page 
// in server
$MainContent = "<div style='width:80%; margin:auto;'>"; // Container
$MainContent .= "<form name='frmSearch' method='get' action=''>";
$MainContent .= "<div class='form-group row'>"; // 1st row
$MainContent .= "<div class='col-sm-12 offset-sm-0'>";
$MainContent .= "<span class='page-title'>Product Search</span>";
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of 1st row
$MainContent .= "<div class='form-group row'>"; // 2nd row
$MainContent .= "<label for='keywords' 
                  class='col-sm-3 col-form-label'>Product Name /Description:</label>";
$MainContent .= "<div class='col-sm-6'>";
$MainContent .= "<input class='form-control' name='keywords' id='keywords' 
                  type='search' />";
$MainContent .= "</div>";
$MainContent .= "<div class='col-sm-3'>";
$MainContent .= "<button type='submit'>Search</button>";
$MainContent .= "</div>";
$MainContent .= "</div>";  // End of 2nd row


// $MainContent .= "</form>";
// $MainContent .= "<form name='filterSearch' method='get' action=''>";
// $MainContent .="<div class='col-sm-3'> ";
// $MainContent .="<select name='price' class='form-control'>";
// $MainContent .="<option value='0'>Select Price</option>";

// $MainContent .="</select>";
// $MainContent .="</form>";


// The search keyword is sent to server
if (isset($_GET['keywords'])) {
    $SearchText=$_GET["keywords"];
    // To Do (DIY): Retrieve list of product records with "ProductTitle" 
    // contains the keyword entered by shopper, and display them in a table. 
    // $search = $conn->real_escape_string($_GET['search']);
    include ('mysql.php');
    $conn = new Mysql_Driver();
    $conn  ->connect();
    //Query the database
    $qry ="SELECT ProductID, ProductTitle, ProductDesc FROM product WHERE ProductTitle LIKE '%$SearchText%' OR ProductDesc LIKE '%$SearchText%' ORDER BY ProductTitle";
    // if (isset($_GET['price'])) {
    //     $qry .="AND Price LIKE '$price'";
    // }
    // else if (isset($price)){
    //     $qry = "SELECT Price FROM product WHERE price LIKE '$price'";
    // }
    $result = $conn->query($qry);
    $MainContent .="<span style='font weight:bold;'>Search result for $SearchText:</span>";
    $MainContent .="<table>";

    if ($conn->num_rows($result) > 0){
        while ($row = $conn ->fetch_array($result)){
            $product ="productDetails.php?pid=$row[ProductID]";
            $MainContent .="<tr><td><a href='$product'>$row[ProductTitle]</a></td></tr>";
        }
    }
    else{
        $MainContent .="<tr><td>No Result Found.</td></tr>";
    }
    $MainContent .="</table>";
    $conn ->close();
    // To Do (DIY): End of Code
}
//advanced product search


$MainContent .= "</div>"; // End of Container
include("MasterTemplate.php");
?>
