<?php

namespace App\Controller;

use App\Model\User;
use App\DBH;
use App\Role\Role;
use App\Response;


class Signin extends Controller
{
    
     
    
    public function signin()
    {
        
        
      // $this->init();

        if($_SESSION["user"]->role != Role::VISITOR_VALUE ){
            
            $response = new Response();
            $response -> addHeader("Location", "/formation-php/web/");
            return $response;
          }
        
         $user = $_SESSION["user"];

        
        try {
            
            
            if (!$user ->hydrate( filter_input_array(INPUT_POST))) {
                
            } else if ($user ->token !== $_SESSION["user"]->token) {
                
                throw new \Error("Invalid token");
                
            } else if (!$user -> email || !$user-> pswd ) 
            {
                    
                throw new \Error("Please complete the form");
            }
                else if (! filter_var($user->email , FILTER_VALIDATE_EMAIL)){
                    
                 throw new \Error("Please submit a valid email");
                 
            } else if (!  $this-> verify($user)){
                    
                 throw new \Error("user not found");
            } else {        
                
                $_SESSION["user"]->id = $this-> selectProfilId($_SESSION["user"]);
               // var_dump( $_SESSION["user"]->id);
                $_SESSION["user"]->email = null;
                $_SESSION["user"]->pswd = null;
                
                    $success ="Your account is valide";
                  
            }
                    
                    
        } catch (\throwable $e) {}
        
        return $this->render("signin.signin.html.php", [
            "token" => $_SESSION["user"]->token,
            "error" => isset($e) ? $e : null, // on lui passe le message à la vue
            "success" => isset($success) ? $success : null,
            "user" => $user,
            "titre" => "Mon titre",
            "titre2" => "Mon titre2 ok",
               
           
       ]);
    }
    /**
     * 
     * @param User $user
     * @throws \Error
     * @return boolean
     */
    private function verify(User $user){
        
        try {
            //récupération du pdo avec la méthode car on ne peut pas l'avoir avec le this
            DBH::get(DBH::PDO) -> beginTransaction();
           // var_dump($this-> verifyMail($user -> email));
           return  $this-> verifyMail($user -> email)
                && $this-> verifyPswd($user -> email, $user->pswd)
                && DBH::get(DBH::PDO) -> commit()
                && $this -> upgradeRoleBdd($user -> email)
                && $this -> upgradeRoleSession(); 
            
            
        } catch (\throwable $e) {
            
            if (DBH::get(DBH::PDO)-> inTransaction()){
                DBH::get(DBH::PDO) ->rollBack();
                return false;
            }
            DBH::get(DBH::PDO) -> commit();
            throw new \Error ("contact WebMaster");
            
        }
    } 
    private function verifyMail($email){
        $pdo = DBH::get(DBH::PDO);
        $sth = DBH::get(DBH::PDO) -> prepare(
           " SELECT COUNT(user_email) FROM user WHERE user_email = :email"
            );
       
        $sth -> bindValue(":email", $email);
        $sth -> execute();
      // permet de compter et veirifier que c'est strictement = à 1
        return $sth->fetch($pdo::FETCH_OBJ)->{"COUNT(user_email)"} === "1";
       // var_dump( $sth->fetch($pdo::FETCH_ASSOC)["COUNT(user_email)"]);

        
    
        
    }
    private function verifyPswd($email,$pswd){
        
        $pdo = DBH::get(DBH::PDO);
        $sth = DBH::get(DBH::PDO) -> prepare(
            "SELECT user_pswd FROM user WHERE user_email = :email"
            );
        
        $sth -> bindValue(":email", $email);
        $sth -> execute();
       // var_dump($pswd);
       
        return password_verify($pswd, $sth->fetch($pdo::FETCH_OBJ)->{"user_pswd"});
     
    }
    
    private function upgradeRoleBdd($email){
       
        
        $sth = DBH::get(DBH::PDO) -> prepare(
        
            "UPDATE user SET user_role =" . Role::USER_VALUE . " WHERE user_email = :email"
            );
        $sth -> bindValue(":email", $email);
        return $sth -> execute();
  
    }
    
    
    private function upgradeRoleSession(){
        
        return $_SESSION["user"]-> role =  Role::USER_VALUE;
        
    }
    
    private function selectProfilId(User $user){
        
        $pdo = DBH::get(DBH::PDO);
        $sth = DBH::get(DBH::PDO) -> prepare(
            "SELECT user_profile FROM user WHERE user_email = :email"
            );
        
        $sth -> bindValue(":email", $user-> email);
        $sth -> execute();
          
        return (int) $sth->fetch($pdo::FETCH_OBJ) -> user_profile;
        
   }
    
    
    
    
    
   
}