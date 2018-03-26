<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChannelProfil
 *
 * @ORM\Table(name="channel_profil", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="profil_id", columns={"profil_id"})})
 * @ORM\Entity
 */
class ChannelProfil
{
    /**
     * @var int
     *
     * @ORM\Column(name="channel_profil_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $channelProfilId;

    /**
     * @var \App\Entity\Channel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Channel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="channel_id")
     * })
     */
    private $channel;

    /**
     * @var \App\Entity\Profil
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profil_id", referencedColumnName="profil_id")
     * })
     */
    private $profil;



    /**
     * Get channelProfilId.
     *
     * @return int
     */
    public function getChannelProfilId()
    {
        return $this->channelProfilId;
    }

    /**
     * Set channel.
     *
     * @param \App\Entity\Channel|null $channel
     *
     * @return ChannelProfil
     */
    public function setChannel(\App\Entity\Channel $channel = null)
    {
        $this->channel = $channel;
    
        return $this;
    }

    /**
     * Get channel.
     *
     * @return \App\Entity\Channel|null
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set profil.
     *
     * @param \App\Entity\Profil|null $profil
     *
     * @return ChannelProfil
     */
    public function setProfil(\App\Entity\Profil $profil = null)
    {
        $this->profil = $profil;
    
        return $this;
    }

    /**
     * Get profil.
     *
     * @return \App\Entity\Profil|null
     */
    public function getProfil()
    {
        return $this->profil;
    }
}
