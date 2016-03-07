<?php
	session_start();

	require_once 'DB_connect.php';

	$account_error='';
	$password_error='';
	$combo_error='';
	$inputuser='';
	$inputpass='';

	if(empty($_POST) === false){

		if (empty($_POST['accountid'])||(strlen($_POST['accountid'])<6)){
			$account_error='Please enter a valid account number';
		}

		if (empty($_POST['password'])||(strlen($_POST['password'])<=6)){
			$password_error='Please enter a valid password';
		}

		$inputuser = mysql_real_escape_string($_POST["accountid"]);
		$inputpass = mysql_real_escape_string($_POST["password"]);


		$hashquery = "SELECT * FROM `ei_user` WHERE `account_number`= '$inputuser'";
		$hashresult = mysql_query($hashquery);
		$hashrow = mysql_fetch_array($hashresult);
		$hashpass = $hashrow['password'];

		$query = "SELECT * FROM `ei_user` WHERE `account_number`= '$inputuser' AND `password`='$hashpass'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);

		if (password_verify($inputpass, $hashpass)) {
			if (mysql_num_rows($result) == 1) {
				//adding User Details for future reference throughout application
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $inputuser;
				$_SESSION['user-id'] = $row['ei_userid'];
				$_SESSION['business'] = $row['Business'];
				$_SESSION['account_no'] = $row['account_number'];
				$_SESSION['mprn'] = $row['mprn'];

				$_SESSION['user_info'] = array();
				array_push($_SESSION['user_info'], $_SESSION['user-id']);
				array_push($_SESSION['user_info'], $_SESSION['business']);
				array_push($_SESSION['user_info'], $_SESSION['account_no']);
				array_push($_SESSION['user_info'], $_SESSION['mprn']);
				header('Location: index.php');

			die();
			}
		}
		else{
			if($account_error==''&& $password_error==''){
			$combo_error="The account number or password you entered has not been found. Please enter them again.";
		}
		}

}
?>
<!DOCTYPE html>
<html class="bg-white">
<head>
    <meta charset="UTF-8">
    <title>Electric Ireland</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<script src="login.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-white">
    <form name ="loginForm" id="loginForm" method="post" action='?' >
        <div class="form-box" id="login-box">
            <a class="image">
                <div style="text-align: center">
                    <!-- Add the class icon to your logo image or logo icon to add the margining -->
                    <img src="img/ElectricIreland/brand_logo_large.jpg" height="98" width="220" />
                </div>
             </a>
            <p id="smarterLiving"><b>Smarter Living</b></p>
            <div class="body bg-gray">
                <h3><font color="009FDA">Login</font></h3>
                <div class="form-group">
				<fieldset class="question">
                    <input id="accountInput" maxlength="8" minlength="8" type="text" name="accountid" class="InputLog" placeholder="Account Number" onkeypress="return isNumber(event)" value='<?php echo htmlentities($inputuser) ?>' required/>
				</fieldset>
                </div>
                <p id="accountError"><?php echo $account_error ?></p>
                <div class="form-group">
					<fieldset class="question">
                    <input id="passwordInput" type="password" minlength="6" name="password" class="InputLog" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" value='<?php echo htmlentities($inputpass) ?>'required/>
					</fieldset>
                </div>
                <p id="passwordError"><?php echo $password_error ?></p>
                <p id="comboError"><?php echo $combo_error ?></p>
            </div>
            <div class="footer text-center">
                <button id="loginButton" name='submitted' type="submit" class="btn bg-el-green btn-block"><font color="white">Sign me in</font></button>
                <p><a href="forgotpassword.html"><font color="009FDA">Forgot Password?</font></a>|<a href="register.php"><font color="009FDA">Register</font></a></p>
				<div class="margin text-center">
					<font color="009FDA">Follow us using social networks</font>
					<br />
					<a href="https://www.facebook.com/ElectricIreland" class="btn bg-light-blue btn-circle" role="button"><i class="fa fa-facebook" style="line-height: inherit;"></i></a>
					<a href="https://twitter.com/ElectricIreland" class="btn bg-aqua btn-circle" role="button"><i class="fa fa-twitter" style="line-height: inherit;"></i></a>
					<a href="https://plus.google.com/112091260087178293076/videos" class="btn bg-red btn-circle" role="button"><i class="fa fa-google-plus" style="line-height: inherit;"></i></a>
					</div>
				</div>
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
	$("#loginForm .InputLog, #loginForm .Date, #loginForm .Datalist").blur( function() 
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