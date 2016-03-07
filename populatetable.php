<?php

	$user = "root";
    $password = "KHGG87CM74";
    $database = "electricireland";

    $connect = mysql_connect("localhost", $user, $password);
    @mysql_select_db($database) or ("Database not found");
	
    
							 //Hard coded value 2
	$sql = "SELECT * FROM `ei_billing` WHERE `user_id` = 2"; 
	$result = mysql_query($sql)or die(mysql_error());
	
	while($fetch = mysql_fetch_array($result))
{
$output[] = array ($fetch[0],$fetch[1],$fetch[2],$fetch[3],$fetch[4]);
}
echo json_encode($output);

	/*$result = mysql_query($sql)or die(mysql_error());
								 
								 while ($row = mysql_fetch_array($result)) { ?>
          <tr class="clickable-row">
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
          </tr>*/
		  
		  
?>