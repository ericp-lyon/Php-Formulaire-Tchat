<?php

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\DatabaseDriver;
use Doctrine\ORM\Tools\Setup;

class DBH
{
        const DOCTRINE = 1,PDO = 2;
    /**
     * @var instance
     */
    private static $instance;
    
     /**
     * @var Doctrine Manager
     */
    private $em;
  
    private function __construct()
    {
        $this->em = $this ->buildEm();
        
        $driver = new DatabaseDriver($this->em->getConnection()->getSchemaManager());
        $driver->setNamespace("App\\Entity\\");
        $this->em->getConfiguration()->setMetadataDriverImpl($driver);
        
        
    }
 
    public static function getInstance() : self
    {
        if(!self::$instance){
            
            self::$instance = new self;
        }
        return self::$instance;
     }
     
     public static function get($type = self::DOCTRINE){
         
         return $type == self ::DOCTRINE
         ? self::getInstance()->em
         : self::getInstance()->em->getConnection()->getWrappedConnection();
     }
    
    private function getParameters() : \stdClass
    {
        
        return json_decode(file_get_contents(__DIR__ . "/../app/config/parameters.json"));
        
    }
    private function buildEm(){ //retourn PDO
             
             $cfg = $this->getParameters();
             return $entityManager = EntityManager::create([
                 
                 "driver"   => "pdo_". $cfg -> database_driver,
                 "user"     => $cfg -> database_user,
                 'password' => $cfg -> database_password,
                 "dbname"   => $cfg ->database_name,
                 "enum" => "string"
             ],
                 Setup::createAnnotationMetadataConfiguration(
                     [__DIR__."/Entity"], false)
                 
                 );
      }
   
    
}