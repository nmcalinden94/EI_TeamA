<?php
//PHP script for showing users details in my account page
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	$myAccount_id = $_SESSION['user-id'];   
	
	require_once 'DB_connect.php';
	
	//Insert if the account number doesn't already exist
	$query = "SELECT * from `ei_user` WHERE `ei_userid` = '$myAccount_id'";	
	$result = mysql_query($query); 
	$row = mysql_fetch_array($result);
	$userMyAccount_array = array();
	
	for($i = 0; $i < 5; $i++)
	{
		array_push($userMyAccount_array, $row[$i]);
	}
	
	$myAccount_Business = $userMyAccount_array[0];
	$myAccount_No = $userMyAccount_array[1];
	$myAccount_MPRN = $userMyAccount_array[2];
	
	//Link User ID
	$user_id = $_SESSION['user-id'];
	
	//Direct Debit Check
	$query1 = "SELECT * from `ei_saveDirectDebit` WHERE `ei_userid` = '$user_id'";
	$result1 = mysql_query($query1); 	
	$row1 = mysql_fetch_array($result1);
	$userDirectDebit_array = array();
	
	for($j = 0; $j < 5; $j++)
	{
		array_push($userDirectDebit_array, $row1[$j]);
	}
	
	$directDebit_Amount = $userDirectDebit_array[0];
	$directDebit_Name = $userDirectDebit_array[1];
	$directDebit_Sort = $userDirectDebit_array[2];
	$directDebit_Number = $userDirectDebit_array[3];
	$directDebit_Date = $userDirectDebit_array[4];
	
	//Card Check
	$query3 = "SELECT * from `ei_saveTopUpDetails` WHERE `ei_userid` = '$user_id'";
	$result3 = mysql_query($query3); 	
	$row3 = mysql_fetch_array($result3);
	$userLoadCard_array = array();
	
	for($z = 0; $z < 5; $z++)
	{
		array_push($userLoadCard_array, $row3[$z]);
	}
	
	$loadCard_Name = $userLoadCard_array[0];
	$loadCard_Number = $userLoadCard_array[1];
	$loadCard_Code = $userLoadCard_array[2];
	$loadCard_Date = $userLoadCard_array[3];
	$loadCard_Date2 = $userLoadCard_array[4];		
?>﻿