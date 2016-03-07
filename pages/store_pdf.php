<?php 

session_start();


	if(!empty($_POST['data'])){
			$data = base64_decode($_POST['data']);
			$businessName =  $_SESSION['business'];
			$variable = explode(",", $_GET["variable"]);
			$fname = $businessName . $variable[0] . "_Direct_Debit.pdf"; // name the file
			$file = fopen("pdf/" .$fname, 'w'); // open the file path
			fwrite($file, $data); //save data
			fclose($file);
		} 
		else {
			echo "No Data Sent";
			echo $date;
		}
?>