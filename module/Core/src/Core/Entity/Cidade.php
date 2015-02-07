<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cidade
 *
 * @ORM\Table(name="saa.cidade", indexes={@ORM\Index(name="IDX_6A98335C773DA226", columns={"id_uf"})})
 * @ORM\Entity
 */
class Cidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cidade_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var \Core\Entity\Uf
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Uf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_uf", referencedColumnName="id")
     * })
     */
    private $idUf;



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
     * Set descricao
     *
     * @param string $descricao
     * @return Cidade
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set idUf
     *
     * @param \Core\Entity\Uf $idUf
     * @return Cidade
     */
    public function setIdUf(\Core\Entity\Uf $idUf = null)
    {
        $this->idUf = $idUf;

        return $this;
    }

    /**
     * Get idUf
     *
     * @return \Core\Entity\Uf 
     */
    public function getIdUf()
    {
        return $this->idUf;
    }
}
