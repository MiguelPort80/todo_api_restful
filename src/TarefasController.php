<?php
declare(strict_types=1);
 
namespace App;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
class TarefasController
{
    static function resgatarTarefas(Request $request, Response $response){
        try {
            $conteudo = file_get_contents(__DIR__ . '/../app/todo.json');
            $dados = json_decode($conteudo, true);
            $response->getBody()->write(json_encode($dados));
            return $response->withStatus(200)->withHeader('content-type', 'application/json');    
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    static function resgatarUmaTarefa(Request $request, Response $response, array $args){
        try {
            $conteudo = file_get_contents(__DIR__ . '/../app/todo.json');
            $dados = json_decode($conteudo, true);
            $id = $args['id'];
                for ($i=0; $i < sizeof($dados['tarefas']); $i++) { 
                    if ($dados['tarefas'][$i]['ID'] == $id) {
                        $return = $dados['tarefas'][$i];
                        $response->getBody()->write(json_encode($return));

                        return $response->withStatus(200)->withHeader('content-type', 'application/json');    
                    }
                }
                throw new \Exception("Tarefa nao encontrada", 1);
            }
            catch (\Throwable $th) {
                throw $th;
            }
 
        }   
}
