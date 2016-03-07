//Function for updating card details 
function saveCardDetails() {		
		
		//variables
		var cardholderid =($('#cardholderid').val());
		var card_number = $('#card_number').val();
		var securitycodeid = $('#securitycodeid').val();
		var expirydate3id = $('#expirydate3id').val();
		
		
		
		if(cardholderid != 0)
		{
		//ajax call to edit details
		$.ajax({
			url:"saveTopUpDetails.php", //the page containing php script
			type: "POST", //request type
			data: {cardholderid : cardholderid, card_number : card_number, securitycodeid : securitycodeid, expirydate3id : expirydate3id},
			success:function(result){
				if (result == "Success")
				{
					document.getElementById("errorMessage_savePayment").removeAttribute('hidden');
					document.getElementById("errorMessage_savePayment").innerHTML = "Saved";
				}
				else{
					document.getElementById("errorMessage_savePayment").removeAttribute('hidden');
					document.getElementById("errorMessage_savePayment").innerHTML = "Already Saved";
					document.getElementById("cardholderid").value = "";
					document.getElementById("card_number").value = "";
					document.getElementById("securitycodeid").value = "";
					document.getElementById("expirydate3id").value = "";
				}
			}
		});
 }
 else
 {
 					document.getElementById("errorMessage_savePayment").removeAttribute('hidden');
					document.getElementById("errorMessage_savePayment").innerHTML = "Not Valid";
 }
 }