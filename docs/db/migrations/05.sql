DROP SEQUENCE saa.profissao_id_seq;
ALTER TABLE saa.profissao ALTER COLUMN descricao TYPE character varying(255);
