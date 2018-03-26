<?php

namespace App\Controller\Api;

use App\DBH;
use App\Response;
use App\Controller\ChannelController;
use App\Entity\Profil;
use App\Model\User;
use App\Role\Role;
use App\Entity\Channel as ChannelEntity;
use Throwable;
use App\Entity\ChannelProfil;
use App\Entity\Message;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class Channel extends ChannelController
{
    /**
     * 
     * @return Response
     */
    public function channel():Response
    {    // lire les entêtes du client
        $accept = filter_input(INPUT_SERVER, "HTTP_ACCEPT");
        
     
        if("application/json" !== $accept){
            
            $this->response-> setStatus(406,"Not Acceptable");
            //sinon on vérifie si le user n'a pas le role user
        }else if (Role::USER_VALUE !==$_SESSION["user"]->role ){
            
            $this->response-> setStatus(401,"Unauthorized");
            //on vérifie le profil du createur et du subscribe
        }else if (!($profil = $this ->getProfil($_SESSION["user"]))
            || !($channel = $this-> getOwnerOrSubscriberChannel($profil))
     )

        {
                $this->response-> setStatus(403,"Forbidden");

        }else {
            $this->input($profil,$channel);

        }return $this->response;
        
        
    }
    
 //   ?$response->setStatus(201,"Created")
 //   :$response->setStatus(400,"Bad Request")
    
    private function isOwnerChannel(User $user) 
    {
        return DBH::get()
        ->getRepository(ChannelEntity::class)
        ->findOneBy([
            "channelId" => filter_input(INPUT_GET, "channel"),
            "profil" => DBH::get()->find(Profil::class,$user->id)
     ]);
    }
    private function isSubscribberChannel(User $user)
    {
        return DBH::get()
        ->getRepository(ChannelProfil::class)
        ->findOneBy([
            "channel" => filter_input(INPUT_GET, "channel"),
            "profil" => DBH::get()->find(Profil::class,$user->id)
        ]);
    }
    
    private function input($profil,$channel){
        
        $method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
        $encoder = array(new JsonEncoder());
        $normalizer= array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer,$encoder);
        
        if($method==="GET"){
            $message = $this->getMessage($channel);
            $this->response-> setStatus(200,"ok");
            $json = $serializer->serialize($message, "json");
            $this->response->setBody($json);
          //  $this->response-> addHeader("Content-type","application/json");
            var_dump($json);
            return $this->response;
            
        } else if ($method==="POST"){
            
            if (!$this->post($profil,$channel)){
                $this->response-> setStatus(400,"Bad Request");
                return $this->response;
              }   
              $this->response-> setStatus(201,"Created");
              $this->response->setBody("{}");
              $this->response-> addHeader("Content-type","application/json"); 
              return $this->response;
 
        }else {
            $this->response-> setStatus(405,"Method Not Allowed");
            return $this->response;
        }
    }
    
    private function post(Profil $profil, ChannelEntity $channel )
    {
        try {
            
            $message = new Message();
            $message ->setChannel($channel);
            $message->setProfil($profil);
            $message->setMessageText(filter_input(INPUT_POST, "message"));
            $message->setTimestamp(time());
            DBH::get()->persist($message);
            DBH::get()->flush();
           return true;
        } catch (Throwable $e) {
        }

    }
    
    private function getMessage(ChannelEntity $channel){
        
        return DBH::get()->getRepository(Message::class)
        ->findBy([
          "channel" =>$channel
        
        ]);
       
        
    }
 
}