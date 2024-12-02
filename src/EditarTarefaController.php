<?php	

declare(strict_types=1);
 
namespace App;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
class EditarTarefaController
{
    public function editarTarefa(Request $request, Response $response, array $args) {
        $jsonData = json_decode($request->getBody()->__toString(), true);
        if ($jsonData == null) {
            return $response->withStatus(404);
        }
        $sucesso = $this->editar(__DIR__ . '/../app/todo.json', $args['id'], $jsonData);
        if (!$sucesso) {
            return $response->withStatus(500)->getBody()->write('Erro ao editar tarefa.');
        }
        return $response->withStatus(200)->withHeader('content-type', 'application/json');;
    }    

    public function editar(string $arquivo, string $id ,array $json){
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
}
