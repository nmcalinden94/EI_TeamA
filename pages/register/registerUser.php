<?php
//PHP script for registration
///Code needed to deal with if the result doesn't exist

	session_start();
	
	require_once '../../DB_connect.php';
	
	
	//Passed variables from html
    $inputAccountID = mysql_real_escape_string($_POST["register_AccountID"]);
    $inputMPRN = mysql_real_escape_string($_POST["register_MPRN"]);
	$inputPASS = mysql_real_escape_string($_POST["register_Password"]);
	$inputConfirm = mysql_real_escape_string($_POST["register_ConfirmPassword"]);
	
	
	if($inputPASS == $inputConfirm)
	{
		
		$unique_Check = "SELECT `ei_userid` FROM `ei_user` WHERE `account_number` = '$inputAccountID'";
		
		$unique_Result = mysql_query($unique_Check);
		
		
		if (mysql_num_rows($unique_Result) == 0)
		{
			//Insert if the account number doesn't already exist
			$query = "INSERT INTO `ei_user` (`Business`, `account_number`, `mprn`, `password`, `ei_userid`) VALUES ('N/A', '$inputAccountID', '$inputMPRN', '$inputPASS', NULL)";
	
			$result = mysql_query($query); 
		
			if ($result) {
				header('Location: ../../login.html');
				die();
			}
			else{
			
				//Add code in to throw error on page instead
				echo "SQL ERROR";
			
				die();
				}
		}
		else{
		
			//Add code in to throw error instead
			echo "User already registered";
			die();
		}
			
			
	}
	else{
			echo "Password failed to match";
			
		}

    
?>﻿