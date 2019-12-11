<?php

namespace App\Models\DAO;

use App\Models\Entidades\Pedido;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Notificacao;

class EmailDAO extends BaseDAO
{    
    public  function email(Pedido $pedido, $subject)
   {
      // var_dump($pedido);
        $codPedido          = $pedido->getCodControle();           
        $codStatus          = $pedido->getCodStatus();           
        $nomeUsuario        = $pedido->getUsuario()->getNome();           
        $codUsuario         = $pedido->getUsuario()->getId();
        $tipoCliente        = $pedido->getClienteLicitacao()->getTipoCliente();
        $razaoSocialCliente = $pedido->getClienteLicitacao()->getRazaoSocial();
        $anexos             = $pedido->getAnexo();
        $numeroPregao       = $pedido->getNumeroLicitacao();
        $numeroAf           = $pedido->getNumeroAf();
        $observacao         = $pedido->getObservacao();
        $valorPedidoAtual   = $pedido->getValorPedido();   
        
        $dadosCadastro = "Codigo: ".$codPedido." <br>"."Cliente: ".$razaoSocialCliente." <br>"."Licitacao: ".$numeroPregao." <br>"."Autorizacao: ".$numeroAf 
                ." <br>"."Valor do Pedido R$".$valorPedidoAtual." <br>"."Observacao: ".$observacao." <br>";
                
        if($subject == 1){
            $subject = "Cadastro do Pedido";
            if( $tipoCliente == 'Municipal'){// AND $tipoCliente == 'Municipal'){
                $to = 'posvenda@fabmed.com.br';
            }else{
                if( $codUsuario != 30 AND $tipoCliente != 'Municipal'){// AND $tipoCliente == 'Municipal'){
                $to = 'atendimento@fabmed.feira.br';
                }                
            }
        }else{
            $subject = "Alteração de Pedido";
            if( $codStatus == 5){// AND $tipoCliente == 'Municipal'){
                $to = 'licitacao2@fabmed.com.br';
            }
           }
    
       $subject .= " - Codigo: " . $codPedido . "  - Cliente: ".$razaoSocialCliente;
       $message = "Ola, <br><br> " .$nomeUsuario.  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/pedido > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< programadorfsaba@gmail.com>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br;vendas2@fabmed.com.br >' . "\r\n"; //email para resposta

      // mail($to, $subject, $message, $headers);
   }
    public  function emailSugestoes(Sugestoes $sugestoes, $subject)
   {
       $codSugestoes       = $sugestoes->getSugId();           
       $status             = $sugestoes->getSugStatus();
       $tipo               = $sugestoes->getSugTipo();
       $nomeUsuario        = $sugestoes->getUsuario()->getNome();
        $anexos             = $sugestoes->getSugAnexo();
        $descricao          = $sugestoes->getSugDescricao(); 
        
        $dadosCadastro = "Codigo: ".$codSugestoes." <br>"."Tipo: ".$tipo
        ." <br>"."Status: ".$status." <br>"."Descricao: ".$descricao." <br>";
                
        if($subject == 1){
            $subject = "Cadastro de Sugestoes";
        }else if($subject == 2){
            $subject = "Alteração de Sugestoes";           
           }else {
            $subject = "Exclusao do Sugestoes";
           }
           $to = 'nuvem@fabmed.com.br;vendas2@fabmed.com.br';
       $subject .= " - Codigo: " . $codSugestoes . "  - Tipo: ".$tipo;
       $message = "Ola, <br><br> " .$nomeUsuario.  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/sugestoes > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< programadorfsaba@gmail.com>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br;vendas2@fabmed.com.br >' . "\r\n"; //email para resposta

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
    <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' border='1px'>     
        <tr> <td>Codigo</td> <td> $codNotificacao  </td>  </tr>
        <tr> <td>Nome</td> <td> $nomeCliente  </td>  </tr>
        <tr> <td>Status</td> <td>$status</td></tr>
        <tr> <td>numero</td> <td>$numero</td> </tr>
        <tr> <td>Pedido</td> <td>$pedido</td> </tr>
        <tr> <td>Valor</td> <td>R$$valor</td> </tr>
        <tr> <td>Prazo Defesa</td><td> $prazoDefesa Dias</td></tr>
        <tr> <td>Observacao</td><td> $observacao </td></tr>
    </table>";

        if($subject == 1){
            $subject = "Cadastro de Notificacao";
        }else if($subject == 2 AND ($status == "ATENDIDO" || $status == "Atendido")){
            $subject = "Alteração de Notificacao";           
        }else {
            $subject = "Exclusao do Notificacao";
        }
        //var_dump($dadosCadastro);
        $to = 'sac@fabmed.com.br';
       $subject .= " - Codigo: " . $codNotificacao . " - Cliente: ".$nomeCliente;
       $message = "Ola, <br><br> " .$nomeUsuario.  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/notificacao/edicao/".$codNotificacao." > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< programadorfsaba@gmail.com>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br;vendas2@fabmed.com.br >' . "\r\n"; //email para resposta

      // mail($to, $subject, $message, $headers);
   }
    public  function emailSuporte($erro)
   {
        $to = 'nuvem@fabmed.com.br;vendas2@fabmed.com.br';
       
       $subject = " Erro no sistema ";
       $message = "Ola, <br><br> favor verificar o erro ocorrido no sistema. <br><br> " . "\r\n";
       $message .= "<a href=http://www.coisavirtual.com.br > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
      // $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $erro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< programadorfsaba@gmail.com>' . "\r\n"; //email com copia
      // $headers .= 'Reply-To: <nuvem@fabmed.com.br;vendas2@fabmed.com.br >' . "\r\n"; //email para resposta

       mail($to, $subject, $message, $headers);
   }
   
}