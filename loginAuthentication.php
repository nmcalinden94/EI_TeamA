<?php
//PHP script for logging in
///Code needed to deal with if the result doesn't exist

	session_start();
	
	require_once 'DB_connect.php';
	
    $inputuser = mysql_real_escape_string($_POST["accountid"]);
    $inputpass = mysql_real_escape_string($_POST["password"]);

    $query = "SELECT * FROM `ei_user` WHERE `account_number`= '$inputuser' AND `password`='$inputpass'";

    $result = mysql_query($query); 
	
	$row = mysql_fetch_array($result);

	
    if (mysql_num_rows($result) == 1) {
        header('Location: index.php');
		
		
		//adding User Details for future reference throughout application
		$_SESSION['user-id'] = $row['ei_userid'];
		$_SESSION['business'] = $row['Business'];
		$_SESSION['account_no'] = $row['account_number'];
		$_SESSION['mprn'] = $row['mprn'];
		
		$_SESSION['user_info'] = array();
		array_push($_SESSION['user_info'], $_SESSION['user-id']);
		array_push($_SESSION['user_info'], $_SESSION['business']);
		array_push($_SESSION['user_info'], $_SESSION['account_no']);
		array_push($_SESSION['user_info'], $_SESSION['mprn']);
		
        die();
    }

?>﻿