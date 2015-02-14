<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class AcompanhamentoRepository extends EntityRepository {

    public function listarPorPsicologo($id) {
        $dql = "SELECT a.id, m.matricula, p.nome, c.descricao as curso,
        pr.descricao as periodo, m.situacaoEscolar, a.dataCriacao
        FROM \Core\Entity\Acompanhamento a
        JOIN a.matricula m
        JOIN m.idPessoa p
        JOIN m.idCurso c
        JOIN c.idPeriodo pr
        WHERE a.idServidor = ?1
        ORDER BY a.dataCriacao DESC";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $id);
        return $query->getResult();
    }
}
