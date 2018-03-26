<?php

namespace App\Controller;

use App\DBH;
use App\Response;
use App\Entity\Profil;
use App\Model\User;
use App\Role\Role;
use App\Entity\Channel as ChannelEntity;
use App\Entity\ChannelProfil;


class ChannelController extends Controller{
        
//     protected $response;
//     // on peut faire le choix de mettre le this init dans le construct ou dans chaque controller
//     public function __construct(){
        
//       //  $this -> init();
//         $this-> response = new Response();
//     }
    
     
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
        
        $channel= DBH::get()->getRepository(ChannelProfil::class)
        ->findOneBy([
            "channel"=>$this->getChannel($profil),
            "profil"=>$profil
        ]);
        return $channel ? $channel->getChannel(): null;
        
    }
    
    protected function getProfil(User $user){
        
        return DBH::get()->find(Profil::class, $user->id);
    }
    
}