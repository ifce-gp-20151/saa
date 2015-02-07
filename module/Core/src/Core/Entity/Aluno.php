<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aluno
 *
 * @ORM\Table(name="saa.aluno", indexes={@ORM\Index(name="IDX_67C971003AE81E6F", columns={"id_pessoa"}), @ORM\Index(name="IDX_67C9710024BE01DC", columns={"id_curso"})})
 * @ORM\Entity
 */
class Aluno
{
    /**
     * @var integer
     *
     * @ORM\Column(name="matricula", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="aluno_matricula_seq", allocationSize=1, initialValue=1)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="situacao_escolar", type="text", nullable=false)
     */
    private $situacaoEscolar;

    /**
     * @var \Core\Entity\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
     * })
     */
    private $idPessoa;

    /**
     * @var \Core\Entity\Curso
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\Curso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso", referencedColumnName="id")
     * })
     */
    private $idCurso;



    /**
     * Get matricula
     *
     * @return integer 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set situacaoEscolar
     *
     * @param string $situacaoEscolar
     * @return Aluno
     */
    public function setSituacaoEscolar($situacaoEscolar)
    {
        $this->situacaoEscolar = $situacaoEscolar;

        return $this;
    }

    /**
     * Get situacaoEscolar
     *
     * @return string 
     */
    public function getSituacaoEscolar()
    {
        return $this->situacaoEscolar;
    }

    /**
     * Set idPessoa
     *
     * @param \Core\Entity\Pessoa $idPessoa
     * @return Aluno
     */
    public function setIdPessoa(\Core\Entity\Pessoa $idPessoa = null)
    {
        $this->idPessoa = $idPessoa;

        return $this;
    }

    /**
     * Get idPessoa
     *
     * @return \Core\Entity\Pessoa 
     */
    public function getIdPessoa()
    {
        return $this->idPessoa;
    }

    /**
     * Set idCurso
     *
     * @param \Core\Entity\Curso $idCurso
     * @return Aluno
     */
    public function setIdCurso(\Core\Entity\Curso $idCurso = null)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get idCurso
     *
     * @return \Core\Entity\Curso 
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }
}
