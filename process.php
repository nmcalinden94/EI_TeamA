<?php

   $username=$_POST['accountid']; //now you have the username in a variable

   mysql_connect('localhost', 'root', 'KHGG87CM74');
   mysql_select_database("electricireland");
   mysql_query("insert into users(username) values('".$username."')");
?>