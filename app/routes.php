<?php
//TODO: Fazer rota de PUT
//TODO: Fazer rota de DELETE

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
require_once __DIR__ . "/../app/data.php";

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write(Data::status());
        return $response->withStatus(200)->withHeader('content-type', 'application/json');    
    });

    $app->get('/tarefas', function (Request $request, Response $response) {
        $data = Data::resgatarTarefas(__DIR__ . '/../app/todo.json');
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(200)->withHeader('content-type', 'application/json');    
    });

    $app->get('/tarefa/{id}', function (Request $request, Response $response, array $args) {
        
        $data = Data::resgatarUmaTarefa(__DIR__ . '/../app/todo.json', $args['id']);
        $response->getBody()->write(json_encode($data));

        return $response->withStatus(200)->withHeader('content-type', 'application/json');    
    });

    $app->post('/novaTarefa', function(Request $request, Response $response){
        $jsonData = json_decode($request->getBody()->__toString(), true);
        if ($jsonData == null) {
            return $response->withStatus(404);
        }
        $sucesso = Data::adicionar(__DIR__ . '/../app/todo.json', $jsonData);

        if (!$sucesso) {
            return $response->withStatus(500)->getBody()->write('Erro ao adicionar tarefa.');
        }
        return $response->withStatus(201);
    });


    $app->put('/editarTarefa/{id}', function(Request $request, Response $response, array $args){
        $jsonData = json_decode($request->getBody()->__toString(), true);
        if ($jsonData == null) {
            return $response->withStatus(404);
        }
        $sucesso = Data::editarTarefa(__DIR__ . '/../app/todo.json', $args['id'], $jsonData);
        if (!$sucesso) {
            return $response->withStatus(500)->getBody()->write('Erro ao editar tarefa.');
        }
        return $response->withStatus(200)->withHeader('content-type', 'application/json');;
    });

    $app->delete('/deletarTarefa/{id}', function(Request $request, Response $response, array $args){
        $sucesso = Data::deletarTarefa(__DIR__ . '/../app/todo.json', $args['id']);
        if (!$sucesso) {
            return $response->withStatus(500)->getBody()->write('Erro ao deletar tarefa.');
        }
        return $response->withStatus(200)->withHeader('content-type', 'application/json');;
    });
};
