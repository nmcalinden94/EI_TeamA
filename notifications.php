<?php
//PHP script for user notifications
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
    	echo "";
	} 
	else 
	{
    	echo "Please log in first to see this page.";
		header('Location: login.php');
		die();
	}
	$userId = $_SESSION['user-id'];
	//Connect Database
	require_once 'DB_connect.php';
	
	//Link User ID
	$user_id = $_SESSION['user-id'];
	
	$query = "SELECT * FROM `ei_saveDirectDebit` WHERE IF(DAY(CURRENT_DATE()) = 1,
    DAY( `direct_debit_date` ) >= DAY(DATE_SUB( NOW() + INTERVAL 1 DAY, INTERVAL 1 DAY )),
    DAY( `direct_debit_date` ) = DAY(DATE_SUB( NOW() + INTERVAL 1 DAY, INTERVAL 1 DAY ))
	) AND  MONTH(direct_debit_date) <= MONTH(NOW()) AND `ei_userid`= '$userId'";
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$_SESSION['number_rows'] = $num_rows;
	$_SESSION['text_number_rows']= 'You have '.$num_rows .' debit payments today';
	$_SESSION['notifications'] = array();
		while(($row =  mysql_fetch_assoc($result))) {
			array_push($_SESSION['notifications'], '£'.$row['debit_amount']. ' will be payed today');
		}
?>﻿