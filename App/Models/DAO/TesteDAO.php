<?php

namespace App\Models\DAO;

use App\Models\Entidades\Teste;
use App\Models\Entidades\Cliente;
use App\Models\Entidades\Pedido;

class TesteDAO extends BaseDAO
{
    public function listarTeste($codControle = null)
    {
       //  $codControle    = $pedido->getCodControle();

        if ($codControle) {
            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.fk_idInstituicao,con.dataAlteracao,con.valorPedido,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
                ,c.codCliente,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
                ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
                ,i.inst_id,i.inst_nome,s.codStatus,s.nome
                FROM controlePedido AS con 
                 INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                 INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
                 INNER JOIN cliente AS c on c.codCliente = con.codCliente
                 INNER JOIN instituicao AS i on i.inst_codigo = con.fk_idInstituicao
                 WHERE con.codControle = $codControle "
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
                    //$pedido->setFk_Instituicao($dado['fk_idInstituicao']);
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
                print json_encode($lista);
          
            }
        } else {
            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
               ,c.codCliente,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
               ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
               ,i.inst_nome
               FROM controlePedido AS con 
				INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
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
                    //$pedido->setFk_Instituicao($dado['fk_idInstituicao']);
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

    public function listarPorNomeFantasia(Teste $teste)
    {
        $resultado = $this->select(
            "SELECT * FROM cliente WHERE nomeFantasiaCliente 
            LIKE '%".$teste->getNomeFantasiaCliente()."%' LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function listarTeste1(Pedido $pedido)
    {

        $codStatus    = $pedido->getCodStatus();
        $codCliente    = $pedido->getCodCliente();
        $codControle    = $pedido->getCodControle();
        $numeroLicitacao    = $pedido->getNumeroLicitacao();
        $numeroAf           = $pedido->getNumeroAf();

        if ($codControle && $numeroLicitacao && $numeroAf && $codStatus && $codCliente) {
            $WHERE = "  WHERE con.codControle = $codControle AND con.codStatus = $codStatus AND con.numeroAf = '" . $numeroAf . "' AND con.numeroPregao = '" . $numeroLicitacao . "'";
        } elseif ($codControle && $numeroLicitacao && $codStatus) {
            $WHERE = "  WHERE con.codControle = $codControle AND con.codStatus = $codStatus AND con.numeroPregao = '" . $numeroLicitacao . "'";
        } elseif ($codControle && $numeroAf && $codStatus) {
            $WHERE = "  WHERE con.codControle = $codControle AND con.codStatus = $codStatus AND con.numeroAf = '" . $numeroAf . "'";
        } elseif ($codControle && $numeroAf) {
            $WHERE = "  WHERE con.codControle = $codControle  AND con.numeroPregao = '" . $numeroAf . "'";
        } elseif ($codControle && $codStatus) {
            $WHERE = "  WHERE con.codControle = $codControle AND con.codStatus = $codStatus";
        } elseif ($codControle) {
            $WHERE = "  WHERE con.codControle = $codControle ";
        } elseif ($numeroLicitacao && $numeroAf && $codStatus) {
            $WHERE = "  WHERE con.codStatus = $codStatus AND con.numeroAf = '" . $numeroAf . "' AND con.numeroPregao = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao && $numeroAf) {
            $WHERE = "  WHERE con.numeroAf = '" . $numeroAf . "' AND con.numeroPregao = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao && $codStatus) {
            $WHERE = "  WHERE con.codStatus = $codStatus AND con.numeroPregao = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao) {
            $WHERE = "  WHERE con.numeroPregao = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao) {
            $WHERE = "  WHERE  con.numeroPregao = '" . $numeroLicitacao . "'";
        } elseif ($numeroAf && $codStatus) {
            $WHERE = "  WHERE con.codStatus = $codStatus AND con.numeroAf = '" . $numeroAf . "'";
        } elseif ($numeroAf) {
            $WHERE = "  WHERE con.numeroAf = '" . $numeroAf . "'";
        } elseif ($codStatus && $codCliente) {
            $WHERE = "  WHERE con.codStatus = $codStatus AND con.codCliente = $codCliente";
        } elseif ($codStatus) {
            $WHERE = "  WHERE con.codStatus = $codStatus";
        } elseif ($codCliente) {
            $WHERE = "  WHERE con.codCliente = $codCliente";
        } else {
            $WHERE = "";
        }
        $sql = "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.fk_idInstituicao,con.dataAlteracao,con.valorPedido,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
            ,c.codCliente,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
            ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
            ,i.inst_id,i.inst_nome,s.codStatus,s.nome
            FROM controlePedido AS con 
             INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
             INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
             INNER JOIN cliente AS c on c.codCliente = con.codCliente
             INNER JOIN instituicao AS i on i.inst_codigo = con.fk_idInstituicao $WHERE ";

        $resultado = $this->select(
            $sql
        );

        $dados = $resultado->fetchAll();

        if ($dados) {

            $lista = [];
            //$soma = 0;
            foreach ($dados as $dado) {

                $pedido = new Pedido();
                $pedido->setCodControle($dado['codControle']);
                $pedido->setDataCadastro($dado['dataCadastro']);
                //date_format($date, 'Y-m-d H:i:s');
                $pedido->setNumeroLicitacao($dado['numeroPregao']);
                $pedido->setNumeroAf($dado['numeroAf']);
                $pedido->setSomaPedido($dado['valorPedido']);
                $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                $pedido->setCodStatus($dado['idStatus']);
                $pedido->setCodCliente($dado['idCliente']);
                $pedido->setAnexo($dado['anexo']);
                $pedido->setObservacao($dado['observacao']);
                $pedido->setCodRepresentante($dado['idRepresentante']);
                //$pedido->setFk_Instituicao($dado['fk_idInstituicao']);
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
        return false;
    }

    public function listar($codControle = null)
    {

        if ($codControle) {
            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.fk_idInstituicao,con.dataAlteracao,con.valorPedido,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
                ,c.codCliente,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
                ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
                ,i.inst_id,i.inst_nome,s.codStatus,s.nome
                FROM controlePedido AS con 
                 INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                 INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
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
				INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
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
                    //$pedido->setFk_Instituicao($dado['fk_idInstituicao']);
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

    public  function listar1($id = null)
    {
        if($id) 
        {
            $resultado = $this->select(
                "SELECT * FROM cliente WHERE codCliente = $id"
            );
        }
        else
        {
            $resultado = $this->select(
                'SELECT * FROM cliente'
            );
            
        }
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Teste::class);
    }

    public function listarAtendidos($codControle = null)
    {

        if ($codControle) {
            $resultado = $this->select(
                "SELECT con.codControle,CON.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,c.tipoCliente,c.nomeCliente,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
                FROM controlePedido AS con 
                 INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                 INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
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
				INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
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
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
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
            throw new \Exception("Erro na gravação de dados. " . $valorPedidoAtual, 500);
        }
    }

    public function excluir(Pedido $pedido)
    {
        try {
            $codControle = $pedido->getCodControle();

            return $this->delete('controlePedido', "codControle = $codControle");
        } catch (\Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

    public function exportarBD($servidor,$usuario,$senha,$dbname,$arquivo = null)
    {
        try{
            $conn = mysqli_connect($servidor,$usuario,$senha,$dbname);
            if($arquivo){
                return $this->importar($conn, $arquivo);
            }else{
                return $this->exportar($conn);
            }
        } catch (\Exception $e) {
            throw new \Exception("erro exportar ", 500);            
        }               
    }
   
    public function importar($conn,$arquivo)
    {
        //Ler os dados do arquivo e converter em string
        $dados = file_get_contents($arquivo);
       if($dados){           
           //Executar as query do backup
           mysqli_multi_query($conn, $dados);
           
           return true;
        }else{
            return false;
        }
    }
    
    public function exportar($conn)
    {
        if ($conn) {                
            $result_tabela = "SHOW TABLES";
            $resultado_tabela = mysqli_query($conn, $result_tabela);       
            while($resultado = mysqli_fetch_row($resultado_tabela)){
                $tabelas[] = $resultado[0];
             }
          
            try	{                
                $result = "";
                foreach($tabelas as $tabela){
                    //Pesquisar o nome das colunas
                    $result_colunas = "SELECT * FROM ".$tabela;
                    $resultado_colunas = mysqli_query($conn, $result_colunas);
                
                    $num_colunas = mysqli_num_fields($resultado_colunas);
                    //echo $tabela. " - " .$num_colunas. "<br>";
                    
                    //Criar a instrução para apagar a tabela caso a mesma exista
                    $result .= 'DROP TABLE IF EXISTS '.$tabela.';';
                    
                    //Pesquisar como a coluna é criada
                    $result_cr_col = "SHOW CREATE TABLE " .$tabela;
                    $resultado_cd_col = mysqli_query($conn,  $result_cr_col);
                  
                    $row_cr_col = mysqli_fetch_row($resultado_cd_col);
                    //var_dump($row_cr_col);
                    $result .= "\n\n".$row_cr_col[1] . ";\n\n";
                    
                    //percorrer o array de colunas
                    for($i = 0; $i < $num_colunas; $i++){
                        //Ler o valor de cada coluna no banco de dados
                        while($row_tp_col = mysqli_fetch_row($resultado_colunas)){
                            //var_dump($row_tp_col);
                            //Criar a intrução da QUERY para inserir os dados
                            $result .= 'INSERT INTO '.$tabela.' VALUES (';
                            
                            //Ler os dados da tabela
                            for($j = 0; $j < $num_colunas; $j++){
                                //addslashes — Adiciona barras invertidas a uma string
                                $row_tp_col[$j] = addslashes($row_tp_col[$j]);
                                //str_replace — Substitui todas as ocorrências da string \n pela \\n
                                $row_tp_col[$j] = str_replace("\n" , "\\n", $row_tp_col[$j]);
                                
                                if(isset($row_tp_col[$j])){
                                    if(!empty($row_tp_col[$j])){
                                        $result .= '"'.$row_tp_col[$j].'"';
                                    }else{
                                        $result .= 'NULL';
                                    }
                                }else{
                                    $result .= 'NULL';
                                }
                                
                                if($j < ($num_colunas - 1)){
                                    $result .=',';
                                }
                            }
                            $result .= ");\n";
                        }
                    }
                    $result .= "\n\n";
                }
                //echo $result;
                
                //Criar o diretório de backup Downloads
                 $diretorio = 'public/assets/media/anexos/backup/';
                
                if(!is_dir($diretorio)){
                    mkdir($diretorio, 0777, true);
                    chmod($diretorio, 0777);
                }
                
                //Nome do arquivo de backup
               // $data = date('Y-m-d-h-i-s');
                $data = date('l-H');
                $nome_arquivo = $diretorio."db_backup_".$data;
                
                $handle = fopen($nome_arquivo.'.sql', 'w+');
                fwrite($handle, $result);
                fclose($handle);
                   
                
                //Montar o link do arquivo
                $download = $nome_arquivo . ".sql";
                //Adicionar o header para download
                if(file_exists($download)){
                    header("Pragma: public");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private", false);
                    //header("Content-Type: application/force-download");
                    //header("Content-Disposition: attachment; filename=\"" . basename($download) . "\";");
                    /*header("Content-Transfer-Encoding: binary");
                    header("Content-Length: " . filesize($download));
                    readfile($download);*/
                    // Sessao::gravaMensagem("<span style='color: green'>Exportado BD com sucesso</span>");
                   // header('Location: ../');
                   //echo " <span style='color: green'>Exportado BD com sucesso</span> ";
                   return true;
                }else{
                    // Sessao::gravaMensagem("<span style='color: red'>Erro ao exportar o BD</span>");
                  //  echo "<span style='color: red'>Erro ao exportar o BD</span>";
                    //$this->render('desenvolvimento/index');
                    return false;
                }
            }
            catch(\PDOException $e)		{
                echo $e->getMessage();
                return false; 
            }
            //mysql_query("SET NAMES 'utf8'");
        } else {            
            return false; 
        }

    }
    

}