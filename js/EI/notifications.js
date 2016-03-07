$(document).ready(function(){
	$('#notifications_table').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true,
                    "iDisplayLength": 5
                });
});