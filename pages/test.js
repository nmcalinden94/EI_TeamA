$('#example3').on('click', '.clickable-row', function(event) {
  $(this).addClass('active').siblings().removeClass('active');
  
  
	var payment = $(this).closest("tr").find('td:eq(1)').text();
  
    if (payment == "Direct Debit Paid")
	{
		document.getElementById("pdfBill").disabled = false;
	}
	else
	{
		document.getElementById("pdfBill").disabled = true;
	}
  
});