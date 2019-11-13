var item = null;

var app = {	
	num_maximo_tecnologias: 100,
	arrayTecnologias: [],	

	adicionaTecnologia: function(teste)
	{
		if($('tr').length > 100)
		{
			app.exibeMensagem('O número máximo <b>('+ app.num_maximo_tecnologias +')</b> de tecnologias foi atingido.');
			$("#teste-autocomplete").val('');			
		}else{
			if($('td:contains('+ teste.codCliente +')').length > 0){
				this.exibeMensagem('A tecnologia <b>'+ teste.codCliente +'</b> já foi selecionada.');
			}else{
				$('#editar-tabela-clientes').append('<tr>'+
					'<td>'+teste.codCliente+'<input type="hidden" value="'+teste.codCliente+'" name="clientes[]"></td>'+
					'<td>'+teste.nomeFantasiaCliente+'<input type="hidden" value="'+teste.codCliente+'" name="clientes[]"></td>'+
					'<td><a class="btn btn-danger btn-sm" onClick="app.removeTecnologia(this,'+ teste.codCliente +')">remover</td>'+
					'</tr>');			
				$("#teste-autocomplete").val('');		
				app.arrayTecnologias.push(teste.codCliente);
			}
		}		
	},

	removeTecnologia: function(tr,teste)
	{
		var tr = $(tr).closest('tr');	
		tr.remove();  	

		var index = app.arrayTecnologias.indexOf(String(teste));	
		app.arrayTecnologias.splice(index,1);
	},

	exibeMensagem: function(mensagem)
	{
		$('#div-modal').html('');
		$('#div-modal').append(mensagem);
		$('#modal-tecnologias').modal();
	}
}



var optionsTeste = {

	url: function(teste) {
		//return "http://coisavirtual.com.br/teste/autoComplete/" + teste;
		return "http://localhost/SOMVC/teste/autoComplete/" + teste;
	},
	getValue: function(element) {
        return element.nomeFantasiaCliente;       
	},
	list: {
		onChooseEvent: function() {		
			item = $("#teste-autocomplete").getSelectedItemData();
			//codCliente= $("#teste-autocomplete").getSelectedItemData().codCliente;
             //$('#teste').val(codCliente);	
			if(app.arrayTecnologias.length < app.num_maximo_tecnologias){				
				if(app.arrayTecnologias.indexOf(item.codCliente) < 0){	
					app.adicionaTecnologia(item);
				}else{					
					app.exibeMensagem('A tecnologia <b>'+ item.nomeFantasiaCliente +'</b> já foi selecionada.');
					$("#teste-autocomplete").val('');
				}
			}else{
				app.exibeMensagem('O número máximo <b>('+ app.num_maximo_tecnologias +')</b> de tecnologias foi atingido.');
				$("#teste-autocomplete").val('');			
			}
		},
		onHideListEvent: function(){
            /*if(codCliente == null){
			$("#teste-autocomplete").val('');	
            }	
			$("#teste-autocomplete").val('');	*/
			item = null;
		}
	}
};
$("#teste-autocomplete").easyAutocomplete(optionsTeste);
		