<?php

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Profil;
use App\DBH;
use App\Entity\Channel;
use App\Entity\ChannelProfil;

require __DIR__ . "/../vendor/autoload.php";


// lire un user
// $user = DBH::get() -> find(
    
//     User::class,
//     47
    
//     );
// var_dump($user ->getUserRole()-> getRoleName());

// exit;

//lire un profile
// $profil = DBH::get() -> find(
    
//     Profil::class,
//     61
    
//     );

// var_dump($profil -> getProfilFirstName());
// exit;

//inserer liés 
//il faut un profile qui vient de doctrine

// $profil = DBH::get() -> find(Profil::class,62);

// $channel = new Channel();

// $channel -> setChannelName("channel name 62");
// $channel -> setChannelDescr("chanel descr 62");
// $channel -> setChannelCapacity(15);
// $channel -> setProfil($profil);

// // //insérer

// DBH::get() -> persist($channel);
// DBH::get() -> flush();

//  exit;

// inserer un channel_profil
// $profil1 = DBH::get() -> find(Profil::class,60);
// $profil2 = DBH::get() -> find(Profil::class,61);

// $channel = DBH::get() -> find(Channel::class,4);

// $channelProfil = new ChannelProfil();

// $channelProfil ->setChannel($channel);
// $channelProfil ->setProfil($profil1);
// DBH::get()->persist($channelProfil);
// DBH::get()->flush();

// $channelProfil = new ChannelProfil();

// $channelProfil ->setChannel($channel);
// $channelProfil ->setProfil($profil2);
// DBH::get()->persist($channelProfil);
// DBH::get()->flush();

// on veut supprimer un channel profil



// on essaye de lire le $channelProfil
// $channelProfil = DBH::get() -> find(ChannelProfil::class,1);
// var_dump($channelProfil->getChannel());
// exit;

//on essaye de supprimer le chanelprofil
$channelProfil = DBH::get() -> find(ChannelProfil::class,1);

DBH::get()->remove($channelProfil);
DBH::get() -> flush();

// $channel -> setChannelDescr("chanel descr test");
// $channel -> setChannelCapacity(5);
// $channel -> setProfil($profil);

// //insérer

// DBH::get() -> persist($channel);
// DBH::get() -> flush();

// exit;


// $user = new User;
// $role = new Role();
// $profil = new Profil();

// $user->setUserEmail("eric-get-php@fr.fr");
// $user->setUserPswd("Aa123");

// $role->setRoleName("administrateur");

// $profil->setProfilAvatar("perico");
// $profil->setProfilFirstname("eric");
// $profil->setProfilName("monsieur");

// $user->setUserProfile($profil);
// $user->setUserRole($role);

// //pour la creation 
// $entityManager->persist($user);
// //pour vider la mémoire tampon
// $entityManager->flush();
