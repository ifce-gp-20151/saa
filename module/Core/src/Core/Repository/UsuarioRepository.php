<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository {

    public function listar() {
        $dql = "SELECT u.id, u.login FROM Core\Entity\Usuario u";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getScalarResult();
    }
}
