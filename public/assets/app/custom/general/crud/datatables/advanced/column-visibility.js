"use strict";

var KTDatatablesAdvancedColumnVisibility = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
			responsive: true,
			columnDefs: [
				{
					// oculta coluna por numero de idex
					targets: false,
					 //targets: [0, 3],
					visible: false,
				},
				{
					//coluna de funcoes
					targets: -1,//definindo posição da colula
					title: 'Acoes',//definindo o nome da coluna
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Editar</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Alterar</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Gerar Relatorio</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Teste</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
					},
				},
				{
					targets: 7,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Pending', 'class': 'kt-badge--brand'},
							2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
							3: {'title': 'Cancelado', 'class': ' kt-badge--danger'},
							4: {'title': 'Aprovado', 'class': ' kt-badge--success'},
							5: {'title': 'Info', 'class': ' kt-badge--info'},
							6: {'title': 'Negado', 'class': ' kt-badge--danger'},
							7: {'title': 'Em Analise', 'class': ' kt-badge--warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: 8,//definindo quantas colunas vai ter a tabela
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Online', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});
	};
	
	

	var initTable1 = function() {
		var table = $('#kt_table_2');

		// begin first table
		table.DataTable({
			responsive: true,
			columnDefs: [
				{
					// oculta coluna por numero de idex
					targets: false,
					 //targets: [0, 3],
					visible: false,
				},
				{
					//coluna de funcoes
					targets: -1,//definindo posição da colula
					title: 'Acoes',//definindo o nome da coluna
					orderable: false,
					
				},
				{
					targets: 7,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Pending', 'class': 'kt-badge--brand'},
							2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
							3: {'title': 'Cancelado', 'class': ' kt-badge--danger'},
							4: {'title': 'Aprovado', 'class': ' kt-badge--success'},
							5: {'title': 'Info', 'class': ' kt-badge--info'},
							6: {'title': 'Negado', 'class': ' kt-badge--danger'},
							7: {'title': 'Em Analise', 'class': ' kt-badge--warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: 8,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Cancelado', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});
	};
	var initTable1 = function() {
		var table = $('#kt_table_cliente');

		// begin first table
		table.DataTable({
			responsive: true,
			columnDefs: [
				{
					// oculta coluna por numero de idex
					targets: false,
					 //targets: [0, 3],
					visible: false,
				},
				{
					//coluna de funcoes
					targets: -1,//definindo posição da colula
					title: 'Acoes',//definindo o nome da coluna
					orderable: false,
					
				},
				{
					targets:-3,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Pending', 'class': 'kt-badge--brand'},
							2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
							D: {'title': 'Dasativado', 'class': ' kt-badge--danger'},
							A: {'title': 'Ativo', 'class': ' kt-badge--success'},
							5: {'title': 'Info', 'class': ' kt-badge--info'},
							6: {'title': 'Negado', 'class': ' kt-badge--danger'},
							7: {'title': 'Em Analise', 'class': ' kt-badge--warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: -2,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Desativado', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Ativo', 'state': 'success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});
	};
	
	var initTable3 = function() {
		var table = $('#kt_table_3');

		// begin first table
		table.DataTable({
			responsive: true,
			columnDefs: [
				{
					// oculta coluna por numero de idex
					targets: false,
					 //targets: [0, 3],
					visible: false,
				},
				{
					//coluna de funcoes
					targets: -1,//definindo posição da colula
					title: 'Acoes',//definindo o nome da coluna
					orderable: false,
					
				},
				{
					targets:-2,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							11111: {'title': 'Pending', 'class': 'kt-badge--brand'},
							D: {'title': 'Dasativado', 'class': ' kt-badge--danger'},
							A: {'title': 'Ativo', 'class': ' kt-badge--success'},
							55555: {'title': 'Info', 'class': ' kt-badge--info'},
							66666: {'title': 'Negado', 'class': ' kt-badge--danger'},
							77777: {'title': 'Em Analise', 'class': ' kt-badge--warning'},
							'ANALISE FaINANCEIRO': {'title': 'Analise Financeiro', 'class': ' kt-badge--warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: -3,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							'CANCELADO': {'title': 'CANCELADO', 'state': 'danger'},
							'NEGADO': {'title': 'NEGADO', 'state': 'danger'},
							'PENDENTE': {'title': 'PENDENTE', 'state': 'danger'},
							111111: {'title': 'Desativado', 'state': 'danger'},
							222222: {'title': 'Retail', 'state': 'primary'},
							'RECEPCIONADO': {'title': 'RECEPCIONADO', 'state': 'primary'},
							333333: {'title': 'Ativo', 'state': 'success'},
							'ATENDIDO': {'title': 'ATENDIDO', 'state': 'success'},
							'ANALISE FINANCEIRO': {'title': 'ANALISE FINANCEIRO', 'state': 'warning'},
							'AUTORIZADO': {'title': 'AUTORIZADO', 'state': 'warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});
	};


	return {

		//main function to initiate the module
		init: function() {
			initTable1();
			initTable3();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesAdvancedColumnVisibility.init();
});