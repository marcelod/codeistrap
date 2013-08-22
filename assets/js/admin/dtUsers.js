var oTable;

$(document).ready(function() {

	var fhc = $("input[name=csrf_test_name]").val();

	oTable = $('#users').dataTable( {
		"bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "admin/users/getDataTable",

        "fnServerParams": function ( aoData ) {
	    	aoData.push( { "name": "csrf_test_name", "value": fhc } );
	    },

        "fnServerData": function(sSource, aoData, fnCallback) {
        	$.ajax(
		          {
		            'dataType': 'json',
		            'type'    : 'POST',
		            'url'     : sSource,
		            'data'    : aoData,
		            'success' : fnCallback
		          }
		      );
		}
	       
		// "fnDrawCallback": function ( oSettings ) {
		// 	$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		// }
	});



	$('#users label select').addClass('form-control');
	$('#users label input').addClass('form-control');

});


