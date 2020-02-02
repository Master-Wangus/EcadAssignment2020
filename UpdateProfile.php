<script type="text/javascript">
function validateForm()
{
    // To Do 1 - Check if password matched
	
	if(document.register.password.value != document.register.password2.value){
		alert("Password not matched!");
		return false;
	
	}
	
	// To Do 2 - Check if telephone number entered correctly
	//           Singapore telephone number consists of 8 digits,
	//           start with 6, 8 or 9
	
	if (document.register.phone.value !=""){
		var str = document.register.phone.value;
		if(str.length !=8)
		{
			alert("Please enter a 8-digit phone number");
			return false; // cancel submission
			
		}
		else if (str.substr(0,1) != "6" &&
				 str.substr(0,1) != "8" &&
			     str.substr(0,1) != "9" 
		){
			alert ("Phone number in Singapore should start with 6,8,9.");
			return false; // cancel submission
		}
	}

	// To do 3 - Check if the email has duplication email
	
	
		
	}

    return true;  // No error found
}
</script>



<?php
// Detect the current session

session_start();
include("mysql.php");

//Create an object for MQL database access
$conn = new Mysql_Driver();
//Connect to the MYSQL database
$conn->connect();

if ( isset ($_SESSION["ShopperID"])){
	$qry = "SELECT ShopperID, Name, Birthdate, Address, Country, Phone, Email, Password, PwdQuestion, PwdAnswer FROM SHOPPER WHERE ShopperID=$_SESSION[ShopperID]";
	$result = $conn->query($qry);
	if ($conn->num_rows($result) >0){
		while ($row = $conn->fetch_array($result)){

$MainContent = "<div style='width:80%; margin:auto;'>";
$MainContent .= "<form name='updateprofile' action='UpdateProfile_Action.php' method='post' 
                       onsubmit='return validateForm()'>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<span class='page-title'>Update Profile</span>";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='name'>Name:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='name' id='name' 
                  type='text' value='$row[Name]'  required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>"; // Birthdate
$MainContent .= "<label class='col-sm-3 col-form-label' for='birthdate'>Birthdate:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='birthdate' id='birthdate' 
                  type='date' value='$row[Birthdate]'  required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of Birthdate
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='address'>Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<textarea class='form-control' name='address' id='address' 
                  cols='25' rows='4' >$row[Address]</textarea>";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='country'>Country:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='country' id='country' type='text' value='$row[Country]' />";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='phone'>Phone:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='phone' id='phone' type='text' value='$row[Phone]' />";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='email'>
                 Email Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='email' id='email' 
                  type='email' value='$row[Email]' required /> ";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='password'>
                 Password:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='password' id='password' 
                  type='password' value='$row[Password]' required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>"; 

$MainContent .= "<div class='form-group row'>"; // Pwd Question
$MainContent .= "<label class='col-sm-3 col-form-label' for='pwdquestion'>
                 Password Question:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='pwdquestion' id='pwdquestion' 
                  type='text' value='$row[PwdQuestion]' required /> "; // required
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of Pwd Question
$MainContent .= "<div class='form-group row'>"; // Pwd Answer
$MainContent .= "<label class='col-sm-3 col-form-label' for='pwdanswer'>
                 Password Answer:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='pwdanswer' id='pwdanswer' 
                  type='text' value='$row[PwdAnswer]' required /> "; // required
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of Pwd Answer

$MainContent .= "<div class='form-group row'>";       
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<button type='submit'>Update</button>";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "</form>";
$MainContent .= "</div>";
		}
	}
}

include("MasterTemplate.php"); 
?>
