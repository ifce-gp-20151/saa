<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DadosFamiliares
 *
 * @ORM\Table(name="saa.dados_familiares", indexes={@ORM\Index(name="IDX_D232754CC14DC792", columns={"id_profissao"}), @ORM\Index(name="IDX_D232754C15ED79C3", columns={"id_grau_parentesco"})})
 * @ORM\Entity(repositoryClass="Core\Repository\DadosFamiliaresRepository")
 */
class DadosFamiliares
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="saa.dados_familiares_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="idade", type="integer", nullable=false)
     */
    private $idade;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fl_mora", type="boolean", nullable=false)
     */
    private $flMora;

    /**
     * @var \Core\Entity\Profissao
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Profissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_profissao", referencedColumnName="id")
     * })
     */
    private $idProfissao;

    /**
     * @var \Core\Entity\GrauParentesco
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\GrauParentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grau_parentesco", referencedColumnName="id")
     * })
     */
    private $idGrauParentesco;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Pessoa", mappedBy="idFamiliares")
     */
    private $idPessoa;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Contato", inversedBy="idDadosFamiliares")
     * @ORM\JoinTable(name="saa.dados_familiares_contato",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_dados_familiares", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_contato", referencedColumnName="id")
     *   }
     * )
     */
    private $idContato;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPessoa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idContato = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nome
     *
     * @param string $nome
     * @return DadosFamiliares
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set idade
     *
     * @param integer $idade
     * @return DadosFamiliares
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;

        return $this;
    }

    /**
     * Get idade
     *
     * @return integer
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * Set flMora
     *
     * @param boolean $flMora
     * @return DadosFamiliares
     */
    public function setFlMora($flMora)
    {
        $this->flMora = $flMora;

        return $this;
    }

    /**
     * Get flMora
     *
     * @return boolean
     */
    public function getFlMora()
    {
        return $this->flMora;
    }

    /**
     * Set idProfissao
     *
     * @param \Core\Entity\Profissao $idProfissao
     * @return DadosFamiliares
     */
    public function setIdProfissao(\Core\Entity\Profissao $idProfissao = null)
    {
        $this->idProfissao = $idProfissao;

        return $this;
    }

    /**
     * Get idProfissao
     *
     * @return \Core\Entity\Profissao
     */
    public function getIdProfissao()
    {
        return $this->idProfissao;
    }

    /**
     * Set idGrauParentesco
     *
     * @param \Core\Entity\GrauParentesco $idGrauParentesco
     * @return DadosFamiliares
     */
    public function setIdGrauParentesco(\Core\Entity\GrauParentesco $idGrauParentesco = null)
    {
        $this->idGrauParentesco = $idGrauParentesco;

        return $this;
    }

    /**
     * Get idGrauParentesco
     *
     * @return \Core\Entity\GrauParentesco
     */
    public function getIdGrauParentesco()
    {
        return $this->idGrauParentesco;
    }

    /**
     * Add idPessoa
     *
     * @param \Core\Entity\Pessoa $idPessoa
     * @return DadosFamiliares
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

    /**
     * Add idContato
     *
     * @param \Core\Entity\Contato $idContato
     * @return DadosFamiliares
     */
    public function addIdContato(\Core\Entity\Contato $idContato)
    {
        $this->idContato[] = $idContato;

        return $this;
    }

    /**
     * Remove idContato
     *
     * @param \Core\Entity\Contato $idContato
     */
    public function removeIdContato(\Core\Entity\Contato $idContato)
    {
        $this->idContato->removeElement($idContato);
    }

    /**
     * Get idContato
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdContato()
    {
        return $this->idContato;
    }

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->idade = (!empty($data['idade'])) ? $data['idade'] : null;
        $this->flMora = (!empty($data['flMora'])) ? true : false;
        $this->idProfissao = (!empty($data['idProfissao'])) ? $data['idProfissao'] : null;
        $this->idGrauParentesco = (!empty($data['id_grau_parentesco'])) ? $data['id_grau_parentesco'] : null;
        $this->idPessoa = (!empty($data['idPessoa'])) ? $data['idPessoa'] : null;
        $this->idContato = (!empty($data['idContato'])) ? $data['idContato'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
