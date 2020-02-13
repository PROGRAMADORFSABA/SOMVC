<?php
    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Transacao;
    use App\Lib\Exportar;
    use App\Models\Entidades\Teste;
    use App\Models\DAO\TesteDAO;
    
    
    
    class TesteService
    {
    public function listar($idTeste = null)
    {
        $testeDAO = new TesteDAO();
        return $testeDAO->listar1($idTeste);
    }


    public function autoComplete(Teste $teste)
    {
        $testeDAO = new TesteDAO();
        $busca = $testeDAO->listarPorNomeFantasia($teste);           
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listaClientes($arrayClientes)
    {
		$testeDAO = new TesteDAO();
		$clientes = [];
        
		if(isset($arrayClientes)){
            foreach ($arrayClientes as $codTeste) 
			{			
                $clientes[] = $testeDAO->listar1($codTeste)[0];	
			}
		}
		return $clientes;
    }
    
    public function importarBD($servidor,$usuario,$senha,$dbname,$arquivo)
    {        
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $testeDAO = new TesteDAO();
                                   
           return $testeDAO->importarBD($servidor,$usuario,$senha,$dbname);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
           // Sessao::gravaMensagem("Importado com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $emailService->emailSuporte($e);
            $transacao->rollBack();
            throw new \Exception(["Erro ao Exportar"]);            
            return false;
        }
    }
    public function exportarBD($servidor,$usuario,$senha,$dbname,$arquivo = null)
    {        
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $testeDAO = new TesteDAO();
                                   
           return $testeDAO->exportarBD($servidor,$usuario,$senha,$dbname,$arquivo = null);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
           // Sessao::gravaMensagem("Exportado com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $emailService->emailSuporte($e);
            $transacao->rollBack();
            throw new \Exception(["Erro ao Exportar"]);            
            return false;
        }
    }
}