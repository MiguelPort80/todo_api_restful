<?php
declare(strict_types=1);
use App\DeletarTarefaController;
use App\EditarTarefaController;
use App\NovaTarefaController;
use App\StatusController;
use App\TarefasController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
require_once __DIR__ . "/../app/data.php";
require __DIR__ . '/../vendor/autoload.php';

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });


    $app->get('/', [StatusController::class, 'status']);

    $app->get('/tarefas', [TarefasController::class, 'resgatarTarefas']);

    $app->get('/tarefa/{id}', [TarefasController::class, 'resgatarUmaTarefa']);

    $app->post('/novaTarefa', [NovaTarefaController::class, 'novaTarefa']);

    $app->put('/editarTarefa/{id}', [EditarTarefaController::class, 'editarTarefa']);

    $app->delete('/deletarTarefa/{id}', [DeletarTarefaController::class, 'deletarTarefa']);
};
