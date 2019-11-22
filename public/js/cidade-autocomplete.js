var cidId = null;

var optionsCidade = {
	url: function(cidade) {
		//return "http://www.coisavirtual.com.br/cidade/autoComplete/" + cidade;
		return "http://localhost/SOMVC/cidade/autoComplete/" + cidade;
	},

	getValue: function(element) {
		return element.nomefantasia;
	},

	list: {		
		onChooseEvent: function() {	
			cidId = $("#cidade-autocomplete").getSelectedItemData().cidId;		
			$('#empresa').val(cidId);			
		},

		onHideListEvent: function(){
			if(cidId == null){
				$("#cidade-autocomplete").val('');	
			}		
		}

	}
};

$("#cidade-autocomplete").easyAutocomplete(optionsCidade);
