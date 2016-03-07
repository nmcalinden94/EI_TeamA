<?php
//Script for editing or updating additional details of logged in user
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	require_once 'DB_connect.php';
	
	$my_Business = $_POST["my_Business"];
	$my_Address = $_POST["my_Address"];
	$my_Postcode = $_POST["my_Postcode"];
	$my_City = $_POST["my_City"];   
	$my_Email =  $_POST["my_Email"];
	$user_id = $_SESSION['user-id'];
	
	
	//Insert if the account number doesn't already exist
	//$query = "UPDATE `ei_user` SET `Business`='$my_Business' WHERE `ei_userid`='$user_id'";
	

	//Insert if the account number doesn't already exist
	$checkExists = "SELECT `ei_userid` FROM `ei_extrainfo` WHERE `ei_userid` = '$user_id'";
			
			
	$check_result = mysql_query($checkExists);
	
	$rowCount = mysql_num_rows($check_result);
	
	//if result found from check then update - else insert new line of details in relation to logged in user
	if ($rowCount == 1) 
	{
		$update_query = "UPDATE `ei_extrainfo` SET `Address`='$my_Address', `Postcode`='$my_Postcode', `City`='$my_City', `e-mail`='$my_Email' WHERE `ei_userid`='$user_id'";
		
		//Below line needs fixed for second sprint
		$update_business = "UPDATE `ei_user` SET `Business`='$my_Business' WHERE `ei_userid`='$user_id'";
			
		$result = mysql_query($update_query);
		
		$business_Result = mysql_query($update_business);
			
		if($result)
		{
			echo "Updated";
			$_SESSION['business'] = $my_Business;
		}
		else 
		{
			echo "Failure";
		}
	}
	else{
		$insert_query = "INSERT INTO `ei_extrainfo` (`ei_userid`, `Address`, `Postcode`, `City`, `e-mail`) VALUES ('$user_id', '$my_Address', '$my_Postcode', '$my_City', '$my_Email') ";
		
		$insert_business = "UPDATE `ei_user` SET `Business`='$my_Business' WHERE `ei_userid`='$user_id'";
		$result = mysql_query($insert_query);
			
		if($result)
		{
			echo "Saved";
			$_SESSION['business'] = $my_Business;
		}
		else
		{
			echo "Failure";
		}
	}
	
	
?>﻿