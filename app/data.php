<?php
declare(strict_types=1);
//DADOS DA TODOLIST
class Data{
    static function status() {
        if (file_exists(__DIR__ . '/../app/todo.json')) {
            $json = [
                "status" => "200",
                "mensagem" => "servidor ativo",
                "data" => date('Y-m-d H:i:s')
            ];
            
            return json_encode($json);
        }else {
            $json = [
                "status" => "404",
                "mensagem" => "servidor inativo",
                "data" => date('Y-m-d H:i:s')
            ];
            
            return json_encode($json);
        }
    }    


    static function resgatarTarefas(string $arquivo){
        try {
            
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
            return $dados;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    static function resgatarUmaTarefa(string $arquivo, string $id){
        try {
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
                for ($i=0; $i < sizeof($dados['tarefas']); $i++) { 
                    if ($dados['tarefas'][$i]['ID'] == $id) {
                        $return = $dados['tarefas'][$i];
                        return $return;
                    }
                }
                throw new Exception("Tarefa não encontrada", 1);
            }
            catch (\Throwable $th) {
                throw $th;
            }
 
        }   
     
    static function adicionar(string $arquivo, array $json){
        try {
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
            $dados['tarefas'][] = $json;
            $conteudo = json_encode($dados);
            file_put_contents($arquivo, $conteudo);

        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    static function editarTarefa(string $arquivo, string $id ,array $json){
        try {
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
            for ($i=0; $i < sizeof($dados['tarefas']); $i++) { 
                    if ($dados['tarefas'][$i]['ID'] == $id) {

                        $dados['tarefas'][$i]['ID'] = $json['ID'];
                        $dados['tarefas'][$i]['Tarefa'] = $json['Tarefa'];
                        $dados['tarefas'][$i]['Concluida'] = $json['Concluida'];
                        file_put_contents($arquivo, json_encode($dados));
                        return true;
                    }
            }
            throw new Exception("Tarefa não encontrada", 1);
        } catch (\Throwable $th) {
            return false;
        }
    }

    static function deletarTarefa(string $arquivo, string $id){
        try {
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
            for ($i=0; $i < sizeof($dados['tarefas']); $i++) { 
                    if ($dados['tarefas'][$i]['ID'] == $id) {
                        unset($dados['tarefas'][$i]);
                        file_put_contents($arquivo, json_encode($dados));
                        return true;
                    }
            }
            throw new Exception("Tarefa não encontrada", 1);
        } catch (\Throwable $th) {
            return false;
        }
    }
}