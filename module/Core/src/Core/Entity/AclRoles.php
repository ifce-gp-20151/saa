<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclRoles
 *
 * @ORM\Table(name="saa.acl_roles", uniqueConstraints={@ORM\UniqueConstraint(name="acl_roles_role_key", columns={"role"})}, indexes={@ORM\Index(name="IDX_32A763783D8E604F", columns={"parent"})})
 * @ORM\Entity
 */
class AclRoles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="acl_roles_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=false)
     */
    private $role;

    /**
     * @var \Core\Entity\AclRoles
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\AclRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\AclResources", mappedBy="role")
     */
    private $resource;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resource = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return AclRoles
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set parent
     *
     * @param \Core\Entity\AclRoles $parent
     * @return AclRoles
     */
    public function setParent(\Core\Entity\AclRoles $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Core\Entity\AclRoles 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add resource
     *
     * @param \Core\Entity\AclResources $resource
     * @return AclRoles
     */
    public function addResource(\Core\Entity\AclResources $resource)
    {
        $this->resource[] = $resource;

        return $this;
    }

    /**
     * Remove resource
     *
     * @param \Core\Entity\AclResources $resource
     */
    public function removeResource(\Core\Entity\AclResources $resource)
    {
        $this->resource->removeElement($resource);
    }

    /**
     * Get resource
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResource()
    {
        return $this->resource;
    }
}
