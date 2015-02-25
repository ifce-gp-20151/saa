<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Table(name="saa.curso", indexes={@ORM\Index(name="IDX_CA3B40ECAD8B6D9D", columns={"id_periodo"})})
 * @ORM\Entity(repositoryClass="Core\Repository\CursoRepository")
 */
class Curso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="curso_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var \Core\Entity\Periodo
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Periodo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periodo", referencedColumnName="id")
     * })
     */
    private $idPeriodo;



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
     * @return Curso
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
     * Set idPeriodo
     *
     * @param \Core\Entity\Periodo $idPeriodo
     * @return Curso
     */
    public function setIdPeriodo(\Core\Entity\Periodo $idPeriodo = null)
    {
        $this->idPeriodo = $idPeriodo;

        return $this;
    }

    /**
     * Get idPeriodo
     *
     * @return \Core\Entity\Periodo
     */
    public function getIdPeriodo()
    {
        return $this->idPeriodo;
    }
}
