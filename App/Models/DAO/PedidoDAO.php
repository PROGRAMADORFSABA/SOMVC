<?php

namespace App\Models\DAO;

use App\Models\Entidades\Pedido;
use App\Models\Entidades\Cliente;
use App\Models\Entidades\Status;
use App\Models\Entidades\Representante;
use App\Models\Entidades\Instituicao;

class PedidoDAO extends BaseDAO
{


    public function listar($codControle = null){

        if ($codControle) {
            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.fk_idInstituicao,con.dataAlteracao,con.valorPedido,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
                ,c.codCliente,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
                ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
                ,i.inst_id,i.inst_nome,s.codStatus,s.nome
                FROM controlePedido AS con 
                 INNER JOIN statuspedido AS s on s.codStatus = con.codStatus
                 INNER JOIN cadrepresentante AS r on r.codRepresentante = con.codRepresentante
                 INNER JOIN cliente AS c on c.codCliente = con.codCliente
                 INNER JOIN instituicao AS i on i.inst_codigo = con.fk_idInstituicao
                 WHERE con.codControle = $codControle "
            );
            $dado = $resultado->fetch();

            if ($dado) {
                $pedido = new Pedido();
                $pedido->setCodControle($dado['codControle']);
                $pedido->setDataCadastro($dado['dataCadastro']);
                //date_format($date, 'Y-m-d H:i:s');
                $pedido->setNumeroLicitacao($dado['numeroPregao']);
                $pedido->setNumeroAf($dado['numeroAf']);
                $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                $pedido->setCodStatus($dado['idStatus']);
                $pedido->setCodCliente($dado['idCliente']);
                $pedido->setAnexo($dado['anexo']);
                $pedido->setObservacao($dado['observacao']);
                $pedido->setCodRepresentante($dado['idRepresentante']);
                $pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                $pedido->setDataFechamento($dado['dataFechamento']);
                $pedido->setDataAlteracao($dado['dataAlteracao']);
                $pedido->getCliente()->setCodCliente($dado['codCliente']);
                $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                $pedido->getCliente()->setStatus($dado['statusCliente']);
                $pedido->getStatus()->setCodStatus($dado['codStatus']);
                $pedido->getStatus()->setNome($dado['nome']);
                $pedido->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $pedido->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $pedido->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);
                $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);
                $pedido->getInstituicao()->setInst_Id($dado['inst_id']);

                return $pedido;
            }
        } else {
            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
               ,c.codCliente,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
               ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
               ,i.inst_nome
               FROM controlePedido AS con 
				INNER JOIN statuspedido AS s on s.codStatus = con.codStatus
                INNER JOIN cadrepresentante AS r on r.codRepresentante = con.codRepresentante
                INNER JOIN cliente AS c on c.codCliente = con.codCliente
                INNER JOIN instituicao AS i on i.inst_codigo = con.fk_idInstituicao
                ORDER BY c.nomeCliente ASC"
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {
                    $pedido = new Pedido();
                    $pedido->setCodControle($dado['codControle']);
                    $pedido->setDataCadastro($dado['dataCadastro']);
                    //date_format($date, 'Y-m-d H:i:s');
                    $pedido->setNumeroLicitacao($dado['numeroPregao']);
                    $pedido->setNumeroAf($dado['numeroAf']);
                    $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                    $pedido->setCodStatus($dado['idStatus']);
                    $pedido->setCodCliente($dado['idCliente']);
                    $pedido->setAnexo($dado['anexo']);
                    $pedido->setObservacao($dado['observacao']);
                    $pedido->setCodRepresentante($dado['idRepresentante']);
                    //        $pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                    $pedido->setDataFechamento($dado['dataFechamento']);
                    $pedido->setDataAlteracao($dado['dataAlteracao']);
                    $pedido->getCliente()->setCodCliente($dado['codCliente']);
                    $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                    $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                    $pedido->getCliente()->setStatus($dado['statusCliente']);
                    $pedido->getStatus()->setNome($dado['nome']);
                    $pedido->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                    $pedido->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                    $pedido->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);
                    $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $lista[] = $pedido;
                }
                return $lista;
            }
        }
        return false;
    }
    public function listarAtendidos($codControle = null)
    {

        if ($codControle) {
            $resultado = $this->select(
                "SELECT con.codControle,CON.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,c.tipoCliente,c.nomeCliente,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
                FROM controlePedido AS con 
                 INNER JOIN statuspedido AS s on s.codStatus = con.codStatus
                 INNER JOIN cadrepresentante AS r on r.codRepresentante = con.codRepresentante
                 INNER JOIN cliente AS c on c.codCliente = con.codCliente
                 INNER JOIN instituicao AS i on i.inst_codigo = con.fk_idInstituicao
                 WHERE con.codControle = $codControle "
            );
            $dado = $resultado->fetch();

            if ($dado) {

                $pedido = new Pedido();

                $pedido->setCodControle($dado['codControle']);
                $pedido->setDataCadastro($dado['dataCadastro']);
                //date_format($date, 'Y-m-d H:i:s');
                $pedido->setNumeroLicitacao($dado['numeroPregao']);
                $pedido->setNumeroAf($dado['numeroAf']);
                $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                $pedido->setCodStatus($dado['idStatus']);
                $pedido->setCodCliente($dado['idCliente']);
                $pedido->setAnexo($dado['anexo']);
                $pedido->setObservacao($dado['observacao']);
                $pedido->setCodRepresentante($dado['idRepresentante']);
                //        $pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                $pedido->setDataFechamento($dado['dataFechamento']);
                $pedido->setDataAlteracao($dado['dataAlteracao']);
                $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                $pedido->getStatus()->setNome($dado['nome']);

                return $pedido;
            }
        } else {

            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
               ,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
               ,r.nomeRepresentante,r.statusRepresentante
               ,i.inst_nome
               FROM controlePedido AS con 
				INNER JOIN statuspedido AS s on s.codStatus = con.codStatus
                INNER JOIN cadrepresentante AS r on r.codRepresentante = con.codRepresentante
                INNER JOIN cliente AS c on c.codCliente = con.codCliente
                INNER JOIN instituicao AS i on i.inst_codigo = con.fk_idInstituicao
                WHERE s.nome in  ('ATENDIDO')
                ORDER BY c.nomeCliente ASC"
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {
                    $pedido = new Pedido();
                    $pedido->setCodControle($dado['codControle']);
                    $pedido->setDataCadastro($dado['dataCadastro']);
                    //date_format($date, 'Y-m-d H:i:s');
                    $pedido->setNumeroLicitacao($dado['numeroPregao']);
                    $pedido->setNumeroAf($dado['numeroAf']);
                    $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                    $pedido->setCodStatus($dado['idStatus']);
                    $pedido->setCodCliente($dado['idCliente']);
                    $pedido->setAnexo($dado['anexo']);
                    $pedido->setObservacao($dado['observacao']);
                    $pedido->setCodRepresentante($dado['idRepresentante']);
                    //        $pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                    $pedido->setDataFechamento($dado['dataFechamento']);
                    $pedido->setDataAlteracao($dado['dataAlteracao']);
                    $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                    $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                    $pedido->getCliente()->setStatus($dado['statusCliente']);
                    $pedido->getStatus()->setNome($dado['nome']);
                    $pedido->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                    $pedido->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);
                    $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $lista[] = $pedido;
                }
                return $lista;
            }
        }
        return false;
    }


    public  function salvar(Pedido $pedido)
    {
        try {
            $numeroLicitacao    = $pedido->getNumeroLicitacao();
            $numeroAf           = $pedido->getNumeroAf();
            $valorPedidoAtual       = $pedido->getValorPedido();
            $valorPedido        = str_replace(",", ".", $valorPedidoAtual);
            $codStatus          = $pedido->getCodStatus();
            $codCliente         = $pedido->getCodCliente();
            $codRepresentante   = $pedido->getCodRepresentante();
            $fk_instituicao     = $pedido->getFk_Instituicao();
            $dataCadastroAtual  = $pedido->getDataCadastro();
            $dataAlteracao      = $pedido->getDataAlteracao();
            $observacao         = $pedido->getObservacao();
            $anexo              = $pedido->getAnexo();
            $dataCadastro       = $dataCadastroAtual->format('Y-m-d h:m:s');
            $dataAlteracao      = $dataCadastro;
            $nomeanexo =  date('Y-m-d-h:m:s');

            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $anexo = md5($nomeanexo) . "." . $file_extension;
               //var_dump($file_extension);
                                 
                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                //  echo " teste 02 ".$anexo;
                $anexo = "sem_anexo.php";
            }

            return $this->insert(
                'controlePedido',
                " :numeroPregao, :numeroAf, :valorPedido, :codStatus, :codCliente, :codRepresentante,
                :dataCadastro, :fk_idInstituicao , :dataAlteracao, :observacao, :anexo",
                [
                    ':numeroPregao' => $numeroLicitacao,
                    ':numeroAf' => $numeroAf,
                    ':valorPedido' => $valorPedido,
                    ':codStatus' => $codStatus,
                    ':codCliente' => $codCliente,
                    ':codRepresentante' => $codRepresentante,
                    ':dataCadastro' => $dataCadastro,
                    ':fk_idInstituicao' => $fk_instituicao,
                    ':dataAlteracao' => $dataAlteracao,
                    ':observacao' => $observacao,
                    ':anexo' => $anexo
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public  function atualizar(Pedido $pedido)
    {
        try {

            $codControle    = $pedido->getCodControle();
            $numeroLicitacao    = $pedido->getNumeroLicitacao();
            $numeroAf           = $pedido->getNumeroAf();
            $valorPedidoAtual       = $pedido->getValorPedido();
            $valorPedido        = str_replace(",", ".", $valorPedidoAtual);
            $codStatus          = $pedido->getCodStatus();
            $codCliente         = $pedido->getCodCliente();
            $codRepresentante   = $pedido->getCodRepresentante();
            $fk_instituicao     = $pedido->getFk_Instituicao();
            $dataCadastroAtual  = $pedido->getDataCadastro();
            $dataAlteracao      = $pedido->getDataAlteracao();
            $observacao         = $pedido->getObservacao();
            $anexo              = $pedido->getAnexo();
            $dataCadastro       = $dataCadastroAtual->format('Y-m-d h:m:s');
            $dataAlteracao      = $dataCadastro;
            $nomeanexo =  date('Y-m-d-h:m:s');
            
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $anexo = md5($nomeanexo) . "." . $file_extension;
               //var_dump($file_extension);
                                 
                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                //  echo " teste 02 ".$anexo;
                $anexo = "sem_anexo.php";
            }

            return $this->update(
                'controlePedido',                
                "numeroPregao= :numeroPregao, numeroAf=:numeroAf, valorPedido=:valorPedido, codStatus=:codStatus, codCliente=:codCliente, codRepresentante=:codRepresentante,
                fk_idInstituicao=:fk_instituicao , dataAlteracao=:dataAlteracao, observacao=:observacao, anexo=:anexo",
                [
                    ':codControle' => $codControle,
                    ':numeroPregao' => $numeroLicitacao,
                    ':numeroAf' => $numeroAf,
                    ':valorPedido' => $valorPedido,
                    ':codStatus' => $codStatus,
                    ':codCliente' => $codCliente,
                    ':codRepresentante' => $codRepresentante,
                    ':fk_instituicao' => $fk_instituicao,
                    ':dataAlteracao' => $dataAlteracao,
                    ':observacao' => $observacao,
                    ':anexo' => $anexo,
                ],
                "codControle = :codControle"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
    }

    public function excluir(Pedido $pedido){
        try {
            $codControle = $pedido->getCodControle();

            return $this->delete('controlePedido', "codControle = $codControle");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
