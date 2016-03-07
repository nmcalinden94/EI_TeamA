$(document).ready(function(){
    $('#paymentsMade_table td.Status').each(function(){
        if ($(this).text() == 'Completed') {
            $(this).css('color','#58A618');
        }
		else if ($(this).text() == 'Failed') {
            $(this).css('color','red');
        }
    });
	
	
	$('#paymentsDue_table').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true,
                    "iDisplayLength": 5
                });
				
    $('#paymentsMade_table').dataTable({
					"bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true,
                    "iDisplayLength": 5
                });
	
});