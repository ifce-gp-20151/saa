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

    public function buscarPor($idAcompanhamento) {
        $stmt = $this->getEntityManager()
                   ->getConnection()
                   ->prepare("SELECT a.id, a.matricula, a.motivo, a.encaminhado,
            to_char(a.data_criacao, 'DD/MM/YYYY') as data_criacao, al.situacao_escolar,
            p.id, p.nome, p.rg, p.sexo, to_char(p.dt_nascimento, 'DD/MM/YYYY') as dt_nascimento,
            extract(year FROM age(current_date, p.dt_nascimento)) as idade,
            p.cpf, c.descricao AS curso, pr.descricao AS periodo,
            ec.descricao AS estado_civil, fl_ativo, pro.descricao AS profissao
            FROM saa.acompanhamento a
            INNER JOIN saa.aluno al ON a.matricula = al.matricula
            INNER JOIN saa.pessoa p ON al.id_pessoa = p.id
            INNER JOIN saa.curso c ON al.id_curso = c.id
            INNER JOIN saa.periodo pr ON c.id_periodo = pr.id
            INNER JOIN saa.estado_civil ec ON p.id_estado_civil = ec.id
            LEFT JOIN saa.atividade_remunerada ar ON p.id = ar.id_pessoa
            LEFT JOIN saa.profissao pro ON ar.id_profissao = pro.id
            WHERE a.id = :id");
        $stmt->bindValue('id', $idAcompanhamento);
        $stmt->execute();
        return $stmt->fetch();
    }

}
