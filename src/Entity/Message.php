<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="profil_id", columns={"profil_id"}), @ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="message_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;

    /**
     * @var string
     *
     * @ORM\Column(name="message_text", type="string", length=255, nullable=false)
     */
    private $messageText;

    /**
     * @var int
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    private $timestamp;

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
     * @var \App\Entity\Channel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Channel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="channel_id")
     * })
     */
    private $channel;



    /**
     * Get messageId.
     *
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set messageText.
     *
     * @param string $messageText
     *
     * @return Message
     */
    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;
    
        return $this;
    }

    /**
     * Get messageText.
     *
     * @return string
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * Set timestamp.
     *
     * @param int $timestamp
     *
     * @return Message
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * Get timestamp.
     *
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set profil.
     *
     * @param \App\Entity\Profil|null $profil
     *
     * @return Message
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

    /**
     * Set channel.
     *
     * @param \App\Entity\Channel|null $channel
     *
     * @return Message
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
}
