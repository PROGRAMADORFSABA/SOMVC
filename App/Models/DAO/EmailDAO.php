<?php

namespace App\Models\DAO;

use App\Models\Entidades\Pedido;

class EmailDAO extends BaseDAO
{    
    public  function email(Pedido $pedido, $subject)
   {
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

       mail($to, $subject, $message, $headers);
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
