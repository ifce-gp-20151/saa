<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contato
 *
 * @ORM\Table(name="saa.contato", indexes={@ORM\Index(name="IDX_C384AB42F3BCFF90", columns={"id_tipo_contato"})})
 * @ORM\Entity
 */
class Contato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="contato_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contato", type="string", length=255, nullable=false)
     */
    private $contato;

    /**
     * @var \Core\Entity\TipoContato
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\TipoContato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_contato", referencedColumnName="id")
     * })
     */
    private $idTipoContato;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\DadosFamiliares", mappedBy="idContato")
     */
    private $idDadosFamiliares;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Pessoa", mappedBy="idContato")
     */
    private $idPessoa;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idDadosFamiliares = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set contato
     *
     * @param string $contato
     * @return Contato
     */
    public function setContato($contato)
    {
        $this->contato = $contato;

        return $this;
    }

    /**
     * Get contato
     *
     * @return string 
     */
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Set idTipoContato
     *
     * @param \Core\Entity\TipoContato $idTipoContato
     * @return Contato
     */
    public function setIdTipoContato(\Core\Entity\TipoContato $idTipoContato = null)
    {
        $this->idTipoContato = $idTipoContato;

        return $this;
    }

    /**
     * Get idTipoContato
     *
     * @return \Core\Entity\TipoContato 
     */
    public function getIdTipoContato()
    {
        return $this->idTipoContato;
    }

    /**
     * Add idDadosFamiliares
     *
     * @param \Core\Entity\DadosFamiliares $idDadosFamiliares
     * @return Contato
     */
    public function addIdDadosFamiliare(\Core\Entity\DadosFamiliares $idDadosFamiliares)
    {
        $this->idDadosFamiliares[] = $idDadosFamiliares;

        return $this;
    }

    /**
     * Remove idDadosFamiliares
     *
     * @param \Core\Entity\DadosFamiliares $idDadosFamiliares
     */
    public function removeIdDadosFamiliare(\Core\Entity\DadosFamiliares $idDadosFamiliares)
    {
        $this->idDadosFamiliares->removeElement($idDadosFamiliares);
    }

    /**
     * Get idDadosFamiliares
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdDadosFamiliares()
    {
        return $this->idDadosFamiliares;
    }

    /**
     * Add idPessoa
     *
     * @param \Core\Entity\Pessoa $idPessoa
     * @return Contato
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
