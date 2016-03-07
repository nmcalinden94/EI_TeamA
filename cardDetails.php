<?php
//PHP script for showing card details in my account page
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	$myAccount_id = $_SESSION['user-id'];   
	
	require_once 'DB_connect.php';
	
	//Insert if the account number doesn't already exist
	$query = "SELECT * from `ei_carddetails` WHERE `ei_userid` = '$myAccount_id'";
	
	
	$result = mysql_query($query); 
	
	
	$row = mysql_fetch_array($result);
	
	$userCard_array = array();
	
	for($i = 0; $i < 6; $i++)
	{
		array_push($userCard_array, $row[$i]);
	}
	
	$myCard_Name = $userCard_array[1];
	$myCard_AccountNo = $userCard_array[2];
	$myCard_sortCode = $userCard_array[3];
	$myCard_Expiry = $userCard_array[4];
	$myCard_Security = $userCard_array[5];

	
	
?>