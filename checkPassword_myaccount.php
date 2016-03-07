<?php
//PHP script for showing users details in my account page
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	require_once 'DB_connect.php';
	   
	$check_Password = $_POST["checkPassword"];
	$user_id = $_SESSION['user-id'];
	
	
	//See if a row comes back - if so passwords match
	$checkPassword_query = "SELECT `ei_userid` FROM `ei_user` where `ei_userid`='$user_id' AND `password`='$check_Password'";
	
	$checkPassword_result = mysql_query($checkPassword_query); 
	
	$num_rows = mysql_num_rows($checkPassword_result);
	
	echo $num_rows;
	
?>﻿