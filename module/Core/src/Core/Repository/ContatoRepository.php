<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class ContatoRepository extends EntityRepository {



    public function listarPorFamiliar($id_familiar) {

        $sql = "SELECT c.id AS id_contato, c.contato, df.nome, df.id AS id_dados_familiares, tc.descricao AS tipo_contato
                FROM saa.contato AS c
                INNER JOIN saa.dados_familiares_contato dfc ON c.id = dfc.id_contato
                INNER JOIN saa.dados_familiares df ON df.id = dfc.id_dados_familiares
                INNER JOIN saa.tipo_contato tc ON tc.id = c.id_tipo_contato
                WHERE df.id = :id_familiar
                ";

        $stmt = $this->getEntityManager()
                 ->getConnection()
                 ->prepare($sql);
        $stmt->bindValue('id_familiar', $id_familiar);
        $stmt->execute();
        return $stmt->fetchAll();

    }
}
