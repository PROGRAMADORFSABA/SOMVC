
document.getElementById('frmCadastro').addEventListener('submit', function(){ // CRIA EM EVENTO QUE É DISPARADO QUANDO O ELEMENTO DE ID 'form' FOR 'submetido/enviado'.
var inputs = this.getElementsByTagName('input'); // PEGA TODOS OS INPUTS PRESENTES NESSE ELEMENTO
var teste = 0;
var tabela1;
for(var i in inputs){ // ITERA OS INPUTS
	//teste = teste + 1;
	var input = inputs[i];
	if(input.type == 'checkbox'){ // CASO SEJA UM 'checkbox'
		input.value = input.checked; // SETA 'value' COM TRUE/FALSE DE ACORDO COM O CHECKED
		if(input.checked == true){
		//	alert("checked true js " +teste );
		teste = 1;
		}else{
		//	alert("checked falso js  " +teste );
		teste = 0;
		}
		tabela1 = teste;
	$.ajax({ //Função AJAX
	//url:"http://coisavirtual.com.br/Permissao/cadastro",			//Arquivo php
		url:"http://localhost/SOMVC/permissao/salvar.php",			//Arquivo php
		type:"POST",				//Método de envio
		data: {tabela1:tabela1}	//Dados
		});
	}
	//input.checked = true; // SETA COMO CHECKED PARA QUE ELE SEJA ENVIADO, O VALOR VALIDO É O QUE ESTA NO 'value' DO ELEMENTO
}


});

if(document.getElementById("enviarEmail").checked == true){
	document.getElementById("email").disabled = false;
}
$(document).on("click", "#enviarEmail", function () {
	var chek = document.getElementById("enviarEmail");		
		if(chek.checked == true){			
			document.getElementById("email").disabled = false;	
	}else{
		$('#email').val('');
		document.getElementById("email").disabled = true;		
	}
});

$(document).on("click", "#andre", function () {
	var chek1 = document.getElementById("andre");		
	if(chek1.checked == true){	
		document.getElementById("teste").disabled = true;	
		$('#teste').val('clicado');
		alert('teste');
	}
});



$('#frmCadastro').submit(function(){
	var tabela = $("#tabela").val();		
	if(document.getElementById("tabela").checked == true){
		alert('teste');
	}
	
	$.ajax({ //Função AJAX
			//url:"http://coisavirtual.com.br/Permissao/cadastro",			//Arquivo php
			url:"http://localhost/SOMVC/Permissao/cadastro",			//Arquivo php
			type:"post",				//Método de envio
			data: {tabela:tabela},	//Dados
			success: function (result){	
				  /* if(result==1){	
					   swal({
						title: "OK!",
						text: "Departamento Cadastrado com Sucesso!",
						type: "success",
						confirmButtonText: "Fechar",
						closeOnConfirm: false
					},

					function(isConfirm){
						if (isConfirm) {
								window.location = "cad_dep.php";
							}
					});

					   $("#nomeDep").val(''); 

				   }else{
					alert("Erro ao salvar");		//Informa o erro
						}*/
					}
				});

		return false;//Evita que a página seja atualizada
	});

 