<?php
//PHP script for saving top-up details
	
	//session code
	session_start();

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
	
	//Connect Database
	require_once '../../DB_connect.php';
	
	//Link User ID
	$user_id = $_SESSION['user-id'];
	
	//Passed variables from html
	$cardholderid = mysql_real_escape_string($_POST["cardholderid"]);
	$card_number = mysql_real_escape_string($_POST["card_number"]);
	$securitycodeid = mysql_real_escape_string($_POST["securitycodeid"]);
	$expirydate3id = mysql_real_escape_string($_POST["expirydate3id"]);
	
	
		//Insert if the card number doesn't already exist
		$query = "INSERT INTO `ei_saveTopUpDetails` (`cardholder_name`, `card_number`, `security_code`, `expiry_date`, `ei_userid`, `save_id`) 
		VALUES ('$cardholderid', '$card_number', '$securitycodeid', '$expirydate3id', '$user_id', NULL);";
		$result = mysql_query($query); 
		
		if ($result) 
		{
			//echo "Success";
			header('Location: pay_as_you_go.php');
			die();
		}
		else
		{		
			//Add code in to throw error on page instead
			echo "Payment details already saved";
			die();
		}
?>﻿