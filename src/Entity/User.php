<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="user_email", columns={"user_email"})}, indexes={@ORM\Index(name="user_role", columns={"user_role"}), @ORM\Index(name="user_profile", columns={"user_profile"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_pswd", type="string", length=255, nullable=false)
     */
    private $userPswd;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $userEmail;

    /**
     * @var \App\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Role", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_role", referencedColumnName="role_id")
     * })
     */
    private $userRole;

    /**
     * @var \App\Entity\Profil
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Profil", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_profile", referencedColumnName="profil_id")
     * })
     */
    private $userProfile;



    /**
     * Set userPswd.
     *
     * @param string $userPswd
     *
     * @return User
     */
    public function setUserPswd($userPswd)
    {
        $this->userPswd = $userPswd;
    
        return $this;
    }

    /**
     * Get userPswd.
     *
     * @return string
     */
    public function getUserPswd()
    {
        return $this->userPswd;
    }

    /**
     * Set userEmail.
     *
     * @param string $userEmail
     *
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    
        return $this;
    }

    /**
     * Get userEmail.
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userRole.
     *
     * @param \App\Entity\Role|null $userRole
     *
     * @return User
     */
    public function setUserRole(\App\Entity\Role $userRole = null)
    {
        $this->userRole = $userRole;
    
        return $this;
    }

    /**
     * Get userRole.
     *
     * @return \App\Entity\Role|null
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Set userProfile.
     *
     * @param \App\Entity\Profil|null $userProfile
     *
     * @return User
     */
    public function setUserProfile(\App\Entity\Profil $userProfile = null)
    {
        $this->userProfile = $userProfile;
    
        return $this;
    }

    /**
     * Get userProfile.
     *
     * @return \App\Entity\Profil|null
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }
}
