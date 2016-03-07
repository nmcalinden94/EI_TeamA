<?php
//PHP script for registration
///Code needed to deal with if the result doesn't exist

	session_start();
	
	require_once 'DB_connect.php';
	
	$account_error='';
	$mprn_error='';
	$password_error='';
	$confirmPassword_error='';
	$inputAccountId ='';
    $inputMPRN ='';
	$inputPASS ='';
	$inputConfirm ='';
	

	if(empty($_POST) === false)
	{//
		//Passed variables from html
		$inputAccountId = mysql_real_escape_string($_POST["register_AccountID"]);
		$inputMPRN = mysql_real_escape_string($_POST["register_MPRN"]);
		$inputPASS = mysql_real_escape_string($_POST["register_Password"]);
		$inputConfirm = mysql_real_escape_string($_POST["register_ConfirmPassword"]);

		if (empty($_POST['register_AccountID'])||(strlen($_POST['register_AccountID'])!=8)){
			$account_error='Please enter a valid 8 digit account number';
		}
		
		if (empty($_POST['register_MPRN'])||(strlen($_POST['register_MPRN'])!=11)){
			$mprn_error='Please enter a valid 11 digit mprn number';
		}
		
		if (empty($_POST['register_Password'])||(strlen($_POST['register_Password'])<=6)){
			$password_error='Please enter a valid password';
		}
		else if(!preg_match("#[0-9]+#",$inputPASS)) {
			$password_error = "Your password must contain at least 1 number";
    }
		else if(!preg_match("#[A-Z]+#",$inputPASS)) {
			$password_error = "Password must contain at least 1 capital letter";
    }
		else if(!preg_match("#[a-z]+#",$inputPASS)) {
			$password_error = "Password must contain at least 1 lowercase letter";
    }
		
		if (empty($_POST['register_ConfirmPassword'])|| $inputPASS != $inputConfirm){
			$confirmPassword_error='Passwords do not match';
		}

		$unique_Check = "SELECT * FROM `ei_user` WHERE `account_number`= '$inputAccountId' OR `mprn`='$inputMPRN'";
		
		$unique_Result = mysql_query($unique_Check); 
	
		$row = mysql_fetch_array($unique_Result);
	
		if($account_error==''&& $mprn_error=='' && $password_error=='' && $confirmPassword_error==''){
			if($inputPASS == $inputConfirm){
				if (mysql_num_rows($unique_Result) != 0) {
					$confirmPassword_error="Account already exists, try again";
				}
		
				else {
					$options = ['cost' => 11,];
					// Get the password from post
					$hash = password_hash($inputConfirm, PASSWORD_BCRYPT, $options);
					$query = "INSERT INTO `ei_user` (`Business`, `account_number`, `mprn`, `password`, `ei_userid`) VALUES (NULL, '$inputAccountId', '$inputMPRN', '$hash', 0)";
					mysql_query($query); 
					if($unique_Result)
					header('Location: login.php');
					die();	  
				}
			}
		}
	}
    
?>﻿
<!DOCTYPE html>
<html class="bg-white">
<head>
    <meta charset="UTF-8">
    <title>Electric Ireland | Registration</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<script src="register.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-white">
    <form name="registerForm" id="registerForm" action="?" method="post">
        <div class="form-box" id="login-box">
            <a class="image">
                <div style="text-align: center">
                    <!-- Add the class icon to your logo image or logo icon to add the margining -->
                    <img src="img/ElectricIreland/brand_logo_large.jpg" height="98" width="220" />
                </div>
            </a>
            <p id="smarterLiving"><b>Smarter Living</b></p>
            <div class="body bg-gray">
                <h3><font color="009FDA">Register</font></h3>
				
                <div class="form-group">
				<fieldset class="question">
                    <input id="accountInput" maxlength="8" minlength="8" name="register_AccountID" type="text" class="InputReg" placeholder="Account Number" onkeypress="return isNumber(event)" value='<?php echo htmlentities($inputAccountId) ?>' required/>
                </fieldset>
				</div>
				</fieldset>
                <p id="accountError"><?php echo $account_error ?></p>  
				<fieldset class="question">
                <div class="form-group">
                    <input id="mprnInput" name="register_MPRN" minlength="11" maxlength="11" type="text" class="InputReg" placeholder="MPRN" onkeypress="return isNumber(event)" value='<?php echo htmlentities($inputMPRN) ?>' required/>
                </div>
				</fieldset>
                <p id="mprnError"><?php echo $mprn_error ?></p>
				<fieldset class="question">
                <div class="form-group">
                    <input id="passwordInput" type="password" minlength="6" name="register_Password" class="InputReg" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" value='<?php echo htmlentities($inputPASS) ?>' required/>
                </div>
				</fieldset>
                <p id="passwordError"><?php echo $password_error ?></p>
				<fieldset class="question">
                <div class="form-group">
                    <input id="confirmPasswordInput" type="password" minlength="6" name="register_ConfirmPassword" class="InputReg" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" value='<?php echo htmlentities($inputConfirm) ?>'required/>
                </div>
				</fieldset>
                <p id="confirmPasswordError"><?php echo $confirmPassword_error ?></p>
            </div>
            <div class="footer">
                <button id="registerButton" type="submit" class="btn bg-el-green btn-block"><font color="white">Register</font></button>
                <a href="login.php" class="text-center">I already have a membership</a>
            </div>
            <br />
        </div>
      </form>
	  
        <!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Webshim Validation -->
		<script src="js/js-webshim/minified/polyfiller.js"></script>
</body>
</html>

<!-- Webshim Validation -->
<script>
/* WEBSHIM.LIB SETUP
****************************************/

	// only implement  Webshim if not an Android native browser (too buggy)
	var nua = navigator.userAgent;
	var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));

	if( is_android ) 
	{
  		webshims.setOptions('forms', 
    	{ 
      		addValidators: true, 
      		customDatalist: true 
    	});
  		webshims.activeLang('en-AU');
  		webshims.polyfill('forms');
	} 
	else 
	{
  		webshims.setOptions('forms', 
    	{ 
    		addValidators: true 
    	},
    	'forms-ext', 
    	{
      		types: 'date number',
      		"number": { "calculateWidth": false },
      		"date": { "calculateWidth": false }
    	});
  		webshims.activeLang('en-AU');
  		webshims.polyfill('forms forms-ext');
	}


	// Change input type to match 'inputmode' on touch devices
	$("html.touch input[type='text']").each( function() 
	{
  		var $t = $(this);
  		if( $t.is("[inputmode='numeric']") ) 
  		{
    		$t.attr("type","number");
  		} 
  		else if( $t.is("[inputmode='tel']") ) 
  		{
    		$t.attr("type","tel");
  		} 
  		else if( $t.is("[inputmode='email']") ) 
  		{
    		$t.attr("type","email");
  		} 
  		else if( $t.is("[inputmode='url']") ) 
  		{
    		$t.attr("type","url");
  		}
	});


	/* DELAYED FORM VALIDATION
	****************************************/
	// Enable validation styling only after field is 'touched'
	$("#registerForm .InputReg, #registerForm .Date, #registerForm .Datalist").blur( function() 
	{
  		$(this).parents("fieldset").addClass("is-validateEnabled");
	});

	/* Enable validation of all inputs once form is submitted
	$("#registerForm").on("submit", function(event) 
	{
  		event.preventDefault();
  		if( $("#registerForm input:invalid").length ) 
  		{
    		$("fieldset").addClass("is-validateEnabled");
    		$("input:invalid").first().focus();
  		} 
  		else 
  		{
    		$("#btnSubmit").attr("value","Submitting...");
    		$(this).submit();
  		}
	});*/
</script>