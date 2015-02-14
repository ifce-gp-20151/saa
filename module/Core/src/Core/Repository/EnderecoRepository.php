<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class EnderecoRepository extends EntityRepository {

    public function listarPor($idAluno) {

        $dql = "SELECT e.logradouro, e.numero, e.cep, e.complemento,
            b.descricao as bairro, c.descricao as cidade, uf.sigla
            FROM Core\Entity\Pessoa p
            JOIN p.idEndereco e
            JOIN e.idBairro b
            JOIN b.idCidade c
            JOIN c.idUf uf
            WHERE p.id = ?1";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $idAluno);
        return $query->getScalarResult();
    }
}
