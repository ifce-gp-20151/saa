<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class CursoRepository extends EntityRepository {

    public function ajaxBuscarCurso($term) {
        $dql = "SELECT c.id, c.descricao as text
                FROM \Core\Entity\Curso c
                WHERE c.descricao LIKE UPPER( ?1 )";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, '%' . $term . '%');

        return $query->getScalarResult();

    }
}
