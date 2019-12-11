<?php

namespace App\Models\DAO;

use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use Exception;

//sug_id, sug_tipo, sug_descricao, sug_status, sug_anexo, sug_datacadastro, sug_dataalteracao ,sug_instituicao, sug_usuario
class SugestoesDAO extends BaseDAO
{

    public  function listar(Sugestoes $sugestoes)
    { 
        $codSugestao    = $sugestoes->getSugId();
        $tipo           = $sugestoes->getSugTipo();
        $status         = $sugestoes->getSugStatus();
        $usuario        = $sugestoes->getCodUsuario();
        $instituicao    = $sugestoes->getCodInstituicao();
        
        $SQL =
                "SELECT sg.sug_id, sg.sug_tipo, sg.sug_descricao, sg.sug_status, sg.sug_anexo, sg.sug_datacadastro, sg.sug_dataalteracao,
                u.id, u.nome,u.nivel, u.email, u.status, u.id_dep,
                i.inst_id, i.inst_codigo, i.inst_nome, i.inst_nomeFantasia,
                d.id as idDep, d.nome as nomeDep
                FROM sugestoes as sg
                INNER JOIN instituicao AS i ON i.inst_id = sg.sug_instituicao
                INNER JOIN usuarios AS u ON u.id = sg.sug_usuario
                INNER JOIN departamentos AS d ON d.id = u.id_dep
                ";
         
             $where = Array();
             if( $codSugestao ){ $where[] = " sg.sug_id = {$codSugestao}"; }             
             if( $status ){ $where[] = " sg.sug_status = '{$status}'"; }
             if( $tipo ){ $where[] = " sg.sug_tipo = '{$tipo}'"; }
             if( $usuario ){ $where[] = " u.id = {$usuario}"; }
             if( $instituicao ){ $where[] = " i.inst_id = {$instituicao}"; }
            
             if( sizeof( $where ) ){
                 $SQL .= ' WHERE '.implode( ' AND ',$where );
                }else {
                    $SQL .= " WHERE sg.sug_status  NOT IN ('CONCLUIDO','CANCELADO') ";
                }
                $resultado = $this->select($SQL);
         
                $dados = $resultado->fetchAll();
                $lista = [];
                foreach ($dados as $dado) {
                    $sugestoes = new Sugestoes();
                    $sugestoes->setSugId($dado['sug_id']);
                    $sugestoes->setSugTipo($dado['sug_tipo']);
                    $sugestoes->setSugDescricao($dado['sug_descricao']);
                    $sugestoes->setSugAnexo($dado['sug_anexo']);
                    $sugestoes->setSugStatus($dado['sug_status']);
                    $sugestoes->setSugDataCadastro($dado['sug_datacadastro']);
                    $sugestoes->setSugDataAlteracao($dado['sug_dataalteracao']);
                    $sugestoes->setInstituicao(new Instituicao());
                    $sugestoes->getInstituicao()->setInst_Id($dado['inst_id']);
                    $sugestoes->getInstituicao()->setInst_Codigo($dado['inst_codigo']);
                    $sugestoes->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $sugestoes->setUsuario(new Usuario());
                    $sugestoes->getUsuario()->setId($dado['id']);
                    $sugestoes->getUsuario()->setNome($dado['nome']);
                    $sugestoes->getUsuario()->setEmail($dado['email']);
                    $sugestoes->getUsuario()->setNivel($dado['nivel']);


                    $lista[] = $sugestoes;
                }
                return $lista;


    }
   
    public  function salvar(Sugestoes $sugestoes)
    {
        try {
                $tipo           = $sugestoes->getSugTipo();
                $status         = $sugestoes->getSugStatus();
                $descricao      = $sugestoes->getSugDescricao();
                $dataCadastro   = $sugestoes->getSugDataCadastro()->format('Y-m-d H:m:s');;
                $usuario        = $sugestoes->getUsuario()->getId();
                $instituicao    = $sugestoes->getInstituicao()->getInst_Id();
                $anexo          = $sugestoes->getSugAnexo();
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
                'sugestoes',
                " :sug_tipo, :sug_descricao, :sug_status, :sug_anexo, :sug_datacadastro, :sug_instituicao, :sug_usuario",
                [
                    ':sug_tipo' => $tipo,
                    ':sug_descricao' => $descricao,
                    ':sug_status' => $status,
                    ':sug_anexo' => $anexo,
                    ':sug_datacadastro' => $dataCadastro,
                    ':sug_instituicao' => $instituicao,
                    ':sug_usuario' => $usuario
                ]
            );
                
        } catch (\Exception $e) {
                //var_dump($e);
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
    }

    public  function atualizar(Sugestoes $sugestoes)
    { 
        try {
            $codSugestao    = $sugestoes->getSugId();
            $tipo           = $sugestoes->getSugTipo();
            $status         = $sugestoes->getSugStatus();
            $descricao      = $sugestoes->getSugDescricao();
            $dataCadastro   = $sugestoes->getSugDataCadastro()->format('Y-m-d H:m:s');;
            $usuario        = $sugestoes->getUsuario()->getId();
            $instituicao    = $sugestoes->getInstituicao()->getInst_Id();
            $anexo          = $sugestoes->getSugAnexo();
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
//sug_id, sug_tipo, sug_descricao, sug_status, sug_anexo, sug_datacadastro, sug_dataalteracao ,sug_instituicao, sug_usuario
            return $this->update(
                'sugestoes',
                "sug_tipo= :tipo, 
                sug_descricao=:descricao, 
                sug_status=:status, 
                sug_anexo=:anexo, 
                sug_datacadastro=:dataCadastro, 
                sug_instituicao=:instituicao, 
                sug_usuario=:usuario",
                [
                    ':codSugestao' => $codSugestao,
                    ':tipo' => $tipo,
                    ':descricao' => $descricao,
                    ':status' => $status,
                    ':anexo' => $anexo,
                    ':dataCadastro' => $dataCadastro,
                    ':instituicao' => $instituicao,
                    ':usuario' => $usuario,
                ],
                "sug_id = :codSugestao"
            );
          
        } catch (\Exception $e) {
            var_dump("teste ".$e);
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
   
    }

    public  function excluir(Sugestoes $sugestoes)
    { 
        try {
            $codSugestao = $sugestoes->getSugId();

            return $this->delete('sugestoes', "sug_id = $codSugestao");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }


}