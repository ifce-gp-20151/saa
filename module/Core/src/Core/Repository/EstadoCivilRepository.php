<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class EstadoCivilRepository extends EntityRepository {

    public function listarTodos() {
        $dql = "SELECT ec
                FROM \Core\Entity\EstadoCivil ec
                ORDER BY ec.descricao";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }
}
