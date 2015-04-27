<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pessoa
 *
 * @ORM\Table(name="saa.pessoa", uniqueConstraints={@ORM\UniqueConstraint(name="pessoa_cpf_key", columns={"cpf"})}, indexes={@ORM\Index(name="IDX_1CDFAB82D7E358F6", columns={"id_estado_civil"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Pessoa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="saa.pessoa_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=11, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="rg", type="string", length=20, nullable=true)
     */
    private $rg;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=true)
     */
    private $sexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_nascimento", type="date", nullable=false)
     */
    private $dtNascimento;

    /**
     * @var \Core\Entity\EstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\EstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_civil", referencedColumnName="id")
     * })
     */
    private $idEstadoCivil;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Profissao", inversedBy="idPessoa")
     * @ORM\JoinTable(name="saa.atividade_remunerada",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_profissao", referencedColumnName="id")
     *   }
     * )
     */
    private $idProfissao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\DadosFamiliares", inversedBy="idPessoa")
     * @ORM\JoinTable(name="saa.pessoa_familiares",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_familiares", referencedColumnName="id")
     *   }
     * )
     */
    private $idFamiliares;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Contato", inversedBy="idPessoa")
     * @ORM\JoinTable(name="saa.pessoa_contato",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_contato", referencedColumnName="id")
     *   }
     * )
     */
    private $idContato;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Endereco", inversedBy="idPessoa")
     * @ORM\JoinTable(name="saa.pessoa_endereco",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_endereco", referencedColumnName="id")
     *   }
     * )
     */
    private $idEndereco;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProfissao = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idFamiliares = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idContato = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idEndereco = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Pessoa
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
     * Set cpf
     *
     * @param string $cpf
     * @return Pessoa
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set rg
     *
     * @param string $rg
     * @return Pessoa
     */
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get rg
     *
     * @return string
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Pessoa
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     * @return Pessoa
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;

        return $this;
    }

    /**
     * Get dtNascimento
     *
     * @return \DateTime
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * Set idEstadoCivil
     *
     * @param \Core\Entity\EstadoCivil $idEstadoCivil
     * @return Pessoa
     */
    public function setIdEstadoCivil(\Core\Entity\EstadoCivil $idEstadoCivil = null)
    {
        $this->idEstadoCivil = $idEstadoCivil;

        return $this;
    }

    /**
     * Get idEstadoCivil
     *
     * @return \Core\Entity\EstadoCivil
     */
    public function getIdEstadoCivil()
    {
        return $this->idEstadoCivil;
    }

    /**
     * Add idProfissao
     *
     * @param \Core\Entity\Profissao $idProfissao
     * @return Pessoa
     */
    public function addIdProfissao(\Core\Entity\Profissao $idProfissao)
    {
        $this->idProfissao[] = $idProfissao;

        return $this;
    }

    /**
     * Remove idProfissao
     *
     * @param \Core\Entity\Profissao $idProfissao
     */
    public function removeIdProfissao(\Core\Entity\Profissao $idProfissao)
    {
        $this->idProfissao->removeElement($idProfissao);
    }

    /**
     * Get idProfissao
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdProfissao()
    {
        return $this->idProfissao;
    }

    /**
     * Add idFamiliares
     *
     * @param \Core\Entity\DadosFamiliares $idFamiliares
     * @return Pessoa
     */
    public function addIdFamiliares(\Core\Entity\DadosFamiliares $idFamiliares)
    {
        $this->idFamiliares[] = $idFamiliares;

        return $this;
    }

    /**
     * Remove idFamiliares
     *
     * @param \Core\Entity\DadosFamiliares $idFamiliares
     */
    public function removeIdFamiliares(\Core\Entity\DadosFamiliares $idFamiliares)
    {
        $this->idFamiliares->removeElement($idFamiliares);
    }

    /**
     * Get idFamiliares
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdFamiliares()
    {
        return $this->idFamiliares;
    }

    /**
     * Add idContato
     *
     * @param \Core\Entity\Contato $idContato
     * @return Pessoa
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

    /**
     * Add idEndereco
     *
     * @param \Core\Entity\Endereco $idEndereco
     * @return Pessoa
     */
    public function addIdEndereco(\Core\Entity\Endereco $idEndereco)
    {
        $this->idEndereco[] = $idEndereco;

        return $this;
    }

    /**
     * Remove idEndereco
     *
     * @param \Core\Entity\Endereco $idEndereco
     */
    public function removeIdEndereco(\Core\Entity\Endereco $idEndereco)
    {
        $this->idEndereco->removeElement($idEndereco);
    }

    /**
     * Get idEndereco
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdEndereco()
    {
        return $this->idEndereco;
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function upcase() {
        $this->nome = mb_strtoupper($this->nome, 'UTF-8');
    }
    
    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->cpf = (!empty($data['cpf'])) ? $data['cpf'] : null;
        $this->rg = (!empty($data['rg'])) ? $data['rg'] : null;
        $this->sexo = (!empty($data['sexo'])) ? $data['sexo'] : null;
        $this->dtNascimento = (!empty($data['dt_nascimento'])) ? \DateTime::createFromFormat('d/m/Y', $data['dt_nascimento']) : null;
        //idEstadoCivil
        //idProfissao
        //idFamiliares
        //idContato
        //idEndereco
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
}

