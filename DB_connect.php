<?php

//Edit details with your own SQL account

	$user = "root";
    $password = "KHGG87CM74";
    $database = "electricireland";

    $connect = mysql_connect("localhost", $user, $password);
    @mysql_select_db($database) or ("Database not found");
	
?>﻿