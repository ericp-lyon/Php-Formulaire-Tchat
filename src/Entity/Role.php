<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=255, nullable=false)
     */
    private $roleName;



    /**
     * Set roleName.
     *
     * @param string $roleName
     *
     * @return Role
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    
        return $this;
    }

    /**
     * Get roleName.
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Get roleId.
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }
}
