<?php

namespace App;

class Response
{
    private 
         /**
         * @var int
         */
        $statusCode,
        /**
         * @var string
         */
        $statusText,
        /**
         * @var array
         */
        $header,
        /**
         * @var string
         */
        $body;
    
        /**
         * constructor
         */
    
   public function __construct()
   {
      $this->statusCode = 200;
      $this->statusText = "ok";
      $this->header = [];
      $this->body ="";
   }
   
   public function setBody(string $body)
   {
       $this->body = $body;
       
   }
   public function getBody(): string
   {
      return $this->body;
       
   }
      /**
    * @param int $code
    * @param string $text
    */
   
   public function setStatus(int $code, string $text)
   {
       $this->statusCode = $code;
       $this->statusText = $text;
   }
   
   /**
    * @return string
    */
   public function getStatus(): string
   {
       return "HTTP/1.1 "
           . $this->statusCode
           . " "
           . $this->statusText;
   }
   public function addHeader(string $name, string $value)
   {
       $this->header[$name] = $value;
              
   }
   /**
    * 
    * @return array
    */
   public function getHeader() : array
   {
       return $this->header;
       
   }
   public function __toString()
   {
       return $this->getBody();
   }
   public function __get($name)
   {
       return property_exists($this, $name)
       ?$this ->{$name}
       :null;
   }
   /**
    * $name est le nom de l'attribut (operande1)
    * $value est la valeur affactée (opérande2)
    */
   public function __set($name, $value)
   {
       throw new \RuntimeException();
       {
           
       }
   }
   
   
   
}

