
	var codCliente = null;
	$('#cadastroCliente').slideUp();
		var optionscliente = {
			url: function (cliente) {
					//return "http://coisavirtual.com.br/cliente/autoComplete/" + cliente; //hospedagem
				return "http://localhost:81/SOMVC/cliente/autoComplete/" + cliente;
			},

			getValue: function (element) {
					return element.nomeFantasiaCliente;
			},

			list: {
				onChooseEvent: function () {
					codCliente = $("#cliente-autocomplete").getSelectedItemData().codCliente;
					$('#cliente').val(codCliente);
					$('#cadastroCliente').slideUp();
				},

				onHideListEvent: function () {
					if (codCliente == null) {
						$('#cliente-autocomplete').val('');
						$('#cadastroCliente').slideDown();
					}
				}
			}
		};
		$("#cliente-autocomplete").easyAutocomplete(optionscliente);
	