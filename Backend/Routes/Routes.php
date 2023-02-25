<?php
namespace App\Routes;

use Bramus\Router\Router;
use App\Controller\GendersController;
use App\Controller\CharacterController;
use App\Controller\ForumsController;
use App\Controller\ThreadsController;
use App\View\ThreadView;

use App\Validators\CharacterValidator;
use App\Validators\ThreadValidator;

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}

$router = new Router();

$router->get('/', function() {
    echo "coucou";
});

$router->mount('/characters', function() use ($router){

    $router->get('/', function(){
        (new CharacterController)->fetchCharacters();
    });

    $router->get('/{characterId}', function($characterId){
        (new CharacterController)->fetchCharacterOfChoice($characterId);
    });

    $router->delete('/{characterId/delete}', function($characterId){
        (new CharacterController)->eraseCharacter($characterId);
    });

    $router->post('/add', function(){
        $payload = json_decode(file_get_contents('php://input'), true);
        $res = (new CharacterValidator($payload))->validateCharacter();
        return $res;
    });

});

$router->mount('/genders', function() use ($router){

    $router->get('/', function(){
        (new GendersController)->getGendersAll();
    });
});

$router->mount('/forums', function() use ($router){

    $router->get('/', function(){
        (new ForumsController)->getAllForums();
    });
});

$router->mount('/threads', function() use ($router){

    $router->get('/', function(){
        (new ThreadsController)->getAllThreads();
    });

    $router->post('/add', function(){
        $payload = json_decode(file_get_contents('php://input'), true);
        $res = (new ThreadValidator($payload))->validateThread();
        return $res;
    });

    $router->put('/{threadId}/update', function($threadId){
        $payload = json_decode(file_get_contents('php://input'), true);
        (new ThreadView)->updateThread($threadId, $payload);
    });
});


$router->run();

