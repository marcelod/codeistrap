

// adapt input/select to bootstrap
function adaptInputBootstrap(oTable) {
	oTable.each(function() {
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
}

function removeDialogHidden(elementModal) {
	$(elementModal).on('hidden.bs.modal', function() {
		$('.modal-dialog').remove();
	});
}



function ajaxSendForm(modalAtivo, form) {
	var idForm = "#" + form.attr('id');
	var queryString = $(idForm).formSerialize();

	$(idForm).ajaxSubmit({
		type: 'POST',
		url : form.attr('action'),
		data: queryString,
		success : function( resp ) {

			var resp = $.parseJSON(resp);
        
			if(resp.success === true)
			{
				if(typeof resp.msg !== "undefined")
					alert(resp.msg);

				parent.oTable.fnReloadAjax();
				$("#" + modalAtivo).modal('hide');				
			}
			else
			{
				$("#msg").html(resp.msg);
			}

		}
	});
}


$(document).ready(function() {

	// acao para salvar
  	$("#save").livequery(function () {
  		$(this).click(function(event) {
  			event.preventDefault();
			ajaxSendForm("create", $('form.form-dialog'));
  		});
  	});

  	// acao para editar
  	$("#saveEdit").livequery(function () {
  		$(this).click(function(event) {
			event.preventDefault();

			ajaxSendForm("edit", $('form.form-dialog-edit'));
		});
	});

	// acao para configurar
	$("#saveConfig").livequery(function () {
  		$(this).click(function(event) {
			event.preventDefault();

			ajaxSendForm("conf", $('form.form-dialog-config'));
		});
	});

	// acao para remover
	$("#remove").livequery(function () {
  		$(this).click(function(event) {
			event.preventDefault();

			ajaxSendForm("delete", $('form.form-dialog-remove'));
		});
	});

		// em configuraçõe do usuário, ao clicar nos checkbox das roles
		// pego as permissões referentes e as mantenho no mesmo estado da role clicada
	$("#collapseRoles input").livequery(function () {
  		$(this).click(function(event) {
			var formModal = $('form.form-dialog-config');

			var checkStatus = this.checked;
			var roleValue	= this.value;

			var permissions = $('#collapsePermissions input');

			$.ajax({
				url: 'ajax/getPermissionsRole',
				type: 'POST',
				data: formModal.serialize() + "&roleId=" + roleValue,
				success: function(resp) {
					var resp = $.parseJSON(resp);

					if(resp.success === true)
					{
						permissions.each(function(index, el) {
							if($.inArray(el.value, resp.permissions) > -1)
							{
								$(el).prop('checked', checkStatus);
							}
						});
					}
				}
			});
		});
	});


});

