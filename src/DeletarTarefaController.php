<?php

namespace App;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeletarTarefaController 
{
    public function deletarTarefa(Request $request, Response $response, array $args) {
        $sucesso = $this->deletar(__DIR__ . '/../app/todo.json', $args['id']);
        if (!$sucesso) {
            return $response->withStatus(500)->getBody()->write('Erro ao deletar tarefa.');
        }
        return $response->withStatus(200)->withHeader('content-type', 'application/json');;
    }
    public function deletar(string $arquivo, string $id){
        try {
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
            for ($i=0; $i < sizeof($dados['tarefas']); $i++) { 
                    if ($dados['tarefas'][$i]['ID'] == $id) {
                        unset($dados['tarefas'][$i]['ID']);
                        unset($dados['tarefas'][$i]['Tarefa']);
                        unset($dados['tarefas'][$i]['Concluida']);
                        unset($dados['tarefas'][$i]);
                        file_put_contents($arquivo, json_encode($dados));
                        return true;
                    }
            }
            throw new \Exception("Tarefa não encontrada", 1);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
