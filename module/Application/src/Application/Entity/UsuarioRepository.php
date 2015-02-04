<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository {

    public function listar() {
        $dql = "SELECT u.id, u.login FROM Application\Entity\Usuario u";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getScalarResult();
    }
}
