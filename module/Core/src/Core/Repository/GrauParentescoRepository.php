<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class GrauParentescoRepository extends EntityRepository {

    public function ajaxBuscarGrauParentesco($term) {
        $dql = "SELECT p.id, p.descricao as text
                FROM \Core\Entity\GrauParentesco p
                WHERE UPPER(p.descricao) LIKE UPPER( ?1 )";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, '%' . $term . '%');

        return $query->getScalarResult();

    }
}
