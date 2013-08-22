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
		// 	$("#create").colorbox({iframe:true, width:"80%", height:"80%"});
		// 	$("#create").colorbox({iframe:true, width:"80%", height:"80%"});
		// }
	});

	// adapt input/select to bootstrap
	oTable.each(function(){
		var dt = $(this);

		var dtWrapper = dt.closest('.dataTables_wrapper');
		// SEARCH - Add the placeholder for Search and Turn this into in-line formcontrol
	    var search_input = dtWrapper.find('div[id$=_filter] input');
	    	search_input
	    		.attr('placeholder', 'Buscar')
	    		.addClass('form-control');
	    // LENGTH - Inline-Form control
	    var length_sel = dtWrapper.find('div[id$=_length] select');
		    length_sel.addClass('form-control');
		// LENGTH - Info adjust location
	    var length_sel = dtWrapper.find('div[id$=_info]');
	    	length_sel.css('margin-top', '18px');
	});	

});


