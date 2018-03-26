<?php
use App\Response;
use App\DBH;

require __DIR__ . "/../vendor/autoload.php";

// var_dump(DBH::get(DBH::PDO));
// var_dump(DBH::get(DBH::DOCTRINE));
// exit;
try {
    
    /**
     * l'url qui doit etre comparé à la patch
     *
     * @var string
     */
    
    $url = filter_input(INPUT_SERVER, "REDIRECT_URL");
//     var_dump($url);
//     exit;
    /**
     * routes collection
     *
     * @var stdClass $routing
     */
    $routing = json_decode(file_get_contents(__DIR__ . "/../app/config/routing.json"));
    // var_dump($routing);
    // exit;
    if (! $url) {
        
        throw new OutOfBoundsException("Can't access directly to front controller");
    } 
    
    // est ce que l'url correspond à la path de la route en cours d'iteration ?
    foreach ($routing as $value) {
        
        if (preg_match(
                "/^" . str_replace("/", "\/", $value->path) . "$/",
            $url
         )) {
                //var_dump("c'est ok");
                unset($url);
                unset($routing);
                $myTab = explode("::", $value->controller);
                $controllerName = $myTab[0];
                $method = $myTab[1];
                
                $controller = new $controllerName();
                $response = $controller->{$method}();
                //ecriture en factoriser à la place de la ligne 41-42 et 45
                // $response = (new $myTab[0]())->{$myTab[1]}();
                unset($controller);
                break;
        }
    }
    //isset vérifie si la variable a été setté
    if (!isset($response)){
        /**
         * 
         * @var \App\Response $response
         */
        $response = new Response;
        
        $response->setStatus(404, "Not Found");
        $response->addHeader("Content-Type", "text/htlm; charset=utf-8");
        $response->setBody("Not Found!");
    }
    
    // entete avec les status
    header($response->getStatus());
    
    // toutes les autres entêtes:
    foreach ($response->getHeader() as $name => $value) {
        header($name . ": " . $value);
    }
    
    // envoyer le body
    echo $response;
    
} catch (Throwable $e) {
    header("HTTP/1.1 500 Internal Server Error");
    header("Content-Type: text/html; charset=utf-8");
    
    die(
        "<h1>Erreur</h1>" 
        . "<b>Erreur</b>: " . $e->getMessage() . " <br> "
        . "<b>line</b>: " . $e->getLine() . " <br> "
        . "<b>file</b>: " . $e->getFile() . " <br> "
        . "</h1>"
        );
}





