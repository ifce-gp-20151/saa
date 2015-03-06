<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class AgendaRepository extends EntityRepository {

    public function listarPorAcompanhamento($idAcompanhamento) {
        $dql = "SELECT ag.data, ag.horaInicio as hora_inicio, ag.horaFim as hora_fim
        FROM \Core\Entity\Agenda ag
        JOIN ag.idAcompanhamento a";

        $query = $this->getEntityManager()->createQuery($dql);
        //$query->setParameter(1, $id);
        return $query->getScalarResult();
    }

}
