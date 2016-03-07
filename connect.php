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
	
	 $_SESSION['user-id'] = $row['ei_userid'];

    if (mysql_num_rows($result) == 1) {
        header('Location: index.html');
        die();
    }
?>﻿