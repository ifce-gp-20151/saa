<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclControllers
 *
 * @ORM\Table(name="acl_controllers", uniqueConstraints={@ORM\UniqueConstraint(name="acl_controllers_controller_key", columns={"controller"})})
 * @ORM\Entity
 */
class AclControllers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="acl_controllers_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=50, nullable=false)
     */
    private $controller;



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
     * Set controller
     *
     * @param string $controller
     * @return AclControllers
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller
     *
     * @return string 
     */
    public function getController()
    {
        return $this->controller;
    }
}
