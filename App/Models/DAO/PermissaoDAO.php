<?php

namespace App\Models\DAO;

use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Permissao;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use Exception;

//sug_id, sug_tipo, sug_descricao, sug_status, sug_anexo, sug_datacadastro, sug_dataalteracao ,sug_instituicao, sug_usuario
class PermissaoDAO extends BaseDAO
{

    public  function listar(Permissao $permissao)
    { 
        $codPermissao    = $permissao->getPerCodigo();
        $usuario        = $permissao->getCodUsuario();
        $instituicao    = $permissao->getCodInstituicao();
        
        $SQL =
                "SELECT per.per_codigo, per.per_tela, per.per_grupo, per.per_incluir, per.per_alterar, per.per_excluir, per.per_pesquisar, per.per_imprimir, per.per_visualisar, per.per_dataalteracao,per.per_datacadastro, per.per_usuario, per.per_instituicao,
                u.id, u.nome,u.nivel, u.email, u.status, u.id_dep,
                i.inst_id, i.inst_codigo, i.inst_nome, i.inst_nomeFantasia,
                d.id as idDep, d.nome as nomeDep
                FROM permissao as per
                INNER JOIN instituicao AS i ON i.inst_id = per.per_instituicao
                INNER JOIN usuarios AS u ON u.id = per.per_usuario
                INNER JOIN departamentos AS d ON d.id = u.id_dep
                ";
         
             $where = Array();
             if( $codPermissao ){ $where[] = " per.per_codigo = {$codPermissao}"; }             
             if( $usuario ){ $where[] = " u.id = {$usuario}"; }
             if( $instituicao ){ $where[] = " i.inst_id = {$instituicao}"; }
            
             if( sizeof( $where ) ){
                 $SQL .= ' WHERE '.implode( ' AND ',$where );
                }
                
                $resultado = $this->select($SQL);
         
                $dados = $resultado->fetchAll();
                $lista = [];
                foreach ($dados as $dado) {
                    $permissao = new Permissao();
                    $permissao->setPerCodigo($dado['per_codigo']);
                    $permissao->setPerAlterar($dado['per_alterar']);
                    $permissao->setPerGrupo($dado['per_grupo']);
                    $permissao->setPerIncluir($dado['per_incluir']);
                    $permissao->setPerExcluir($dado['per_excluir']);
                    $permissao->setPerImprimir($dado['per_imprimir']);
                    $permissao->setPerRelatorio($dado['per_relatorio']);
                    $permissao->setPerVisualisar($dado['per_visualisar']);
                    $permissao->setPerTela($dado['per_tela']);
                    $permissao->setPerDataCadastro($dado['per_datacadastro']);
                    $permissao->setPerDataAlteracao($dado['per_dataalteracao']);
                    $permissao->setInstituicao(new Instituicao());
                    $permissao->getInstituicao()->setInst_Id($dado['inst_id']);
                    $permissao->getInstituicao()->setInst_Codigo($dado['inst_codigo']);
                    $permissao->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $permissao->setUsuario(new Usuario());
                    $permissao->getUsuario()->setId($dado['id']);
                    $permissao->getUsuario()->setNome($dado['nome']);
                    $permissao->getUsuario()->setEmail($dado['email']);
                    $permissao->getUsuario()->setNivel($dado['nivel']);


                    $lista[] = $permissao;
                }
                return $lista;


    }
   
    public  function salvar(Permissao $permissao)
    {
        try{
            if (isset($permissao)) {            
                         
                    $alterar        = $permissao->getPerAlterar();
                    var_dump( $alterar);
                    $grupo          = $permissao->getPerGrupo();
                    $incluir        = $permissao->getPerIncluir();
                    $excluir        = $permissao->getPerExcluir();
                    $imprimir       = $permissao->getPerImprimir();
                    $relatorio      = $permissao->getPerRelatorio();
                    $visualisar     = $permissao->getPerVisualisar();
                    $tela           = $permissao->getPerTela();                   
                    $usuario        = $permissao->getUsuario()->getId();
                    $instituicao    = $permissao->getInstituicao()->getInst_Id();                
                    $dataCadastro   = $permissao->getPerDataCadastro()->format('Y-m-d H:m:s');;
                    return $this->insert(
                        'permissao',
                        ":per_codigo, :per_tela, :per_grupo, :per_incluir, :per_alterar, :per_excluir, :per_pesquisar, :per_imprimir, :per_visualisar, :per_dataalteracao,:per_datacadastro, :per_usuario, :per_instituicao",
                        [
                            ':per_codigo' => $usuario,
                            ':per_tela' => $tela,
                            ':per_grupo' => $grupo,
                            ':per_incluir' => $incluir,
                            ':per_alterar' => $alterar,
                            ':per_excluir' => $excluir,
                            ':per_imprimir' => $imprimir,
                            ':per_relatorio' => $relatorio,
                            ':per_visualisar' => $visualisar,
                            ':per_datacadastro' => $dataCadastro,
                            ':per_instituicao' => $instituicao,
                            ':per_usuario' => $usuario
                            ]
                        );
                        
                    }
                
            } catch (\Exception $e) {
                //var_dump($e);
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
    }

    /*public  function atualizar(Permissao $permissao)
    { 
        try {
            $codPermissao=     $permissao->getPerCodigo();
            $alterar    $permissao->getPerAlterar();
            $incluir =    $permissao->getPerIncluir();
            $excluir    $permissao->getPerExcluir();
            $imprimir =    $permissao->getPerImprimir();
            $relatorio =    $permissao->getPerRelatorio();
            $visualisar =    $permissao->getPerVisualisar();
            $tela =    $permissao->getPerTela();                   
            $dataCadastro   = $permissao->getPerDataCadastro()->format('Y-m-d H:m:s');;
            $usuario        = $permissao->getUsuario()->getId();
            $instituicao    = $permissao->getInstituicao()->getInst_Id();

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
                'sugestoes',
                "sug_tipo= :tipo, 
                sug_descricao=:descricao, 
                sug_status=:status, 
                sug_anexo=:anexo, 
                sug_datacadastro=:dataCadastro, 
                sug_instituicao=:instituicao, 
                sug_usuario=:usuario",
                [
                    ':codSugestao' => $codPermissao,
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

    public  function excluir(Permissao $permissao)
    { 
        try {
            $codPermissao = $permissao->getPerCodigo();

            return $this->delete('sugestoes', "sug_id = $codPermissao");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }

*/
}