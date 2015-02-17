<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class AcompanhamentoIndividualRepository extends EntityRepository {

    public function buscarNumeroProximoEncontro($id_acompanhamento) {
        $stmt = $this->getEntityManager()
                   ->getConnection()
                   ->prepare("SELECT coalesce(max(numero_encontro), 1) AS max
            FROM saa.acompanhamento_individual WHERE id_acompanhamento = :id_acompanhamento");
        $stmt->bindValue('id_acompanhamento', $id_acompanhamento);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function listarPor($id_acompanhamento) {
        $dql = "SELECT ai.id, ai.numeroEncontro, ai.dataCriacao
            FROM Core\Entity\AcompanhamentoIndividual ai
            JOIN ai.idAcompanhamento a
            WHERE a.id = ?1 ORDER BY ai.dataCriacao DESC";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $id_acompanhamento);
        return $query->getResult();
    }
}
