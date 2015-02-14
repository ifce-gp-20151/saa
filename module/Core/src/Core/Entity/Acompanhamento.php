<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acompanhamento
 *
 * @ORM\Table(name="saa.acompanhamento", indexes={@ORM\Index(name="IDX_85A671915DF1885", columns={"matricula"}), @ORM\Index(name="IDX_85A6719AB4EC365", columns={"id_servidor"})})
 * @ORM\Entity(repositoryClass="Core\Repository\AcompanhamentoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Acompanhamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="saa.acompanhamento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo", type="text", nullable=false)
     */
    private $motivo;

    /**
     * @var string
     *
     * @ORM\Column(name="encaminhado", type="string", length=255, nullable=true)
     */
    private $encaminhado;

    /**
     * @var \Core\Entity\Aluno
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Aluno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matricula", referencedColumnName="matricula")
     * })
     */
    private $matricula;

    /**
     * @var \Core\Entity\Servidor
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Servidor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servidor", referencedColumnName="id")
     * })
     */
    private $idServidor;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Agenda", inversedBy="idAcompanhamento")
     * @ORM\JoinTable(name="saa.agenda_acompanhamento",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_acompanhamento", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_agenda", referencedColumnName="id")
     *   }
     * )
     */
    private $idAgenda;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_criacao", type="datetime", nullable=true, options={"default": "now()"})
     */
    private $dataCriacao;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAgenda = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set motivo
     *
     * @param string $motivo
     * @return Acompanhamento
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo
     *
     * @return string
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set encaminhado
     *
     * @param string $encaminhado
     * @return Acompanhamento
     */
    public function setEncaminhado($encaminhado)
    {
        $this->encaminhado = $encaminhado;

        return $this;
    }

    /**
     * Get encaminhado
     *
     * @return string
     */
    public function getEncaminhado()
    {
        return $this->encaminhado;
    }

    /**
     * Set matricula
     *
     * @param \Core\Entity\Aluno $matricula
     * @return Acompanhamento
     */
    public function setMatricula(\Core\Entity\Aluno $matricula = null)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get dataCriacao
     *
     * @return Datetime
     */
    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    /**
     * Get matricula
     *
     * @return \Core\Entity\Aluno
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set idServidor
     *
     * @param \Core\Entity\Servidor $idServidor
     * @return Acompanhamento
     */
    public function setIdServidor(\Core\Entity\Servidor $idServidor = null)
    {
        $this->idServidor = $idServidor;

        return $this;
    }

    /**
     * Get idServidor
     *
     * @return \Core\Entity\Servidor
     */
    public function getIdServidor()
    {
        return $this->idServidor;
    }

    /**
     * Add idAgenda
     *
     * @param \Core\Entity\Agenda $idAgenda
     * @return Acompanhamento
     */
    public function addIdAgenda(\Core\Entity\Agenda $idAgenda)
    {
        $this->idAgenda[] = $idAgenda;

        return $this;
    }

    /**
     * Remove idAgenda
     *
     * @param \Core\Entity\Agenda $idAgenda
     */
    public function removeIdAgenda(\Core\Entity\Agenda $idAgenda)
    {
        $this->idAgenda->removeElement($idAgenda);
    }

    /**
     * Get idAgenda
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdAgenda()
    {
        return $this->idAgenda;
    }

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        //$this->matricula = (!empty($data['matricula'])) ? $data['matricula'] : null;
        $this->motivo = (!empty($data['motivo'])) ? $data['motivo'] : null;
        $this->encaminhado = (!empty($data['encaminhado'])) ? $data['encaminhado'] : null;
        //$this->id_servidor = (!empty($data['id_servidor'])) ? $data['id_servidor'] : null;
        $this->dataCriacao = (!empty($data['data_criacao'])) ? $data['data_criacao'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
