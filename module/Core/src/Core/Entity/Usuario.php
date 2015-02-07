<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="saa.usuario", indexes={@ORM\Index(name="IDX_2A8F60F0D60322AC", columns={"role_id"})})
 * @ORM\Entity(repositoryClass="Core\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=70, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=100, nullable=false)
     */
    private $senha;

    /**
     * @var \Core\Entity\Servidor
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Core\Entity\Servidor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @var \Core\Entity\AclRoles
     *
     * @ORM\ManyToOne(targetEntity="Core\Entity\AclRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;



    /**
     * Set login
     *
     * @param string $login
     * @return Usuario
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set senha
     *
     * @param string $senha
     * @return Usuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get senha
     *
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set id
     *
     * @param \Core\Entity\Servidor $id
     * @return Usuario
     */
    public function setId(\Core\Entity\Servidor $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \Core\Entity\Servidor
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param \Core\Entity\AclRoles $role
     * @return Usuario
     */
    public function setRole(\Core\Entity\AclRoles $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Core\Entity\AclRoles
     */
    public function getRole()
    {
        return $this->role;
    }
}
