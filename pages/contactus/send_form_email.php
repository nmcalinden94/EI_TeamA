<?php
session_start();
//session code
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
    echo "";
} 
else 
{
    echo "Please log in first to see this page.";
	header('Location: ../../login.php');
	die();
}
 
if(isset($_POST['email'])) 
{
 
    function died($error) 
    {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
    
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['company']) ||
        !isset($_POST['subjectname']) ||
        !isset($_POST['message'])) 
        {
        	died('We are sorry, but there appears to be a problem with the form you submitted.');       
    	}
 
    	$name = $_POST['name']; // required
    	$email = $_POST['email']; // required
    	$company = $_POST['company']; // required
    	$telephone = $_POST['telephone']; // not required
    	$message = $_POST['message']; // required
    	$email_subject = $_POST['subjectname']; // required
    	$error_message = "";
    	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  	if(!preg_match($email_exp,$email)) 
  	{
    	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  	}
    	$string_exp = "/^[A-Za-z .'-]+$/";
 
  	if(!preg_match($string_exp,$name)) 
  	{
    	$error_message .= 'The Name you entered does not appear to be valid.<br />';
  	}
 
  	if(!preg_match($string_exp,$company)) 
  	{
    	$error_message .= 'The Company name you entered does not appear to be valid.<br />';
  	}
 
  	if(strlen($message) < 2) 
  	{
    	$error_message .= 'The message you entered do not appear to be valid.<br />';
  	}
 
  	if(strlen($error_message) > 0) 
  	{
    	died($error_message);
  	}
 
    $email_message = "Form details below.\n\n";     
    function clean_string($string) 
    {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
        
	$message = '<html><body>';
	$message .= '<center><img src="http://www.louisekiely.com/wp-content/uploads/2015/08/Electric-Ireland-logo.jpg" height="95" width="206" alt="Electric Ireland" /></center>';
	$message .= '<br/>';
	$message .= '<table  align="center" rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Business Name:</strong> </td><td>" . strip_tags($_POST['company']) . "</td></tr>";
	$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
	$message .= "<tr><td><strong>Telephone:</strong> </td><td>" . strip_tags($_POST['telephone']) . "</td></tr>";
	$message .= "<tr><td><strong>Message:</strong> </td><td>" . $_POST['message'] . "</td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
    
	
	//General Email Send
	if (strpos($email_subject, 'General') !== false)
    {
		require '../../php/phpmailer/PHPMailerAutoload.php';
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
		$mail->setFrom('electricirelanda@outlook.com', $name);
		$mail->addAddress('electricirelanda@outlook.com');     
		$mail->addReplyTo( $email, $name);

		// Set email format to HTML
		$mail->isHTML(true);                                  

		$mail->Subject = $email_subject;
		$mail->Body    = $message;

		if(!$mail->send()) 
		{
			header('Location: ContactFeedbackFail.php?name='.$_POST['name']."&company=".$_POST['company']."&email=".$_POST['email']."&telephone=".$_POST['telephone']."&message=".$_POST['message']);
    		//echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
			header('Location: contact_us.php');
    	}
	}
	
	//Fault Reporting Send
	else if (strpos($email_subject, 'Fault Reporting') !== false)
    {
		require '../../php/phpmailer/PHPMailerAutoload.php';
		// Set mailer to use SMTP
		$mail = new PHPMailer;
		$mail->isSMTP();
	
		// Specify main and backup SMTP servers                                      
		$mail->Host = 'smtp.live.com';
	
		// Enable SMTP authentication  
		$mail->SMTPAuth = true; 
	
		// SMTP username                              
		$mail->Username = 'ei-fault-reporting@outlook.com';
	
		// SMTP password                 
		$mail->Password = '@Password93';
	
		// Enable TLS encryption, `ssl` also accepted                           
		$mail->SMTPSecure = 'tls';
	
		// TCP port to connect to
		$mail->Port = 587;                                    
	
		// Add a recipient
		$mail->setFrom('ei-fault-reporting@outlook.com', $name);
		$mail->addAddress('ei-fault-reporting@outlook.com');     
		$mail->addReplyTo( $email, $name);

		// Set email format to HTML
		$mail->isHTML(true);                                  

		$mail->Subject = $email_subject;
		$mail->Body    = $message;

		if(!$mail->send()) 
		{
			header('Location: ContactFeedbackFail.php?name='.$_POST['name']."&company=".$_POST['company']."&email=".$_POST['email']."&telephone=".$_POST['telephone']."&message=".$_POST['message']);
    		//echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
    		header('Location: contact_us.php');	
    	}
	}
	
	//Pay As You Go Email Send
	else if (strpos($email_subject, 'Pay As You Go') !== false)
    {
		require '../../php/phpmailer/PHPMailerAutoload.php';
		// Set mailer to use SMTP
		$mail = new PHPMailer;
		$mail->isSMTP();
	
		// Specify main and backup SMTP servers                                      
		$mail->Host = 'smtp.live.com';
	
		// Enable SMTP authentication  
		$mail->SMTPAuth = true; 
	
		// SMTP username                              
		$mail->Username = 'ei-pay-as-you-go@outlook.com';
	
		// SMTP password                 
		$mail->Password = '@Password93';
	
		// Enable TLS encryption, `ssl` also accepted                           
		$mail->SMTPSecure = 'tls';
	
		// TCP port to connect to
		$mail->Port = 587;                                    
	
		// Add a recipient
		$mail->setFrom('ei-pay-as-you-go@outlook.com', $name);
		$mail->addAddress('ei-pay-as-you-go@outlook.com');     
		$mail->addReplyTo( $email, $name);

		// Set email format to HTML
		$mail->isHTML(true);                                  

		$mail->Subject = $email_subject;
		$mail->Body    = $message;

		if(!$mail->send()) 
		{
			header('Location: ContactFeedbackFail.php?name='.$_POST['name']."&company=".$_POST['company']."&email=".$_POST['email']."&telephone=".$_POST['telephone']."&message=".$_POST['message']);
    		//echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
			header('Location: contact_us.php');
    	}
	}
	
	//App Issues Email Send
	else if (strpos($email_subject, 'App Issues') !== false)
    {
		require '../../php/phpmailer/PHPMailerAutoload.php';
		// Set mailer to use SMTP
		$mail = new PHPMailer;
		$mail->isSMTP();
	
		// Specify main and backup SMTP servers                                      
		$mail->Host = 'smtp.live.com';
	
		// Enable SMTP authentication  
		$mail->SMTPAuth = true; 
	
		// SMTP username                              
		$mail->Username = 'ei-app-issues@outlook.com';
	
		// SMTP password                 
		$mail->Password = '@Password93';
	
		// Enable TLS encryption, `ssl` also accepted                           
		$mail->SMTPSecure = 'tls';
	
		// TCP port to connect to
		$mail->Port = 587;                                    
	
		// Add a recipient
		$mail->setFrom('ei-app-issues@outlook.com', $name);
		$mail->addAddress('ei-app-issues@outlook.com');     
		$mail->addReplyTo( $email, $name);

		// Set email format to HTML
		$mail->isHTML(true);                                  

		$mail->Subject = $email_subject;
		$mail->Body    = $message;

		if(!$mail->send()) 
		{
			header('Location: ContactFeedbackFail.php?name='.$_POST['name']."&company=".$_POST['company']."&email=".$_POST['email']."&telephone=".$_POST['telephone']."&message=".$_POST['message']);
    		//echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
    		header('Location: contact_us.php');
		}
		}
	
	//Services Email Send
	else if (strpos($email_subject, 'Services') !== false)
    {
		require '../../php/phpmailer/PHPMailerAutoload.php';
		// Set mailer to use SMTP
		$mail = new PHPMailer;
		$mail->isSMTP();
	
		// Specify main and backup SMTP servers                                      
		$mail->Host = 'smtp.live.com';
	
		// Enable SMTP authentication  
		$mail->SMTPAuth = true; 
	
		// SMTP username                              
		$mail->Username = 'ei-services@outlook.com';
	
		// SMTP password                 
		$mail->Password = '@Password93';
	
		// Enable TLS encryption, `ssl` also accepted                           
		$mail->SMTPSecure = 'tls';
	
		// TCP port to connect to
		$mail->Port = 587;                                    
	
		// Add a recipient
		$mail->setFrom('ei-services@outlook.com', $name);
		$mail->addAddress('ei-services@outlook.com');     
		$mail->addReplyTo( $email, $name);

		// Set email format to HTML
		$mail->isHTML(true);                                  

		$mail->Subject = $email_subject;
		$mail->Body    = $message;

		if(!$mail->send()) 
		{
			header('Location: ContactFeedbackFail.php?name='.$_POST['name']."&company=".$_POST['company']."&email=".$_POST['email']."&telephone=".$_POST['telephone']."&message=".$_POST['message']);
    		//echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
    		header('Location: contact_us.php');
    	}
	}
	
	//Sales Support Email Send
	else if (strpos($email_subject, 'Sales Support') !== false)
    {
		require '../../php/phpmailer/PHPMailerAutoload.php';
		// Set mailer to use SMTP
		$mail = new PHPMailer;
		$mail->isSMTP();
	
		// Specify main and backup SMTP servers                                      
		$mail->Host = 'smtp.live.com';
	
		// Enable SMTP authentication  
		$mail->SMTPAuth = true; 
	
		// SMTP username                              
		$mail->Username = 'electric-ireland-sales@outlook.com';
	
		// SMTP password                 
		$mail->Password = '@Password93';
	
		// Enable TLS encryption, `ssl` also accepted                           
		$mail->SMTPSecure = 'tls';
	
		// TCP port to connect to
		$mail->Port = 587;                                    
	
		// Add a recipient
		$mail->setFrom('electric-ireland-sales@outlook.com', $name);
		$mail->addAddress('electric-ireland-sales@outlook.com');     
		$mail->addReplyTo( $email, $name);

		// Set email format to HTML
		$mail->isHTML(true);                                  

		$mail->Subject = $email_subject;
		$mail->Body    = $message;

		if(!$mail->send()) 
		{
			header('Location: ContactFeedbackFail.php?name='.$_POST['name']."&company=".$_POST['company']."&email=".$_POST['email']."&telephone=".$_POST['telephone']."&message=".$_POST['message']);
    		//echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
    		header('Location: contact_us.php');	
    	}
	}
	
	else
	{
	header('Location: ContactFeedbackFail.php?name='.$_POST['name']."&company=".$_POST['company']."&email=".$_POST['email']."&telephone=".$_POST['telephone']."&message=".$_POST['message']);
}
}
?>