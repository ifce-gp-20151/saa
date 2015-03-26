<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class AgendaRepository extends EntityRepository {

    public function listarPorAcompanhamento($idAcompanhamento) {
        $sql = "SELECT ag.id, TO_CHAR( ag.data, 'DD/MM/YYYY' ) as data, ag.hora_inicio,
           ag.hora_fim
           FROM saa.agenda ag
           INNER JOIN saa.agenda_acompanhamento aa on ag.id = aa.id_agenda
           WHERE aa.id_acompanhamento = :id
           and ag.fl_ocorreu = false";
        $stmt = $this->getEntityManager()
                 ->getConnection()
                 ->prepare($sql);
        $stmt->bindValue('id', $idAcompanhamento);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listar() {
        $sql = "SELECT ag.id, TO_CHAR( ag.data, 'DD/MM/YYYY' ) as data, ag.hora_inicio,
           ag.hora_fim
           FROM saa.agenda ag";
        $stmt = $this->getEntityManager()
                 ->getConnection()
                 ->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function isHorarioDisponivel( $agenda, $id_servidor ) {
    /*    $sql = "SELECT count(*) as quantidade_encontros
           FROM saa.agenda ag
           INNER JOIN saa.agenda_acompanhamento ac on ac.id_agenda = ag.id
           INNER JOIN saa.acompanhamento a on a.id = ac.id_acompanhamento
           WHERE ag.data = :data
           and ag.hora_inicio = :hora_inicio
           and ag.hora_fim = :hora_fim
           and a.id_servidor = :id_servidor
           or ( :hora_inicio between ag.hora_inicio and ag.hora_fim - '00:01'
           and data = :data and a.id_servidor = :id_servidor)";
    */

        $sql = "SELECT count(*) as quantidade_encontros
                FROM saa.agenda ag
                INNER JOIN saa.agenda_acompanhamento ac on ac.id_agenda = ag.id
                INNER JOIN saa.acompanhamento a on a.id = ac.id_acompanhamento
                WHERE

                ((:hora_inicio between ag.hora_inicio and ag.hora_fim - '00:01') or
                (:hora_fim between ag.hora_inicio and ag.hora_fim - '00:01') or
                (:hora_inicio <= ag.hora_inicio and :hora_fim >= ag.hora_fim - '00:01')) and
                data = :data and a.id_servidor = :id_servidor
                and ag.fl_ocorreu = false";

        $stmt = $this->getEntityManager()
                   ->getConnection()
                   ->prepare($sql);

        $stmt->bindValue('data', $agenda->getData()->format("Y-m-d"));
        $stmt->bindValue('hora_inicio', $agenda->getHoraInicio()->format("H:i"));
        $stmt->bindValue('hora_fim', $agenda->getHoraFim()->format("H:i"));
        $stmt->bindValue('id_servidor', $id_servidor );
        $stmt->execute();
        $rowSet = $stmt->fetch();

        if( $rowSet[ 'quantidade_encontros' ] > 0 ) {
            return false;
        } else {
            return true;
        }
    }

    public function ocorreAgendamento( $id_agendamento ) {

        $sql = "UPDATE saa.agenda
                SET fl_ocorreu = true
                WHERE id = :id_agendamento";

        $stmt = $this->getEntityManager()
                   ->getConnection()
                   ->prepare($sql);
        $stmt->bindValue('id_agendamento', $id_agendamento );
        $stmt->execute();

    }

}
