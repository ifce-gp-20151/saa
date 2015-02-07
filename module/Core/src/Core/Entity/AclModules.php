<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclModules
 *
 * @ORM\Table(name="saa.acl_modules", uniqueConstraints={@ORM\UniqueConstraint(name="acl_modules_module_key", columns={"module"})})
 * @ORM\Entity
 */
class AclModules
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="acl_modules_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=50, nullable=false)
     */
    private $module;



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
     * Set module
     *
     * @param string $module
     * @return AclModules
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }
}
