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
	$pricetype = mysql_real_escape_string($_POST["pricetype"]);
	$cardholderid = mysql_real_escape_string($_POST["cardholderid"]);
	$card_number = mysql_real_escape_string($_POST["card_number"]);
	$securitycodeid = mysql_real_escape_string($_POST["securitycodeid"]);
	$expirydate3id = mysql_real_escape_string($_POST["expirydate3id"]);
	
		//Submit Payment Details Into Database
		$query = "INSERT INTO `ei_submitTopUpPayment` (`top_up_amount`, `cardholder_name`, `card_number`, `security_code`, `expiry_date`, `top_up_id`, `ei_userid`) 
		VALUES ('$pricetype', '$cardholderid', '$card_number', '$securitycodeid', '$expirydate3id', NULL, '$user_id');";
		$result = mysql_query($query); 
		
		//Get Reference Number
		$sql = "SELECT `top_up_id` FROM `ei_submitTopUpPayment` WHERE `ei_userid` = '$user_id' ORDER BY `top_up_id` DESC LIMIT 1";
		$result1 = mysql_query($sql);
		$rs = mysql_fetch_array($result1);
		$result2 = $rs['top_up_id'];
		$_SESSION['result2'] = $result2;
		
		if ($result) 
		{
			header('Location: PayAsYouGoFeedback.php?pricetype='.$_POST['pricetype']."&cardholderid=".$_POST['cardholderid']."&card_number=".$_POST['card_number']."&securitycodeid=".$_POST['securitycodeid']."&expirydate3id=".$_POST['expirydate3id']);
			die();
		}
		else
		{		
			header('Location: PayAsYouGoFeedbackFail.php?pricetype='.$_POST['pricetype']."&cardholderid=".$_POST['cardholderid']."&card_number=".$_POST['card_number']."&securitycodeid=".$_POST['securitycodeid']."&expirydate3id=".$_POST['expirydate3id']);	
			die();
		}
?>﻿