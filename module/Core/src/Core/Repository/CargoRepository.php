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
    
    public function listar($restricao = null, $offset = 0) {
        
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select('c');
        $builder->from('\Core\Entity\Cargo', 'c');
        
        if (! empty($restricao)) {
            $builder->where('c.descricao LIKE UPPER(?1)');
            $builder->setParameter(1, '%' . $restricao . '%');
        }
        
        $builder->orderBy('c.descricao', 'ASC');
        $builder->setMaxResults(10);
        $builder->setFirstResult($offset);
        
        $query = $builder->getQuery();
        return $query->getResult();
    }
}
