var codCliente = null;

var optionscliente = {
	url: function(cliente) {
		return "http://localhost/SOMVC/cliente/autoComplete/" + cliente;
	},

	getValue: function(element) {
		return element.nomeFantasiaCliente;
	},

	list: {		
		onChooseEvent: function() {	
			codCliente = $("#cliente-autocomplete").getSelectedItemData().codCliente;		
			$('#cliente').val(codCliente);			
		},

		onHideListEvent: function(){
			if(codCliente == null){
				$("#cliente-autocomplete").val('');	
			}		
		}

	}
};

$("#cliente-autocomplete").easyAutocomplete(optionscliente);
