<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class DadosFamiliaresRepository extends EntityRepository {

    public function listarPor($idAluno) {

        $dql = "SELECT df.nome, df.idade, df.flMora,
            pro.descricao as profissao, gp.descricao as grau_parentesco
            FROM Core\Entity\DadosFamiliares df
            JOIN df.idProfissao pro
            JOIN df.idGrauParentesco gp
            JOIN df.idPessoa p
            WHERE p.id = ?1
            ORDER BY p.nome";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $idAluno);
        return $query->getScalarResult();
    }

    public function listar($restricao = null) {

        $dql = "SELECT p.id as id_pessoa, df.id, df.nome, df.idade, df.flMora,
            pro.descricao as profissao, gp.descricao as grau_parentesco
            FROM Core\Entity\DadosFamiliares df
            JOIN df.idProfissao pro
            JOIN df.idGrauParentesco gp
            JOIN df.idPessoa p ";

        $params = array();
        if (! empty($restricao)) {

             if (preg_match('/\d+/', $restricao)) {
                 $dql .= ' WHERE df.nome = ?1 ';
                 $params[1] = $restricao;
             } else {
                $dql .= ' WHERE UPPER(df.nome) LIKE UPPER(?1) ';
                $params[1] = '%' . $restricao . '%';
            }
        }

        $dql .=  " ORDER BY df.nome ";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters($params);
        return $query->getResult();
    }

}
