<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 *
 * @ORM\Table(name="saa.agenda")
 * @ORM\Entity(repositoryClass="Core\Repository\AgendaRepository")
 */
class Agenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="saa.agenda_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fl_ocorreu", type="boolean", nullable=false)
     */
    private $flOcorreu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=true)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fim", type="time", nullable=true)
     */
    private $horaFim;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Core\Entity\Acompanhamento", mappedBy="idAgenda")
     */
    private $idAcompanhamento;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAcompanhamento = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set data
     *
     * @param \DateTime $data
     * @return Agenda
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set flOcorreu
     *
     * @param boolean $flOcorreu
     * @return Agenda
     */
    public function setFlOcorreu($flOcorreu)
    {
        $this->flOcorreu = $flOcorreu;

        return $this;
    }

    /**
     * Get flOcorreu
     *
     * @return boolean
     */
    public function getFlOcorreu()
    {
        return $this->flOcorreu;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return Agenda
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFim
     *
     * @param \DateTime $horaFim
     * @return Agenda
     */
    public function setHoraFim($horaFim)
    {
        $this->horaFim = $horaFim;

        return $this;
    }

    /**
     * Get horaFim
     *
     * @return \DateTime
     */
    public function getHoraFim()
    {
        return $this->horaFim;
    }

    /**
     * Add idAcompanhamento
     *
     * @param \Core\Entity\Acompanhamento $idAcompanhamento
     * @return Agenda
     */
    public function addIdAcompanhamento(\Core\Entity\Acompanhamento $idAcompanhamento)
    {
        $this->idAcompanhamento[] = $idAcompanhamento;

        return $this;
    }

    /**
     * Remove idAcompanhamento
     *
     * @param \Core\Entity\Acompanhamento $idAcompanhamento
     */
    public function removeIdAcompanhamento(\Core\Entity\Acompanhamento $idAcompanhamento)
    {
        $this->idAcompanhamento->removeElement($idAcompanhamento);
    }

    /**
     * Get idAcompanhamento
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdAcompanhamento()
    {
        return $this->idAcompanhamento;
    }

    public function exchangeArray($data) {

        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        //$this->matricula = (!empty($data['matricula'])) ? $data['matricula'] : null;
        $this->data = (!empty($data['data'])) ? \DateTime::createFromFormat('d/m/Y', $data['data']) : null;
        $this->flOcorreu = (!empty($data['fl_ocorreu'])) ? $data['fl_ocorreu'] : false;
        $this->horaInicio = (!empty($data['hora_inicio'])) ? \DateTime::createFromFormat('H:i', $data['hora_inicio']) : null;
        $this->horaFim = (!empty($data['hora_fim'])) ? \DateTime::createFromFormat('H:i', $data['hora_fim']) : null;
        //$this->id_servidor = (!empty($data['id_servidor'])) ? $data['id_servidor'] : null;

    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
