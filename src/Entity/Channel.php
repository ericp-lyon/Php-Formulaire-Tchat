<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="channel", indexes={@ORM\Index(name="profil_id", columns={"profil_id"})})
 * @ORM\Entity
 */
class Channel
{
    /**
     * @var int
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $channelId;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_name", type="string", length=255, nullable=false)
     */
    private $channelName;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_descr", type="string", length=255, nullable=false)
     */
    private $channelDescr;

    /**
     * @var int
     *
     * @ORM\Column(name="channel_capacity", type="integer", nullable=false)
     */
    private $channelCapacity;

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
     * Get channelId.
     *
     * @return int
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set channelName.
     *
     * @param string $channelName
     *
     * @return Channel
     */
    public function setChannelName($channelName)
    {
        $this->channelName = $channelName;
    
        return $this;
    }

    /**
     * Get channelName.
     *
     * @return string
     */
    public function getChannelName()
    {
        return $this->channelName;
    }

    /**
     * Set channelDescr.
     *
     * @param string $channelDescr
     *
     * @return Channel
     */
    public function setChannelDescr($channelDescr)
    {
        $this->channelDescr = $channelDescr;
    
        return $this;
    }

    /**
     * Get channelDescr.
     *
     * @return string
     */
    public function getChannelDescr()
    {
        return $this->channelDescr;
    }

    /**
     * Set channelCapacity.
     *
     * @param int $channelCapacity
     *
     * @return Channel
     */
    public function setChannelCapacity($channelCapacity)
    {
        $this->channelCapacity = $channelCapacity;
    
        return $this;
    }

    /**
     * Get channelCapacity.
     *
     * @return int
     */
    public function getChannelCapacity()
    {
        return $this->channelCapacity;
    }

    /**
     * Set profil.
     *
     * @param \App\Entity\Profil|null $profil
     *
     * @return Channel
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
