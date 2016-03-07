<?php
//PHP script for saving direct debits

	//session code
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
    	echo "";
	} 
	else 
	{
    	echo "Please log in first to see this page.";
		header('Location: ../../login.php');
		die();
	}

	//Connect Database
	require_once '../../DB_connect.php';
	
	//Link User ID
	$user_id = $_SESSION['user-id'];
	
	//Passed variables from html
	$inputamountid = mysql_real_escape_string($_POST["debittype"]);
	$inputaccountnameid = mysql_real_escape_string($_POST["accountnameid"]);
	$inputsortcodeid = mysql_real_escape_string($_POST["sortcodeid"]);
	$inputaccountnumberid = mysql_real_escape_string($_POST["accountnumberid"]);
	$inputdebitdateid = mysql_real_escape_string($_POST["directdebitdate3id"]);
		
		//Insert if the Account Number doesn't already exist
		$query = "INSERT INTO `ei_saveDirectDebit` (`debit_amount`, `account_name`, `sort_code`, `account_number`, `direct_debit_date`, `ei_userid`, `direct_debit_id`) 
		VALUES ('$inputamountid', '$inputaccountnameid', '$inputsortcodeid', '$inputaccountnumberid', '$inputdebitdateid', '$user_id', NULL);";
		$result = mysql_query($query); 
		
		//Get Reference Number
		$sql = "SELECT `direct_debit_id` FROM `ei_saveDirectDebit` WHERE `ei_userid` = '$user_id' ORDER BY `direct_debit_id` DESC LIMIT 1";
		$result1 = mysql_query($sql);
		$rs = mysql_fetch_array($result1);
		$result2 = $rs['direct_debit_id'];
		$_SESSION['result2'] = $result2;
		
		if ($result) 
		{
			header('Location: DirectDebitFeedback.php?debittype='.$_POST['debittype']."&accountnameid=".$_POST['accountnameid']."&sortcodeid=".$_POST['sortcodeid']."&accountnumberid=".$_POST['accountnumberid']."&directdebitdate3id=".$_POST['directdebitdate3id']);
			die();
		}
		else
		{	
			header('Location: DirectDebitFeedbackFail.php?debittype='.$_POST['debittype']."&accountnameid=".$_POST['accountnameid']."&sortcodeid=".$_POST['sortcodeid']."&accountnumberid=".$_POST['accountnumberid']."&directdebitdate3id=".$_POST['directdebitdate3id']);
			die();
		}
?>﻿

