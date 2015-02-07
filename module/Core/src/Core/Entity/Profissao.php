<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profissao
 *
 * @ORM\Table(name="saa.profissao")
 * @ORM\Entity(repositoryClass="Core\Repository\ProfissaoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Profissao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="saa.profissao_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=50, nullable=false)
     */
    private $descricao;

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
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function upcase() {
        $this->descricao = mb_strtoupper($this->descricao, 'UTF-8');
    }
    
    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->descricao = (!empty($data['descricao'])) ? $data['descricao'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
