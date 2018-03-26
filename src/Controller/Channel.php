<?php

namespace App\Controller;


use App\DBH;
use App\Response;
use App\Entity\Profil;
use App\Model\User;
use App\Role\Role;
use Throwable;
use App\Entity\Channel as ChannelEntity;
use Error;
use App\Entity\ChannelProfil;



class Channel extends ChannelController
{
    /**
     * 
     * @return Response
     */
    public function channel():Response
    {
        if(Role::USER_VALUE !== $_SESSION["user"]->role){

            throw new Error("can't not access ti user pages");
        }
        try {
            $profil = $this->getProfil($_SESSION["user"]);
            $channel = $this->getOwnerOrSubscriberChannel($profil);
            
            if(!$channel){
                throw new Error("can't not access ti user pages");
            }
   
        } catch (Throwable $e) 
    
        {
            return $this ->redirectToUrl("/formation-php/web/");
        }
       
        return $this-> render("channel/channel.html.php",[
            "user" =>$_SESSION["user"],
            "titre" => "Bonjour User: ".$_SESSION["user"]->id,
            "titre2" => "Vous êtes sur le Channel: ".$channel->getChannelId(),
           //"channel"=>$channel
        ]);
    }
    
    protected function getOwnerOrSubscriberChannel(Profil $profil){
        
        return !($channel = $this->getOwnerChannel($profil))
               ? $this->getSubscriberChannel($profil)
               : $channel;
    }
    
    /**
     * 
     * @return ChannelEntity|null
     */
    protected function getChannel(){
        
        return DBH::get()->find(
            ChannelEntity::class,
            filter_input(INPUT_GET, "id")
             );
    }
    /**
     * 
     * @param Profil $profil
     * @return ChannelEntity|null
     */
    protected function getOwnerChannel(Profil $profil){
        
        return DBH::get()->getRepository(ChannelEntity::class)
        ->findOneBy([
            "channelId"=>filter_input(INPUT_GET, "id"),
            "profil"=>$profil
        ]);
    }
    /**
     * 
     * @param Profil $profil
     * @return ChannelEntity|null
     */
    protected function getSubscriberChannel(Profil $profil){
        
        return DBH::get()->getRepository(ChannelProfil::class)
        ->findOneBy([
            "channel"=>$this->getChannel($profil),
            "profil"=>$profil
        ])->getChannel();
        
    }
    
    protected function getProfil(User $user){
        
        return DBH::get()->find(Profil::class, $user->id);
    }
    
   
    
}