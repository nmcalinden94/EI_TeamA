$(document).ready(function(){
	
	$('#paymentsMade_table').on('click', '.clickable-row', function(event) {
	$(this).addClass('active').siblings().removeClass('active');
  
  
	ei_Statements.payment_Made = $(this).closest("tr").find('td:eq(2)').text();
	ei_Statements.date_Of_Issue = $(this).closest("tr").find('td:eq(0)').text();
	ei_Statements.total_Payment = $(this).closest("tr").find('td:eq(1)').text();
	ei_Statements.processed = $(this).closest("tr").find('td:eq(3)').text();
	ei_Statements.invoice_No = $(this).closest("tr").find('td:eq(4)').text();
	
	var userDetails = <?php echo json_encode($_SESSION['user_info']); ?>;
	
	user_Details.accountNumber = userDetails[2];
	user_Details.MPRN = userDetails[3];
	user_Details.business_Name = userDetails[1];
	
	var additionalDetails = <?php require_once '../extraDetails.php'; echo json_encode($userExtra_array); ?>;
	
	user_Details.business_Address = additionalDetails[1];
	user_Details.postcode = additionalDetails[2];
	user_Details.city = additionalDetails[3];
  
    if (ei_Statements.payment_Made == "Direct Debit Paid")
	{
		document.getElementById("pdfBill").disabled = false;
	}
	else
	{
		document.getElementById("pdfBill").disabled = true;
	}
  
});
});