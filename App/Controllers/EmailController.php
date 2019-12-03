<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\PedidoDAO;
use App\Models\DAO\StatusDAO;
use App\Models\DAO\RepresentanteDAO;
use App\Services\RepresentanteService;
use App\Services\ClienteLicitacaoService;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\StatusService;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;

class PedidoController extends Controller
{

public function emailPedido(Pedido $pedido){

            $nomeUsuario        = $pedido->getUsuario()->getNome();           
            $codUsuario         = $pedido->getUsuario()->getId();
            $codStatus          =  $pedido->setCodStatus($_POST['codStatus']);
            $tipoCliente        = $pedido->getClienteLicitacao()->getTipoCliente();
            $razaoSocialCliente = $pedido->getClienteLicitacao()->getRazaoSocial();
            if( $tipoCliente == 'Municipal'){// AND $tipoCliente == 'Municipal'){
                $to = 'posvenda@fabmed.com.br';
            }else{
                if( $codUsuario != 30){// AND $tipoCliente == 'Municipal'){
                $to = 'atendimento@fabmed.feira.br';
                }                
            } 
               $subject = "Cadastro do Pedido - Codigo: " . $codPedido . "  - Cliente: ".$razaoSocialCliente;
               $message = "Ola, <br><br> " .$nomeUsuario. " - " . $tipoCliente  . " efetuou cadastro do pedido no sistema <br><br> " . "\r\n";
               $message .= "<a href=http://www.coisavirtual.com.br/pedido > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
              // $message .= "<a href=http://www.coisavirtual.com.br/public/assets/media/anexos/".$anexo."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
               $message .= "Dados do cadastro: <br> <br><br>" . "\r\n";
               $message .= "favor da tratamento" . "\r\n";
               $headers = 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
               $headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
               //$headers .= 'CC:< programadorfsaba@gmail.com>' . "\r\n"; //email com copia
           //	$headers .= 'Reply-To: < carlosandrefsaba@gmail.com>' . "\r\n"; //email para resposta

               mail($to, $subject, $message, $headers);

}


}