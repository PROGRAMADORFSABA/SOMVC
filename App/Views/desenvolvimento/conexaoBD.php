<?php  

        $servidor = filter_input(INPUT_POST, 'servidor', FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $dbname = filter_input(INPUT_POST, 'dbname', FILTER_SANITIZE_STRING);

        $result_tabela = "SHOW TABLES";
//Criar a conexao com BD

		try		{
			$DB_con = new PDO("mysql:host=". $servidor .";dbname=". $dbname.";charset=utf8", $usuario, $senha,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo " conexao efetuada com sucesso " ;
            $resultado_tabela = $DB_con->prepare($result_tabela);
            $resultado_tabela->execute();
            $resultados = $resultado_tabela->fetchAll();           
            
            foreach ($resultados as $resultado) {
               // print_r( $resultado)."<br>";
                $lista [] = $resultado[0];                
            }
        
            $result = "";
            foreach($lista as $tabela){
                print_r( $tabela)."<br>";
                //Pesquisar o nome das colunas
                $result_colunas = "SELECT * FROM ".$tabela;
                $resultado_colunas = $DB_con->prepare( $result_colunas);
                $resultado_colunas->execute();
                $num_colunas = rowCount($resultado_colunas);
                //echo $tabela. " - " .$num_colunas. "<br>";
                
                //Criar a instrução para apagar a tabela caso a mesma exista
                $result .= 'DROP TABLE IF EXISTS '.$tabela.';';
                
                //Pesquisar como a coluna é criada
                $result_cr_col = "SHOW CREATE TABLE " .$tabela;
                $resultado_cd_col = $DB_con->prepare( $result_cr_col);
                $resultado_cd_col->execute();
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
            
            //Criar o diretório de backup
            $diretorio = 'backup/';
            if(!is_dir($diretorio)){
                mkdir($diretorio, 0777, true);
                chmod($diretorio, 0777);
            }
            
            //Nome do arquivo de backup
            $data = date('Y-m-d-h-i-s');
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
                header("Content-Type: application/force-download");
                header("Content-Disposition: attachment; filename=\"" . basename($download) . "\";");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . filesize($download));
                readfile($download);
                $_SESSION['msg'] = "<span style='color: green'>Exportado BD com sucesso</span>";
            }else{
                $_SESSION['msg'] = "<span style='color: red'>Erro ao exportar o BD</span>";
            }
            
                    
      
          
        
        
        
        
        }
		catch(PDOException $e)		{
            echo $e->getMessage();
		}
		return $DB_con;
		mysql_query("SET NAMES 'utf8'");
    

        
       