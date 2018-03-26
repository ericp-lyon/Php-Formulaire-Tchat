<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profil
 *
 * @ORM\Table(name="profil")
 * @ORM\Entity
 */
class Profil
{
    /**
     * @var int
     *
     * @ORM\Column(name="profil_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $profilId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profil_firstname", type="string", length=255, nullable=true)
     */
    private $profilFirstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profil_name", type="string", length=255, nullable=true)
     */
    private $profilName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profil_avatar", type="string", length=255, nullable=true)
     */
    private $profilAvatar;



    /**
     * Set profilFirstname.
     *
     * @param string|null $profilFirstname
     *
     * @return Profil
     */
    public function setProfilFirstname($profilFirstname = null)
    {
        $this->profilFirstname = $profilFirstname;
    
        return $this;
    }

    /**
     * Get profilFirstname.
     *
     * @return string|null
     */
    public function getProfilFirstname()
    {
        return $this->profilFirstname;
    }

    /**
     * Set profilName.
     *
     * @param string|null $profilName
     *
     * @return Profil
     */
    public function setProfilName($profilName = null)
    {
        $this->profilName = $profilName;
    
        return $this;
    }

    /**
     * Get profilName.
     *
     * @return string|null
     */
    public function getProfilName()
    {
        return $this->profilName;
    }

    /**
     * Set profilAvatar.
     *
     * @param string|null $profilAvatar
     *
     * @return Profil
     */
    public function setProfilAvatar($profilAvatar = null)
    {
        $this->profilAvatar = $profilAvatar;
    
        return $this;
    }

    /**
     * Get profilAvatar.
     *
     * @return string|null
     */
    public function getProfilAvatar()
    {
        return $this->profilAvatar;
    }

    /**
     * Get profilId.
     *
     * @return int
     */
    public function getProfilId()
    {
        return $this->profilId;
    }
}
