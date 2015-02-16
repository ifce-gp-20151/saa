<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcompanhamentoIndividual
 *
 * @ORM\Table(name="saa.acompanhamento_individual", indexes={@ORM\Index(name="IDX_36C13975353CDA1F", columns={"id_acompanhamento"})})
 * @ORM\Entity(repositoryClass="Core\Repository\AcompanhamentoIndividualRepository")
 * @ORM\HasLifecycleCallbacks
 */
class AcompanhamentoIndividual
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="saa.acompanhamento_individual_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_encontro", type="integer", nullable=false)
     */
    private $numeroEncontro;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    private $descricao;

    /**
     * @var \Core\Entity\Acompanhamento
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Acompanhamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_acompanhamento", referencedColumnName="id")
     * })
     */
    private $idAcompanhamento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_criacao", type="datetime", nullable=false)
     */
    private $dataCriacao;

    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->dataCriacao = new \DateTime('now');
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
     * Set numeroEncontro
     *
     * @param integer $numeroEncontro
     * @return AcompanhamentoIndividual
     */
    public function setNumeroEncontro($numeroEncontro)
    {
        $this->numeroEncontro = $numeroEncontro;

        return $this;
    }

    /**
     * Get numeroEncontro
     *
     * @return integer
     */
    public function getNumeroEncontro()
    {
        return $this->numeroEncontro;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return AcompanhamentoIndividual
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
     * Set idAcompanhamento
     *
     * @param \Core\Entity\Acompanhamento $idAcompanhamento
     * @return AcompanhamentoIndividual
     */
    public function setIdAcompanhamento(\Core\Entity\Acompanhamento $idAcompanhamento = null)
    {
        $this->idAcompanhamento = $idAcompanhamento;

        return $this;
    }

    /**
     * Get idAcompanhamento
     *
     * @return \Core\Entity\Acompanhamento
     */
    public function getIdAcompanhamento()
    {
        return $this->idAcompanhamento;
    }

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->numero_encontro = (!empty($data['numero_encontro'])) ? $data['numero_encontro'] : null;
        $this->descricao = (!empty($data['descricao'])) ? $data['descricao'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
