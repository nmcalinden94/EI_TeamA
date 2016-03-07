<?php
//PHP script for showing additional details in my account page
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	$myAccount_id = $_SESSION['user-id'];   
	
	require_once 'DB_connect.php';
	
	//Insert if the account number doesn't already exist
	$query = "SELECT * from `ei_extrainfo` WHERE `ei_userid` = '$myAccount_id'";
	
	
	$result = mysql_query($query); 
	
	
	$row = mysql_fetch_array($result);
	
	$userExtra_array = array();
	
	for($i = 0; $i < 5; $i++)
	{
		array_push($userExtra_array, $row[$i]);
	}
	
	$my_Address = $userExtra_array[1];
	$my_Postcode = $userExtra_array[2];
	$my_City = $userExtra_array[3];
	$my_Email = $userExtra_array[4];
	
	

	
	
?>