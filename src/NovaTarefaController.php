<?php	

declare(strict_types=1);
 
namespace App;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
class NovaTarefaController
{
    public function novaTarefa(Request $request, Response $response){
        $jsonData = json_decode($request->getBody()->__toString(), true);
        if ($jsonData == null) {
            return $response->withStatus(404);
        }
        $sucesso = $this->adicionar(__DIR__ . '/../app/todo.json', $jsonData);

        if (!$sucesso) {
            return $response->withStatus(500)->getBody()->write('Erro ao adicionar tarefa.');
        }
        return $response->withStatus(201);
    }


    public function adicionar(string $arquivo, array $json){
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
}
