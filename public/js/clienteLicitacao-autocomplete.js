
	var licitacaoCliente_cod = null;
	document.getElementById("numeroLicitacao").disabled = false;
	$('#cadastroCliente').slideUp();
	
		var optionscliente = {
			url: function (cliente) {
				//return "http://coisavirtual.com.br/clienteLicitacao/autoComplete/" + cliente; //hospedagem
				//return "http://localhost:81/SOMVC/clienteLicitacao/autoComplete/" + cliente;
				return "http://localhost/SOMVC/clienteLicitacao/autoComplete/" + cliente;
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
						$('#clienteLicitacao-autocomplete').val('Cliente não encontrado!');
						$('#cadastroCliente').slideDown();
					
					}
				}
			}
		};
		$("#clienteLicitacao-autocomplete").easyAutocomplete(optionscliente);