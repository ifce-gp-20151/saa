<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class AgendaRepository extends EntityRepository {

    public function listarPorAcompanhamento($idAcompanhamento) {
      $stmt = $this->getEntityManager()
                 ->getConnection()
                 ->prepare("SELECT TO_CHAR( ag.data, 'DD/MM/YYYY' ) as data, ag.hora_inicio,
                    ag.hora_fim
                    FROM saa.agenda ag
                    INNER JOIN saa.agenda_acompanhamento aa on ag.id = aa.id_agenda
                    WHERE aa.id_acompanhamento = :id");
      $stmt->bindValue('id', $idAcompanhamento);
      $stmt->execute();
      return $stmt->fetchAll();
    }

    public function listar() {
      $stmt = $this->getEntityManager()
                 ->getConnection()
                 ->prepare("SELECT TO_CHAR( ag.data, 'DD/MM/YYYY' ) as data, ag.hora_inicio,
                    ag.hora_fim
                    FROM saa.agenda ag");
      $stmt->execute();
      return $stmt->fetchAll();
    }

}
