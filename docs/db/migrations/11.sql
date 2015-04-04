START TRANSACTION;

-- REMOVA TODAS AS LINHAS DA TABELA saa.acompanhamento_individual ANTES DE EXECUTAR

ALTER TABLE saa.acompanhamento_individual ADD COLUMN passphrase character varying(8) NOT NULL;

COMMIT;
