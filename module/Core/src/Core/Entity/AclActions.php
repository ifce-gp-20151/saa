<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclActions
 *
 * @ORM\Table(name="saa.acl_actions", uniqueConstraints={@ORM\UniqueConstraint(name="acl_actions_action_key", columns={"action"})})
 * @ORM\Entity
 */
class AclActions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="acl_actions_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=50, nullable=false)
     */
    private $action;



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
     * @param string $action
     * @return AclActions
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}
