
$(document).on("click", "#btnAdicionarPedido", function () {

	//var numeroNota = $('#numeroNota').val();
	var numeroPedido = $('#numeroPedido').val();
	var valor = $('#valor').val();
	if (numeroPedido != '' && valor != '') {
		tproduto(numeroPedido, valor);
	} else {
		alert(" favor prencher todos os dados do pedido ");
	}
});

function tproduto( numeroPedido, valor) {
	$('#kt_table_3').append('<tr>' +
		'<td>' + numeroPedido + ' 	<input type="hidden" value="'+ numeroPedido +'" name="pedidos[]"></td>' +
		//'<td>' + numeroNota + ' 	<input type="hidden" value="'+ numeroNota +'" name="pedidos[]"></td>' +
		'<td>R$' + valor + ' 		<input type="hidden" value="'+ valor +'" name="pedidos[]"></td>' +
		'<td><a class="btn btn-outline-danger btn-sm  btn-elevate btn-pill btn-elevate-air" id="removePedido" onClick="app.removePedido(this,' + numeroPedido + ')">excluir' +
		'<a class="btn btn-outline-warning btn-sm  btn-elevate btn-pill btn-elevate-air" id="editarPedido" onClick="app.editarPedido(this,' + numeroPedido + ')">Editar</td>' +
		'</tr>');
	$("#numeroPedido").val('');
	$("#numeroNota").val('');
	$("#valor").val('');
}

$(document).on("click", "#removePedido", function () {
	$(this).parent().parent().remove();
});
$(document).on("click", "#editarPedido", function () {	
	var teste1 = $(this).parent().parent().text();
alert(' funcao em desenvolvimento ' );
});
