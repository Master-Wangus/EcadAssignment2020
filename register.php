
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
$MainContent = "<div style='width:80%; margin:auto;'>";
$MainContent .= "<form name='register' action='registration.php' method='post' 
                       onsubmit='return validateForm()'>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<span class='page-title'>Membership Registration</span>";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='name'>Name:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='name' id='name' 
                  type='text' required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>"; // Birthdate
$MainContent .= "<label class='col-sm-3 col-form-label' for='birthdate'>Birthdate:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='birthdate' id='birthdate' 
                  type='date' required /> "; // required
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of Birthdate
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='address'>Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<textarea class='form-control' name='address' id='address'
                  cols='25' rows='4' ></textarea>";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='country'>Country:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='country' id='country' type='text' />";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='phone'>Phone:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='phone' id='phone' type='text' />";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='email'>
                 Email Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='email' id='email' 
                  type='email' required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='password'>
                 Password:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='password' id='password' 
                  type='password' required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='password2'>
                 Retype Password:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='password2' id='password2' 
                  type='password' required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "<div class='form-group row'>"; // Pwd Question
$MainContent .= "<label class='col-sm-3 col-form-label' for='pwdquestion'>
                 Password Question:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='pwdquestion' id='pwdquestion' 
                  type='text' required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of Pwd Question
$MainContent .= "<div class='form-group row'>"; // Pwd Answer
$MainContent .= "<label class='col-sm-3 col-form-label' for='pwdanswer'>
                 Password Answer:</label>";
$MainContent .= "<div class='col-sm-9'>";	
$MainContent .= "<input class='form-control' name='pwdanswer' id='pwdanswer' 
                  type='text' required /> "; //required
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of Pwd Answer

/* $MainContent .= "<div class='form-group row'>"; // Active Status
$MainContent .= "<label class='col-sm-3 col-form-label' for='pwdanswer'>
                 Password Answer:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='pwdanswer' id='pwdanswer' 
                  type='text' required /> (required)";
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of Active Status */

$MainContent .= "<div class='form-group row'>";       
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<button type='submit'>Register</button>";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "</form>";
$MainContent .= "</div>";
include("MasterTemplate.php"); 
?>