<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclResources
 *
 * @ORM\Table(name="acl_resources", uniqueConstraints={@ORM\UniqueConstraint(name="acl_resources_module_id_controller_id_action_id_key", columns={"module_id", "controller_id", "action_id"})}, indexes={@ORM\Index(name="IDX_9863DD9B9D32F035", columns={"action_id"}), @ORM\Index(name="IDX_9863DD9BF6D1A74B", columns={"controller_id"}), @ORM\Index(name="IDX_9863DD9BAFC2B591", columns={"module_id"})})
 * @ORM\Entity
 */
class AclResources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="acl_resources_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Application\Entity\AclActions
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\AclActions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     * })
     */
    private $action;

    /**
     * @var \Application\Entity\AclControllers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\AclControllers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="controller_id", referencedColumnName="id")
     * })
     */
    private $controller;

    /**
     * @var \Application\Entity\AclModules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\AclModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application\Entity\AclRoles", inversedBy="resource")
     * @ORM\JoinTable(name="acl_privileges",
     *   joinColumns={
     *     @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   }
     * )
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set action
     *
     * @param \Application\Entity\AclActions $action
     * @return AclResources
     */
    public function setAction(\Application\Entity\AclActions $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \Application\Entity\AclActions 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set controller
     *
     * @param \Application\Entity\AclControllers $controller
     * @return AclResources
     */
    public function setController(\Application\Entity\AclControllers $controller = null)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller
     *
     * @return \Application\Entity\AclControllers 
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set module
     *
     * @param \Application\Entity\AclModules $module
     * @return AclResources
     */
    public function setModule(\Application\Entity\AclModules $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\AclModules 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Add role
     *
     * @param \Application\Entity\AclRoles $role
     * @return AclResources
     */
    public function addRole(\Application\Entity\AclRoles $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Application\Entity\AclRoles $role
     */
    public function removeRole(\Application\Entity\AclRoles $role)
    {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRole()
    {
        return $this->role;
    }
}
