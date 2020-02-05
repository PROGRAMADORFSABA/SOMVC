<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;
use App\Models\Entidades\Estado;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;

class TransportadoraDAO extends BaseDAO
{
    public function listar(Transportadora $transportadora)
    {
        
        $codTransportadora    = $transportadora->getTraId();        
        $razaoSocial          = $transportadora->getTraRazaoSocial();
        $nomeFantasia         = $transportadora->getTraNomeFantasia();
        $status               = $transportadora->getTraStatus();
        $cnpj                 = $transportadora->getTraCnpj();
        $usuario              = "";//$transportadora->getTraUsuario();
        $instituicao          = '';//$transportadora->getTraInstituicao();
        
        $SQL =
                "SELECT tra.tra_id, tra.tra_razaosocial, tra.tra_nomefantasia,tra.tra_cnpj,tra.tra_ie,tra.tra_email,tra.tra_contato, tra.tra_telefone,
                tra.tra_celular,tra.tra_observacao, tra.tra_datacadastro,tra.tra_dataalteracao,tra.tra_usuario,tra.tra_instituicao,tra.tra_pessoa,tra.tra_status,
                end.end_id,end.end_longradouro,end.end_numero,end.end_bairro,end.end_complemento,end.end_pontoreferencia,end.end_cep,end.end_dataalteracao,end.end_datacadastro,end.end_cidade,end.end_pessoa,
                                u.id, u.nome,u.nivel, u.email, u.status, u.id_dep,
                                i.inst_id, i.inst_codigo, i.inst_nome, i.inst_nomeFantasia,
                                d.id as idDep, d.nome as nomeDep,
                                pes.pes_id,pes.pes_tipo,
                                cid.cidid, cid.cidnome,cid.cidestado,
                                est.estid, est.estnome, est.estuf
                                FROM transportadora as tra
                                INNER JOIN instituicao AS i ON i.inst_id = tra.tra_instituicao
                                INNER JOIN usuarios AS u ON u.id = tra.tra_usuario
                                INNER JOIN departamentos AS d ON d.id = u.id_dep
                                INNER JOIN pessoa AS pes ON pes.pes_id = tra.tra_pessoa                
                                INNER JOIN endereco AS end ON end.end_pessoa = pes.pes_id
                                INNER JOIN cidade AS cid ON cid.cidid = end.end_cidade
                                INNER JOIN estado AS est ON est.estid = cid.cidestado
                ";
           
             $where = Array();
             if( $codTransportadora ){ $where[] = " tra.tra_id = {$codTransportadora}"; }             
             if( $status ){ $where[] = " tra.tra_status = '{$status}'"; }
             if($razaoSocial){ $where[] = " tra.tra_razaosocial = '{$razaoSocial}'"; }
             if($nomeFantasia){ $where[] = " tra.tra_nomefantasia = '{$nomeFantasia}'"; }
             if($cnpj){ $where[] = " tra.tra_cnpj = '{$cnpj}'"; }
             if( $usuario ){ $where[] = " u.id = {$usuario}"; }
             if( $instituicao ){ $where[] = " i.inst_id = {$instituicao}"; }
            
             if( sizeof( $where ) ){
                 $SQL .= ' WHERE '.implode( ' AND ',$where );
                }else {
                   // $SQL .= " WHERE tra.tra_status  NOT IN ('ATIVO') ";
                }                
                $resultado = $this->select($SQL);
         
                $dados = $resultado->fetchAll();
                $lista = [];
                foreach ($dados as $dado) {
                    $transportadora = new Transportadora();
                    $transportadora->setTraId($dado['tra_id']);
                    $transportadora->setTraRazaoSocial($dado['tra_razaosocial']);
                    $transportadora->setTraNomeFantasia($dado['tra_nomefantasia']);
                    $transportadora->setTraCnpj($dado['tra_cnpj']);
                    $transportadora->setTraIE($dado['tra_ie']);
                    $transportadora->setTraEmail($dado['tra_email']);
                    $transportadora->setTraContato($dado['tra_contato']);
                    $transportadora->setTraTelefone($dado['tra_telefone']);
                    $transportadora->setTraCelular($dado['tra_celular']);
                    $transportadora->setTraStatus($dado['tra_status']);
                    $transportadora->setTraObservacao($dado['tra_observacao']);
                    $transportadora->setTraPessoa($dado['tra_pessoa']);
                    $transportadora->setTraDataCadastro($dado['tra_datacadastro']);
                    $transportadora->setTraDataAlteracao($dado['tra_dataalteracao']);
                    $transportadora->setEndLongradouro($dado['end_longradouro']);
                    $transportadora->setEndNumero($dado['end_numero']);
                    $transportadora->setEndBairro($dado['end_bairro']);
                    $transportadora->setEndComplemento($dado['end_complemento']);
                    $transportadora->setEndPontoReferencia($dado['end_pontoreferenai']);
                    $transportadora->setEndCep($dado['end_cep']);
                    $transportadora->setEndPessoa($dado['end_pessoa']);
                    $transportadora->setEndCidade(new Cidade());
                    $transportadora->getEndCidade()->setCidId($dado['cidid']);
                    $transportadora->getEndCidade()->setCidNome($dado['cidnome']);
                    $transportadora->getEndCidade()->setEstado(new Estado());
                    $transportadora->getEndCidade()->getEstado()->setEstId($dado['estid']);
                    $transportadora->getEndCidade()->getEstado()->setEstNome($dado['estnome']);
                    $transportadora->getEndCidade()->getEstado()->setEstUf($dado['estuf']);
                    $transportadora->setTraInstituicao(new Instituicao());
                    $transportadora->getTraInstituicao()->setInst_Id($dado['inst_id']);
                    $transportadora->getTraInstituicao()->setInst_Codigo($dado['inst_codigo']);
                    $transportadora->getTraInstituicao()->setInst_Nome($dado['inst_nome']);
                    $transportadora->setTraUsuario(new Usuario());
                    $transportadora->getTraUsuario()->setId($dado['id']);
                    $transportadora->getTraUsuario()->setNome($dado['nome']);
                    $transportadora->getTraUsuario()->setEmail($dado['email']);
                    $transportadora->getTraUsuario()->setNivel($dado['nivel']);

                    $lista[] = $transportadora;
                }
              
                return $lista;        
    }

    public function salvar(Transportadora $transportadora)
    {
        try {
                $razaoSocial    = $transportadora->getTraRazaoSocial();
                $nomeFantasia   = $transportadora->getTraNomeFantasia();
                $cnpj           = $transportadora->getTraCnpj();
                $insEstadual     = $transportadora->getTraIE();
                $email          = $transportadora->getTraEmail();
                $pessoa         = $transportadora->getTraPessoa();
                $status         = $transportadora->getTraStatus();
                $observacao     = $transportadora->getTraObservacao();
                $telefone       = $transportadora->getTraTelefone();
                $celular        = $transportadora->getTraCelular();
                $contato      = $transportadora->getTraContato(); //$dataAtual = date('Y-m-d H:i:s');
                //$dataCadastro   = $transportadora->getTraDataCadastro()->format('Y-m-d H:m:s');;
                $usuario        = $transportadora->getTraUsuario()->getId();
                $instituicao    = $transportadora->getTraInstituicao()->getInst_Id();
               // $anexo          = $transportadora->getTraAnexo();
                $nomeanexo      =  date('Y-m-d-H:m:s');
    
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
                $anexo = "sem_anexo1.png";
            }            
            return $this->insert(
                'transportadora',
                   ":tra_razaosocial,
                    :tra_nomefantasia,
                    :tra_cnpj,
                    :tra_ie,
                    :tra_email,
                    :tra_contato,
                    :tra_telefone,
                    :tra_celular,
                    :tra_observacao,
                    :tra_status,
                    :tra_datacadastro,
                    :tra_dataalteracao,                   
                    :tra_usuario,
                    :tra_instituicao,
                    :tra_pessoa",
                [                    
                    ':tra_razaosocial'  => $razaoSocial,
                    ':tra_nomefantasia' =>$nomeFantasia,
                    ':tra_cnpj'         => $cnpj,
                    ':tra_ie'           => $insEstadual,
                    ':tra_email'        =>$email,
                    ':tra_contato'      =>$contato,
                    ':tra_telefone'     =>$telefone,
                    ':tra_celular'      => $celular,
                    ':tra_observacao'   => $observacao,
                    ':tra_status'       => $status,
                    ':tra_datacadastro' => date('Y-m-d H:i:s'),
                    ':tra_dataalteracao'=> date('Y-m-d H:i:s'),
                    ':tra_usuario'      =>$usuario,
                    ':tra_instituicao'  =>$instituicao,
                    ':tra_pessoa'       => $pessoa
                ]
            );
                
        } catch (\Exception $e) {
                //var_dump($e);
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
        

    }
    public function alterar(Transportadora $transportadora)
    {        
        try {             
                $codTransportadora  = $transportadora->getTraId();
                $razaoSocial        = $transportadora->getTraRazaoSocial();
                $nomeFantasia       = $transportadora->getTraNomeFantasia();
                $cnpj               = $transportadora->getTraCnpj();
                $insEstadual        = $transportadora->getTraIE();
                $email              = $transportadora->getTraEmail();
                $pessoa             = $transportadora->getTraPessoa();
                $status             = $transportadora->getTraStatus();
                $observacao         = $transportadora->getTraObservacao();
                $telefone           = $transportadora->getTraTelefone();
                $celular            = $transportadora->getTraCelular();
                $contato            = $transportadora->getTraContato(); //$dataAtual = date('Y-m-d H:i:s');
                //$dataCadastro   = $transportadora->getTraDataCadastro()->format('Y-m-d H:m:s');;
                $usuario            = $transportadora->getTraUsuario()->getId();
                $instituicao        = $transportadora->getTraInstituicao()->getInst_Id();
               // $anexo          = $transportadora->getTraAnexo();
                $nomeanexo      =  date('Y-m-d-H:m:s');
            $nomeanexo      = date('Y-m-d-H:m:s');

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
               if($anexo == ""){
                $anexo = "sem_anexo1.png";
                }
            }
            return $this->update(
                'transportadora',
                   "tra_razaosocial     =:razaosocial,
                    tra_nomefantasia    =:nomefantasia,
                    tra_cnpj            =:cnpj,
                    tra_ie              =:ie,
                    tra_email           =:email,
                    tra_contato         =:contato,
                    tra_telefone        =:telefone,
                    tra_celular         =:celular,
                    tra_observacao      =:observacao,
                    tra_status          =:status,
                    tra_dataalteracao   =:dataalteracao,                   
                    tra_usuario         =:usuario,
                    tra_instituicao     =:instituicao,
                    tra_pessoa          =:pessoa",
                [
                    ':codTransportadora'=> $codTransportadora,
                    ':razaosocial'      => $razaoSocial,
                    ':nomefantasia'     =>$nomeFantasia,
                    ':cnpj'             => $cnpj,
                    ':ie'               => $insEstadual,
                    ':email'            =>$email,
                    ':contato'          =>$contato,
                    ':telefone'         =>$telefone,
                    ':celular'          => $celular,
                    ':observacao'       => $observacao,
                    ':status'           => $status,
                    ':dataalteracao'    => date('Y-m-d H:i:s'),
                    ':usuario'          =>$usuario,
                    ':instituicao'      =>$instituicao,
                    ':pessoa'           => $pessoa,
                ],
                "tra_id =:codTransportadora"
            );          
        } catch (\Exception $e) {
           // var_dump("teste ".$e);
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Transportadora $transportadora)
    {        
        try {
            $codTransportadora = $transportadora->getTraId();

            return $this->delete('transportadora', "tra_id = $codTransportadora");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }

}