var item = null;

var app = {	
	num_maximo_produto: 10,
	arrayProdutos: [],	

	adicionaProduto: function(produto)
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
					'<td>'+produto.produto+'<input type="hidden" value="'+produto.idproduto+'" name="produtos[]"></td>'+
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
		app.arrayProdutos.splice(index,1);
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
		return "http://localhost/SOMVC/produto/autocomplete/" + produto;
	},

	getValue: function(element) {
		return element.produto;
	},

	list: {
		onChooseEvent: function() {		
			item = $("#autocomplete-produto").getSelectedItemData();

			if(app.arrayProdutos.length < app.num_maximo_produto){				
				if(app.arrayProdutos.indexOf(item.idproduto) < 0){	
					app.adicionaProduto(item);
				}else{					
					app.exibeMensagem('O produto <b>'+ item.produto +'</b> já foi selecionada.');
					$("#autocomplete-produto").val('');
				}
			}else{
				app.exibeMensagem('O número máximo <b>('+ app.num_maximo_produto +')</b> de produto foi atingido.');
				$("#autocomplete-produto").val('');			
			}
		},

		onHideListEvent: function(){			
			$("#autocomplete-produto").val('');	
			item = null;
		}
	}
};

$("#autocomplete-produto").easyAutocomplete(optionsProdutos);
