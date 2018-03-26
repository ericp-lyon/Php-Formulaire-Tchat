<?php

namespace App\Controller;


use App\Response;
use App\Role\Role;
use Doctrine\Tests\Common\Annotations;
use App\Form\Form;
use App\DBH;
use App\Entity\Profil;
use App\Entity\Channel;
use App\Model\User;


class Home extends Controller
{
    
     
   
    public function home():Response
    {
        if(Role::USER_VALUE !== $_SESSION["user"]->role){
            
            return $this-> renderDefaultHome();
        }
          try {
          // il faut séparer les 2 type de traitement pour traiter le get ou le post    
              if (filter_input_array(INPUT_GET)
                  && "delete" === filter_input(INPUT_GET, "action")
                  && $this->deleteChannel($_SESSION["user"])){
                      $success = "channel created";
                      return $this ->redirectToUrl("/formation-php/web/");
                      
         
  
              }else if(!$this -> isValid( $_SESSION["user"])){
                  
                  
              }else if ($this->createChannel( $_SESSION["user"])) {
  
                  $success = "channel created";
             }

          } catch (\Throwable $e) {
          }   
          $channels= $this ->getChannel($_SESSION["user"]);
          return $this-> render("channel/owner.html.php",[
                "user" =>$_SESSION["user"],
                "error" => isset($e) ? $e : null,
                "success" => isset($success) ? $success : null,
                "channels" =>  isset($channels) ? $channels : [],
                "titre" => "Mon titre",
                "titre2" => "Mon titre2 ok"
                
            ]);
            
        
    }
    /**
     * 
     * @param User $user
     * @return bool
     * @throws Throwable
     */
    private function createChannel(User $user): bool
    {
  
        $profil = DBH::get()->find(Profil::class,$user->id);
        $channel = new Channel();
        $channel ->setChannelName(filter_input(INPUT_POST, FORM::CHANNEL_NAME));
        $channel ->setChannelDescr(filter_input(INPUT_POST, FORM::CHANNEL_DESCRIPTION_NAME));
        $channel ->setChannelCapacity(filter_input(INPUT_POST, FORM::CHANNEL_CAPACITY));
        $channel ->setProfil($profil);
        DBH::get() ->persist($channel);
        DBH::get() ->flush();
        return true;
 
    }
    /**
     * 
     * @param User $user
     * @return array
     */
    private function getChannel(User $user): array
    {
        return DBH::get()
        ->getRepository(Channel::class)
        ->findBy(["profil" => DBH::get()->find(Profil::class,$user->id)]);
    }
    
    
    private function deleteChannel(User $user)
    {
        $channel = DBH::get()
        ->getRepository(Channel::class)
        ->findOneBy([
            "channelId" => filter_input(INPUT_GET, "channel"),
            "profil" => DBH::get()->find(Profil::class,$user->id)
            
        ]);
        if(!$channel){
            throw new \Error("Channel does not exists");
        }
            
            DBH::get() ->remove($channel);
            DBH::get() ->flush();
            return true;
    }
    private function isValid($user)
    
    {
            //si rien n'est posté false
             if(!filter_input_array(INPUT_POST)){
            return false;
            
             }else if ($user ->token !== filter_input(INPUT_POST, "token")){
                 throw new \Error("Invalid token");
             }else if (! filter_input(INPUT_POST, FORM::CHANNEL_NAME)
                 || ! filter_input(INPUT_POST, FORM::CHANNEL_DESCRIPTION_NAME)
                 || ! filter_input(INPUT_POST, FORM::CHANNEL_CAPACITY)
                 ){
                 throw new \Error("Please complete the form");
             } return true;
    
    }
    
    private function renderDefaultHome(){
        
        return $this ->render ("home.home.html.php",[
            "user" =>$_SESSION["user"],
            "titre" => "Mon titre",
            "titre2" => "Mon titre2 ok"
        ]);
    }
    
    
   
}