var item = null;

var app = {	
	num_maximo_produto: 10,
	arrayTecnologias: [],	

	adicionaProduto: function(Produto)
	{
		if($('tr').length >10)
		{
			app.exibeMensagem('O número máximo <b>('+ app.num_maximo_produto +')</b> de produto foi atingido.');
			$("#autocomplete-produto").val('');
		}else{
			if($('td:contains('+ produto.produto +')').length > 0){
				this.exibeMensagem('O Produto <b>'+ produto.produto +'</b> já foi selecionada.');
			}else{
				$('#editar-tabela-produto').append('<tr>'+
					'<td>'+produto.produto+'<input type="hidden" value="'+produto.idproduto+'" name="produto[]"></td>'+
					'<td><a class="btn btn-danger btn-sm" onClick="app.removeProduto(this,'+ produto.idproduto +')">remover</td>'+
					'</tr>');			
				$("#autocomplete-produto").val('');
				app.arrayProdutos.push(produto.idproduto);
			}
		}		
	},

	removeProduto: function(tr,produto)
	{
		var tr = $(tr).closest('tr');	
		tr.remove();  	

		var index = app.arrayProdutos.indexOf(String(produto));	
		app.arrayTecnologias.splice(index,1);
	},

	exibeMensagem: function(mensagem)
	{
		$('#div-modal').html('');
		$('#div-modal').append(mensagem);
		$('#modal-produtos').modal();
	}
}



var optionsProdutos = {

	url: function(produto) {
		return "http://localhost/mvc-mestre-detalhe/produto/autoComplete/" + produto;
	},

	getValue: function(element) {
		return element.produto;
	},

	list: {
		onChooseEvent: function() {		
			item = $("#autocomplete-produto").getSelectedItemData();

			if(app.arrayTecnologias.length < app.num_maximo_tecnologias){				
				if(app.arrayTecnologias.indexOf(item.idtecnologia) < 0){	
					app.adicionaTecnologia(item);
				}else{					
					app.exibeMensagem('A tecnologia <b>'+ item.tecnologia +'</b> já foi selecionada.');
					$("#autocomplete-tecnologia").val('');
				}
			}else{
				app.exibeMensagem('O número máximo <b>('+ app.num_maximo_tecnologias +')</b> de tecnologias foi atingido.');
				$("#autocomplete-tecnologia").val('');			
			}
		},

		onHideListEvent: function(){			
			$("#autocomplete-tecnologia").val('');	
			item = null;
		}
	}
};

$("#autocomplete-tecnologia").easyAutocomplete(optionsTecnologias);
