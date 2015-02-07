<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 *
 * @ORM\Table(name="saa.endereco", indexes={@ORM\Index(name="IDX_F8E0D60EA7C487E8", columns={"id_bairro"})})
 * @ORM\Entity
 */
class Endereco
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="endereco_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="logradouro", type="string", length=255, nullable=false)
     */
    private $logradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=10, nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=10, nullable=true)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="complemento", type="string", length=255, nullable=true)
     */
    private $complemento;

    /**
     * @var \Core\Entity\Bairro
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Bairro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bairro", referencedColumnName="id")
     * })
     */
    private $idBairro;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Pessoa", mappedBy="idEndereco")
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
     * Set logradouro
     *
     * @param string $logradouro
     * @return Endereco
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get logradouro
     *
     * @return string 
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Endereco
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set cep
     *
     * @param string $cep
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     * @return Endereco
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get complemento
     *
     * @return string 
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set idBairro
     *
     * @param \Core\Entity\Bairro $idBairro
     * @return Endereco
     */
    public function setIdBairro(\Core\Entity\Bairro $idBairro = null)
    {
        $this->idBairro = $idBairro;

        return $this;
    }

    /**
     * Get idBairro
     *
     * @return \Core\Entity\Bairro 
     */
    public function getIdBairro()
    {
        return $this->idBairro;
    }

    /**
     * Add idPessoa
     *
     * @param \Core\Entity\Pessoa $idPessoa
     * @return Endereco
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
