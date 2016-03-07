//All methods below are seperated for explaining
//All custom javascript functionality for editing details on the my account page can be found here 
//Last Saved = 18/02/2016

//Show password change box
function showPasswordBox(){
	
	document.getElementById('changePassword').style.visibility = 'visible';
	document.getElementById('edit_MyAccountPassword').setAttribute("disabled", true);
}

//Show password change box
function closePasswordBox(){
	
	document.getElementById('changePassword').style.visibility = 'hidden';
	document.getElementById('edit_MyAccountPassword').removeAttribute("disabled");
}

/*
 * Editing the Account Details (First Tab)
 * Methods below handle acccessibility and calls to PHP scripts for SQL statements
 *
 */

//Method used to set accessibility of text boxes and buttons when edit button is selected
function enableMyAccountEditing() {
	
	document.getElementById("errorMessage_myAccount").innerHTML = ""; 
	
	//Buttons
	document.getElementById("edit_MyAccountDetails").setAttribute("disabled", true);
    document.getElementById("myAccount_Submit").removeAttribute("disabled");
	document.getElementById("myAccount_Cancel").removeAttribute("disabled");
	
	//Text boxes
	document.getElementById("my_Business").removeAttribute("readonly");
	document.getElementById("my_Address").removeAttribute("readonly");
	document.getElementById("my_Postcode").removeAttribute("readonly");
	document.getElementById("my_City").removeAttribute("readonly");
	document.getElementById("my_Email").removeAttribute("readonly");
}


//Disable accessibility of text boxes and buttons
function disableMyAccountEditing() {
	
	document.getElementById("errorMessage_myAccount").innerHTML = ""; 
	
	//Buttons
	document.getElementById("edit_MyAccountDetails").removeAttribute("disabled");
    document.getElementById("myAccount_Submit").setAttribute("disabled", true);
	document.getElementById("myAccount_Cancel").setAttribute("disabled", true);
	
	//Text boxes
	document.getElementById("my_Business").setAttribute("readonly", true);
	document.getElementById("my_Address").setAttribute("readonly", true);
	document.getElementById("my_Postcode").setAttribute("readonly", true);
	document.getElementById("my_City").setAttribute("readonly", true);
	document.getElementById("my_Email").setAttribute("readonly", true);
}

//Validate before performing editing method
function validation_MyAccountDetails(){
	
	//Check validation on Account number and MPRN
	var post = document.getElementById("my_Postcode").value;
    var email = document.getElementById("my_Email").value;
	var postcodeValid, emailValid;
	
	var newPostCode = checkPostCode(post);
	
	if (newPostCode)
	{
		document.getElementById("my_Postcode").value = newPostCode;
		document.getElementById("my_Postcode").removeAttribute("required");
		document.getElementById("errorMessage_myAccount").innerHTML = "";
		postcodeValid = true;
	}
	else{
		var accountErrorText = "Enter in a valid Postcode";
		document.getElementById("my_Postcode").setAttribute("required", true);
        document.getElementById("errorMessage_myAccount").innerHTML = accountErrorText;
	}
	
	if(postcodeValid == true)
	{
		//return true or false on validating email 
		var emailCheck = validateEmail(email);
		
		if(emailCheck)
		{
			document.getElementById("my_Email").removeAttribute("required");
			document.getElementById("errorMessage_myAccount").innerHTML = "";
			emailValid = true;
		}
		else{
			
			var accountErrorText = "Enter in a valid e-mail address";
			document.getElementById("my_Email").setAttribute("required", true);
			document.getElementById("errorMessage_myAccount").innerHTML = accountErrorText;
			
		}
	}

	//Perform Update function 
	if (postcodeValid ==true && emailValid == true){
          editUserDetails();
    }
	
}

//Validate email address
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

//Function to insert or update extra details of user
function editUserDetails() {
	
		//variables
		var my_Address = $('#my_Address').val();
		var my_Postcode = $('#my_Postcode').val();
		var my_City = $('#my_City').val();
		var my_Email = $('#my_Email').val();
		var my_Business = $('#my_Business').val();
			
		//Ajax call to update additional info of logged in user
		$.ajax({
			url:"editUserDetails.php", //the page containing php script
			type: "POST", //request type
			data: {my_Address: my_Address, my_Postcode : my_Postcode, my_City : my_City, my_Email : my_Email, my_Business : my_Business},
			success:function(result){
				if (result != "Failed")
				{
					disableMyAccountEditing();
					document.getElementById("errorMessage_myAccount").innerHTML = "Details Saved";
				}
				else{
					document.getElementById("errorMessage_myAccount").innerHTML = "Failed to save details. Check connection.";
				}
			}
		});
 }

//Function to allow user to update their details
function editPassword() {	
	
	//Get password entered
	var password = document.getElementById("my_Password").value;
	var newPassword = document.getElementById("my_NewPass").value;
	var checkPassword = document.getElementById("my_ConfirmPass").value;
	
	//Check if password textbox is not empty
	if(password != "")
	{
		if (newPassword == checkPassword)
		{
			//Ajax call to check the password is correct in relation to logged in account
			$.ajax({
			url:"editPassword.php", //the page containing php script
			type: "POST", //request type
			data: {password : password, newPassword : newPassword}, //data passed through
			success:function(result){
				if(result == 1)
				{
					successMessage();
					document.getElementById('changePassword').style.visibility = 'hidden';
					document.getElementById('edit_MyAccountPassword').removeAttribute("disabled");
					document.getElementById("my_Password").value = "";
					document.getElementById("my_NewPass").value = "";
					document.getElementById("my_ConfirmPass").value = "";
				}	
				else if(result == 0)
				{
					document.getElementById("my_Password").setAttribute("required", true);
					document.getElementById("errorMessage_myPassword").innerHTML = "Incorrect Password";
				}
			}
		});
		}
		else
		{
			document.getElementById("my_Password").setAttribute("required", true);
			document.getElementById("errorMessage_myPassword").innerHTML = "Enter password";//If password field is not entered
		}
	}
		
}	
	
 /*
 * Editing the Payment Details (2nd Tab)
 * Methods below handle acccessibility and calls to PHP scripts for SQL statements
 *
 */
  
//Method used to set accessibility of text boxes and buttons when edit button is selected
function enableMyPaymentEditing() {
	
	document.getElementById("errorMessage_myPayment").innerHTML = "";
	
	//Buttons
	document.getElementById("edit_MyPaymentDetails").setAttribute("disabled", true);
    document.getElementById("myPayment_Submit").removeAttribute("disabled");
	document.getElementById("myPayment_cancel").removeAttribute("disabled");
	
	//Text boxes
	document.getElementById("cardholderid").removeAttribute("readonly");
	document.getElementById("card_number").removeAttribute("readonly");
	document.getElementById("expirydate3id").removeAttribute("readonly");
	document.getElementById("securitycodeid").removeAttribute("readonly");
	document.getElementById("expirydate3id").style.backgroundColor = "#ffffff";	
}

//Disable text boxes and buttons
function disableMyPaymentEditing() {
	
	//Buttons
	document.getElementById("edit_MyPaymentDetails").removeAttribute("disabled");
    document.getElementById("myPayment_Submit").setAttribute("disabled", true);
	document.getElementById("myPayment_cancel").setAttribute("disabled", true);
	
	//Text boxes
	document.getElementById("cardholderid").setAttribute("readonly", true);
	document.getElementById("card_number").setAttribute("readonly", true);
	document.getElementById("expirydate3id").setAttribute("readonly", true);
	document.getElementById("securitycodeid").setAttribute("readonly", true);
	document.getElementById("expirydate3id").style.backgroundColor = "#e3e3e3";
}

//Validate before performing editing method
function validation_MyPaymentDetails(){
	
	//Check validation on Account number and MPRN
	var card_No = document.getElementById("card_number").value;
	var card_Expiry = document.getElementById("expirydate3id").value;
	var card_Security = document.getElementById("securitycodeid").value;

	var numberValid, securityValid;
		
	//Account number validation 
	if (card_No == "" || card_No == null || card_No.length != 19) {
		var accountErrorText = "Enter a 16 digit Card Number";
		document.getElementById("card_number").setAttribute("required", true);
        document.getElementById("errorMessage_myPayment").innerHTML = accountErrorText;
    }
	else {
		document.getElementById("card_number").removeAttribute("required");
		document.getElementById("errorMessage_myPayment").innerHTML = "";
		numberValid = true;
	}
	
	//Expiry Date validation
	if (numberValid === true)
	{
		if (card_Security == "" || card_Security == null || card_Security.length != 3)
		{
			var accountErrorText = "Enter a 3 digit security code";
			document.getElementById("securitycodeid").setAttribute("required", true);
			document.getElementById("errorMessage_myPayment").innerHTML = accountErrorText;
		}
		else 
		{
			document.getElementById("securitycodeid").removeAttribute("required");
			document.getElementById("errorMessage_myPayment").innerHTML = "";
			securityValid = true;
		}
	}
	
	//Perform Update function 
	if (numberValid === true && securityValid === true){
          editPaymentDetails();
    }
}

//Function for updating card details 
function editPaymentDetails() {
			
		//variables
		var card_Number = ($('#card_number').val());
		var card_Name = $('#cardholderid').val();
		var card_Expiry = $('#expirydate3id').val();
		var card_Security = ($('#securitycodeid').val());
		
		//ajax call to edit details
		$.ajax({
			url:"editPaymentDetails.php", //the page containing php script
			type: "POST", //request type
			data: {card_Number: card_Number, card_Name, card_Expiry : card_Expiry, card_Security : card_Security},
			success:function(result){
				if (result != "Failed")
				{
					disableMyPaymentEditing();
					document.getElementById("errorMessage_myPayment").innerHTML = "Card Details Saved";
				}
				else{
					document.getElementById("errorMessage_myPayment").innerHTML = "Failed to save details. Check connection.";
				}
			}
		});
 }
  /*
 * Editing the Additional Details (3rd Tab)
 * Methods below handle acccessibility and calls to PHP scripts for SQL statements
 *
 */


 //check data entered into textbox is a number
function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            };