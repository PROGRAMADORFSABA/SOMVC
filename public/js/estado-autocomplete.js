var estid = null;

var optionsEstado = {
	url: function(estado) {
		return "http://localhost/SOMVC/estado/autoComplete/" + estado;
	},

	getValue: function(element) {
		return element.estnome  + " - " + element.estuf;
	},

	list: {		
		onChooseEvent: function() {	
			estid = $("#estado-autocomplete").getSelectedItemData().estid;		
			$('#estado').val(estid);			
		},

		onHideListEvent: function(){
			if(estid == null){
				$("#estado-autocomplete").val('');	
			}		
		}

	}
};

$("#estado-autocomplete").easyAutocomplete(optionsEstado);
