<?php
//Script for editing payment details
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	require_once 'DB_connect.php';
	
	$cardholderid = $_POST["cardholderid"];
	$card_number = $_POST["card_number"];   
	$expirydate3id =  $_POST["expirydate3id"];
	$securitycodeid = $_POST["securitycodeid"];
	$user_id = $_SESSION['user-id'];
		
	//Insert if the account number doesn't already exist
	$checkExists = "SELECT `ei_userid` FROM `ei_saveTopUpDetails` WHERE `ei_userid` = '$user_id'";	
	$check_result = mysql_query($checkExists);
	$rowCount = mysql_num_rows($check_result);	
	
	// if a row has been found - update details where the user id exists
	if ($rowCount == 1) 
	{
			$update_query = "UPDATE `ei_saveTopUpDetails` SET `cardholder_name`='$cardholderid', `card_number`='$card_number', `security_code`='$securitycodeid', `expiry_date`='$expirydate3id' WHERE `ei_userid`='$user_id'";
			$result = mysql_query($update_query);
			
			if($result)
			{
				echo "Updated";
			}
			else 
			{
				echo "Failure";
			}
	}
	//Else insert the new user card details
	else
	{
			$insert_query = "INSERT INTO `ei_saveTopUpDetails` (`cardholder_name`, `card_number`, `security_code`, `expiry_date`, `ei_userid`, `save_id`) 
			VALUES ('$cardholderid', '$card_number', '$securitycodeid', '$expirydate3id', '$user_id', NULL);";
			$result = mysql_query($insert_query);
			
			if($result)
			{
				echo "Saved";
			}
			else
			{
				echo "Failure";
			}
	}
?>﻿