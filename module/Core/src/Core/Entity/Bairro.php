<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bairro
 *
 * @ORM\Table(name="saa.bairro", indexes={@ORM\Index(name="IDX_81F332054CAF86B1", columns={"id_cidade"})})
 * @ORM\Entity
 */
class Bairro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="bairro_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var \Core\Entity\Cidade
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Cidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cidade", referencedColumnName="id")
     * })
     */
    private $idCidade;



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
     * @return Bairro
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
     * Set idCidade
     *
     * @param \Core\Entity\Cidade $idCidade
     * @return Bairro
     */
    public function setIdCidade(\Core\Entity\Cidade $idCidade = null)
    {
        $this->idCidade = $idCidade;

        return $this;
    }

    /**
     * Get idCidade
     *
     * @return \Core\Entity\Cidade 
     */
    public function getIdCidade()
    {
        return $this->idCidade;
    }
}
