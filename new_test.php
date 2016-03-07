<?php

	$user = "root";
    $password = "KHGG87CM74";
    $database = "electricireland";
	
	$uid = (isset($_POST['userID'])) ? $_POST['userID'] : 0;
	
    $connect = mysql_connect("localhost", $user, $password);
    @mysql_select_db($database) or ("Database not found");
	
    
							 //Hard coded value 2
	$sql = "SELECT * FROM `ei_billing` WHERE `user_id` = '$uid'"; 
	$result = mysql_query($sql);
								 
								 while ($row = mysql_fetch_array($result)) { ?>
          <tr class="clickable-row">
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
          </tr>
		  
		  
<?php } 

?>