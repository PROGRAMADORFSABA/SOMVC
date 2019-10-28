
	var licitacaoCliente_cod = null;
	$('#cadastroCliente').slideUp();
		var optionscliente = {
			url: function (cliente) {
				//return "http://coisavirtual.com.br/clienteLicitacao/autoComplete/" + cliente; //hospedagem
				return "http://localhost:81/SOMVC/clienteLicitacao/autoComplete/" + cliente;
			},

			getValue: function (element) {
					return element.razaosocial;
			},

			list: {
				onChooseEvent: function () {
					licitacaoCliente_cod = $("#clienteLicitacao-autocomplete").getSelectedItemData().licitacaoCliente_cod;
					$('#cliente').val(licitacaoCliente_cod);
					$('#cadastroCliente').slideUp();
				},

				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#clienteLicitacao-autocomplete').val('');
						$('#cadastroCliente').slideDown();
					}
				}
			}
		};
		$("#clienteLicitacao-autocomplete").easyAutocomplete(optionscliente);
/*	
$(document).ready(function () {
	$('#clientePesquisa').keyup(function (e) {
		e.preventDefault();
		
		var cliente = $(this).val();
		$.ajax({
			url: "http://localhost/SOMVC/cliente/PesquisarCliente",
			type: "POST",
			async: true,
			data: { cliente: cliente },
			success: function (resultado) {
				
				if (resultado  == '[]' ) {					
					$('#clientePesquisa').val('');
					$('#andreteste').val('');
					$('#clienteCad').slideDown();
				}else{
					$('#clienteCad').slideUp();					
					var dados = $.parseJSON(resultado);					
					 $('#andreteste').val(dados[0].nomeCliente);
					 console.log(dados);
					}
				}, 
				error: function (error) {
					console.log(error);
				}
			});
			
		});
		$("#clientePesquisa").easyAutocomplete(resultado);
});
*/