<?php

namespace App\Controller;

use App\Response;
use App\Model\User;
use App\Role\Role;


class Controller{
    
    
    const INCLUDE_PATH = __DIR__ . "/../Ressources/views/";
    protected $response;
    // on peut faire le choix de mettre le this init dans le construct ou dans chaque controller
    public function __construct(){
        
        $this -> init();
     $this-> response = new Response();
    }
    
    
    
    //on se base sur la syntaxe de symfony, le deuxieme param est optionnel et on doit lui spécifier
    protected function render(string $view, array $parameters=[])
    {
        
        $filename = self::INCLUDE_PATH . $view;
        
        if(!is_readable($filename))
        {
            throw new \InvalidArgumentException("this view file is not readable");
        }
        
        /**
         * permet d 'extraire les parametres en dynamique
         */
        extract($parameters);
        
        /**
         * encadrer le include en le mettant dans le tampon pour qu il ne parte
         * pas dans le navigateur mais gérer uniquement par la response centralisée
         */
         
        ob_start();
        include $filename;
        $output = ob_get_contents();
        ob_end_clean();
        $response = new Response();
        $response ->setBody($output);
        return $response;
     
    }
    /**
     * 
     * @return User|boolean
     */
    
    protected function init(){
        
        session_start();
              
      if(!array_key_exists("user", $_SESSION)){
          $user = new User();
          $user->agent = filter_input(INPUT_SERVER, "HTTP_USER_AGENT");
          $user->ip = filter_input(INPUT_SERVER, "REMOTE_ADDR");
          $user->timestamp = time(); 
          $user->token = md5(uniqid(uniqid(),true)); 
          $user->role= Role::VISITOR_VALUE;
          return $_SESSION ["user"] = $user;
      }
      
      return $this->authorize();
   
        
    }
    /**
     * 
     * @throws \RuntimeException
     * return boolean | null
     */
   
    protected function authorize()
    {
        if( $_SESSION["user"] -> agent
          !== filter_input(INPUT_SERVER, "HTTP_USER_AGENT")
            || $_SESSION["user"]->ip
          !==filter_input(INPUT_SERVER, "REMOTE_ADDR"))
              {$this-> revoke();
                 throw new  \RuntimeException("Authorization failure");
              }
               return true ;
       
    }
    
    /*
     * 
     */    
     protected function revoke(){
        
        return session_destroy();
        
    }
    /**
     * 
     * @param string $url
     * @return Response
     */
    
    protected function redirectToUrl(string $url) : Response
    {
        
        $response = new Response();
        $response -> addHeader("Location", $url);
        return $response;
        
    }
 
}