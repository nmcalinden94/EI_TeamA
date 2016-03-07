<?php
//PHP script for showing users details in my account page
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	require_once 'DB_connect.php';
	   
	$check_Password = $_POST["password"];
	$new_Password = $_POST["newPassword"];
	$user_id = $_SESSION['user-id'];
	
	$hashquery = "SELECT * FROM `ei_user` WHERE `ei_userid`= '$user_id'";
	$hashresult = mysql_query($hashquery);
	$hashrow = mysql_fetch_array($hashresult);
	$hashpass = $hashrow['password'];
	
	$query = "SELECT * FROM `ei_user` WHERE `ei_userid`= '$user_id' AND `password`='$hashpass'";
	$result = mysql_query($query);
	
	if (mysql_num_rows($result) == 1)
	{	
		$options = ['cost' => 11,];
		$hash_newPass = password_hash($new_Password, PASSWORD_BCRYPT, $options);
		$update_query = "UPDATE `ei_user` SET `password`='$hash_newPass' WHERE `ei_userid`='$user_id'";
		
		$update_query_result = mysql_query($update_query);
		
		if($update_query_result)
		{
			echo 1;
		}
		else{
			echo 0;
		}
	}
	else{
		echo 0;
	}
	
	
	
?>﻿