//document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
	var licitacaoCliente_cod = null;
	//$('#cadastroCliente').slideUp();
//	$('#cadastroCliente').slideDown();
		var optionsclientecontrato = {
			url: function (cliente) {
				//return "http://www.coisavirtual.com.br/contrato/autoCompleteContratoClienteRazaoSocial/" + cliente; //hospedagem
				//return "http://localhost:81/SOMVC/contrato/autoCompleteContratoClienteRazaoSocial/" + cliente;
				return "http://localhost/SOMVC/contrato/autoCompleteContratoClienteRazaoSocial/" + cliente;
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
					document.getElementById("numeroLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#contratoCliente-Autocomplete').val('Nao encontrato');
						$('#cadastroCliente').slideDown();
						document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#contratoCliente-Autocomplete").easyAutocomplete(optionsclientecontrato);
	
//document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
	var licitacaoCliente_cod = null;
	//$('#cadastroCliente').slideUp();
//	$('#cadastroCliente').slideDown();
		var optionsclienteedital = {
			url: function (cliente) {
				//return "http://www.coisavirtual.com.br/contrato/autoCompleteEditalClienteRazaoSocial/" + cliente; //hospedagem
				//return "http://localhost:81/SOMVC/contrato/autoCompleteEditalClienteRazaoSocial/" + cliente;
				return "http://localhost/SOMVC/contrato/autoCompleteEditalClienteRazaoSocial/" + cliente;
			},
			getValue: function (element) {
					return element.razaosocial;
			},
			list: {
				onChooseEvent: function () {
					licitacaoCliente_cod = $("#editalCliente-Autocomplete").getSelectedItemData().licitacaoCliente_cod;
					razaoSocial = $("#editalCliente-Autocomplete").getSelectedItemData().razaosocial;
					$('#cliente').val(licitacaoCliente_cod);
					$('#cadastroCliente').slideUp();
					$('#numeroContrato').disabled = false;
					document.getElementById("editalLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#contratoCliente-Autocomplete').val('Nao encontrato');
						$('#cadastroCliente').slideDown();
						document.getElementById("editalLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#editalCliente-Autocomplete").easyAutocomplete(optionsclienteedital);
	
		var optionscontrato = {
			url: function (cliente) {
				//return "http://www.coisavirtual.com.br/contrato/autoCompleteNumeroContratoCodCliente/" + cliente+"/"+ licitacaoCliente_cod; //hospedagem
				//return "http://localhost:81/SOMVC/contrato/autoCompleteNumeroContratoCodCliente/" + cliente+"/"+ licitacaoCliente_cod;
				return "http://localhost/SOMVC/contrato/autoCompleteNumeroContratoCodCliente/"+cliente +"/"+ licitacaoCliente_cod;
			},

			getValue: function (element) {
					return element.edt_numero;
			},

			list: {
				onChooseEvent: function () {
					numeroEdital = $("#numeroLicitacao-AutoComplete").getSelectedItemData().edt_id;				
					razaoSocial = $("#numeroLicitacao-AutoComplete").getSelectedItemData().razaosocial;
					$('#numeroLicitacao').val(numeroEdital);			
			
					document.getElementById("numeroLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null || edt_id == null) {
						$('##numeroLicitacao-AutoComplete').val('Nao encontrato');
						$('#numeroLicitacao').val('');					
						document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#numeroLicitacao-AutoComplete").easyAutocomplete(optionscontrato);

		var optionsedital = {
			url: function (cliente) {
				//return "http://www.coisavirtual.com.br/contrato/autoCompleteNumeroEditalCodCliente/" + cliente+"/"+ licitacaoCliente_cod; //hospedagem
				//return "http://localhost:81/SOMVC/contrato/autoCompleteNumeroEditalCodCliente/" + cliente+"/"+ licitacaoCliente_cod;
				return "http://localhost/SOMVC/contrato/autoCompleteNumeroEditalCodCliente/"+cliente +"/"+ licitacaoCliente_cod;
			},

			getValue: function (element) {
					return element.edt_numero;
			},

			list: {
				onChooseEvent: function () {
					numeroEdital = $("#editalLicitacao-AutoComplete").getSelectedItemData().edt_id;				
					razaoSocial = $("#editalLicitacao-AutoComplete").getSelectedItemData().razaosocial;
					$('#numeroLicitacao').val(numeroEdital);			
			
					document.getElementById("editalLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null || edt_id == null) {
						$('#editalLicitacao-AutoComplete').val('Nao encontrato');
						$('#numeroLicitacao').val('');					
						document.getElementById("editalLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#editalLicitacao-AutoComplete").easyAutocomplete(optionsedital);