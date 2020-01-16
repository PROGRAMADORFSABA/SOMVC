<?php

namespace App\Models\DAO;

use App\Models\Entidades\Pedido;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Notificacao;

class EmailDAO extends BaseDAO
{    
    public  function email(Pedido $pedido, $email, $subject, $mensagem = null)
   {
    
       $codPedido          = $pedido->getCodControle();           
       $codStatus          = $pedido->getStatus()->getCodStatus();           
       $nomeStatus         = $pedido->getStatus()->getNome();           
       $nomeUsuario        = $pedido->getUsuario()->getNome();           
       $codUsuario         = $pedido->getUsuario()->getId();
       $tipoCliente        = $pedido->getClienteLicitacao()->getTipoCliente();
       $razaoSocialCliente = $pedido->getClienteLicitacao()->getRazaoSocial();
       $anexos             = $pedido->getAnexo();
       $data               = $pedido->getDataCadastro()->format('d/m/Y h:m:s');
       $numeroPregao       = $pedido->getNumeroLicitacao();
       $numeroAf           = $pedido->getNumeroAf();
       $numeroPedidoERP    = $pedido->getNumeroPedidoERP();
       $observacao         = $pedido->getObservacao();
       $valorPedidoAtual   = $pedido->getValorPedido();   
     
       $dadosCadastro .= "
                    <table style='width:50%' border='1px' cellspacing='0' cellpadding='2'>     
                            <tr> <td><b>Codigo</b></td><td>$codPedido</td></tr>
                            <tr> <td><b>Cliente</b></td><td> $razaoSocialCliente</td></tr>
                            <tr> <td><b>Status</b></td><td>$nomeStatus</td></tr>
                            <tr> <td><b>Data</b></td><td>$data </td></tr>
                            <tr> <td><b>Pregao</b></td><td>$numeroPregao</td></tr>
                            <tr> <td><b>Numero AFM</b></td><td>$numeroAf</td></tr>
                            <tr> <td><b>Numero</b></td><td>$numeroPedidoERP</td></tr>
                            <tr> <td><b>Valor</b></td><td>R$$valorPedidoAtual</td></tr>
                            <tr> <td><b>Observacao</b></td><td><pre>$observacao</pre></td></tr>
                    </table>";
       
       if($subject == 1){
           $subject = "Cadastro do Pedido";
           if( $tipoCliente == 'Municipal'){// AND $tipoCliente == 'Municipal'){
               $to .= 'posvenda@fabmed.com.br';
            }else{
                if( $codUsuario != 30 AND $tipoCliente != 'Municipal'){// AND $tipoCliente == 'Municipal'){
                    $to .= 'atendimento@fabmed.feira.br';
                }                
            }
        }else if($subject == 2){
            $subject = "Alteração de Pedido";
            $to .= 'licitacao2@fabmed.com.br, sac@fabmed.com.br';
            if( $codStatus == 5 || $codStatus == 3){
            }else if( $codStatus == 6 AND $tipoCliente != 'Municipal'){
                $to .= 'atendimento@fabmed.feira.br';
            }
        }else if($subject == 3){
            $subject = "envio do email do Pedido";            
        }
        $arrayEmail = array();
        $arrayEmail[] = $email;
        if( sizeof( $arrayEmail ) ){
            $to .= ', '.implode( ',',$arrayEmail );
        } 
        $hora = date('H'); 
        if (  $hora >= 12 &&  $hora <= 18 ) {
            $saudacao = " Boa Tarde!";
        }else if (  $hora  >= 00 &&  $hora  < 12 ){
            $saudacao = " Bom Dia!";
        }else{
            $saudacao = " Boa Noite!";
        }            

       $subject .= " - Codigo: " . $codPedido . "  - Cliente: ".$razaoSocialCliente;
       $message = $saudacao.", <br><br> " .$nomeUsuario.  "  efetuou ". $subject  . "<br> " . "\r\n";
       //$message .= "<p align='justify widher:80%;'><h3><pre>" . $mensagem. "</pre></h3></p><br>";
       $message .= "<a href=http://www.coisavirtual.com.br/pedido > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: < nuvem@fabmed.com.br,vendas2@fabmed.com.br >' . "\r\n"; //email para resposta
      
       $mensagem1 = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict. dtd'>
       <html><head><title >".$subject."</title><style type=' text/css'>body{width:98%;height:auto; text-align:left;margin:0px;padding:1%;}h1 {font-size:320%;color:#008;font-family:impact;} p{font-family:arial;}</style></ head>
       <body><p align=justify>Olá <b>".$saudacao."</b>,<br> obrigado por <b>".$dadosCadastro."</b> no nosso <b>".$mensagem."</b></p>.</body> </html>";
      
       var_dump( $mensagem1);
    // mail($to, $subject, $message, $headers);
   }
    
   public  function emailEdital(Edital $edital, $email, $subject)
   {
       $codigo          = $edital->getEdtId();           
       $razaoSocialCliente = $edital->getClienteLicitacao()->getRazaoSocial();
       $nomeStatus         = $edital->getEditalStatus()->getStEdtNome();          
       $nomeUsuario        = $edital->getUsuario()->getNome();  
       $codUsuario         = $edital->getUsuario()->getId();
       $tipoCliente        = $edital->getClienteLicitacao()->getTipoCliente();
       $anexos             = $edital->getEdtAnexo();
       $numeroPregao       = $edital->getEdtNumero();
       $modalidede         = $edital->getEdtModalidade();
       $representante      = $edital->getRepresentante()->getNomeRepresentante();
       $dataAbertura       = $edital->getEdtDataAbertura()->format('d/m/Y').' - ' .$edital->getEdtHora()->format('H:m:s');
       $observacao         = $edital->getEdtObservacao();
       $tipo               = $edital->getEdtTipo();
       $analise            = $edital->getEdtAnalise();
       $valor              = $edital->getEdtValor();   
       $codStatus          = $edital->getEditalStatus()->getStEdtId();           
   
       $dadosCadastro .= "
                    <table style='width:50% ' border='1px solid black'  >     
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Cliente</td> <td> $razaoSocialCliente  </td>  </tr>
                            <tr> <td>Status</td> <td>$nomeStatus</td></tr>
                            <tr> <td>Data e Hora</td> <td>$dataAbertura</td></tr>
                            <tr> <td>Pregao</td> <td>$numeroPregao</td></tr>
                            <tr> <td>Modalidade</td> <td>$modalidede</td> </tr>
                            <tr> <td>Tipo</td><td> $tipo </td></tr>
                            <tr> <td>Representante</td> <td>$representante</td> </tr>
                            <tr> <td>Valor</td> <td>R$$valor</td> </tr>
                            <tr> <td>Observacao</td><td> $observacao </td></tr>
                            <tr> <td>Analise</td><td> $analise </td></tr>
                    </table>";
       
       if($subject == 1){
           $subject = "Cadastro do Edital";
           if( $tipoCliente == 'Municipal'){// AND $tipoCliente == 'Municipal'){
               $to .= 'posvenda@fabmed.com.br';
            }else{
                if( $codUsuario != 30 AND $tipoCliente != 'Municipal'){// AND $tipoCliente == 'Municipal'){
                    $to .= 'atendimento@fabmed.feira.br';
                }                
            }
        }else{
            $subject = "Alteração de Edital";
            $to .= 'licitacao2@fabmed.com.br, sac@fabmed.com.br';
            if( $codStatus == 5 || $codStatus == 3){
            }else if( $codStatus == 6 AND $tipoCliente != 'Municipal'){
                $to .= 'atendimento@fabmed.feira.br';
            }
        }
        $arrayEmail = array();
        if( sizeof( $arrayEmail ) ){
            $arrayEmail[] = $email;
            $to .= ', '.implode( ',',$arrayEmail );
        }               
      
       $subject .= " - Codigo: " . $codigo . "  - Cliente: ".$razaoSocialCliente;
       $message = "Ola, <br><br> " .$nomeUsuario.  "  efetuou ". $subject  . " <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/edital".$codigo." > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br,vendas2@fabmed.com.br; >' . "\r\n"; //email para resposta
         mail($to, $subject, $message, $headers);
   }
   public  function emailUsuario(Usuario $usuario, $email, $subject)
   {
       $codigo              = $usuario->getId();           
       $nome                = $usuario->getNome();
      // $email               = $usuario->getEmail();
       $status              = $usuario->getStatus();          
       
       $valida = sha1($email);
       $to = $email;
       $dadosCadastro .= "
                    <table style='width:50% ' border='1px cellspacing='0' cellpadding='2' solid black'  >     
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Nome</td> <td> $nome  </td>  </tr>
                            <tr> <td>Status</td> <td>$status</td></tr>
                            <tr> <td>Email</td> <td>$email</td></tr>
                    </table>";
       
       if($subject == 1){
           $subject = "Cadastro de Usuario";
           
        }else{
            $subject = "Alteração de Usuario";           
        }
        $arrayEmail = array();
        if( sizeof( $arrayEmail ) ){
            $arrayEmail[] = $email;
            $to .= ', '.implode( ',',$arrayEmail );
        }               
      
       $subject .= " - Codigo: " . $codigo . "  - nome: ".$nome;
       $message = "Ola, <br><br> " .$nome.  "  efetuou ". $subject  . " <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/usuario/validaUsuario/?v=$valida&v2=$email&v3=$codigo> Click aqui para validar seu cadastro </a>";      
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br,vendas2@fabmed.com.br; >' . "\r\n"; //email para resposta
        mail($to, $subject, $message, $headers);
   }

   public  function emailSugestoes(Sugestoes $sugestoes, $subject)
    {
        $codSugestoes       = $sugestoes->getSugId();           
        $status             = $sugestoes->getSugStatus();
        $assunto             = $sugestoes->getSugAssunto();
        $tipo               = $sugestoes->getSugTipo();
        $nomeUsuario        = $sugestoes->getUsuario()->getNome();
        $anexos             = $sugestoes->getSugAnexo();
        $descricao          = $sugestoes->getSugDescricao(); 
        
        $dadosCadastro .= "
        <table style='width:50% ' border='1px cellspacing='0' cellpadding='2' solid black'  >     
                <tr> <td>Codigo</td> <td> $codSugestoes  </td>  </tr>
                <tr> <td>Assunto</td> <td> $assunto  </td>  </tr>
                <tr> <td>Tipo</td> <td> $tipo  </td>  </tr>
                <tr> <td>Status</td> <td>$status</td></tr>
                <tr> <td>Descricao</td> <td>$descricao</td></tr>
        </table>";
       
        
        if($subject == 1){
            $subject = "Cadastro de Sugestoes";
        }else if($subject == 2){
            $subject = "Alteração de Sugestoes";           
       }else {
            $subject = "Exclusao do Sugestoes";
       }
           $to = 'nuvem@fabmed.com.br; vendas2@fabmed.com.br';
       $subject .= " - Codigo: " . $codSugestoes . "  - Tipo: ".$tipo;
       $message = "Ola, <br><br> " .$nomeUsuario.  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/sugestoes > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br, vendas2@fabmed.com.br >' . "\r\n"; //email para resposta

      // mail($to, $subject, $message, $headers);
   }
    
   public  function emailNotificacao(Notificacao $notificacao, $subject)
   {
       $codNotificacao     = $notificacao->getNtf_cod();           
       $status             = $notificacao->getNtf_status();
       $numero             = $notificacao->getNtf_numero();
       $pedido             = $notificacao->getNtf_pedido();
       $valor              = number_format($notificacao->getNtf_valor(), 2, ',', '.');
       $prazoDefesa        = $notificacao->getNtf_prazodefesa();
       $nomeUsuario        = $notificacao->getNtf_usuario()->getNome();
       $nomeCliente        = $notificacao->getClienteLicitacao()->getRazaoSocial();
       $anexos             = $notificacao->getNtf_anexo();
       $observacao         = $notificacao->getNtf_observacao(); 
        
    $dadosCadastro .= "
    <table border='1px solid black' cellspacing='0' cellpadding='2' border-collapse='collapse' >     
        <tr> <td>Codigo</td> <td> $codNotificacao  </td>  </tr>
        <tr> <td>Cliente</td> <td> $nomeCliente  </td>  </tr>
        <tr> <td>Status</td> <td>$status</td></tr>
        <tr> <td>Numero</td> <td>$numero</td> </tr>
        <tr> <td>Pedido</td> <td>$pedido</td> </tr>
        <tr> <td>Valor</td> <td>R$$valor</td> </tr>
        <tr> <td>Prazo Defesa</td><td> $prazoDefesa Dias</td></tr>
        <tr> <td>Observacao</td><td> $observacao </td></tr>
    </table>";

        if($subject == 1){
            $subject = "Cadastro de Notificacao";
        }else if($subject == 2 AND ($status == "ATENDIDO" || $status == "Atendido")){
            $subject = "Alteração de Notificacao";           
        }else  if($subject == 3) {
            $subject = "Exclusao do Notificacao";
        }
    
       $to = 'sac@fabmed.com.br';
       $subject .= " - Codigo: " . $codNotificacao . " - Cliente: ".$nomeCliente;
       $message = "Ola, <br><br> " .$nomeUsuario.  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/notificacao/edicao/".$codNotificacao."  > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br, vendas2@fabmed.com.br >' . "\r\n"; //email para resposta
       
      mail($to, $subject, $message, $headers);
   }
    public  function emailSuporte($erro, $tela)
   {
    $dadosCadastro .= "
    <table style='width:50% ' border='1px cellspacing='0' cellpadding='2' solid black'  >     
            <tr> <td>Descricao do erro </td> <td> $erro  </td>  </tr>
    </table>";

        $to = 'nuvem@fabmed.com.br, vendas2@fabmed.com.br';       
       $subject = " Erro no sistema ('.$tela.') ";
       $message = "Ola , <br><br> favor verificar o erro ocorrido no sistema com o usuario(a) ". $_SESSION['nome']." - E-mail ".$_SESSION['email'] ."<br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To:'. $_SESSION['nome'].' < '.$_SESSION['email'] .' > '. "\r\n"; //email para resposta
      
       mail($to, $subject, $message, $headers);
   }
   
}
