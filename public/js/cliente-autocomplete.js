
	var codCliente = null;
	$('#cadastroCliente').slideUp();
		var optionscliente = {
			url: function (cliente) {
				return "http://localhost/SOMVC/cliente/autoComplete/" + cliente;
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
