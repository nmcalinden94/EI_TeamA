<?php 
require '../php/phpmailer/PHPMailerAutoload.php';
		
		// Set mailer to use SMTP
		$mail = new PHPMailer;
		$mail->isSMTP();
		
		$date = $_POST['date'];
		$business = $_POST['business'];
		$email = $_POST['email'];
		
		$filename = $business . $date . '_Direct_Debit.pdf';
		
		// Specify main and backup SMTP servers                                      
		$mail->Host = 'smtp.live.com';
	
		// Enable SMTP authentication  
		$mail->SMTPAuth = true; 
	
		// SMTP username                              
		$mail->Username = 'ei_pdf_sender@hotmail.com';
	
		// SMTP password                 
		$mail->Password = '@Password93';
	
		// Enable TLS encryption, `ssl` also accepted                           
		$mail->SMTPSecure = 'tls';
	
		// TCP port to connect to
		$mail->Port = 587;                                    
	
		// Add a recipient
		$mail->setFrom('ei_pdf_sender@hotmail.com', 'Electric Ireland');
		$mail->addAddress($email);     
		$mail->addReplyTo('ei_pdf_sender@hotmail.com', 'Electric Ireland');
		$mail->addAttachment('pdf/' . $filename, $filename);

		// Set email format to HTML
		$mail->isHTML(true);                                  

		$mail->Subject = $business . ' Direct Debit: ' . $date;
		$mail->Body    = 'Attached is the direct debit electricity statement you requested.';

		if(!$mail->send()) 
		{
    		echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
			unlink('pdf/' . $filename);
		} 
		else 
		{
			echo 'Message Sent';
			unlink('pdf/' . $filename);
		}
		
		
 
?>
