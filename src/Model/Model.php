<?php

namespace App\Model;

class Model 
{
    
    /**
     * 
     * @param string $name
     * @return  mixed | NULL
     */
    public function __get($name)
    {
        return property_exists($this, $name)
        ?$this ->{$name}
        :null;
    }
    /**
     * 
     * @param string $name
     * @param  mixed | NULL
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name))
        
        {
            $this ->{$name} = $value;
        }
    }
    
    public function hydrate($inputArray){
        if(!$inputArray){
            return false;
        }
        
        foreach ($inputArray as $name =>$value){
            
            $this -> __set($name, $value);
        }
        return true;
    }
    
    
    
}