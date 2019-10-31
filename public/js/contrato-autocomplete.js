document.getElementById("numeroLicitacao").disabled = true;
	var licitacaoCliente_cod = null;
	//$('#cadastroCliente').slideUp();
//	$('#cadastroCliente').slideDown();
		var optionscliente = {
			url: function (cliente) {
				//return "http://coisavirtual.com.br/numeroLicitacao/autoComplete/" + cliente; //hospedagem
				return "http://localhost:81/SOMVC/contrato/editalPorCliente/" + cliente;
				//return "http://localhost/SOMVC/numeroLicitacao/autoComplete/" + cliente;
			},
			getValue: function (element) {
					return element.razaosocial;
			},
			list: {
				onChooseEvent: function () {
					licitacaoCliente_cod = $("#contratoCliente-Autocomplete").getSelectedItemData().licitacaoCliente_cod;
					razaoSocial = $("#contratoCliente-Autocomplete").getSelectedItemData().razaosocial;
					$('#cliente').val(licitacaoCliente_cod);
					$('#cadastroCliente').slideUp();
					$('#numeroContrato').disabled = false;
					document.getElementById("numeroLicitacao").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#contratoCliente-Autocomplete').val('Nao encontrato');
						$('#cadastroCliente').slideDown();
						document.getElementById("numeroLicitacao").disabled = true;
					}
				}
			}
		};
		$("#contratoCliente-Autocomplete").easyAutocomplete(optionscliente);
	
		var optionsedital = {
			url: function (cliente) {
				return "http://coisavirtual.com.br/contrato/editalPorCliente/" + cliente; //hospedagem
				//return "http://localhost:81/SOMVC/contrato/editalPorCliente/" + cliente;
				//return "http://localhost/SOMVC/contrato/editalPorCliente/" + cliente;
			},

			getValue: function (element) {
					return element.edt_numero;
			},

			list: {
				onChooseEvent: function () {
					numeroEdital = $("#numeroLicitacao-AutoComplete").getSelectedItemData().edt_id;
					razaoSocial = $("#numeroLicitacao-AutoComplete").getSelectedItemData().razaosocial;
					$('#numeroLicitacao').val(numeroEdital);
					$('#cadastroCliente').slideUp();
			
					document.getElementById("numeroLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#numeroLicitacao').val('Nao encontrato');
						$('#cadastroCliente').slideDown();
						document.getElementById("numeroLicitacao").disabled = true;
					}
				}
			}
		};
		$("#numeroLicitacao-AutoComplete").easyAutocomplete(optionsedital);