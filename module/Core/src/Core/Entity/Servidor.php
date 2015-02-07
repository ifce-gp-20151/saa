<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servidor
 *
 * @ORM\Table(name="saa.servidor", indexes={@ORM\Index(name="IDX_FB952FF0D56B1641", columns={"id_cargo"})})
 * @ORM\Entity
 */
class Servidor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="servidor_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="siape", type="integer", nullable=false)
     */
    private $siape;

    /**
     * @var \Core\Entity\Cargo
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Cargo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cargo", referencedColumnName="id")
     * })
     */
    private $idCargo;



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
     * Set siape
     *
     * @param integer $siape
     * @return Servidor
     */
    public function setSiape($siape)
    {
        $this->siape = $siape;

        return $this;
    }

    /**
     * Get siape
     *
     * @return integer 
     */
    public function getSiape()
    {
        return $this->siape;
    }

    /**
     * Set idCargo
     *
     * @param \Core\Entity\Cargo $idCargo
     * @return Servidor
     */
    public function setIdCargo(\Core\Entity\Cargo $idCargo = null)
    {
        $this->idCargo = $idCargo;

        return $this;
    }

    /**
     * Get idCargo
     *
     * @return \Core\Entity\Cargo 
     */
    public function getIdCargo()
    {
        return $this->idCargo;
    }
}
