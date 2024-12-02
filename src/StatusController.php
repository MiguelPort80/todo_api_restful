<?php	

declare(strict_types=1);
 
namespace App;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
class StatusController
{
    public function status(Request $request, Response $response){
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($this->getStatus());
        return $response->withStatus(200)->withHeader('content-type', 'application/json');    
    }
    

    public function getStatus() {
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
}