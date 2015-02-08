<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class AlunoRepository extends EntityRepository {
    
    public function ajaxFindByMatricula($matricula) {
        $dql = "SELECT a.situacaoEscolar, p.nome, c.descricao as curso, pe.descricao as periodo
        FROM Core\Entity\Aluno a
        JOIN a.idPessoa p
        JOIN a.idCurso c
        JOIN c.idPeriodo pe
        WHERE a.matricula = ?1";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $matricula);
        $result = $query->getResult();
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }
}
