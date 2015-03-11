<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class CargoRepository extends EntityRepository {

    public function listarTodos() {
        $dql = "SELECT c
                FROM \Core\Entity\Cargo c
                ORDER BY c.descricao";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }
}
