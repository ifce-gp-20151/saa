<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class ProfissaoRepository extends EntityRepository {

    public function listar($restricao = null, $offset = 0) {

        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select('p');
        $builder->from('\Core\Entity\Profissao', 'p');

        if (! empty($restricao)) {
            $builder->where('p.descricao LIKE UPPER(?1)');
            $builder->setParameter(1, '%' . $restricao . '%');
        }

        $builder->orderBy('p.descricao', 'ASC');
        $builder->setMaxResults(10);
        $builder->setFirstResult($offset);

        $query = $builder->getQuery();
        return $query->getResult();
    }

    public function ajaxBuscarProfissao($term) {
        $dql = "SELECT p.id, p.descricao as text
                FROM \Core\Entity\Profissao p
                WHERE UPPER(p.descricao) LIKE UPPER( ?1 )";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, '%' . $term . '%');

        return $query->getScalarResult();

    }
}
