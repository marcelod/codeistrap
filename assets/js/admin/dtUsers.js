var oTable;

$(document).ready(function() {

	var fhc = $("input[name=csrf_test_name]").val();

	oTable = $('#users').dataTable( {
		"bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "admin/users/getDataTable",

        'aoColumnDefs': [
            { "sWidth": "50px",  "aTargets": [ 0 ], "sClass" : "hidden-xs" },  //id
            { "sWidth": "70px", "aTargets": [ 3 ], "sClass" : "text-center hidden-xs" }, //sexo
            { "bVisible": false, "aTargets": [ 4 ] }, //confirmed
            { "bVisible": false, "aTargets": [ 5 ] }, //active
            { "sWidth": "100px", "bSearchable": false, "bSortable": false, "aTargets": [ 6 ]} //acoes
        ],

        "fnServerParams": function ( aoData ) {
	    	aoData.push( { "name": "csrf_test_name", "value": fhc } );
	    },

        "fnServerData": function(sSource, aoData, fnCallback) {
        	$.ajax({
        		'dataType': 'json',
	            'type'    : 'POST',
	            'url'     : sSource,
	            'data'    : aoData,
	            'success' : fnCallback		          
        	});
		},

		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			var aDataConfirmed = aData[4];
			var aDataActive    = aData[5];
			
			if(aDataConfirmed === "0") {
				$(nRow).addClass('danger');
			} else if(aDataActive === "0") {
				$(nRow).addClass('warning');
			}
        },  

        "fnDrawCallback": function ( oSettings ) {
			// CREATE NEW ELEMENT
			$('a#new').click(function(){
				$('#create').load('admin/users/create', function(){
					$('#create').modal();
					removeDialogHidden("#create");
				});
			});

			//CONFIG
			$('a.conf_row_dt').click(function(e) {
				var user_id = $(this).data('id');
				$('#conf').load('admin/users/config', {id : user_id, csrf_test_name: fhc}, function(){
					$('#conf').modal();
					removeDialogHidden("#conf");
				});
			});

			//EDIT
			$('a.edit_row_dt').click(function(e) {
				var user_id = $(this).data('id');
				$('#edit').load('admin/users/edit', {id : user_id, csrf_test_name: fhc}, function(){
					$('#edit').modal();
					removeDialogHidden("#edit");
				});
			});

			// ACTIVE/INACTIVE
			$('a.active_row_dt').click(function(e) {
				e.preventDefault();

				var link = $(this).attr('href');

				$.get(link, function() {
					oTable.fnReloadAjax();
				});				
			});

			//DELETE
			$('a.delete_row_dt').click(function() {
				var user_id = $(this).data('id');
				$('#delete').load('admin/users/delete', {id : user_id, csrf_test_name: fhc}, function(){
					$('#delete').modal();
					removeDialogHidden("#delete");
				});
			});			
		}
	});

	// adapt input/select to bootstrap
    adaptInputBootstrap(oTable);

});
