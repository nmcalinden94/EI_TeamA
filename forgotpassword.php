<?php

	//connect to db
	session_start();

	require_once 'DB_connect.php';
	$email='';
	$accountError = "";

	if(empty($_POST) === false){
		$email = mysql_real_escape_string($_POST["email"]);
		$email_check = mysql_query("SELECT * FROM `ei_user` WHERE email='".$email."'");
		$count = mysql_num_rows($email_check);
		
		if($count!=0){
			$random = rand(72891, 92729);
			$new_password = $random;
			
			$email_password = $new_password;
			$options = ['cost' => 11,];
					// Get the password from post
			$new_password = password_hash($new_password, PASSWORD_BCRYPT, $options);
			mysql_query("UPDATE `ei_user` SET password='".$new_password."' WHERE email='".$email."'");
			
			$subject = "Login Information";
			$message = "Your password has been changed to $email_password";
			
				//General Email Send

			require 'php/phpmailer/PHPMailerAutoload.php';
			// Set mailer to use SMTP
			$mail = new PHPMailer;
			$mail->isSMTP();
		
			// Specify main and backup SMTP servers                                      
			$mail->Host = 'smtp.live.com';
		
			// Enable SMTP authentication  
			$mail->SMTPAuth = true; 
		
			// SMTP username                              
			$mail->Username = 'electricirelanda@outlook.com';
		
			// SMTP password                 
			$mail->Password = '@Password93';
		
			// Enable TLS encryption, `ssl` also accepted                           
			$mail->SMTPSecure = 'tls';
		
			// TCP port to connect to
			$mail->Port = 587;                                    
		
			// Add a recipient
			$mail->setFrom($email, "EI");
			$mail->addAddress($email);     
			$mail->addReplyTo( $email, "");

			// Set email format to HTML
			$mail->isHTML(true);                                  

			$mail->Subject = $subject;
			$mail->Body    = $message;

			if(!$mail->send()) 
			{
				$accountError="Email did not send";
			} 
			else 
			{
				$accountError = "Your new password has been sent to your email";
			}
			}	
			else {
				$accountError = "Email doesn't exist";
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-white">
    <form name="forgotPasswordForm" id="forgotPasswordForm" method="post" action="?">
        <div class="form-box" id="login-box">
            <a class="image">
                <div style="text-align: center">
                    <!-- Add the class icon to your logo image or logo icon to add the margining -->
                    <img src="img/ElectricIreland/brand_logo_large.jpg" height="100" width="240" />
                </div>
            </a>
            <p id="smarterLiving"><b>Smarter Living</b></p>
            <div class="body bg-gray">
                <h3><font color="009FDA">Retrieve Password</font></h3>
                <p><font color="808080">Please enter your your email address and a new password will be sent to your email</font></p>
                <div class="form-group">
				<fieldset class="question">
                    <input id="accountInput"  type="text"  class="InputForgetPassword" name="email"  placeholder="Enter Your E-Mail Address" minlength="3" maxlength="50" required/>
				</fieldset>
                </div>
                <p id="accountError"><?php echo $accountError ?></p>
            </div>
            <div class="footer">
                <button id="submitButton" type="submit" name ="submit "class="btn bg-el-green btn-block"><font color="white">Submit</font></button>
                <a href="login.php" class="text-center">I remember my login credentials</a>
            </div>
            <br>
        </div>
    </form>
    <div class="margin text-center">
        <span class="text-blue">Follow us using social networks</span>
        <br />
        <a href="https://www.facebook.com/ElectricIreland" class="btn bg-light-blue btn-circle" role="button"><i class="fa fa-facebook"style="line-height: inherit;"></i></a>
        <a href="https://twitter.com/ElectricIreland" class="btn bg-aqua btn-circle" role="button"><i class="fa fa-twitter"style="line-height: inherit;"></i></a>
        <a href="https://plus.google.com/112091260087178293076/videos" class="btn bg-red btn-circle" role="button"><i class="fa fa-google-plus"style="line-height: inherit;"></i></a>
    </div>
        <script type="text/javascript">
            function validateForm() {
                var a = document.getElementById("accountInput").value;
                var accountValid;

                    if (a == "" || a == null) {
                        emailErrorText = "Please enter a valid acount number";
                        document.getElementById("accountError").innerHTML = emailErrorText;
                    }

                    else if (a != "" || a != null) {
                        if (a.length<6) {
                            document.getElementById("accountError").innerHTML = "Account Number needs to be a minimum of 6 digits";
                        }
                        else {
                            document.getElementById("accountError").innerHTML = "";
                            accountValid = true;
                        }
                    }
                    if (accountValid==true) {
                        return true;
                    }
                    else {
                        return false;
                    }
            }

            function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            };
        </script>
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
	$("#forgotPasswordForm .InputForgetPassword, #forgotPasswordForm .Date, #forgotPasswordForm .Datalist").blur( function() 
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