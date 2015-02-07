<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclResources
 *
 * @ORM\Table(name="saa.acl_resources", uniqueConstraints={@ORM\UniqueConstraint(name="acl_resources_module_id_controller_id_action_id_key", columns={"module_id", "controller_id", "action_id"})}, indexes={@ORM\Index(name="IDX_9863DD9B9D32F035", columns={"action_id"}), @ORM\Index(name="IDX_9863DD9BF6D1A74B", columns={"controller_id"}), @ORM\Index(name="IDX_9863DD9BAFC2B591", columns={"module_id"})})
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
     * @var \Core\Entity\AclActions
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\AclActions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     * })
     */
    private $action;

    /**
     * @var \Core\Entity\AclControllers
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\AclControllers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="controller_id", referencedColumnName="id")
     * })
     */
    private $controller;

    /**
     * @var \Core\Entity\AclModules
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\AclModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\AclRoles", inversedBy="resource")
     * @ORM\JoinTable(name="saa.acl_privileges",
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
     * @param \Core\Entity\AclActions $action
     * @return AclResources
     */
    public function setAction(\Core\Entity\AclActions $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \Core\Entity\AclActions 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set controller
     *
     * @param \Core\Entity\AclControllers $controller
     * @return AclResources
     */
    public function setController(\Core\Entity\AclControllers $controller = null)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller
     *
     * @return \Core\Entity\AclControllers 
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set module
     *
     * @param \Core\Entity\AclModules $module
     * @return AclResources
     */
    public function setModule(\Core\Entity\AclModules $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Core\Entity\AclModules 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Add role
     *
     * @param \Core\Entity\AclRoles $role
     * @return AclResources
     */
    public function addRole(\Core\Entity\AclRoles $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Core\Entity\AclRoles $role
     */
    public function removeRole(\Core\Entity\AclRoles $role)
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
