<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profissao
 *
 * @ORM\Table(name="saa.profissao")
 * @ORM\Entity
 */
class Profissao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="profissao_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=50, nullable=false)
     */
    private $descricao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Pessoa", mappedBy="idProfissao")
     */
    private $idPessoa;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPessoa = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set descricao
     *
     * @param string $descricao
     * @return Profissao
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
     * Add idPessoa
     *
     * @param \Core\Entity\Pessoa $idPessoa
     * @return Profissao
     */
    public function addIdPessoa(\Core\Entity\Pessoa $idPessoa)
    {
        $this->idPessoa[] = $idPessoa;

        return $this;
    }

    /**
     * Remove idPessoa
     *
     * @param \Core\Entity\Pessoa $idPessoa
     */
    public function removeIdPessoa(\Core\Entity\Pessoa $idPessoa)
    {
        $this->idPessoa->removeElement($idPessoa);
    }

    /**
     * Get idPessoa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdPessoa()
    {
        return $this->idPessoa;
    }
}
