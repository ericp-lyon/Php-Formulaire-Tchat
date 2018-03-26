<?php
namespace App\Controller;

use App\Response;
use App\DBH;
use App\Role\Role;


class Signout extends Controller
 
{
    
    public function signout() : Response
    {
        
       $user = $_SESSION["user"];
             
        $this -> downgradeRoleBdd($user->id);
        $this -> upgradeRoleSession();
       
       $this -> revoke();
        
        return $this-> redirectToUrl("/formation-php/web/");
             
    }
    
    private function upgradeRoleSession(){
        
        return $_SESSION["user"]-> role =  Role::VISITOR_VALUE;
        
    }
    
        
    private function downgradeRoleBdd($profilId){   
               
        $sth = DBH::get(DBH::PDO) -> prepare(
            
            "UPDATE user SET user_role =" . Role::VISITOR_VALUE . " WHERE user_profile = :profilId"
            );
        $sth -> bindValue(":profilId", $profilId);
        return $sth -> execute();

    }
    
    

}