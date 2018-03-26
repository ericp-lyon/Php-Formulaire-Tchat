<?php

namespace App\Model;

class User extends Model
{
    protected 
    /**
     * @var integer
     */
    $id,
    /**
     * @var integer
     */
    $ip,
    /**
     * @var string
     */
    $agent,
    
    /**
     * @var integer
     */
    $timestamp,
    
    /**
     * @var string
     */
    $email,
    /**
     * @var string
     */
    $pswd,
    
    /**
     * @var string
     */
    $token,
    
    /**
     * @var integer
     */
    $role;
    
}
